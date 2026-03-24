@extends('layouts.app')
@section('content')
<main class="main-top">
 @include('shared.search-flight-results-form')
<section class="pt-3">
    <div class="container" style="height: 100vh; display: flex; flex-direction: column;">
    {{--  <div class="container-fluid" style="height: 100vh; display: flex; flex-direction: column;">  --}}
        <div class="row flex-grow-1 g-2 g-lg-4">
            <div class="col-lg-8 col-xl-8 ps-xl-5">
                {{-- <div class="col-lg-8 col-xl-8 ps-xl-5" style="overflow-y: scroll; scrollbar-width: none; -ms-overflow-style: none; height: auto;"> --}}
                <style>
                    .col-lg-8::-webkit-scrollbar {
                        display: none;
                    }
                </style>
                @include('shared.flight-results-items')
            </div>
            <div id="map" class="col-lg-4 col-xl-4" style="height: auto;">
                @include('shared.flight-results-map')
            </div>
        </div>
    </div>
</section>
</main>
@endsection
