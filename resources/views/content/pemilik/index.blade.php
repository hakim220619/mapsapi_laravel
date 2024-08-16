@extends('layouts/layoutMaster')

@section('title', 'Tables - Basic Tables')

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Pemilik</h4>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Basic Bootstrap Table -->
    <div class="card">
        {{-- <h5 class="card-header">Table Basic</h5> --}}
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Tlp</th>
                        <th>Alamat</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($pemilik as $a)
                        <tr>
                            <td>{{ $a->name }}</td>
                            <td>{{ $a->username }}</td>
                            <td>{{ $a->email }}</td>
                            <td>{{ $a->tlp }}</td>
                            <td>{{ $a->alamat }}</td>
                            <td>{{ $a->role }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $a->id }}"><i
                                                class="mdi mdi-pencil-outline me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"
                                            onclick="confirmDelete({{ $a->id }})"><i
                                                class="mdi mdi-trash-can-outline me-1"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal{{ $a->id }}" tabindex="-1"
                            aria-labelledby="editModalLabel{{ $a->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $a->id }}">Edit Pemilik</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('pemilik.update', $a->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Full Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ $a->name }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" class="form-control" id="username" name="username"
                                                    value="{{ $a->username }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    value="{{ $a->email }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="tlp" class="form-label">Tlp</label>
                                                <input type="text" class="form-control" id="tlp" name="tlp"
                                                    value="{{ $a->tlp }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <input type="text" class="form-control" id="alamat" name="alamat"
                                                    value="{{ $a->alamat }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="role" class="form-label">Role</label>
                                                <input type="text" class="form-control" id="role" name="role"
                                                    value="{{ $a->role }}">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Edit -->
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to delete route
                    window.location.href = '/pemilik/delete/' + id;
                }
            })
        }
    </script>
@endsection
