@extends('layouts.app')

@section('title', 'User List')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>User List</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">User List</h2>
            <p class="section-lead">
                You can manage all users, such as editing, deleting and more.
            </p>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Users</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-header">
                                <a href="" class="btn btn-primary">Add User</a>
                            </div>
                            <div class="float-right">
                                <form method="GET">
                                    <div class="input-group">
                                        <input name="search" type="text" class="form-control" placeholder="Search">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Administrator</td>
                                        <td>
                                            <a href="#" class="btn btn-primary">Edit</a>
                                            <a href="#" class="btn btn-danger">Delete</a>
                                        <td>
                                    </tr>
                                    {{-- @forelse ($users as $index => $user)
                                        <tr>
                                            <td>
                                                {{ $index + $users->firstItem() }}
                                            </td>
                                            <td>{{ $user->name }}
                                                <div class="table-links">
                                                    <a href="#">View</a>
                                                    <div class="bullet"></div>
                                                    <a href="#">Edit</a>
                                                    <div class="bullet"></div>
                                                    <a href="#" class="text-danger">Trash</a>
                                                </div>
                                            </td>
                                            <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                            <td>{{ $user->phone }}</td>
                                            <td>
                                                @if ($user->email_verified_at != null)
                                                    <div class="badge badge-success">Verified</div>
                                                @else
                                                    <div class="badge badge-warning">Unverified</div>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No Data Found</td>
                                        </tr>
                                    @endforelse --}}
                                </table>
                            </div>
                            <div class="float-right">
                                <nav>
                                    <ul class="pagination">
                                        {{-- {{ $users->withQueryString()->links() }} --}}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('sidebar')
