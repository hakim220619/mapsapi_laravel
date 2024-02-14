@extends('layouts/layoutMaster')

@section('title', 'Chat - Apps')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css') }}" />
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-chat.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/app-chat.js') }}"></script>
    <script>
        function openChart(id_user) {
            // console.log(id_user);
            $('#id_user').val(id_user);
            $.ajax({
                type: 'GET',
                url: '{{ route('chat.getMessageById') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id_user: id_user,
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    var htmlChat = '';
                    for (i = 0; i < data.length; i++) {
                        // console.log(data);
                        if (data[i].type == 'N') {
                            htmlChat += '<li class="chat-message chat-message-right">' +
                                '<div class="d-flex overflow-hidden">' +
                                '<div class="chat-message-wrapper flex-grow-1">' +
                                '<div class="chat-message-text">' +
                                '<p class="mb-0">' + data[i].message + '</p>' +
                                '</div>' +
                                '<div class="text-end text-muted">' +
                                '<i class="mdi mdi-check-all mdi-14px text-success me-1"></i>' +
                                '<small>' + data[i].created_at + '</small>' +
                                '</div>' +
                                '</div>' +
                                '<div class="user-avatar flex-shrink-0 ms-3">' +
                                '<div class="avatar avatar-sm">' +
                                '<img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar" class="rounded-circle">' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</li>';
                        }
                        if (data[i].type == 'Y') {
                            htmlChat += '<li class="chat-message">' +
                                '<div class="d-flex overflow-hidden">' +
                                '<div class="chat-message-wrapper flex-grow-1">' +
                                '<div class="chat-message-text">' +
                                '<p class="mb-0">' + data[i].message + '</p>' +
                                '</div>' +
                                '<div class="text-end text-muted">' +
                                '<i class="mdi mdi-check-all mdi-14px text-success me-1"></i>' +
                                '<small>' + data[i].created_at + '</small>' +
                                '</div>' +
                                '</div>' +
                                '<div class="user-avatar flex-shrink-0 ms-3">' +
                                '<div class="avatar avatar-sm">' +
                                '<img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar" class="rounded-circle">' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</li>';
                        }

                    }
                    $('#listChatbyId').html(
                        htmlChat
                    );
                    var htmlHeader = '';
                    htmlHeader += '<h6 class="m-0">' + data[0].name + '</h6>';
                    $('#htmlHeader').html(
                        htmlHeader
                    );


                }
            });

        }

        function sendMessage() {
            var id_user = $('#id_user').val();
            var msg = $('#message').val();
            // var uidadmin = $('#uidadmin').val();
            $.ajax({
                type: 'POST',
                url: '{{ route('messgaeSend') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    msg: msg,
                    id_user: id_user,
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    openChart(id_user)
                }
            });
        }
    </script>
@endsection

