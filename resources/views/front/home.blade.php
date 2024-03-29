@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Landing - Front Pages')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/nouislider/nouislider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/rateyo/rateyo.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/front-page-landing.css') }}" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

@endsection

@section('vendor-script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="{{ asset('assets/vendor/libs/nouislider/nouislider.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
@endsection

@section('page-script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ asset('assets/js/front-page-landing.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/rateyo/rateyo.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>


    {{-- @php
        dd(isset($user));
    @endphp --}}
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/65ca3d490ff6374032cc100f/1hmevuqhk';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->



    <script>
        tampil_data();
        $('#map2').hide();

        function getKeyword(params) {
            // console.log(params);
            // if ("geolocation" in navigator) {
            // Get the user's current location


            // $("#map").html("");
            // document.getElementById('map').innerHTML =
            //     "< div id='map' style='width: 100%; height: 100%;'>";

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
                    $('#show_data').hide();
                    // $('#map2').show();
                    var rand = Math.floor(Math.random() * 10);
                    // console.log(data.data);
                    $('#adddiv').html('<div style="width: 100%; height: 500px;" id="map' + rand + '"></div>');
                    navigator.geolocation.getCurrentPosition(function(position) {
                        const latitude = position.coords.latitude;
                        const longitude = position.coords.longitude;

                        const map2 = L.map('map' + rand + '').setView([latitude, longitude], 10);

                        // console.log(longitude);
                        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                        }).addTo(map2);
                        var iconMarker = L.icon({
                            iconUrl: '{{ asset('assets/img/marker/marker.png') }}',
                            iconSize: [100, 100],
                        })

                        // console.log(data.data);
                        var i;
                        var no = 1;
                        for (i = 0; i < data.data.length; i++) {
                            // function onLocationFound(e) {
                            // console.log(e);
                            L.marker([data.data[i].latitude.replace(/r/g, ''), data.data[i].longitude
                                    .replace(
                                        /r/g, '')
                                ], {
                                    icon: iconMarker,
                                    draggable: false
                                })
                                .bindPopup('Nama Jasa: ' + data.data[i].nama_jasa +
                                    ' <br> Jenis Jasa: ' +
                                    data.data[
                                        i].jenis_jasa + ' <br> Alamat: ' + data.data[i].alamat_jasa +
                                    '<div id="rateYo' + data.data[i].id +
                                    '" style="margin-left: 38px;"></div><br>' +
                                    '<button class="btn btn-primary" onClick="routeLokasiSearch(' + data
                                    .data[
                                        i]
                                    .latitude.replace(/r/g,
                                        '') + ', ' + data.data[i].longitude.replace(/r/g, '') +
                                    ')">Location </button>'
                                )
                                .addTo(map2);
                            // }

                            // map2.on('locationfound', onLocationFound);

                        }
                        $('#show_data2').html(
                            '<h3 class="text-center mb-2"><span class="fw-bold">List</span> Jasa</h3><div class="row gy-5 mt-2" id="dataShow' +
                            rand + '">');
                        var html = '';
                        for (i = 0; i < data.data.length; i++) {
                            // console.log(data.data);
                            html += '<div class="col-lg-3 col-sm-6">' +
                                '<div class="card card-hover-border-primary mt-3 mt-lg-0 shadow-none">' +
                                '<div class="bg-label-primary position-relative team-image-box">' +
                                ' <img src="{{ asset('') }}storage/images/jasa/' + data.data[i]
                                .image +
                                '" alt="section title icon" class="me-2" />' +
                                '</div>' +
                                '<div class="card-body text-center">' +
                                '<h5 class="card-title fw-semibold mb-1">' + data.data[i].nama_jasa +
                                '</h5>' +
                                ' <p class="card-text">' + data.data[i].jenis_jasa + '</p>' +
                                '<div id="rateYo' + data.data[i].id +
                                '" style="margin-left: 40px;"></div>' +
                                '<div class="text-center team-media-icons"><button type="button" class="btn btn-primary" onclick="openModal()"> Chat </button>' +
                                '<button type="button" class="btn btn-success ms-1" onclick="ratingOpen(' +
                                data.data[i]
                                .uid +
                                ')"> Rating </button>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                        }
                        // console.log(html);
                        $('#dataShow' + rand + '').html(html);
                        for (i = 0; i < data.data.length; i++) {
                            if (data.data[i].rating == null) {
                                $("#rateYo" + data.data[i].id + "").rateYo({
                                    rating: 0,
                                    spacing: "10px",
                                    numStars: 5,
                                    minValue: 0,
                                    maxValue: 5,
                                    normalFill: 'black',
                                    ratedFill: 'orange',
                                })
                            } else {
                                $("#rateYo" + data.data[i].id + "").rateYo({
                                    rating: data.data[i].rating,
                                    spacing: "10px",
                                    numStars: 5,
                                    minValue: 0,
                                    maxValue: 5,
                                    normalFill: 'black',
                                    ratedFill: 'orange',
                                })
                            }
                        }
                        var marker2 = L.marker([latitude, longitude], {
                                //icon:iconMarker,
                                draggable: false
                            })
                            .bindPopup('Titik Anda')
                            .addTo(map2);

                    })
                }

            });
        }

        function routeLokasiSearch(lat, long) {

            console.log(lat);
            console.log(long);

            var params = $('#search').val();
            console.log(params);
            var rand = Math.floor(Math.random() * 10);
            // console.log(data.data);
            $('#adddiv').html('<div style="width: 100%; height: 500px;" id="map' + rand + '"></div>');
            navigator.geolocation.getCurrentPosition(function(position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                const map = L.map('map' + rand + '').setView([latitude, longitude], 10);
                // console.log(latitude);
                // console.log(longitude);
                const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map);

                var iconMarker = L.icon({
                    iconUrl: '{{ asset('assets/img/marker/marker.png') }}',
                    iconSize: [100, 100],
                })

                $.ajax({
                    type: 'POST',
                    url: '{{ route('getLotlatNotRouteParams') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        lat: lat,
                        long: long,
                        keywords: params
                    },
                    async: true,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        var control = L.Routing.control({
                            createMarker: function(i, wp, nWps) {
                                return L.marker([data.datalokasi[0].latitude.replace(/r/g,
                                            ''),
                                        data.datalokasi[0].longitude.replace(
                                            /r/g, '')
                                    ], {
                                        icon: iconMarker,
                                        draggable: false
                                    })
                                    .bindPopup('Nama Jasa: ' + data.datalokasi[0]
                                        .nama_jasa +
                                        ' <br> Jenis Jasa: ' +
                                        data.datalokasi[0].jenis_jasa + ' <br> Alamat: ' +
                                        data
                                        .datalokasi[0].alamat_jasa +
                                        '<br>' +
                                        '<div id="rateYo' + data.datalokasi[0].id +
                                        '" style="margin-left: 38px;"></div><br>' +
                                        '<button class="btn btn-primary" onClick="routeLokasi(' +
                                        data.datalokasi[
                                            0].latitude.replace(/r/g,
                                            '') + ', ' + data.datalokasi[0].longitude
                                        .replace(
                                            /r/g, '') +
                                        ')">Location</button>'
                                    )
                                    .addTo(map);

                            },
                            waypoints: [
                                L.latLng(latitude, longitude),
                                L.latLng(lat, long)
                            ],
                            // routeWhileDragging: true
                        }).addTo(map);
                        var i;
                        var r;
                        var no = 1;
                        for (i = 0; i < data.data.length; i++) {


                            L.marker([data.data[i].latitude.replace(/r/g, ''), data.data[i].longitude
                                    .replace(
                                        /r/g, '')
                                ], {
                                    icon: iconMarker,
                                    draggable: false
                                })
                                .bindPopup('Nama Jasa: ' + data.data[i].nama_jasa +
                                    ' <br> Jenis Jasa: ' +
                                    data.data[i].jenis_jasa + ' <br> Alamat: ' + data.data[i]
                                    .alamat_jasa +
                                    '<br>' +
                                    '<div id="rateYo' + data.data[i].id +
                                    '" style="margin-left: 38px;"></div><br>' +
                                    '<button class="btn btn-primary" onClick="routeLokasi(' + data.data[
                                        i].latitude.replace(/r/g,
                                        '') + ', ' + data.data[i].longitude.replace(/r/g, '') +
                                    ')">Location</button>'
                                )
                                .addTo(map);
                            // console.log(data[i].rate);
                            // gfg(data[i].rate);
                        }

                    }
                });

                var marker2 = L.marker([latitude, longitude], {
                        //icon:iconMarker,
                        draggable: false
                    })
                    .bindPopup('Titik Anda')
                    .addTo(map);

            })
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
                            '<div id="rateYo' + data[i].id + '" style="margin-left: 38px;"></div><br>' +
                            '<div class="text-center team-media-icons"><button type="button" class="btn btn-primary" onclick="openModal(' +
                            data[i].uid + ')"> Chat </button>' +
                            '<button type="button" class="btn btn-success ms-1" onclick="ratingOpen(' + data[i]
                            .uid +
                            ')"> Rating </button>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';

                    }
                    // console.log(data[i].rating);
                    $('#show_data').html(html);
                    // $('#datatable').DataTable();
                    for (i = 0; i < data.length; i++) {
                        // console.log(data);
                        if (data[i].rating == null) {
                            $("#rateYo" + data[i].id + "").rateYo({
                                rating: 0,
                                spacing: "10px",
                                numStars: 5,
                                minValue: 0,
                                maxValue: 5,
                                normalFill: 'black',
                                ratedFill: 'orange',
                            })
                        } else {
                            $("#rateYo" + data[i].id + "").rateYo({
                                rating: data[i].rating,
                                spacing: "10px",
                                numStars: 5,
                                minValue: 0,
                                maxValue: 5,
                                normalFill: 'black',
                                ratedFill: 'orange',
                            })
                        }

                    }

                }
            });
        }
        // modalChat();

        function ratingOpen(uid) {

            Swal.fire({
                title: "Give Rating",
                input: "text",
                inputAttributes: {
                    autocapitalize: "off"
                },
                showCancelButton: true,
                confirmButtonText: "Submit",
                showLoaderOnConfirm: true,
                preConfirm: async (rat) => {

                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    var keyw = $('#search').val();
                    // console.log(keyw);
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('giveRating') }}',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            jasa_id: uid,
                            rating: result.value,
                            key: keyw
                        },
                        async: true,
                        dataType: 'json',
                        success: function(data) {
                            Swal.fire("Rating Succes Added");
                            // console.log(data.key);
                            if (data.key == null) {
                                tampil_data();
                            } else {
                                getKeyword(data.key);
                            }
                        }
                    });
                }
            });
        }

        function openModal(uid) {
            // console.log(uid);
            $.ajax({
                type: 'GET',
                url: '{{ route('user.getMessage') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id_admin: uid,
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var htmlChat = '';
                    html +=
                        '<div class="modal fade" id="chatModal" tabindex="-1" aria-hidden="true"><div class="modal-dialog modal-simple modal-pricing"><div class="modal-content p-2 p-md-5"><div class="modal-body py-3 py-md-0"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button><h2>Chat Messages</h2>' +
                        '<div id="chatsmessage"></div>'

                    '</div></div></div></div>'
                    $('#mapsJasa').html(
                        html
                    );
                    for (i = 0; i < data.length; i++) {
                        // console.log(data);
                        if (data[i].type == 'Y') {
                            htmlChat +=
                                '<div class="container123"><p>' +
                                data[i].message + '</p><span class="time-right">' + data[i].created_at +
                                '</span></div>';
                        } else {
                            htmlChat +=
                                '<div class="container123 darker"><p>' +
                                data[i].message + '</p><span class="time-left">' + data[i].created_at +
                                '</span></div>';
                        }


                    }
                    htmlChat +=
                        '<div class="row"><div class="col-md-8"><input type="text" class="form-control" id="message" name="message"><input type="hidden" class="form-control" id="uidadmin" value="' +
                        uid +
                        '"></div> <div class="col-md-4"><button type="button" class="btn btn-primary" onclick="sendMessage()">Send</button> </div></div>';
                    $('#chatsmessage').html(
                        htmlChat
                    );
                    $('#chatModal').modal('show');
                    // console.log(html);


                }
            });

        }

        function close() {
            $('#chatModal').modal('hide');
        }


        function sendMessage() {
            var msg = $('#message').val();
            var uidadmin = $('#uidadmin').val();
            $.ajax({
                type: 'POST',
                url: '{{ route('messgaeSend') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    msg: msg,
                    uidadmin: uidadmin,
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    openModal(data.uid);
                    close();
                }
            });
        }
    </script>

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
                    iconSize: [100, 100],
                })
                $.ajax({
                    type: 'GET',
                    url: '{{ route('user.getLotlat') }}',
                    async: true,
                    dataType: 'json',
                    success: function(data) {
                        var i;
                        var r;
                        var no = 1;
                        for (i = 0; i < data.length; i++) {

                            L.marker([data[i].latitude.replace(/r/g, ''), data[i].longitude.replace(
                                    /r/g, '')], {
                                    icon: iconMarker,
                                    draggable: false
                                })
                                .bindPopup('Nama Jasa: ' + data[i].nama_jasa + ' <br> Jenis Jasa: ' +
                                    data[i].jenis_jasa + ' <br> Alamat: ' + data[i].alamat_jasa +
                                    '<br>' +
                                    '<div id="rateYo' + data[i].id +
                                    '" style="margin-left: 38px;"></div><br>' +
                                    '<button class="btn btn-primary" onClick="routeLokasi(' + data[i]
                                    .latitude.replace(/r/g,
                                        '') + ', ' + data[i].longitude.replace(/r/g, '') +
                                    ')">Location </button>'
                                )
                                .addTo(map);
                            // console.log(data[i].rate);
                            // gfg(data[i].rate);
                        }

                    }
                });

                var marker2 = L.marker([latitude, longitude], {
                        //icon:iconMarker,
                        draggable: false
                    })
                    .bindPopup('Titik Anda')
                    .addTo(map);

            });

            function routeLokasi(lat, long) {
                console.log(lat);
                console.log(long);
                var rand = Math.floor(Math.random() * 10);
                // console.log(data.data);
                $('#adddiv').html('<div style="width: 100%; height: 500px;" id="map' + rand + '"></div>');
                navigator.geolocation.getCurrentPosition(function(position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    const map = L.map('map' + rand + '').setView([latitude, longitude], 10);
                    // console.log(latitude);
                    // console.log(longitude);
                    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                    }).addTo(map);

                    var iconMarker = L.icon({
                        iconUrl: '{{ asset('assets/img/marker/marker.png') }}',
                        iconSize: [100, 100],
                    })

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('getLotlatNotRoute') }}',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            lat: lat,
                            long: long
                        },
                        async: true,
                        dataType: 'json',
                        success: function(data) {
                            var control = L.Routing.control({
                                createMarker: function(i, wp, nWps) {
                                    return L.marker([lat, long], {
                                        icon: iconMarker,
                                        draggable: false
                                    })

                                },
                                waypoints: [
                                    L.latLng(latitude, longitude),
                                    L.latLng(lat, long)
                                ],
                                // routeWhileDragging: true
                            }).addTo(map);
                            var i;
                            var r;
                            var no = 1;
                            for (i = 0; i < data.length; i++) {


                                L.marker([data[i].latitude.replace(/r/g, ''), data[i].longitude.replace(
                                        /r/g, '')], {
                                        icon: iconMarker,
                                        draggable: false
                                    })
                                    .bindPopup('Nama Jasa: ' + data[i].nama_jasa +
                                        ' <br> Jenis Jasa: ' +
                                        data[i].jenis_jasa + ' <br> Alamat: ' + data[i].alamat_jasa +
                                        '<br>' +
                                        '<div id="rateYo' + data[i].id +
                                        '" style="margin-left: 38px;"></div><br>' +
                                        '<button class="btn btn-primary" onClick="routeLokasi(' + data[
                                            i].latitude.replace(/r/g,
                                            '') + ', ' + data[i].longitude.replace(/r/g, '') +
                                        ')">Location</button>'
                                    )
                                    .addTo(map);
                                // console.log(data[i].rate);
                                // gfg(data[i].rate);
                            }

                        }
                    });

                    var marker2 = L.marker([latitude, longitude], {
                            //icon:iconMarker,
                            draggable: false
                        })
                        .bindPopup('Titik Anda')
                        .addTo(map);

                })
            }
        } else {
            console.error("Geolocation is not available in this browser.");
        }
    </script>


