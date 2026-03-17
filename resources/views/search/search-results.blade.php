@extends('layouts.app-search-results')
@section('content')
<main>
<section class="">
    <div class="container position-relative">
        <!-- Search START -->
        @include('shared.search-results-form')
        <!-- Search END -->
    </div>
</section>
<section class="pt-3">
    <div class="container">
        <div class="row g-2 g-lg-4">
            <!-- Search Results Items (Scrollable vertically with hidden scrollbar) -->
            <div class="col-lg-8 col-xl-8 ps-xl-5" style="height: 600px; overflow-y: scroll; scrollbar-width: none; -ms-overflow-style: none;">
                <!-- Hide scrollbar for Webkit browsers -->
                <style>
                    .col-lg-8::-webkit-scrollbar {
                        display: none;
                    }
                </style>
                @include('shared.search-results-items')
            </div>

            <!-- Search Results Map (Sticky, stays fixed while scrolling) -->
            <div id="map" class="col-lg-4 col-xl-4" style="position: sticky; top: 0; height: 500px;">
                @include('shared.search-results-map')
            </div>
        </div>
    </div>
</section>
</main>
@endsection
