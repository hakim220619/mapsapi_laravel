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

                    const map = L.map('map').setView([latitude, longitude], 10);

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

                    const map = L.map('map').setView([latitude, longitude], 10);
                    // console.log(latitude);
                    // console.log(longitude);
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

    <script>
        tampil_data();
        $('#map2').hide();

        function getKeyword(params) {
            console.log(params);
            // if ("geolocation" in navigator) {
            // Get the user's current location

            navigator.geolocation.getCurrentPosition(function(position) {
                // $("#map").html("");
                // document.getElementById('map').innerHTML =
                //     "< div id='map' style='width: 100%; height: 100%;'>";
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                const map2 = L.map('map2').setView([latitude, longitude], 10);
                // console.log(map);
                // if (map != undefined || map != null) {

                //     // map.off();
                //     // map.remove();

                //     const map = L.map('map2').setView([latitude, longitude], 10);
                //     map.invalidateSize();
                //     console.log(map);
                // }
                // // console.log(latitude);
                // console.log(longitude);
                const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map2);
                var iconMarker = L.icon({
                    iconUrl: '{{ asset('assets/img/marker/marker.png') }}',
                    iconSize: [50, 50],
                })
                $.ajax({
                    type: 'GET',
                    url: '{{ route('user.searchgetLotlat') }}',
                    data: {
                        // "_token": "{{ csrf_token() }}",
                        keywords: params
                    },
                    async: true,
                    dataType: 'json',
                    success: function(data) {
                        $('#map').hide();
                        $('#map2').show();


                        // console.log(data);
                        var i;
                        var no = 1;
                        for (i = 0; i < data.length; i++) {
                            L.marker([data[i].latitude.replace(/r/g, ''), data[i].longitude.replace(
                                    /r/g, '')], {
                                    icon: iconMarker,
                                    draggable: true
                                })
                                .bindPopup(data[i].nama_jasa)
                                .addTo(map2);
                        }


                    }
                });
                var marker2 = L.marker([latitude, longitude], {
                        //icon:iconMarker,
                        draggable: true
                    })
                    .bindPopup('Titik Anda')
                    .addTo(map2);
                // console.log('asd');
            })


            // });
            // } else {
            //     console.error("Geolocation is not available in this browser.");
            // }
        }

        function tampil_data() {

            // console.log($("#thajaran_id").val());
            $.ajax({
                type: 'GET',
                url: '{{ route('user.getLotlat') }}',
                async: true,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    var no = 1;
                    for (i = 0; i < data.length; i++) {
                        // console.log(data);
                        html += '<div class="col-lg-3 col-sm-6">' +
                            '<div class="card card-hover-border-primary mt-3 mt-lg-0 shadow-none">' +
                            '<div class="bg-label-primary position-relative team-image-box">' +
                            ' <img src="{{ asset('') }}storage/images/jasa/' + data[i].image +
                            '" alt="section title icon" class="me-2" />' +
                            '</div>' +
                            '<div class="card-body text-center">' +
                            '<h5 class="card-title fw-semibold mb-1">' + data[i].nama_jasa + '</h5>' +
                            ' <p class="card-text">' + data[i].jenis_jasa + '</p>' +
                            '<div class="text-center team-media-icons">' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                    }
                    // console.log(html);
                    $('#show_data').html(html);
                    // $('#datatable').DataTable();


                }
            });
        }
    </script>


@endsection

@section('content')
    <div data-bs-spy="scroll" class="scrollspy-example">
        <!-- Hero: Start -->
        <section id="mapsJasa" class="section-py landing-hero">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="row">
                        <div class="col-md-3">
                            <h5 class="card-header">Mau Cari Jasa? <br>
                                <p>Dapatkan info jasa terdekat dari titik anda</p>

                            </h5>
                        </div>
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-2">
                            <br>
                            <input type="text" class="form-control" id="search" name="search" placeholder="Search"
                                onchange="getKeyword(this.value)">
                        </div>
                    </div>


                    <div class="card-body">
                        <div style="width: 100%; height: 500px;" id="map"></div>
                        <div style="width: 100%; height: 500px;" id="map2"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero: End -->




        <!-- Our great team: Start -->
        <section id="landingTeam" class="section-py landing-team">
            <div class="container bg-icon-right">
                {{-- <h6 class="text-center fw-semibold d-flex justify-content-center align-items-center mb-4">
                    <img src="{{ asset('assets/img/front-pages/icons/section-tilte-icon.png') }}" alt="section title icon"
                        class="me-2" />
                    <span class="text-uppercase">our great team</span>
                </h6> --}}
                <h3 class="text-center mb-2"><span class="fw-bold">List</span> Jasa</h3>
                {{-- <p class="text-center fw-medium mb-3 mb-md-5 pb-3">Who is behind these great-looking interfaces?</p> --}}
                <div class="row gy-5 mt-2" id="show_data">


        </section>
        <!-- Our great team: End -->






        <!-- Contact Us: End -->
    </div>
@endsection
