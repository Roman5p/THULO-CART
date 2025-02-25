@extends('backend.layouts.main')

@section('title', 'Product')

@section('main-section')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard / </span> Users</h4>
            <h1>Users</h1>
            <div class="row">
                <div class="col">
                    <a name="" id="" class="btn btn-primary my-2" href="{{ route('admin.users.create') }}"
                        role="button"> + Add Users</a>
                    <div class="card mb-4">
                        <h5 class="card-header">Users List</h5>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">S.N</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Gender</th>
                                            <th scope="cole">Image</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Contact</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr class="">
                                                <td scope ="row">{{ $loop->iteration }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->gender }}</td>
                                                <td><img src="{{ asset('storage/' . $user->profile) }}" alt="User Image" style="width: 50px; height: 50px;"></td>
                                                <td>{{ $user->role }}</td>
                                                <td>{{ $user->contact }}</td>
                                                <td>
                                                    <a name="" id="" class="btn btn-primary"
                                                        href="{{ route('admin.users.edit', $user->id) }}"
                                                        role="button">Edit</a>
                                                    <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                        onclick="return confirm ('Are you sure')" method="post"
                                                        class="d-inline-block">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                        @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection
