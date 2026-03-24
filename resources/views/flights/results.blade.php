@extends('layouts.app-blank')
@section('content')
<main class="main-top" style="min-height: 100vh;">
 @include('shared.search-flight-results-form')
<section class="pt-3">
    <div class="container" style="height: 100vh; display: flex; flex-direction: column;">
        <div class="row flex-grow-1 g-2 g-lg-4">
            <div class="col-lg-8 col-xl-8 ps-xl-5 results-list">
                @include('shared.flight-results-items')
            </div>
            <div id="map" class="col-lg-4 col-xl-4 results-map">
                @include('shared.flight-results-map')
            </div>
        </div>
    </div>
    <style>
        .results-list {
            max-height: 80vh;
            overflow-y: scroll;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .filters {
            max-height: 80vh;
            overflow-y: scroll;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .results-list::-webkit-scrollbar {
            display: none;
        }
        .results-map {
            position: sticky;
            top: 0;
            height: 100vh;
        }
        .results-map {
            position: sticky;
            top: 0;
            height: 100vh;
        }
    </style>
</section>
</main>
@endsection
