@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Landing - Front Pages')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/nouislider/nouislider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/front-page-landing.css') }}" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/nouislider/nouislider.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/front-page-landing.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    {{-- @php
        dd(isset($user));
    @endphp --}}
    @if (isset($user))
        <script>
            // Check if geolocation is available in the browser
            if ("geolocation" in navigator) {
                // Get the user's current location
                navigator.geolocation.getCurrentPosition(function(position) {
                    // The user's latitude and longitude are in position.coords.latitude and position.coords.longitude
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    // console.log(latitude);

                    const map = L.map('map').setView([-7.614220647215262, 109.28495082260261], 5);

                    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                    }).addTo(map);

                    var iconMarker = L.icon({
                        iconUrl: '{{ asset('assets/img/marker/marker.png') }}',
                        iconSize: [50, 50],
                    })
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('user.getLotlat') }}',
                        async: true,
                        dataType: 'json',
                        success: function(data) {
                            var i;
                            var no = 1;
                            for (i = 0; i < data.length; i++) {
                                L.marker([data[i].latitude.replace(/r/g, ''), data[i].longitude.replace(
                                        /r/g, '')], {
                                        icon: iconMarker,
                                        draggable: true
                                    })
                                    .bindPopup(data[i].nama_jasa)
                                    .addTo(map);


                            }
                        }
                    });
                    var marker2 = L.marker([latitude, longitude], {
                            //icon:iconMarker,
                            draggable: true
                        })
                        .bindPopup('Titik Anda')
                        .addTo(map);

                    // console.log(`Latitude: ${latitude}, Longitude: ${longitude}`);
                }, function(error) {
                    // Handle errors, if any
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            console.error("User denied the request for geolocation.");
                            break;
                        case error.POSITION_UNAVAILABLE:
                            console.error("Location information is unavailable.");
                            break;
                        case error.TIMEOUT:
                            console.error("The request to get user location timed out.");
                            break;
                        case error.UNKNOWN_ERROR:
                            console.error("An unknown error occurred.");
                            break;
                    }
                });
            } else {
                console.error("Geolocation is not available in this browser.");
            }
        </script>
    @else
        <script>
            if ("geolocation" in navigator) {
                // Get the user's current location
                navigator.geolocation.getCurrentPosition(function(position) {
                    // The user's latitude and longitude are in position.coords.latitude and position.coords.longitude
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    const map = L.map('map').setView([-7.614220647215262, 109.28495082260261], 5);

                    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                    }).addTo(map);

                    var iconMarker = L.icon({
                        iconUrl: '{{ asset('assets/img/marker/marker.png') }}',
                        iconSize: [50, 50],
                    })
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('user.getLotlat') }}',
                        async: true,
                        dataType: 'json',
                        success: function(data) {
                            var i;
                            var no = 1;
                            for (i = 0; i < data.length; i++) {
                                L.marker([data[i].latitude.replace(/r/g, ''), data[i].longitude.replace(
                                        /r/g, '')], {
                                        icon: iconMarker,
                                        draggable: true
                                    })
                                    .bindPopup(data[i].nama_jasa)
                                    .addTo(map);


                            }
                        }
                    });



                    var marker2 = L.marker([latitude, longitude], {
                            //icon:iconMarker,
                            draggable: true
                        })
                        .bindPopup('Titik Anda')
                        .addTo(map);

                });
            } else {
                console.error("Geolocation is not available in this browser.");
            }
        </script>
    @endif


@endsection

