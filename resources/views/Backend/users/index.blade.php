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
                                                <td><img src="{{ asset('storage/' . $user->profile) }}" alt="User Image"
                                                        style="width: 50px; height: 50px;"></td>
                                                <td>{{ $user->role }}</td>
                                                <td>{{ $user->contact }}</td>
                                                <td>
                                                    <a name="" id="" class="btn btn-primary"
                                                        href="{{ route('admin.users.edit', $user->id) }}" role="button">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-pencil"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M12.146.854a.5.5 0 0 1 .708 0l2.292 2.292a.5.5 0 0 1 0 .708l-9.793 9.793a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l9.793-9.793zM11.207 3L3 11.207V13h1.793L13 4.793 11.207 3zM12 2.207L13.793 4 12 5.793 10.207 4 12 2.207zM1 13.5V15h1.5l.5-.5H1.5a.5.5 0 0 1-.5-.5z" />
                                                        </svg>
                                                    </a>
                                                    <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                        onclick="return confirm ('Are you sure')" method="post"
                                                        class="d-inline-block">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-trash"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M5.5 5.5A.5.5 0 0 1 6 5h4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5H6a.5.5 0 0 1-.5-.5v-7zM4.118 4a1 1 0 0 1 .876-.707h6.012a1 1 0 0 1 .876.707L12.5 4H14a.5.5 0 0 1 0 1h-1v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5H2a.5.5 0 0 1 0-1h1.5l.618-1zM5.5 4a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.5-.5h-4z" />
                                                            </svg>
                                                        </button>
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
