<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property-read \App\Models\BusAgencies|null $agency
 * @property-read \App\Models\BusFare|null $fare
 * @property-read \App\Models\BusRoutes|null $route
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAccessPoints newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAccessPoints newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAccessPoints query()
 */
	class BusAccessPoints extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $first_name
 * @property string $last_name
 * @property string $phone
 * @property string $email
 * @property string|null $online
 * @property string $status
 * @property string $login_type
 * @property string|null $photo
 * @property string|null $photo_path
 * @property string $address
 * @property string|null $agency_name
 * @property string|null $agency_type
 * @property string|null $agency_registration_number
 * @property string|null $country_region
 * @property string|null $operating_routes
 * @property string|null $agency_description
 * @property string|null $agency_logo
 * @property string|null $license_certifications
 * @property string|null $bank_name
 * @property string|null $branch_name
 * @property string|null $holder_name
 * @property string|null $account_no
 * @property string|null $other_info
 * @property string|null $ifsc_code
 * @property string $creer
 * @property string $modifier
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null $amount
 * @property string|null $reset_password_otp
 * @property string|null $reset_password_otp_modifier
 * @property string|null $deleted_at
 * @property int $is_verified
 * @property string $parcel_delivery
 * @property string|null $zone_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Buses> $buses
 * @property-read int|null $buses_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BusRoutes> $routes
 * @property-read int|null $routes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BusSchedules> $schedules
 * @property-read int|null $schedules_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereAccountNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereAgencyDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereAgencyLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereAgencyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereAgencyRegistrationNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereAgencyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereBranchName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereCountryRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereCreer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereHolderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereIfscCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereIsVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereLicenseCertifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereLoginType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereModifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereOnline($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereOperatingRoutes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereOtherInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereParcelDelivery($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies wherePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereResetPasswordOtp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereResetPasswordOtpModifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusAgencies whereZoneId($value)
 */
	class BusAgencies extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $bus_schedule_id
 * @property string $bookingreference
 * @property string $contact_phone
 * @property string $contact_email
 * @property string|null $total_amount
 * @property string|null $status
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BusPassengers> $passengers
 * @property-read int|null $passengers_count
 * @property-read \App\Models\BusSchedules|null $schedule
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusBookings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusBookings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusBookings query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusBookings whereBookingreference($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusBookings whereBusScheduleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusBookings whereContactEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusBookings whereContactPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusBookings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusBookings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusBookings whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusBookings whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusBookings whereUpdatedAt($value)
 */
	class BusBookings extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $passenger_id
 * @property string $type
 * @property string $unique_identifier
 * @property string $issuing_country_code
 * @property string $expires_on
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \App\Models\BusPassengers|null $passenger
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusDocuments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusDocuments newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusDocuments query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusDocuments whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusDocuments whereExpiresOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusDocuments whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusDocuments whereIssuingCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusDocuments wherePassengerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusDocuments whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusDocuments whereUniqueIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusDocuments whereUpdatedAt($value)
 */
	class BusDocuments extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $agency_id
 * @property int $route_id
 * @property string $pickup
 * @property string $dropoff
 * @property string|null $amount
 * @property string $currency
 * @property string $departure_time
 * @property string $arrival_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BusAgencies $agency
 * @property-read \App\Models\BusPoint|null $dropoffPoint
 * @property-read \App\Models\BusPoint|null $pickupPoint
 * @property-read \App\Models\BusRoutes|null $route
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusFare newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusFare newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusFare query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusFare whereAgencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusFare whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusFare whereArrivalTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusFare whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusFare whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusFare whereDepartureTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusFare whereDropoff($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusFare whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusFare wherePickup($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusFare whereRouteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusFare whereUpdatedAt($value)
 */
	class BusFare extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $booking_id
 * @property int|null $schedule_id
 * @property string $seat
 * @property string|null $seat_price
 * @property string $title
 * @property string $given_name
 * @property string $family_name
 * @property string $email
 * @property string $phone
 * @property string $dob
 * @property string $gender
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \App\Models\BusBookings|null $booking
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BusDocuments> $identityDocuments
 * @property-read int|null $identity_documents_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusPassengers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusPassengers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusPassengers query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusPassengers whereBookingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusPassengers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusPassengers whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusPassengers whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusPassengers whereFamilyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusPassengers whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusPassengers whereGivenName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusPassengers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusPassengers wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusPassengers whereScheduleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusPassengers whereSeat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusPassengers whereSeatPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusPassengers whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusPassengers whereUpdatedAt($value)
 */
	class BusPassengers extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $agency_id
 * @property string $name
 * @property string $iata_code
 * @property string|null $longitude
 * @property string|null $latitude
 * @property string $about
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BusFare> $faresAsDropoff
 * @property-read int|null $fares_as_dropoff_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BusFare> $faresAsPickup
 * @property-read int|null $fares_as_pickup_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusPoint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusPoint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusPoint query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusPoint whereAbout($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusPoint whereAgencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusPoint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusPoint whereIataCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusPoint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusPoint whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusPoint whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusPoint whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusPoint whereUpdatedAt($value)
 */
	class BusPoint extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $agency_id
 * @property string $origin
 * @property string $destination
 * @property string|null $status
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \App\Models\BusAgencies|null $agency
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BusFare> $fares
 * @property-read int|null $fares_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BusSchedules> $schedules
 * @property-read int|null $schedules_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusRoutes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusRoutes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusRoutes query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusRoutes whereAgencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusRoutes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusRoutes whereDestination($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusRoutes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusRoutes whereOrigin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusRoutes whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusRoutes whereUpdatedAt($value)
 */
	class BusRoutes extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $agency_id
 * @property int $bus_id
 * @property int $route_id
 * @property int|null $busfare_id
 * @property int $group_id
 * @property string $departure_date
 * @property string $departure_time
 * @property string $arrival_time
 * @property string $status
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \App\Models\BusAgencies $agency
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BusBookings> $bookings
 * @property-read int|null $bookings_count
 * @property-read \App\Models\Buses $bus
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BusAccessPoints> $busAccessPoints
 * @property-read int|null $bus_access_points_count
 * @property-read \App\Models\BusFare|null $fare
 * @property-read \App\Models\BusSeatLayout|null $layout
 * @property-read \App\Models\BusRoutes $route
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusSchedules newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusSchedules newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusSchedules query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusSchedules whereAgencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusSchedules whereArrivalTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusSchedules whereBusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusSchedules whereBusfareId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusSchedules whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusSchedules whereDepartureDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusSchedules whereDepartureTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusSchedules whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusSchedules whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusSchedules whereRouteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusSchedules whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusSchedules whereUpdatedAt($value)
 */
	class BusSchedules extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $agency_id
 * @property string $name
 * @property string $layout_type
 * @property int $total_seats
 * @property string $layout_json
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusSeatLayout newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusSeatLayout newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusSeatLayout query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusSeatLayout whereAgencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusSeatLayout whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusSeatLayout whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusSeatLayout whereLayoutJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusSeatLayout whereLayoutType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusSeatLayout whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusSeatLayout whereTotalSeats($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BusSeatLayout whereUpdatedAt($value)
 */
	class BusSeatLayout extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $agency_id
 * @property int|null $layout_id
 * @property string $name
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Facility> $facilities
 * @property string $vin_number
 * @property string $plate_number
 * @property string $bus_type
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \App\Models\BusAgencies $agency
 * @property-read int|null $facilities_count
 * @property-read \App\Models\BusSeatLayout|null $layout
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buses newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buses newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buses query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buses whereAgencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buses whereBusType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buses whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buses whereFacilities($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buses whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buses whereLayoutId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buses whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buses wherePlateNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buses whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buses whereVinNumber($value)
 */
	class Buses extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string|null $phone
 * @property string $company
 * @property string|null $url
 * @property string $country
 * @property string|null $address
 * @property string|null $comments
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $created_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactSubmission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactSubmission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactSubmission query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactSubmission whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactSubmission whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactSubmission whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactSubmission whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactSubmission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactSubmission whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactSubmission whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactSubmission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactSubmission whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactSubmission wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactSubmission whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactSubmission whereUrl($value)
 */
	class ContactSubmission extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property float $exchange_rate
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereExchangeRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Currency whereUpdatedAt($value)
 */
	class Currency extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $icon
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facility newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facility newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facility query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facility whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facility whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facility whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facility whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facility whereUpdatedAt($value)
 */
	class Facility extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $booking_id
 * @property string $offer_id
 * @property string $currency
 * @property string $total_amount
 * @property string $tax_amount
 * @property string|null $status
 * @property string|null $booking_reference
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \App\Models\FlightContacts|null $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FlightPassengers> $passengers
 * @property-read int|null $passengers_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightBookings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightBookings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightBookings query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightBookings whereBookingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightBookings whereBookingReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightBookings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightBookings whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightBookings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightBookings whereOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightBookings whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightBookings whereTaxAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightBookings whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightBookings whereUpdatedAt($value)
 */
	class FlightBookings extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $booking_id
 * @property string $email
 * @property string $phone_number
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \App\Models\FlightBookings|null $booking
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightContacts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightContacts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightContacts query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightContacts whereBookingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightContacts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightContacts whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightContacts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightContacts wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightContacts whereUpdatedAt($value)
 */
	class FlightContacts extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $passenger_id
 * @property string $unique_identifier
 * @property string $document_type
 * @property string $issuing_country_code
 * @property string $expires_on
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \App\Models\FlightPassengers|null $passenger
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightIdentityDocuments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightIdentityDocuments newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightIdentityDocuments query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightIdentityDocuments whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightIdentityDocuments whereDocumentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightIdentityDocuments whereExpiresOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightIdentityDocuments whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightIdentityDocuments whereIssuingCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightIdentityDocuments wherePassengerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightIdentityDocuments whereUniqueIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightIdentityDocuments whereUpdatedAt($value)
 */
	class FlightIdentityDocuments extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $booking_id
 * @property string $passenger_id
 * @property string|null $phone_number
 * @property string|null $email
 * @property string|null $born_on
 * @property string|null $title
 * @property string|null $gender
 * @property string $family_name
 * @property string $given_name
 * @property string|null $infant_passenger_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \App\Models\FlightBookings|null $booking
 * @property-read \App\Models\FlightIdentityDocuments|null $identityDocuments
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightPassengers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightPassengers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightPassengers query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightPassengers whereBookingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightPassengers whereBornOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightPassengers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightPassengers whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightPassengers whereFamilyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightPassengers whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightPassengers whereGivenName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightPassengers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightPassengers whereInfantPassengerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightPassengers wherePassengerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightPassengers wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightPassengers whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FlightPassengers whereUpdatedAt($value)
 */
	class FlightPassengers extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $type
 * @property string $title
 * @property string $message
 * @property string|null $read_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereUpdatedAt($value)
 */
	class Notification extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $libelle
 * @property string $image
 * @property string $statut
 * @property string $creer
 * @property string $modifier
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PaymentSetting|null $settings
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereCreer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereLibelle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereModifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentMethod whereUpdatedAt($value)
 */
	class PaymentMethod extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $app_id
 * @property string|null $key
 * @property string|null $clientpublishableKey
 * @property string|null $secret_key
 * @property string|null $merchant_Id
 * @property string|null $merchant_key
 * @property string|null $public_key
 * @property string|null $private_key
 * @property string|null $encryption_key
 * @property string|null $tokenization_key
 * @property string|null $accesstoken
 * @property string|null $callback_url
 * @property string|null $webhook_url
 * @property string|null $cancel_url
 * @property string|null $notify_url
 * @property string|null $return_url
 * @property string $isEnabled
 * @property string|null $isLive
 * @property string|null $isSandboxEnabled
 * @property string $id_payment_method
 * @property string|null $username
 * @property string|null $password
 * @property string|null $tax_type
 * @property string|null $tax_amount
 * @property string $creer
 * @property string $modifier
 * @property string|null $deleted_at
 * @property-read \App\Models\PaymentMethod|null $method
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting whereAccesstoken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting whereAppId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting whereCallbackUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting whereCancelUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting whereClientpublishableKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting whereCreer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting whereEncryptionKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting whereIdPaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting whereIsEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting whereIsLive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting whereIsSandboxEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting whereMerchantKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting whereModifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting whereNotifyUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting wherePrivateKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting wherePublicKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting whereReturnUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting whereSecretKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting whereTaxAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting whereTaxType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting whereTokenizationKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentSetting whereWebhookUrl($value)
 */
	class PaymentSetting extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $name
 * @property string $email
 * @property string|null $avatar
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $provider
 * @property string|null $provider_id
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