@section('content')
    <div data-bs-spy="scroll" class="scrollspy-example">
        <!-- Hero: Start -->
        <section id="landingHero" class="section-py landing-hero">
            <div class="col-12">
                <div class="card mb-4">
                    <h5 class="card-header">Marker Circle & Polygon</h5>
                    <div class="card-body">
                        <div style="width: 100%; height: 500px;" id="map"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero: End -->




        <!-- Our great team: Start -->
        <section id="landingTeam" class="section-py landing-team">
            <div class="container bg-icon-right">
                <h6 class="text-center fw-semibold d-flex justify-content-center align-items-center mb-4">
                    <img src="{{ asset('assets/img/front-pages/icons/section-tilte-icon.png') }}" alt="section title icon"
                        class="me-2" />
                    <span class="text-uppercase">our great team</span>
                </h6>
                <h3 class="text-center mb-2"><span class="fw-bold">Supported</span> by Real People</h3>
                <p class="text-center fw-medium mb-3 mb-md-5 pb-3">Who is behind these great-looking interfaces?</p>
                <div class="row gy-5 mt-2">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card card-hover-border-primary mt-3 mt-lg-0 shadow-none">
                            <div class="bg-label-primary position-relative team-image-box">
                                <img src="{{ asset('assets/img/front-pages/landing-page/team-member-1.png') }}"
                                    class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                    alt="human image" />
                            </div>
                            <div class="card-body text-center">
                                <h5 class="card-title fw-semibold mb-1">Sophie Gilbert</h5>
                                <p class="card-text">Project Manager</p>
                                <div class="text-center team-media-icons">
                                    <a href="javascript:void(0);" class="text-heading" target="_blank">
                                        <i class="tf-icons mdi mdi-facebook mdi-24px me-2"></i>
                                    </a>
                                    <a href="javascript:void(0);" class="text-heading" target="_blank">
                                        <i class="tf-icons mdi mdi-twitter mdi-24px me-2"></i>
                                    </a>
                                    <a href="javascript:void(0);" class="text-heading" target="_blank">
                                        <i class="tf-icons mdi mdi-linkedin mdi-24px"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card card-hover-border-danger mt-3 mt-lg-0 shadow-none">
                            <div class="bg-label-danger position-relative team-image-box">
                                <img src="{{ asset('assets/img/front-pages/landing-page/team-member-2.png') }}"
                                    class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                    alt="human image" />
                            </div>
                            <div class="card-body text-center">
                                <h5 class="card-title fw-semibold mb-1">Nannie Ford</h5>
                                <p class="card-text">Development Lead</p>
                                <div class="text-center team-media-icons">
                                    <a href="javascript:void(0);" class="text-heading" target="_blank">
                                        <i class="tf-icons mdi mdi-facebook mdi-24px me-2"></i>
                                    </a>
                                    <a href="javascript:void(0);" class="text-heading" target="_blank">
                                        <i class="tf-icons mdi mdi-twitter mdi-24px me-2"></i>
                                    </a>
                                    <a href="javascript:void(0);" class="text-heading" target="_blank">
                                        <i class="tf-icons mdi mdi-linkedin mdi-24px"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card card-hover-border-success mt-3 mt-lg-0 shadow-none">
                            <div class="bg-label-success position-relative team-image-box">
                                <img src="{{ asset('assets/img/front-pages/landing-page/team-member-3.png') }}"
                                    class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                    alt="human image" />
                            </div>
                            <div class="card-body text-center">
                                <h5 class="card-title fw-semibold mb-1">Chris Watkins</h5>
                                <p class="card-text">Marketing Manager</p>
                                <div class="text-center team-media-icons">
                                    <a href="javascript:void(0);" class="text-heading" target="_blank">
                                        <i class="tf-icons mdi mdi-facebook mdi-24px me-2"></i>
                                    </a>
                                    <a href="javascript:void(0);" class="text-heading" target="_blank">
                                        <i class="tf-icons mdi mdi-twitter mdi-24px me-2"></i>
                                    </a>
                                    <a href="javascript:void(0);" class="text-heading" target="_blank">
                                        <i class="tf-icons mdi mdi-linkedin mdi-24px"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card card-hover-border-info mt-3 mt-lg-0 shadow-none">
                            <div class="bg-label-info position-relative team-image-box">
                                <img src="{{ asset('assets/img/front-pages/landing-page/team-member-4.png') }}"
                                    class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                    alt="human image" />
                            </div>
                            <div class="card-body text-center">
                                <h5 class="card-title fw-semibold mb-1">Paul Miles</h5>
                                <p class="card-text">UI Designer</p>
                                <div class="text-center team-media-icons">
                                    <a href="javascript:void(0);" class="text-heading" target="_blank">
                                        <i class="tf-icons mdi mdi-facebook mdi-24px me-2"></i>
                                    </a>
                                    <a href="javascript:void(0);" class="text-heading" target="_blank">
                                        <i class="tf-icons mdi mdi-twitter mdi-24px me-2"></i>
                                    </a>
                                    <a href="javascript:void(0);" class="text-heading" target="_blank">
                                        <i class="tf-icons mdi mdi-linkedin mdi-24px"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Our great team: End -->






        <!-- Contact Us: End -->
    </div>
@endsection
