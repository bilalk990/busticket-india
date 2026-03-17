<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Rating;
use App\Models\UsersCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    /**
     * Store a new rating for a booking.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $bookingId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $bookingId)
    {
        try {
            Log::info('Rating submission started', [
                'booking_id' => $bookingId,
                'request_data' => $request->all(),
                'user' => Auth::guard('customer')->user() ? [
                    'id' => Auth::guard('customer')->user()->id,
                    'email' => Auth::guard('customer')->user()->email
                ] : null
            ]);

            $booking = Booking::findOrFail($bookingId);
            $user = Auth::guard('customer')->user();

            // Validate that the user is authenticated
            if (!$user) {
                Log::warning('Unauthenticated rating attempt', [
                    'booking_id' => $bookingId,
                    'ip' => $request->ip()
                ]);
                return response()->json(['error' => 'Please login to rate this trip'], 401);
            }

            // Validate that the user owns the booking
            if ($booking->user_id !== $user->id) {
                Log::warning('Unauthorized rating attempt', [
                    'booking_id' => $bookingId,
                    'user_id' => $user->id,
                    'booking_user_id' => $booking->user_id
                ]);
                return response()->json(['error' => 'You can only rate your own trips'], 403);
            }

            // Validate that the booking is confirmed
            if ($booking->status !== 'confirmed') {
                Log::warning('Attempt to rate non-confirmed trip', [
                    'booking_id' => $bookingId,
                    'status' => $booking->status
                ]);
                return response()->json(['error' => 'Can only rate confirmed trips'], 422);
            }

            // Validate that the booking hasn't been rated already
            if ($booking->ratingValue) {
                Log::warning('Attempt to rate already rated trip', [
                    'booking_id' => $bookingId,
                    'existing_rating_id' => $booking->rating->id
                ]);
                return response()->json(['error' => 'This booking has already been rated'], 422);
            }

            $validator = Validator::make($request->all(), [
                'rating' => 'required|integer|min:1|max:5',
                'comment' => 'nullable|string|max:1000',
                'rating_details' => 'nullable|array',
                'rating_details.*' => 'integer|min:1|max:5',
            ]);

            if ($validator->fails()) {
                Log::warning('Rating validation failed', [
                    'booking_id' => $bookingId,
                    'errors' => $validator->errors()->toArray()
                ]);
                return response()->json(['error' => $validator->errors()->first()], 422);
            }

            try {
                DB::beginTransaction();

                $rating = new Rating([
                    'booking_id' => $bookingId,
                    'user_id' => $user->id,
                    'agency_id' => $booking->schedule->bus->agency_id,
                    'rating' => $request->rating,
                    'comment' => $request->comment,
                    'rating_details' => $request->rating_details,
                    'is_verified' => true,
                    'is_public' => true,
                ]);

                $rating->save();

                DB::commit();

                Log::info('Rating submitted successfully', [
                    'booking_id' => $bookingId,
                    'rating_id' => $rating->id,
                    'rating_value' => $rating->rating
                ]);

                return response()->json([
                    'message' => 'Rating submitted successfully',
                    'rating' => $rating
                ]);
            } catch (QueryException $e) {
                DB::rollBack();
                Log::error('Database error while saving rating', [
                    'booking_id' => $bookingId,
                    'error' => $e->getMessage(),
                    'sql' => $e->getSql(),
                    'bindings' => $e->getBindings()
                ]);
                return response()->json(['error' => 'Database error while saving rating: ' . $e->getMessage()], 500);
            }

        } catch (\Exception $e) {
            Log::error('Error submitting rating', [
                'booking_id' => $bookingId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'An error occurred while submitting your rating: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get the rating for a booking.
     *
     * @param  int  $bookingId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $rating = $booking->rating;

        if (!$rating) {
            return response()->json(['error' => 'No rating found for this booking'], 404);
        }

        return response()->json($rating);
    }

    /**
     * Update an existing rating.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $bookingId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $rating = $booking->rating;
        $user = Auth::guard('customer')->user();

        if (!$user) {
            return response()->json(['error' => 'Please login to update this rating'], 401);
        }

        if (!$rating) {
            return response()->json(['error' => 'No rating found for this booking'], 404);
        }

        // Validate that the user owns the rating
        if ($rating->user_id !== $user->id) {
            return response()->json(['error' => 'You can only update your own ratings'], 403);
        }

        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
            'rating_details' => 'nullable|array',
            'rating_details.*' => 'integer|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $rating->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
            'rating_details' => $request->rating_details,
        ]);

        return response()->json([
            'message' => 'Rating updated successfully',
            'rating' => $rating
        ]);
    }

    /**
     * Delete a rating.
     *
     * @param  int  $bookingId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $rating = $booking->rating;
        $user = Auth::guard('customer')->user();

        if (!$user) {
            return response()->json(['error' => 'Please login to delete this rating'], 401);
        }

        if (!$rating) {
            return response()->json(['error' => 'No rating found for this booking'], 404);
        }

        // Validate that the user owns the rating
        if ($rating->user_id !== $user->id) {
            return response()->json(['error' => 'You can only delete your own ratings'], 403);
        }

        $rating->delete();

        return response()->json(['message' => 'Rating deleted successfully']);
    }
}