@endsection

@section('content')
    <style>
        .container123 {
            border: 2px solid #dedede;
            background-color: #f1f1f1;
            border-radius: 5px;
            padding: 10px;
            margin: 10px 0;
        }

        .darker {
            border-color: #ccc;
            background-color: #ddd;
        }

        .container123::after {
            content: "";
            clear: both;
            display: table;
        }

        .container123 img {
            float: left;
            max-width: 60px;
            width: 100%;
            margin-right: 20px;
            border-radius: 50%;
        }

        .container123 img.right {
            float: right;
            margin-left: 20px;
            margin-right: 0;
        }

        .time-right {
            float: right;
            color: #aaa;
        }

        .time-left {
            float: left;
            color: #999;
        }

        .star {
            font-size: 10vh;
            cursor: pointer;
        }

        .one {
            color: rgb(255, 0, 0);
        }

        .two {
            color: rgb(255, 106, 0);
        }

        .three {
            color: rgb(251, 255, 120);
        }

        .four {
            color: rgb(255, 255, 0);
        }

        .five {
            color: rgb(24, 159, 14);
        }
    </style>

    <div data-bs-spy="scroll" class="scrollspy-example">
        <!-- Hero: Start -->
        <section class="section-py landing-hero">
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
                    <div class="card-body" id="adddiv">
                        <div style="width: 100%; height: 500px;" id="map"></div>
                        {{-- <div style="width: 100%; height: 500px;" id="map2"></div> --}}
                    </div>
                    <div id="mapsJasa"></div>
                </div>
            </div>
        </section>
        <!-- Hero: End -->




        <!-- Our great team: Start -->
        <section id="landingTeam" class="section-py landing-team">
            <div class="container bg-icon-right" id="show_data2">
                <h3 class="text-center mb-2"><span class="fw-bold">List</span> Jasa</h3>
                {{-- <p class="text-center fw-medium mb-3 mb-md-5 pb-3">Who is behind these great-looking interfaces?</p> --}}
                <div class="row gy-5 mt-2" id="show_data">


        </section>

    </div>
@endsection
