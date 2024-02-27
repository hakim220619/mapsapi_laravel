@extends('layouts/layoutMaster')

@section('title', 'Tables - Basic Tables')

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Pemilik /</span> Jasa</h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        {{-- <h5 class="card-header">Table Basic</h5> --}}
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Nama Jasa</th>
                        <th>Jenis jasa</th>
                        <th>Alamat Jasa</th>
                        <th>Image</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($jasa as $a)
                        <tr>
                            <td>{{ $a->name }}</td>
                            <td>{{ $a->nama_jasa }}</td>
                            <td>{{ $a->jenis_jasa }}</td>
                            <td>{{ $a->alamat_jasa }}</td>
                            <td><img src="{{ asset('') }}storage/images/jasa/{{ $a->image }}" alt="section title icon"
                                    class="me-2" style="max-width: 200px; max-height: 200px" /></td>
                            <td>{{ $a->latitude }}</td>
                            <td>{{ $a->longitude }}</td>
                            <td>



                                <button class="dropdown-item" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{ $a->id }}"><i
                                        class="mdi mdi-pencil-outline me-1"></i>
                                </button>


                            </td>
                            <div class="modal fade" id="exampleModal{{ $a->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Jasa</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="formAuthentication" class="mb-3" action="{{ url('/update-pemilik') }}"
                                            enctype="multipart/form-data" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $a->id }}">
                                            <div class="modal-body">
                                                <div class="form-floating form-floating-outline mb-3">

                                                    <input type="text" class="form-control" id="nama_jasa"
                                                        name="nama_jasa" value="{{ $a->nama_jasa }}"
                                                        aria-describedby="emailHelp" placeholder="Enter Nama Jasa">
                                                    <label for="nama_jasa">Nama Jasa</label>
                                                </div>
                                                <div class="form-floating form-floating-outline mb-3">

                                                    <input type="text" class="form-control" id="jenis_jasa"
                                                        name="jenis_jasa" value="{{ $a->jenis_jasa }}"
                                                        aria-describedby="emailHelp" placeholder="Enter Nama Jasa">
                                                    <label for="nama_jasa">Jenis Jasa</label>
                                                </div>
                                                <div class="form-floating form-floating-outline mb-3">

                                                    <input type="text" class="form-control" id="alamat_jasa"
                                                        name="alamat_jasa" value="{{ $a->alamat_jasa }}"
                                                        aria-describedby="emailHelp" placeholder="Enter Nama Jasa">
                                                    <label for="nama_jasa">Alamat Jasa</label>
                                                </div>
                                                <div class="form-floating form-floating-outline mb-3">
                                                    <input type="file" class="form-control" id="image" name="image"
                                                        placeholder="Enter your Image">
                                                    <label for="image">Image</label>
                                                </div>
                                                <div class="form-floating form-floating-outline mb-3">
                                                    <input type="text" class="form-control" id="latitude"
                                                        name="latitude" value="{{ $a->latitude }}"
                                                        placeholder="Enter your Latitude" autofocus>
                                                    <label for="latitude">Latitude</label>
                                                </div>
                                                <div class="form-floating form-floating-outline mb-3">
                                                    <input type="text" class="form-control" id="longitude"
                                                        name="longitude" value="{{ $a->longitude }}"
                                                        placeholder="Enter your Longitude" autofocus>
                                                    <label for="longitude">Longitude</label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- <td><i class="mdi mdi-wallet-travel mdi-20px text-danger me-3"></i><span class="fw-medium">Tours
                                    Project</span></td>
                            <td>Albert Cook</td>
                            <td>
                                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                        class="avatar avatar-xs pull-up" title="Lilian Fuller">
                                        <img src="{{ asset('assets/img/avatars/5.png') }}" alt="Avatar"
                                            class="rounded-circle">
                                    </li>
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                        class="avatar avatar-xs pull-up" title="Sophia Wilkerson">
                                        <img src="{{ asset('assets/img/avatars/6.png') }}" alt="Avatar"
                                            class="rounded-circle">
                                    </li>
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                        class="avatar avatar-xs pull-up" title="Christina Parker">
                                        <img src="{{ asset('assets/img/avatars/7.png') }}" alt="Avatar"
                                            class="rounded-circle">
                                    </li>
                                </ul>
                            </td>
                            <td><span class="badge rounded-pill bg-label-primary me-1">Active</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="mdi mdi-pencil-outline me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="mdi mdi-trash-can-outline me-1"></i> Delete</a>
                                    </div>
                                </div>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
