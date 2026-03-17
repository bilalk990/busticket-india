@extends('layouts.app-partner')
@section('title', $title)
@section('content')
<main class="main-top">
    <div class="p-4 p-sm-5" style="background-image: url({{ asset('assets/images/background.jpg') }}); background-repeat: no-repeat; background-size: cover;">
        <div class="pt-0 pb-5 row justify-content-between">
            <div class="pb-5 mb-0 col-md-7 col-lg-8 col-xxl-7 mb-lg-5">
                <h2 class="text-white text-head">{{ $title }}</h2>
            </div>
        </div>
    </div>
    <section class="py-0">
        <div class="container position-relative">
            <div class="p-4 bg-light rounded-3 position-relative p-sm-5">
                <figure class="position-absolute top-50 start-50 d-none d-lg-block mt-n4 ms-9">
                    <svg class="fill-primary" width="138px" height="33px">
                        <path	d="M105.158,32.490 L107.645,20.515 L101.600,21.873 L108.218,14.263 L110.496,2.974 L137.327,32.728 L105.158,32.490 ZM97.722,13.092 C96.678,12.477 95.604,11.881 94.529,11.319 L94.235,11.166 L94.543,10.576 L94.837,10.730 C95.922,11.296 97.006,11.898 98.060,12.519 L98.346,12.687 L98.009,13.260 L97.722,13.092 ZM91.250,9.714 C90.131,9.202 89.001,8.723 87.890,8.290 L87.581,8.170 L87.822,7.550 L88.132,7.671 C89.254,8.108 90.396,8.592 91.527,9.109 L91.829,9.247 L91.553,9.852 L91.250,9.714 ZM84.453,7.073 C83.279,6.699 82.117,6.374 80.943,6.092 L80.620,6.014 L80.776,5.368 L81.099,5.445 C82.287,5.730 83.465,6.060 84.655,6.439 L84.971,6.539 L84.770,7.173 L84.453,7.073 ZM77.372,5.388 C76.150,5.201 74.933,5.073 73.757,5.007 L73.425,4.988 L73.462,4.324 L73.794,4.343 C74.992,4.409 76.230,4.540 77.473,4.730 L77.802,4.781 L77.701,5.438 L77.372,5.388 ZM66.526,5.421 L66.199,5.480 L66.080,4.826 L66.407,4.766 C67.599,4.550 68.838,4.405 70.090,4.336 L70.422,4.318 L70.458,4.982 L70.126,5.000 C68.902,5.068 67.690,5.209 66.526,5.421 ZM59.574,7.498 L59.267,7.625 L59.014,7.010 L59.321,6.883 C60.448,6.418 61.621,6.003 62.809,5.646 L63.128,5.551 L63.318,6.188 L63.000,6.283 C61.833,6.633 60.681,7.042 59.574,7.498 ZM59.311,8.479 C60.126,9.473 60.795,10.540 61.300,11.649 L61.438,11.952 L60.833,12.228 L60.695,11.925 C60.214,10.868 59.575,9.851 58.797,8.901 L58.586,8.644 L59.100,8.222 L59.311,8.479 ZM54.714,31.225 L54.415,31.370 L54.126,30.771 L54.425,30.626 C55.435,30.137 56.398,29.436 57.287,28.542 L57.522,28.306 L57.993,28.775 L57.759,29.011 C56.816,29.959 55.792,30.703 54.714,31.225 ZM56.229,6.392 C55.322,5.672 54.309,5.004 53.218,4.408 L52.926,4.248 L53.245,3.665 L53.537,3.824 C54.662,4.439 55.706,5.128 56.643,5.871 L56.903,6.078 L56.489,6.599 L56.229,6.392 ZM56.268,8.312 L56.584,8.897 L56.292,9.055 C55.219,9.636 54.178,10.276 53.199,10.957 L52.926,11.147 L52.546,10.601 L52.819,10.411 C53.819,9.715 54.881,9.063 55.976,8.470 L56.268,8.312 ZM51.033,32.098 C50.331,32.098 49.622,32.004 48.925,31.819 C48.925,31.819 48.924,31.819 48.923,31.818 C48.397,31.678 47.868,31.483 47.351,31.238 L47.051,31.096 L47.336,30.495 L47.636,30.637 C48.117,30.865 48.608,31.046 49.095,31.176 C49.096,31.176 49.096,31.176 49.097,31.176 C49.737,31.347 50.389,31.433 51.034,31.433 L51.366,31.433 L51.366,32.098 L51.033,32.098 ZM47.808,15.784 L47.592,16.037 L47.087,15.605 L47.303,15.352 C48.086,14.437 48.962,13.546 49.905,12.704 L50.154,12.483 L50.596,12.979 L50.348,13.200 C49.426,14.022 48.572,14.892 47.808,15.784 ZM49.926,2.908 C48.822,2.493 47.656,2.136 46.459,1.846 L46.136,1.768 L46.293,1.121 L46.616,1.200 C47.836,1.495 49.031,1.861 50.160,2.285 L50.471,2.402 L50.237,3.024 L49.926,2.908 ZM44.153,21.953 L44.048,22.268 L43.418,22.058 L43.523,21.742 C43.892,20.634 44.428,19.496 45.115,18.362 L45.287,18.077 L45.856,18.421 L45.683,18.706 C45.022,19.798 44.507,20.891 44.153,21.953 ZM42.888,1.188 C41.701,1.034 40.482,0.940 39.265,0.907 L38.933,0.898 L38.951,0.233 L39.283,0.242 C40.523,0.275 41.764,0.372 42.974,0.528 L43.303,0.571 L43.218,1.230 L42.888,1.188 ZM32.021,1.426 L31.694,1.482 L31.582,0.827 L31.910,0.770 C33.121,0.564 34.357,0.414 35.583,0.326 L35.915,0.302 L35.962,0.965 L35.630,0.989 C34.426,1.076 33.212,1.223 32.021,1.426 ZM25.072,3.458 L24.766,3.588 L24.506,2.976 L24.812,2.845 C25.949,2.362 27.122,1.942 28.300,1.598 L28.619,1.505 L28.805,2.143 L28.485,2.237 C27.333,2.573 26.185,2.984 25.072,3.458 ZM18.761,7.025 L18.490,7.219 L18.103,6.679 L18.374,6.485 C19.387,5.759 20.435,5.087 21.492,4.488 L21.781,4.324 L22.108,4.902 L21.819,5.067 C20.783,5.654 19.754,6.313 18.761,7.025 ZM13.280,11.802 L13.050,12.042 L12.570,11.581 L12.801,11.341 C13.668,10.439 14.568,9.579 15.475,8.786 L15.725,8.567 L16.163,9.067 L15.913,9.286 C15.020,10.067 14.134,10.913 13.280,11.802 ZM8.648,17.428 L8.455,17.699 L7.914,17.314 L8.106,17.043 C8.831,16.023 9.585,15.035 10.349,14.106 L10.560,13.849 L11.073,14.271 L10.862,14.528 C10.109,15.445 9.364,16.420 8.648,17.428 ZM4.796,23.630 L4.637,23.922 L4.053,23.605 L4.212,23.313 C4.803,22.223 5.426,21.149 6.064,20.120 L6.240,19.837 L6.805,20.187 L6.629,20.470 C5.998,21.488 5.381,22.551 4.796,23.630 ZM1.658,30.231 L1.532,30.539 L0.917,30.286 L1.044,29.979 C1.508,28.850 2.011,27.714 2.539,26.603 L2.682,26.303 L3.282,26.588 L3.140,26.888 C2.617,27.989 2.118,29.113 1.658,30.231 ZM43.602,25.437 C43.661,26.716 44.055,27.783 44.772,28.607 L44.990,28.858 L44.488,29.295 L44.270,29.044 C43.452,28.104 43.004,26.901 42.937,25.468 L42.922,25.136 L43.586,25.104 L43.602,25.437 ZM60.942,22.425 L61.047,22.110 L61.678,22.319 L61.573,22.634 C61.175,23.834 60.657,24.979 60.033,26.037 L59.864,26.323 L59.291,25.986 L59.461,25.699 C60.061,24.681 60.559,23.580 60.942,22.425 ZM61.816,17.509 C61.836,16.777 61.795,16.048 61.694,15.341 L61.648,15.012 L62.306,14.918 L62.353,15.247 C62.458,15.991 62.502,16.758 62.480,17.527 C62.467,18.008 62.433,18.500 62.378,18.989 L62.341,19.319 L61.680,19.246 L61.717,18.915 C61.770,18.445 61.803,17.972 61.816,17.509 Z"/>
                    </svg>
                </figure>

                <div class="row align-items-center position-relative">
                    <div class="col-lg-8">
                        <div class="d-flex">
                            <h3>{{ __('lang.time_to_join') }}</h3>
                        </div>
                        <h6><p class="accordion-header font-base">{{ __('lang.join_us_taxi') }}</p> </h6>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="#contact" class="mb-0 btn btn-lg btn-dark">{{ __('lang.contact_us_today') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-0 pt-md-5">
        <div class="container">
            <div class="mb-4 row">
                <div class="text-center col-12">
                    <h2 class="mb-0">{{ __('lang.awesome_vehicles') }}</h2>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-sm-4 col-xl-2">
                    <div class="p-4 text-center shadow card align-items-center h-100">
                        <div class="icon-xxl bg-light rounded-circle">
                            <img src="assets/images/category/cab/seadan.svg" class="w-90px" alt="">
                        </div>
                        <div class="px-0 pb-0 card-body">
                            <h5 class="card-title"><a href="index-cab.html#" class="stretched-link">Sedan</a></h5>
                            <span>(6 Cars)</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-xl-2">
                    <div class="p-4 text-center shadow card align-items-center h-100">
                        <div class="icon-xxl bg-light rounded-circle">
                            <img src="assets/images/category/cab/micro.svg" class="w-90px" alt="">
                        </div>
                        <div class="px-0 pb-0 card-body">
                            <h5 class="card-title"><a href="index-cab.html#" class="stretched-link">Micro</a></h5>
                            <span>(8 Cars)</span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-xl-2">
                    <div class="p-4 text-center shadow card align-items-center h-100">
                        <div class="icon-xxl bg-light rounded-circle">
                            <img src="assets/images/category/cab/suv-2.svg" class="w-90px" alt="">
                        </div>
                        <div class="px-0 pb-0 card-body">
                            <h5 class="card-title"><a href="index-cab.html#" class="stretched-link">CUV</a></h5>
                            <span>(4 Cars)</span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-xl-2">
                    <div class="p-4 text-center shadow card align-items-center h-100">
                        <div class="icon-xxl bg-light rounded-circle">
                            <img src="assets/images/category/cab/suv.svg" class="w-90px" alt="">
                        </div>
                        <div class="px-0 pb-0 card-body">
                            <h5 class="card-title"><a href="index-cab.html#" class="stretched-link">SUV</a></h5>
                            <span>(5 Cars)</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class="pt-0 pt-xl-5">
        <div class="container">
            <div class="mb-3 row mb-sm-4">
                <div class="text-center col-12">
                    <h2>Why Choose Us</h2>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-sm-6 col-lg-4">
                    <div class="p-4 shadow card card-body h-100">
                        <div class="mb-4 icon-lg bg-primary bg-opacity-10 text-primary rounded-circle"><i class="bi bi-lightning-fill fs-5"></i></div>
                        <h5>Advance Booking</h5>
                        <p class="mb-0">Happiness prosperous impression had conviction For every delay in they Extremity now. </p>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <div class="p-4 shadow card card-body h-100">
                        <div class="mb-4 icon-lg bg-success bg-opacity-10 text-success rounded-circle"><i class="fa-solid fa-leaf fs-5"></i></div>
                        <h5>Economical Trip</h5>
                        <p class="mb-0">Extremity now strangers contained breakfast him discourse additions Sincerity.</p>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <div class="p-4 shadow card card-body h-100">
                        <div class="mb-4 icon-lg bg-warning bg-opacity-15 text-warning rounded-circle"><i class="bi bi-life-preserver fs-5"></i></div>
                        <h5>Secure and Safer</h5>
                        <p class="mb-0">Perpetual extremity now strangers contained breakfast him discourse additions.</p>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <div class="p-4 shadow card card-body h-100">
                        <div class="mb-4 icon-lg bg-danger bg-opacity-10 text-danger rounded-circle"><i class="fa-solid fa-car fs-5"></i></div>
                        <h5>Vehicle Options</h5>
                        <p class="mb-0">The Prosperous impression had conviction For every delay in they Extremity now. </p>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <div class="p-4 shadow card card-body h-100">
                        <div class="mb-4 icon-lg bg-orange bg-opacity-10 text-orange rounded-circle"><i class="fa-solid fa-wifi fs-5"></i></div>
                        <h5>Cab Entertainment</h5>
                        <p class="mb-0">Extremity now strangers contained breakfast him discourse additions Sincerity.</p>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <div class="p-4 shadow card card-body h-100">
                        <div class="mb-4 icon-lg bg-info bg-opacity-10 text-info rounded-circle"><i class="fa-solid fa-wheelchair fs-5"></i></div>
                        <h5>Polite Driver</h5>
                        <p class="mb-0">Perpetual extremity now strangers contained breakfast him discourse additions.</p>
                    </div>
                </div>
        </div>
    </section>

    <section class="pt-0 pt-lg-8">
        <div class="container position-relative">
            <div class="bottom-0 position-absolute end-0 z-index-99 me-8 d-none d-lg-block">
                <img src="assets/images/element/01.png" class="mb-3 h-400px" alt="">
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="p-4 overflow-hidden bg-light rounded-2 position-relative p-sm-5">
                        <figure class="bottom-0 position-absolute start-0 mb-n1">
                            <svg class="fill-primary" width="77px" height="77px">
                                <path d="M76.997,41.258 L45.173,41.258 L67.676,63.760 L63.763,67.673 L41.261,45.171 L41.261,76.994 L35.728,76.994 L35.728,45.171 L13.226,67.673 L9.313,63.760 L31.816,41.258 L-0.007,41.258 L-0.007,35.725 L31.816,35.725 L9.313,13.223 L13.226,9.311 L35.728,31.813 L35.728,-0.010 L41.261,-0.010 L41.261,31.813 L63.763,9.311 L67.676,13.223 L45.174,35.725 L76.997,35.725 L76.997,41.258 Z"></path>
                            </svg>
                        </figure>
                        <figure class="top-0 position-absolute start-50 translate-middle ms-9">
                            <svg class="fill-warning" width="191.7px" height="211px" viewBox="0 0 191.7 211" >
                                <path d="M183.4,105.8c0-0.8-0.1-1.4-0.2-2c-0.2-1-0.5-2-0.8-3c-0.3-1.5-1-2.9-1.5-4.3c-0.2-0.5-0.3-1-0.6-1.4 c-0.3-0.4-0.5-0.9-0.7-1.4c0-0.1-0.1-0.2-0.3-0.1c0.1,0.2,0,0.4,0.2,0.7c0.5,1.1,0.9,2.2,1.3,3.3c0.5,1.2,0.8,2.4,1.2,3.6 c0.2,0.7,0.4,1.3,0.6,2C182.7,104,182.8,104.9,183.4,105.8 M120.9,62.4c0.3,0,0.5,0.3,0.8,0.2c0.4-0.1,0.6-0.4,1-0.6 c0.5-0.3,0.6-0.7,0.6-1.2c0-0.4,0.3-0.3,0.5-0.4c0-0.8,0-1.6-0.8-2.2C122.4,59.6,121.1,60.7,120.9,62.4 M148.7,166.5 c-1.9,0.9-5.9,4.1-6.5,5.8c0.5-0.3,1.1-0.4,1.2-1c0.1-0.2,0.4-0.4,0.6-0.6c0.2-0.3,0.6,0,0.9-0.3c0.2-0.3,0.7-0.5,0.9-0.8 c0.2-0.5,0.7-0.5,1-0.8c0.2-0.3,0.5-0.7,0.9-0.8c0.4-0.2,0.4-0.7,0.9-0.7c0.5,0,0.4-0.7,0.8-0.6c0.4-0.5,1.1-0.7,1.5-1.2 c0.1-0.2,0.2-0.3,0-0.5c-0.5,0.1-0.9,0.5-1.3,0.8c-0.3,0-0.4-0.4-0.7-0.2c0,0-0.1,0-0.1,0.1C148.7,165.8,148.7,166.1,148.7,166.5  M159,171.3c-1.2,0.4-1.8,1.5-2.8,2.1c-1,0.6-1.9,1.4-2.9,2.2c-1,0.8-1.9,1.6-2.8,2.4c0.2,0.1,0.4,0.1,0.6,0 c0.7-0.7,1.8-0.6,2.3-1.5c0.7,0,1-0.6,1.4-0.9c0.3-0.3,0.7-0.4,1-0.4c0.3-0.5,0.6-0.8,1-1c0.4-0.2,0.6-0.7,1.1-0.8 c-0.3-0.7-0.3-0.7,0.7-1c0-0.2-0.3-0.2-0.2-0.5C158.6,171.7,158.8,171.5,159,171.3 M127.8,135.8c1.4-1.9,2.6-3.9,3.7-5.9 c1.3-2.5,2.5-5,3.8-7.4c0.1-0.3,0.2-0.5,0-0.8c-2.7,4.5-5,9.1-7.4,13.6C127.7,135.4,127.8,135.6,127.8,135.8 M38.9,72.2 c-0.4,0.4-0.8,0.8-1.2,1.2c-0.3,0.4-0.8,0.7-1.1,1.1c-0.5,0.5-0.8,1.2-1.3,1.7c-1,1-1.9,2.1-2.8,3.2c-1.4,1.7-2.4,3.7-3.6,5.6 c-0.3,0.4-0.5,0.9-0.7,1.4c3.7-4.5,6.8-9.5,10.8-13.8C39.1,72.5,39,72.3,38.9,72.2 M94.1,198.1c0.1,0.4,0.1,0.6,0.2,0.8 c-0.6,0-0.2,0.9-0.9,1c-0.7,0-1.4-0.1-2.2,0.2c-0.4,0.1-0.3,0.3-0.2,0.5c0.6,0,1.2,0.1,1.6-0.3c0.3,0.1,0.1,0.4,0.4,0.5 c0.8,0,1.6,0.2,2.3,0c0.8-0.3,1.5-0.1,2.2-0.2c0.8,0,1.5,0,2.3,0c0.2,0,0.4,0,0.6,0c0.1,0,0.1-0.1,0.2-0.1c0-0.2,0.1-0.4,0-0.6 c-0.7,0.3-0.7,0.2-1.2-0.2c-0.3-0.2,0-0.4,0-0.5c-0.1-0.4-0.6-0.2-0.9-0.4c-0.2-0.1,0.2-0.5-0.2-0.6c-0.2,0.4,0.2,0.9-0.4,1.2 c-0.6-0.3-0.6-0.3-1.1,0.4c0,0.3,0.5,0,0.5,0.4c-0.3,0-0.6,0.2-0.7-0.3c0-0.2-0.5-0.3-0.6-0.4c-0.3,0-0.3,0.3-0.5,0.2 c-0.3-0.2-0.3-0.6-0.5-0.8c0.1-0.2,0.4-0.3,0.4-0.5c-0.4-0.2-0.5,0.3-0.8,0.2C94.4,198.4,94.3,198.3,94.1,198.1 M101.9,167.3 c0-0.9,0.6-1.5,0.8-2.3c0.2-1,0.6-2,0.8-2.9c0.2-0.8,0.5-1.7,0.6-2.5c0.2-0.9,0.5-1.7,0.7-2.6c0.2-0.9,0.4-1.8,0.7-2.7 c0.2-0.5,0.4-1,0.5-1.5c0.1-0.6,0.2-1.2,0.5-1.7c0.3-0.5,0-1.3,0.7-1.7c0.2-0.1,0.1-0.4,0-0.6c0-0.1-0.2-0.2-0.1-0.3 c0.5-0.5,0.3-1.2,0.6-1.8c-0.2,0-0.4,0-0.5,0.3c-0.4,1.3-0.9,2.6-1.4,3.9c-0.1,0.5-0.4,0.9-0.3,1.4c-0.6,1-0.7,2.1-0.9,3.1 c-0.2,1.1-0.6,2.1-0.8,3.2c-0.6,2.3-1.1,4.7-1.9,7C102.1,166.1,101.4,166.6,101.9,167.3 M23.2,154c-0.1-0.3-0.2-0.6-0.4-0.8 c-0.1-0.1-0.3-0.1-0.4-0.3c-0.3-1.1-0.6-2.1-1-3.1c-0.2-0.5-0.3-1.1-0.7-1.5c-1.1-1.2-2.1-2.4-3.2-3.7c-0.1-0.1-0.3-0.2-0.3-0.4 c0-0.3-0.3-0.4-0.4-0.5c-0.1-0.1-0.2-0.4-0.6-0.4c0.7,1.7,1.6,3.2,2.5,4.7c0.9,1.4,1.7,2.9,2.7,4.2c0.4,0.6,0.8,1.3,1.1,2 c0,0.1,0.2,0.1,0.2,0.2C23,154.2,23.1,154.1,23.2,154 M90.5,85.8c0.5-0.1,0.4-0.6,0.7-0.8c0.3-0.2,0.5-0.6,0.8-0.9 c0.9-1.2,1.8-2.4,2.8-3.6c0.7-0.9,1.4-1.7,2-2.6c0.6-0.9,1.4-1.7,1.9-2.6c0.5-0.9,1.4-1.5,1.7-2.5c-0.6-0.4-1-0.4-1.5,0.1 c-0.7,0.8-1.3,1.7-1.9,2.5c-0.4,0.6-0.8,1.2-1.2,1.8c-0.9,1.1-1.6,2.3-2.4,3.5c-0.9,1.4-1.8,2.9-2.8,4.3 C90.5,85.3,90.4,85.5,90.5,85.8 M140.6,176.1c0.5-0.5,1.1-0.7,1.7-1c0.7-0.4,1.3-0.8,1.9-1.2c0.3-0.1,0.2-0.6,0.6-0.5 c0.6-1.2,1.7-1.9,2.8-2.7c0.1,0.1,0.3,0.2,0.4,0.3c0.1-0.1,0.2-0.2,0.3-0.3c-0.1-0.1-0.2-0.2-0.2-0.3c0.2-0.3,0.6,0.1,0.7-0.3 c-0.1-0.1-0.3-0.1-0.4-0.2c0-0.7,0-0.7,0.7-0.9c0.1,0,0.2-0.1,0.2-0.2c0-0.2-0.2-0.3-0.2-0.4c0.1-0.3,0.7-0.4,0.4-0.8 c-0.8,0.3-1.2,0.9-1.8,1.4c-0.7,0.5-1.4,1-2,1.6c-0.6,0.6-1.2,1.1-1.9,1.6c-0.7,0.6-1.5,1.1-2.2,1.7c-0.2,0.2-0.4,0.6-0.7,0.7 c-0.4,0.1-0.6,0.4-0.8,0.6c-0.3,0.3-0.5,0.5-0.8,0.8C139.7,176.4,140.2,175.5,140.6,176.1 M130.5,206.4c0.2,0.2,0.5,0.1,0.7,0 c1-0.4,2-0.7,3-1.1c1.8-0.6,3.5-1.4,5.2-2.2c2.9-1.3,5.8-2.8,8.5-4.4c1.2-0.7,2.3-1.4,3.5-2.2c1.2-0.8,2.4-1.7,3.6-2.6 c1.2-0.8,2.2-1.7,3.3-2.6c0.9-0.7,1.7-1.6,2.7-2.2c0.2-0.1,0.4-0.3,0.5-0.5c0.2-0.2,0.4-0.3,0.5-0.5c-0.3-0.2-0.4,0-0.5,0.1 c-0.5,0.6-1.1,1-1.7,1.4c-1.4,1-2.7,2.2-4.1,3.2c-0.7,0.6-1.5,1.2-2.2,1.7c-1.8,1.1-3.4,2.3-5.2,3.3c-2.4,1.4-4.8,2.7-7.2,4.1 c-0.6,0.3-1.2,0.4-1.8,0.7c-1.2,0.7-2.5,1.3-3.8,1.8c-1,0.3-1.9,0.9-2.9,1.2C131.8,205.8,131.1,206,130.5,206.4 M10.6,79.8 c0.1-0.1,0.3-0.3,0.4-0.4c-0.3-0.2-0.3-0.5-0.4-0.8c0.2-0.5,0.8,0.1,0.9-0.5c-0.1-0.2-0.4,0-0.5-0.3c-0.1-0.4,0.2-0.7,0.4-1 c0.2-0.1,0.4,0.1,0.6-0.1c-0.2-0.3-0.4-0.5-0.1-0.8c0.4-0.6,0.6-1.5,1.2-1.9c0.2-0.2,0.1-0.5,0.4-0.7c-0.2-0.6,0.3-1,0.5-1.4 c0.8-1.4,1.6-2.8,2.4-4.1c1.2-1.8,2.3-3.5,3.6-5.2c0.9-1.1,1.7-2.4,2.8-3.4c0.2-0.2,0.2-0.3,0-0.4c-4.4,3.8-7.5,8.7-10,13.9 c-0.2-0.2-0.3-0.3-0.5-0.2c-0.2,0.4-0.3,0.8-0.6,1.2c-0.3,0.5-0.3,0.8,0,1.2c-0.2,0.5-0.5,0.9-0.6,1.2c-0.2,0-0.5,0-0.5,0.1 c-0.3,0.6-0.8,1.1-0.6,1.8c-0.5,0-0.5,0.5-0.7,0.7c0.2,0.4-0.6,0.7-0.1,1.2c0.3,0.4,0.1,0.7-0.3,0.9c-0.1-0.1-0.1-0.1-0.2-0.2 c0,0.4-0.5,0.5-0.3,0.9c0.2,0.2,0.3-0.3,0.5,0C8.6,82,8.4,82.7,8,83.3c-0.2,0.4-0.2,0.7-0.1,1.1c0.3-0.5,0.3-1,0.9-1.2 c-0.2-0.2-0.4-0.3-0.1-0.6c0.2-0.3,0.5-0.2,0.8-0.3c0.1,0,0.1-0.1,0.1-0.2c-0.1-0.1-0.3-0.1-0.5-0.2c0.5-0.9,0.8-1.8,1.4-2.6 C10.5,79.6,10.5,79.7,10.6,79.8 M21.4,74.7c0.9-0.5,1.3-1.4,2-2c0.5-0.5,1-1.2,1.5-1.8c0.5-0.7,1.1-1.2,1.6-1.9 c0.7-1,1.5-1.9,2.3-2.8c0.2-0.2,0.5-0.4,0.7-0.7c0.3-0.7,1-1.1,1.5-1.7c0.5-0.6,0.8-1.3,1.4-1.7c0.2-0.1,0.4-0.1,0.5-0.4 c0.7-1,1.8-1.7,2.4-2.8c0.5-0.1,0.5-0.6,0.8-0.9c0.3-0.3,0.6-0.6,0.9-0.9c-0.6-0.3-0.7,0.3-1,0.4c-1.2,0.7-2.3,1.5-3.4,2.5 c-2,1.8-3.8,3.9-5.5,6c-0.4,0.5-0.9,1-1.3,1.5c-1.3,1.8-2.6,3.7-3.9,5.6C21.8,73.6,21.6,74,21.4,74.7 M65.2,30.8 c-0.5-0.4-0.8-0.2-1.1,0.1v0.8c-0.7,0-0.6,1-1.2,1.3c-0.6,0.2-1,0.8-1.4,1.3c0.1,0.3,0.5,0.1,0.6,0.4c0.4-0.4,0.7-0.9,1.3-0.8v-0.6 c0.5-0.1,0.8-0.5,1.1-0.8c0.3-0.3,0.9-0.3,0.9-0.9c0.6,0.1,0.6-0.6,1-0.8c0.4-0.2,0.7-0.6,1-0.9c0.3-0.3,0.6-0.8,0.9-1.1 c0.3-0.3,0.5-0.7,0.9-1c0.4-0.3,0.9-0.4,1-0.9c0.2-0.5,0.6-0.7,1-0.9c-0.2-0.8,0.4-0.8,1-0.9c-0.1-0.1-0.2-0.2-0.2-0.2 c0-0.3,0.3-0.1,0.4-0.3c0.2-0.5,0.5-1.1,1-1.4c0.6-0.3,0.8-0.9,1.3-1.3c1.7-1.7,3.4-3.3,5.2-4.9c0.1-0.1,0.2-0.3,0.4-0.3 c0.8-0.2,1.2-0.8,1.8-1.3c0.6-0.5,1.2-1.1,1.8-1.5c1-0.6,1.9-1.2,2.7-2c0.2,0.1,0.2,0.2,0.3,0.2c0.5-0.4,0.8-1,1.3-1.1 c0.6-0.1,0.8-0.6,1.4-1c-1.2,0.1-1.2,0.1-1.8,0.7c-0.4-0.3-0.8,0.3-1.2,0c-0.1,0.4,0,1-0.8,1c-0.1,0-0.3,0.1-0.3,0.2 c-0.3,0.8-1.1,1-1.7,1.4c-0.5,0.4-1,0.8-1.6,0.6c-0.3,0.6-0.6,1-1.1,1.2c-0.1-0.1-0.2-0.2-0.3-0.3c-0.1,0.3-0.3,0.6-0.4,0.9 c-0.4,0-0.8,0.2-1.1,0.4v0.5c-0.4,0.1-0.6,0.3-0.8,0.6c-0.2,0.2-0.6,0.2-0.7,0.7c-0.1,0.3-0.5,0.5-0.7,0.8c-0.3,0.1-0.6-0.1-0.9,0.1 c0.2,0.1,0.4,0.1,0.7,0.3c-0.7,0-0.7,0.5-0.9,0.8c-0.5,0.4-0.9,0.9-1.4,1.4c0.2,0.5-0.5,0.2-0.5,0.6c0,0.5-0.6,0-0.7,0.4 c0.1,0.1,0.1,0.2,0.1,0.1c-0.6,0.6-1.1,1.1-1.7,1.7c-0.1,0.2-0.2-0.3-0.4-0.1c-0.3,0.3,0.6,0.5,0.1,0.8c-0.2,0-0.2-0.3-0.4-0.1 c-0.1,0.2,0.1,0.5-0.2,0.7c-0.1-0.2-0.3-0.3-0.4-0.3C70,25,70,25.1,70,25.2c0,0.5-0.1,1-0.7,1.2c0,0.5-0.5,0.5-0.8,0.8 c-0.2,0.3-0.6,0.5-0.8,0.9C67.1,29.1,66,29.8,65.2,30.8 M1.2,100.8c-0.3-0.2-0.3-0.6-0.2-0.9c0.6-1.7,0.8-3.5,1.3-5.2 C2.6,93.9,2.8,93,3,92c0.1-0.8,0.5-1.4,0.6-2.2C3.7,89,4,88.2,4.2,87.4c0.2-0.7,0.5-1.3,0.7-2c0.3-1,0.6-2,1-3 c0.2-0.6,0.4-1.3,0.8-1.8c0.1-0.1,0.1-0.3,0.1-0.4c0.2-0.6,0.4-1.2,0.7-1.8c0.6-1.2,1.1-2.5,1.7-3.7c0.5-0.9,0.9-1.8,1.3-2.6 c0.4-0.8,0.8-1.7,1.3-2.5c1-1.9,2.2-3.8,3.5-5.6c1-1.4,2.1-2.7,3.2-4c0.9-1.1,1.8-2.1,2.9-3c0.8-0.7,1.6-1.6,2.5-2.2 c0.8-0.6,1.7-1.3,2.5-1.9c1.9-1.4,3.9-2.8,5.9-4.1c1.2-0.8,2.4-1.5,3.6-2.3c1.4-0.9,2.8-1.6,4.2-2.5c0.8-0.5,1.7-1,2.6-1.4 c0.8-0.5,1.7-0.8,2.5-1.3c0.8-0.5,1.7-0.9,2.5-1.3c0.8-0.4,1.5-1,2.5-1.1c0.4-0.7,1.2-0.7,1.8-1c0.6-0.3,1.2-0.6,1.8-1 c0.6-0.4,1.2-0.7,1.8-1.1c1.2-0.7,2.3-1.5,3.5-2.2c0.7-0.4,1.2-1.1,1.9-1.5c1.3-0.9,2.4-2,3.5-3.1c0.4-0.5,0.9-0.9,1.4-1.2 c0.4-0.2,0.4-0.7,0.8-1c0.6-0.5,1-1,1.6-1.5c0.2-0.2,0.3-0.3,0.3-0.6c0.3,0,0.4,0,0.6-0.1c0.2-0.2-0.1-0.2-0.1-0.3 c0.2-0.2,0.3-0.5,0.7-0.6c0.3-0.1,0.3-0.5,0.5-0.7c0.6-0.4,0.7-1.3,1.5-1.5c0.2-0.7,0.8-1.1,1.2-1.7c0.2-0.3,0.5-0.5,0.8-0.6 c0.3-0.1,0.1-0.7,0.6-0.6c0.5-1.1,1.6-1.6,2.4-2.3c1.4-1.2,2.6-2.4,4.2-3.4c0.8-0.5,1.5-1.2,2.2-1.7c1.8-1.1,3.5-2.3,5.4-3.2 c0.8-0.4,1.5-0.9,2.3-1.3c1.7-0.8,3.3-1.5,5.1-2.2c0.3-0.1,0.6-0.3,1-0.2c0.4,0.1,0.6-0.4,0.9-0.5c0.4-0.1,0.9-0.1,1.3-0.3 c0.2-0.1,0.7-0.2,1-0.3c0.9-0.5,2-0.4,2.9-0.9c0.3-0.2,0.8-0.1,1.1-0.1c1.2-0.1,2.4-0.7,3.6-0.6c0.7,0,1.3-0.1,1.9-0.4 c0.2-0.1,0.4-0.2,0.6-0.1c0.6,0.2,1.1,0,1.6,0c0.6,0,1.1-0.3,1.7-0.2c0.6,0,1.3,0.2,1.8,0c1-0.3,2-0.2,3-0.2c0.5,0,1-0.2,1.5,0.2 c0.2,0.2,0.5-0.5,0.8-0.1c0.2,0.2,0.5,0.2,0.7,0c0.3-0.1,0.6,0.3,0.8,0.1c0.2-0.2,0.6-0.4,0.7-0.2c0.2,0.4,0.6-0.1,0.7,0.2 c0,0,0.1,0,0.1,0c1.1-0.1,2.1,0.3,3.2,0.3c0.6,0,1.3,0.1,1.9,0.3c0.6,0.2,1.2,0.3,1.8,0.4c1,0.2,2,0.6,3,0.8c0.3,0,0.3,0.7,0.8,0.3 c0.2,0.4,0.6,0.1,0.9,0.2c0.2,0.1,0.4,0.3,0.6,0.5c0.6-0.1,1.1,0.2,1.7,0.4c1.1,0.4,2.2,0.9,3.3,1.5c1.4,0.8,2.9,1.5,4.1,2.8 c0.2,0.3,0.5,0,0.8,0.2c1.3,1.2,2.8,2.2,3.9,3.6c0.5,0.6,1.2,1,1.7,1.6c1,1.2,2.1,2.3,3,3.6c0.5,0.8,1.1,1.6,1.7,2.4 c1.1,1.7,2.1,3.4,2.8,5.3c0.5,1.4,1,2.8,1.4,4.3c0.1,0.5,0.1,1,0.2,1.5c0.2,0.5,0.2,0.9,0.2,1.4c0,0.4,0.3,0.6,0.3,1 c-0.1,0.3-0.1,0.7,0.2,1c0.1,0.2,0,0.5,0,0.8c0,0.4,0.1,0.8,0,1.2c-0.1,0.3,0.4,0.6,0,0.9c0.4,0.3,0.2,0.7,0.2,1.1 c0,0.4,0,0.7,0,1.1v1.2c0,0.4-0.1,0.8,0,1.1c0.2,0.6,0.1,1.3,0.2,1.9c0.1,0.7,0.1,1.5,0,2.2c0,0.6,0.4,1.2,0.3,1.9 c-0.1,0.6-0.2,1.3,0,1.9c0.2,0.7,0,1.4,0.3,2c0.3,0.7,0,1.4,0.2,2c0.4,1.4,0.4,2.8,0.8,4.2c0.5,1.7,0.7,3.5,1.3,5.2 c0.4,1.1,0.8,2.2,1.1,3.3c0.4,1.1,0.9,2.1,1.5,3.2c0.7,1.3,1.5,2.5,2.4,3.6c0.9,1.2,1.9,2.2,2.8,3.3c0.4,0.5,0.9,1,1.3,1.5 c0.4,0.6,1.1,1,1.5,1.6c1.1,1.5,2.5,2.6,3.5,4.2c1.7,1.6,2.7,3.6,4.1,5.4c0.7,0.9,1.2,1.9,1.7,2.9c1,1.6,1.8,3.3,2.6,5 c0.8,1.6,1.4,3.2,1.9,4.8c0.4,1.2,0.7,2.4,1.1,3.6c0.2,0.5-0.1,1,0.3,1.4c0,1.1,0.6,2.2,0.5,3.3c0.4,0.7,0.3,1.4,0.2,2.1 c0,0.5,0.4,0.9,0.3,1.5c-0.1,0.5-0.2,1.1,0,1.6c0.3,0.8,0.2,1.7,0.2,2.5c0,1.9,0,3.8,0,5.7c0,0.6,0.2,1.3-0.1,1.9 c-0.3,0.5,0.1,1.2-0.3,1.7c-0.1,0.2,0.2,0.3,0.2,0.6c-0.1,0.5,0.2,1.1-0.2,1.6c-0.3,0.4,0.1,1-0.3,1.5c-0.2,0.3,0.6,0.7,0,1 c0.1,0.7-0.1,1.3-0.2,2c-0.1,0.5,0.2,1.1-0.2,1.6c-0.3,0.5,0.2,1.1-0.3,1.6c0.2,0.8-0.3,1.5-0.3,2.3c0,0.6-0.2,1.2-0.3,1.8 c-0.2,0.9-0.4,1.9-0.6,2.8c-0.1,0.3-0.2,0.7-0.3,1c-0.1,0.2-0.3,0.3-0.3,0.5c0,1.5-0.5,2.9-1,4.3c-0.3,0.8-0.5,1.7-0.9,2.6 c-0.1,0.2-0.1,0.6-0.3,0.8c-0.5,0.6-0.7,1.4-0.9,2.2c-0.1,0.4-0.3,0.8-0.5,1.1c0,0.1-0.2,0.1-0.2,0.2c0,1.1-0.7,1.9-1.1,2.8 c-0.4,0.9-1,1.7-1.3,2.6c-0.8,1.8-1.9,3.4-2.7,5.2c-0.3,0.6-0.7,1.1-0.9,1.5c-0.1,0.4,0.2,0.4,0.2,0.8c-0.1,0.3-0.3,0.4-0.7,0.5 c0.2,0.9-0.5,1.5-0.9,2.1c-0.9,1.6-1.9,3.1-3,4.6c-0.7,1-1.4,2-2.2,2.9c-2.6,2.9-5.3,5.6-8.1,8.3c-1.1,1-2.1,2.1-3.3,3 c-1,0.8-1.9,1.7-2.9,2.4c-2.3,1.8-4.7,3.5-7.1,5.1c-1.9,1.2-3.8,2.3-5.8,3.4c-1.2,0.7-2.5,1.4-3.8,1.9c-2.1,1-4.2,1.9-6.3,2.7 c-2,0.8-4.1,1.2-6.1,2.1c-1.3,0-2.5,0.8-3.8,0.8c-0.6,0.4-1.3,0.3-1.9,0.4c-0.6,0.1-1.3,0.4-2,0.3c-0.3,0-0.6,0.3-1,0.2 c-0.3-0.1-0.7-0.1-1,0.2c-0.3-0.4-0.5,0.2-0.8,0.1c-0.3-0.1-0.8-0.1-1.1,0c-0.8,0.3-1.6,0-2.3,0.3c-0.8,0.3-1.5,0-2.2,0.2 c-0.9,0.3-1.7-0.2-2.5,0c-0.1,0-0.2-0.1-0.3-0.2c-0.2,0.1-0.1,0.3-0.2,0.4c-0.3-0.2-0.5-0.4-0.8-0.4c-0.3-0.1-0.7,0-1.2,0 c-0.2,0.2-0.4,0.5-0.6,0.8c-0.5-0.1-0.9,0.1-1.3-0.2c-0.2-0.1-0.6,0.1-0.9,0.1c-0.4,0.1-0.8-0.4-1.1-0.2c-0.4,0.3-0.8,0.2-1.2,0.2 c-3.5,0-7.1,0-10.6,0c-0.4,0-0.8,0.2-1.1-0.2c-0.4,0.6-0.7-0.1-1.1,0c-0.4,0.1-0.7-0.1-1.1-0.2c-0.6-0.2-1.4,0-2.1-0.1 c-0.5,0-0.9,0.1-1.4-0.2c-0.4-0.2-0.9-0.1-1.4-0.2c-0.6-0.1-1.2-0.3-1.8-0.3c-0.4,0-0.8,0-1.3-0.2c-0.3-0.2-0.8,0.1-1.1-0.3 c-0.8,0-1.6-0.3-2.4-0.5c-1.9-0.4-3.7-1-5.6-1.6c-1.5-0.5-3.1-1-4.6-1.6c-0.5-0.2-1-0.4-1.5-0.6c-1.7-0.8-3.5-1.5-5.1-2.4 c-1.4-0.8-2.9-1.6-4.3-2.5c-0.7-0.5-1.6-0.8-2.4-1.3c-1.8-1.1-3.7-2.2-5.4-3.4c-1.5-1.1-3.1-2.1-4.4-3.4c-0.3-0.4-0.8-0.6-1.2-0.9 c-0.4-0.4-0.8-0.9-1.2-1.2c-0.6-0.4-1.1-1-1.6-1.4c-0.4-0.3-0.4-1-1.1-1.2c-0.5-0.1-0.5-0.9-1.1-1.1c-0.2-0.8-1-0.9-1.4-1.6 c-0.4-0.7-1-1.1-1.6-1.7c-0.5-0.5-1.2-1-1.6-1.7c-0.9-1.1-2-2-2.8-3.1c-0.8-1-1.9-1.9-2.5-3.1c-0.1-0.3-0.4-0.2-0.6-0.3 c-0.2-0.2-0.1-0.4-0.3-0.6c-0.7-0.7-1.3-1.4-2-2.2c-0.9-1.1-1.7-2.2-2.6-3.3c-1.4-1.7-2.6-3.5-3.8-5.3c-0.8-1.2-1.5-2.4-2.3-3.6 c-0.9-1.4-1.7-2.8-2.6-4.2c-0.6-1.1-1.2-2.2-1.8-3.3c-0.5-0.9-1-1.7-1.5-2.5c-0.7-1.2-1.4-2.3-2.1-3.5c-1-1.6-1.9-3.3-2.8-5.1 c-0.4-0.9-0.8-1.8-1.2-2.7c-0.2-0.6-0.4-1.2-0.7-1.8c-0.6-1.1-0.8-2.4-1.2-3.5c-0.1-0.4-0.2-0.8-0.3-1.2c-0.1-0.4-0.2-0.7-0.2-1.1 c-0.2-1.1-0.2-2.3-0.7-3.4c0-0.1,0-0.2,0-0.2c0.1-1.3-0.4-2.5-0.3-3.8c0.1-1.1-0.4-2.3-0.2-3.4c-0.4-0.7-0.1-1.4-0.3-2.1 c-0.4-1.8-0.2-3.7-0.2-5.5c0-1.8,0-3.7,0-5.5c0-1.3,0.3-2.5,0.5-3.8c0-0.3,0.2-0.6,0.2-0.9C0.7,101.7,0.9,101.2,1.2,100.8"/>
                            </svg>
                        </figure>
                        <figure class="bottom-0 position-absolute end-0 me-6 mb-n6 d-none d-sm-block">
                            <svg class="fill-info" width="189.7px" height="182.4px" viewBox="0 0 189.7 182.4">
                                <path d="M27.2,37.9c-1.9,1.4-3.2,2.6-4,4.4c-0.2,0.5-0.5,1,0.1,1.4c0.3,0.2,1.1,0,1.1,0C24.5,41.4,28.1,41.2,27.2,37.9 M159.4,152.4c0.3,0.2,0.5,0.4,0.8,0.7c3.5-2.6,6.5-5.7,8.8-9.4c-1.7,1.2-3,2.8-4.5,4.2C162.8,149.5,161.1,150.9,159.4,152.4 M58.2,69.6c3.4-5.2,7.7-9.9,9.5-15.9C62.7,57.9,60.6,63.8,58.2,69.6 M133.9,106.2c-3.2,4-7.8,7.2-8.4,13 C129.3,115.5,132.8,111.6,133.9,106.2 M31.5,33.9c7.9-6.7,17-11.9,24.2-19.6C46.5,19.6,37.9,25.4,31.5,33.9 M154.5,109.5 c-7.4,9.6-14.7,18.9-21.9,28.2C146.6,125.7,153.4,116.8,154.5,109.5 M34.4,70.2c0.4-0.2,0.9-0.4,1-0.7C39,59,46.4,51.4,54.4,44 c4-3.6,6.6-8.5,10.1-13.8C53.4,33.8,34.8,59,34.4,70.2 M86.4,182.4c-42.1-0.7-70.8-24.4-82.7-62.1c-6.8-21.6-3.9-42.6,6-62.4 c9.9-20,24.7-36,44.9-46.3C62.9,7.3,72,4.2,80.8,0.8c3.5-1.3,7.1-1,10.8,0.3c4.6,1.6,9.5,2.3,14.4,2.2c10.8-0.4,20.4,3.1,29.3,8.6 c6,3.7,12.5,6.7,17.9,11.4c16.7,14.6,28.3,32.5,34.9,53.6c2.5,8,1.6,16.1,0.8,24.2c-0.4,4.6-2.3,9.2-3,13.7c-0.6,3.5-3.4,6-3.2,8.3 c0.3,3.5-1.1,5.7-2.5,8.1c-13.2,22.9-34,35.9-58.4,44c-8.7,2.9-17.4,5.3-26.4,6.6C91.9,182.3,88.3,182.3,86.4,182.4"/>
                            </svg>
                        </figure>

                        <div class="row position-relative p-sm-3">
                            <div class="col-lg-7">
                                <h3 class="mb-4">Download our app and access exclusive features</h3>
                                <ul class="mb-4 list-inline position-relative">
                                    <li class="list-inline-item me-3"> <i class="bi bi-patch-check-fill text-success me-1"></i>24/7 Customer Support</li>
                                    <li class="list-inline-item me-3"> <i class="bi bi-patch-check-fill text-success me-1"></i>Ride Safely</li>
                                    <li class="list-inline-item"> <i class="bi bi-patch-check-fill text-success me-1"></i>Top Rated Driver - Partner</li>
                                </ul>
                                <div class="gap-3 hstack">
                                    <a href="index-cab.html#"> <img src="assets/images/element/google-play.svg" class="h-50px" alt=""> </a>
                                    <a href="index-cab.html#"> <img src="assets/images/element/app-store.svg" class="h-50px" alt=""> </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section class="pt-0 pt-lg-5">
        <div class="container">
            <div class="row">
                <div class="mx-auto col-lg-10 col-xl-8">
                    <h2 class="mb-4 text-center">Frequently Asked Questions</h2>
                    <div class="accordion accordion-icon accordion-bg-light" id="accordionFaq">
                        <div class="mb-3 accordion-item">
                            <h6 class="accordion-header font-base" id="heading-1">
                                <button class="rounded accordion-button fw-bold collapsed pe-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                                    How Does it Work?
                                </button>
                            </h6>
                            <div id="collapse-1" class="accordion-collapse collapse show" aria-labelledby="heading-1" data-bs-parent="#accordionFaq">
                                <div class="pb-0 mt-3 accordion-body">
                                    Yet remarkably appearance gets him his projection. Diverted endeavor bed peculiar men the not desirous. Acuteness abilities ask can offending furnished fulfilled sex. Warrant fifteen exposed ye at mistake. Blush since so in noisy still built up an again. As young ye hopes no he place means. Partiality diminution gay yet entreaties admiration. In mention perhaps attempt pointed suppose. Unknown ye chamber of warrant of Norland arrived.
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 accordion-item">
                            <h6 class="accordion-header font-base" id="heading-2">
                                <button class="rounded accordion-button fw-bold collapsed pe-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
                                    What are monthly tracked users?
                                </button>
                            </h6>
                            <div id="collapse-2" class="accordion-collapse collapse" aria-labelledby="heading-2" data-bs-parent="#accordionFaq">
                                <div class="pb-0 mt-3 accordion-body">
                                    What deal evil rent by real in. But her ready least set lived spite solid. September how men saw tolerably two behavior arranging. She offices for highest and replied one venture pasture. Applauded no discovery in newspaper allowance am northward. Frequently partiality possession resolution at or appearance unaffected me. Engaged its was the evident pleased husband. Ye goodness felicity do disposal dwelling no. First am plate jokes to began to cause a scale. Subjects he prospect elegance followed no overcame possible it on. Improved own provided blessing may peculiar domestic. Sight house has sex never. No visited raising gravity outward subject my cottage Mr be.
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 accordion-item">
                            <h6 class="accordion-header font-base" id="heading-3">
                                <button class="rounded accordion-button fw-bold collapsed pe-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
                                    What if I go with my prepaid  monthly
                                </button>
                            </h6>
                            <div id="collapse-3" class="accordion-collapse collapse" aria-labelledby="heading-3" data-bs-parent="#accordionFaq">
                                <div class="pb-0 mt-3 accordion-body">
                                    Post no so what deal evil rent by real in. But her ready least set lived spite solid. September how men saw tolerably two behavior arranging. She offices for highest and replied one venture pasture. Applauded no discovery in newspaper allowance am northward. Frequently partiality possession resolution at or appearance unaffected me. Engaged its was the evident pleased husband. Ye goodness felicity do disposal dwelling no. First am plate jokes to began to cause a scale. Subjects he prospect elegance followed no overcame possible it on. Improved own provided blessing may peculiar domestic. Sight house has sex never. No visited raising gravity outward subject my cottage Mr be. Hold do at tore in park feet near my case. Invitation at understood occasional sentiments insipidity inhabiting in. Off melancholy alteration principles old. Is do speedily kindness properly oh. Respect article painted cottage he is offices parlors.
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 accordion-item">
                            <h6 class="accordion-header font-base" id="heading-4">
                                <button class="rounded accordion-button fw-bold collapsed pe-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                                    What is the difference between cabs and taxi
                                </button>
                            </h6>
                            <div id="collapse-4" class="accordion-collapse collapse" aria-labelledby="heading-4" data-bs-parent="#accordionFaq">
                                <div class="pb-0 mt-3 accordion-body">
                                    <p>What deal evil rent by real in. But her ready least set lived spite solid. September how men saw tolerably two behavior arranging. She offices for highest and replied one venture pasture. Applauded no discovery in newspaper allowance am northward. Frequently partiality possession resolution at or appearance unaffected me. Engaged its was the evident pleased husband. Ye goodness felicity do disposal dwelling no. First am plate jokes to began to cause a scale. Subjects he prospect elegance followed no overcame possible it on. Improved own provided blessing may peculiar domestic. Sight house has sex never. No visited raising gravity outward subject my cottage Mr be.</p>
                                    <p class="mb-0">At the moment, we only accept Credit/Debit cards and Paypal payments. Paypal is the easiest way to make payments online. While checking out your order. Be sure to fill in correct details for fast & hassle-free payment processing.	</p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 accordion-item">
                            <h6 class="accordion-header font-base" id="heading-5">
                                <button class="rounded accordion-button fw-bold collapsed pe-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-5" aria-expanded="false" aria-controls="collapse-5">
                                    How can I check the fare for my Booking ride?
                                </button>
                            </h6>
                            <div id="collapse-5" class="accordion-collapse collapse" aria-labelledby="heading-5" data-bs-parent="#accordionFaq">
                                <div class="pb-0 mt-3 accordion-body">
                                    Post no so what deal evil rent by real in. But her ready least set lived spite solid. September how men saw tolerably two behavior arranging. She offices for highest and replied one venture pasture. Applauded no discovery in newspaper allowance am northward. Frequently partiality possession resolution at or appearance unaffected me. Engaged its was the evident pleased husband. Ye goodness felicity do disposal dwelling no. First am plate jokes to began to cause a scale. Subjects he prospect elegance followed no overcame possible it on. Improved own provided blessing may peculiar domestic. Sight house has sex never. No visited raising gravity outward subject my cottage Mr be. Hold do at tore in park feet near my case. Invitation at understood occasional sentiments insipidity inhabiting in. Off melancholy alteration principles old. Is do speedily kindness properly oh. Respect article painted cottage he is offices parlors.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" id="contact" style="background-color: white;">
        <div class="container py-5">
            <div class="mb-4 text-center">
                <h2>Get in touch</h2>
                <p>Let us know a few details about your company, and we'll take a look at what we can do to start selling more tickets together.</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form class="mt-4" method="POST" action="/contact">
                @csrf
                <div class="row">
                    <div class="mb-4 col-md-6 form-control-bg-light">
                        <label class="form-label">First name *</label>
                        <input type="text" class="form-control" name="first_name" required>
                    </div>
                    <div class="mb-4 col-md-6 form-control-bg-light">
                        <label class="form-label">Last name *</label>
                        <input type="text" class="form-control" name="last_name" required>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-4 col-md-6 form-control-bg-light">
                        <label class="form-label">Your email *</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-4 col-md-6 form-control-bg-light">
                        <label class="form-label">Phone</label>
                        <input type="tel" class="form-control" name="phone">
                    </div>
                </div>

                <div class="row">
                    <div class="mb-4 col-md-6 form-control-bg-light">
                        <label class="form-label">Company *</label>
                        <input type="text" class="form-control" name="company" required>
                    </div>
                    <div class="mb-4 col-md-6 form-control-bg-light">
                        <label class="form-label">URL</label>
                        <input type="url" class="form-control" name="url">
                    </div>
                </div>

                <div class="row">
                    <div class="mb-4 col-md-6 form-control-bg-light">
                        <label class="form-label">Country *</label>
                        <select class="form-select form-control" name="country" required>
                            <option hidden>Select country</option>
                            <option value="AF">Afghanistan</option>
                            <option value="AL">Albania</option>
                            <option value="DZ">Algeria</option>
                            <option value="US">USA</option>
                            <option value="ZM">Zambia</option>
                            <option value="ZW">Zimbabwe</option>
                        </select>
                    </div>
                    <div class="mb-4 col-md-6 form-control-bg-light">
                        <label class="form-label">Address</label>
                        <input type="address" class="form-control" name="address">
                    </div>
                </div>

                <div class="mb-4 form-control-bg-light">
                    <label class="form-label">Comments</label>
                    <textarea class="form-control" name="comments" rows="5"></textarea>
                </div>

                {{--  <div class="mb-4">
                    {!! NoCaptcha::renderJs() !!}
                    {!! NoCaptcha::display() !!}
                </div>  --}}

                <div>
                    <button class="mb-0 btn btn-lg btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </section>
    @endsection