@section('content')
    <div class="app-chat card overflow-hidden">
        <div class="row g-0">
            <!-- Sidebar Left -->
            <div class="col app-chat-sidebar-left app-sidebar overflow-hidden" id="app-chat-sidebar-left">
                <div
                    class="chat-sidebar-left-user sidebar-header d-flex flex-column justify-content-center align-items-center flex-wrap px-4 pt-5">
                    <div class="avatar avatar-xl avatar-online w-px-75 h-px-75">
                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar" class="rounded-circle">
                    </div>
                    <h5 class="mt-3 mb-1">John Doe</h5>
                    <span>UI/UX Designer</span>
                    <i class="mdi mdi-close mdi-20px cursor-pointer close-sidebar" data-bs-toggle="sidebar" data-overlay
                        data-target="#app-chat-sidebar-left"></i>
                </div>
                <div class="sidebar-body px-4 pb-4">
                    <div class="mt-4 mb-3 pt-2">
                        <label for="chat-sidebar-left-user-about" class="text-uppercase fw-medium">About</label>
                        <textarea id="chat-sidebar-left-user-about" class="form-control chat-sidebar-left-user-about mt-3" rows="3"
                            maxlength="120">Dessert chocolate cake lemon drops jujubes.</textarea>
                    </div>
                    <div class="my-3">
                        <p class="text-uppercase fw-medium">Status</p>
                        <div class="d-grid gap-1">
                            <div class="form-check form-check-success">
                                <input name="chat-user-status" class="form-check-input" type="radio" value="active"
                                    id="user-active" checked>
                                <label class="form-check-label" for="user-active">Active</label>
                            </div>
                            <div class="form-check form-check-danger">
                                <input name="chat-user-status" class="form-check-input" type="radio" value="busy"
                                    id="user-busy">
                                <label class="form-check-label" for="user-busy">Busy</label>
                            </div>
                            <div class="form-check form-check-warning">
                                <input name="chat-user-status" class="form-check-input" type="radio" value="away"
                                    id="user-away">
                                <label class="form-check-label" for="user-away">Away</label>
                            </div>
                            <div class="form-check form-check-secondary">
                                <input name="chat-user-status" class="form-check-input" type="radio" value="offline"
                                    id="user-offline">
                                <label class="form-check-label" for="user-offline">Offline</label>
                            </div>
                        </div>
                    </div>
                    <div class="my-3">
                        <p class="text-uppercase fw-medium">Settings</p>
                        <ul class="list-unstyled d-grid gap-2 me-3">
                            <li class="d-flex justify-content-between align-items-center">
                                <div>
                                    <i class='mdi mdi-check-circle-outline me-1 mdi-24px'></i>
                                    <span class="align-middle">Two-step Verification</span>
                                </div>
                                <label class="switch switch-primary me-4 switch-sm">
                                    <input type="checkbox" class="switch-input" checked="" />
                                    <span class="switch-toggle-slider">
                                        <span class="switch-on"></span>
                                        <span class="switch-off"></span>
                                    </span>
                                </label>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <div>
                                    <i class='mdi mdi-bell-outline me-1 mdi-24px'></i>
                                    <span class="align-middle">Notification</span>
                                </div>
                                <label class="switch switch-primary me-4 switch-sm">
                                    <input type="checkbox" class="switch-input" />
                                    <span class="switch-toggle-slider">
                                        <span class="switch-on"></span>
                                        <span class="switch-off"></span>
                                    </span>
                                </label>
                            </li>
                            <li>
                                <i class="mdi mdi-account-outline me-1 mdi-24px"></i>
                                <span class="align-middle">Invite Friends</span>
                            </li>
                            <li>
                                <i class="mdi mdi-delete-outline me-1 mdi-24px"></i>
                                <span class="align-middle">Delete Account</span>
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex mt-4">
                        <button class="btn btn-primary" data-bs-toggle="sidebar" data-overlay
                            data-target="#app-chat-sidebar-left">Logout</button>
                    </div>
                </div>
            </div>
            <!-- /Sidebar Left-->

            <!-- Chat & Contacts -->
            <div class="col app-chat-contacts app-sidebar flex-grow-0 overflow-hidden border-end" id="app-chat-contacts">
                <div class="sidebar-header py-3 px-4 border-bottom">
                    <div class="d-flex align-items-center me-3 me-lg-0">
                        <div class="flex-shrink-0 avatar avatar-online me-3" data-bs-toggle="sidebar"
                            data-overlay="app-overlay-ex" data-target="#app-chat-sidebar-left">
                            <img class="user-avatar rounded-circle cursor-pointer"
                                src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar">
                        </div>
                        <div class="flex-grow-1 input-group input-group-merge rounded-pill">
                            <span class="input-group-text" id="basic-addon-search31"><i
                                    class="mdi mdi-magnify lh-1 mdi-24px"></i></span>
                            <input type="text" class="form-control chat-search-input" placeholder="Search..."
                                aria-label="Search..." aria-describedby="basic-addon-search31">
                        </div>
                    </div>
                    <i class="mdi mdi-close mdi-20px cursor-pointer position-absolute top-0 end-0 mt-2 me-2 fs-4 d-lg-none d-block"
                        data-overlay data-bs-toggle="sidebar" data-target="#app-chat-contacts"></i>
                </div>
                <div class="sidebar-body">

                    <!-- Chats -->
                    <ul class="list-unstyled chat-contact-list" id="chat-list">
                        <li class="chat-contact-list-item chat-contact-list-item-title">
                            <h5 class="text-primary mb-0">Chats</h5>
                        </li>
                        <li class="chat-contact-list-item chat-list-item-0 d-none">
                            <h6 class="text-muted mb-0">No Chats Found</h6>
                        </li>
                        @foreach ($listChat as $a)
                            <li class="chat-contact-list-item">
                                <a class="d-flex align-items-center" onclick="openChart({{ $a->id_user }})">
                                    <div class="flex-shrink-0 avatar avatar-online">
                                        <img src="{{ asset('assets/img/avatars/13.png') }}" alt="Avatar"
                                            class="rounded-circle">
                                    </div>
                                    <div class="chat-contact-info flex-grow-1 ms-3">
                                        <h6 class="chat-contact-name text-truncate m-0">{{ $a->name }}</h6>
                                        {{-- <p class="chat-contact-status text-truncate mb-0">{{ $a->tlp }}</p> --}}
                                    </div>
                                    {{-- <small class="mb-auto">5 Minutes</small> --}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <!-- Contacts -->

                </div>
            </div>
            <!-- /Chat contacts -->

            <!-- Chat History -->
            <div class="col app-chat-history">
                <div class="chat-history-wrapper">
                    <div class="chat-history-header border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex overflow-hidden align-items-center">
                                <i class="mdi mdi-menu mdi-24px cursor-pointer d-lg-none d-block me-3"
                                    data-bs-toggle="sidebar" data-overlay data-target="#app-chat-contacts"></i>
                                <div class="flex-shrink-0 avatar avatar-online">
                                    <img src="{{ asset('assets/img/avatars/4.png') }}" alt="Avatar"
                                        class="rounded-circle" data-bs-toggle="sidebar" data-overlay
                                        data-target="#app-chat-sidebar-right">
                                </div>
                                <div class="chat-contact-info flex-grow-1 ms-3" id="htmlHeader">
                                    {{-- <h6 class="m-0">Felecia Rower</h6>
                                    <span class="user-status">NextJS developer</span> --}}
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <i
                                    class="mdi mdi-phone-outline mdi-24px cursor-pointer d-sm-block d-none me-1 btn btn-text-secondary btn-icon rounded-pill"></i>
                                <i
                                    class="mdi mdi-video-outline mdi-24px cursor-pointer d-sm-block d-none me-1 btn btn-text-secondary btn-icon rounded-pill"></i>
                                <i
                                    class="mdi mdi-magnify mdi-24px cursor-pointer d-sm-block d-none me-1 btn btn-text-secondary btn-icon rounded-pill"></i>
                                <div class="dropdown">
                                    <button class="btn btn-icon btn-text-secondary rounded-pill dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown" aria-expanded="true" id="chat-header-actions"><i
                                            class="mdi mdi-dots-vertical mdi-24px"></i></button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="chat-header-actions">
                                        <a class="dropdown-item" href="javascript:void(0);">View Contact</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Mute Notifications</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Block Contact</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Clear Chat</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Report</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chat-history-body">
                        <ul class="list-unstyled chat-history" id="listChatbyId">
                            {{-- <li class="chat-message chat-message-right">
                                <div class="d-flex overflow-hidden">
                                    <div class="chat-message-wrapper flex-grow-1">
                                        <div class="chat-message-text">
                                            <p class="mb-0">How can we help? We're here for you! 😄</p>
                                        </div>
                                        <div class="text-end text-muted">
                                            <i class='mdi mdi-check-all mdi-14px text-success me-1'></i>
                                            <small>10:00 AM</small>
                                        </div>
                                    </div>
                                    <div class="user-avatar flex-shrink-0 ms-3">
                                        <div class="avatar avatar-sm">
                                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar"
                                                class="rounded-circle">
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="chat-message">
                                <div class="d-flex overflow-hidden">
                                    <div class="user-avatar flex-shrink-0 me-3">
                                        <div class="avatar avatar-sm">
                                            <img src="{{ asset('assets/img/avatars/4.png') }}" alt="Avatar"
                                                class="rounded-circle">
                                        </div>
                                    </div>
                                    <div class="chat-message-wrapper flex-grow-1">
                                        <div class="chat-message-text">
                                            <p class="mb-0">Hey John, I am looking for the best admin template.</p>
                                            <p class="mb-0">Could you please help me to find it out? 🤔</p>
                                        </div>

                                        <div class="text-muted">
                                            <small>10:02 AM</small>
                                        </div>
                                    </div>
                                </div>
                            </li> --}}

                        </ul>
                    </div>
                    <!-- Chat message form -->
                    <div class="chat-history-footer">
                        <form class="form-send-message d-flex justify-content-between align-items-center ">
                            <input class="form-control message-input me-3 shadow-none" id="message"
                                placeholder="Type your message here">
                            <div class="message-actions d-flex align-items-center">
                                <i
                                    class="btn btn-text-secondary btn-icon rounded-pill speech-to-text mdi mdi-microphone mdi-20px cursor-pointer"></i>
                                <label for="attach-doc" class="form-label mb-0">
                                    <i
                                        class="mdi mdi-paperclip mdi-20px cursor-pointer btn btn-text-secondary btn-icon rounded-pill me-2 ms-1"></i>
                                    <input type="file" id="attach-doc" hidden>
                                </label>
                                <input type="hidden" id="id_user">
                                <button class="btn btn-primary d-flex send-msg-btn" onclick="sendMessage()">
                                    <span class="align-middle">Send</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Chat History -->

            <!-- Sidebar Right -->
            <div class="col app-chat-sidebar-right app-sidebar overflow-hidden" id="app-chat-sidebar-right">
                <div
                    class="sidebar-header d-flex flex-column justify-content-center align-items-center flex-wrap px-4 pt-5">
                    <div class="avatar avatar-xl avatar-online w-px-75 h-px-75">
                        <img src="{{ asset('assets/img/avatars/4.png') }}" alt="Avatar" class="rounded-circle">
                    </div>
                    <h5 class="mt-3 mb-1">Felecia Rower</h5>
                    <span>NextJS Developer</span>
                    <i class="mdi mdi-close mdi-20px cursor-pointer close-sidebar d-block" data-bs-toggle="sidebar"
                        data-overlay data-target="#app-chat-sidebar-right"></i>
                </div>
                <div class="sidebar-body px-4">
                    <div class="my-4 pt-2">
                        <p class="text-uppercase fw-medium mb-2">About</p>
                        <p class="mb-0">It is a long established fact that a reader will be distracted by readable
                            content.</p>
                    </div>
                    <div class="my-4">
                        <p class="text-uppercase fw-medium">Personal Information</p>
                        <ul class="list-unstyled d-grid gap-2 mb-0">
                            <li class="d-flex align-items-center">
                                <i class='mdi mdi-email-outline mdi-24px'></i>
                                <span class="align-middle ms-2">josephGreen@email.com</span>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class='mdi mdi-phone mdi-24px'></i>
                                <span class="align-middle ms-2">+1(123) 456 - 7890</span>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class='mdi mdi-clock-outline mdi-24px'></i>
                                <span class="align-middle ms-2">Mon - Fri 10AM - 8PM</span>
                            </li>
                        </ul>
                    </div>
                    <div class="my-4">
                        <p class="text-uppercase fw-medium">Options</p>
                        <ul class="list-unstyled d-grid gap-2">
                            <li class="cursor-pointer d-flex align-items-center">
                                <i class='mdi mdi-bookmark-outline mdi-24px'></i>
                                <span class="align-middle ms-2">Add Tag</span>
                            </li>
                            <li class="cursor-pointer d-flex align-items-center">
                                <i class='mdi mdi-star-outline mdi-24px'></i>
                                <span class="align-middle ms-2">Important Contact</span>
                            </li>
                            <li class="cursor-pointer d-flex align-items-center">
                                <i class='mdi mdi-image-outline mdi-24px'></i>
                                <span class="align-middle ms-2">Shared Media</span>
                            </li>
                            <li class="cursor-pointer d-flex align-items-center">
                                <i class='mdi mdi-delete-outline mdi-24px'></i>
                                <span class="align-middle ms-2">Delete Contact</span>
                            </li>
                            <li class="cursor-pointer d-flex align-items-center">
                                <i class='mdi mdi-block-helper mdi-24px'></i>
                                <span class="align-middle ms-2">Block Contact</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Sidebar Right -->

            <div class="app-overlay"></div>
        </div>
    </div>
@endsection
