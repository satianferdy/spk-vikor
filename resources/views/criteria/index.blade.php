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
                                <a href="{{ route('criteria.create') }}" class="btn btn-primary">Add Criteria</a>
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
                                        <th>Type</th>
                                        <th>Weight</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                    @forelse ($criterion as $cr)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $cr->code }}</td>
                                            <td>{{ $cr->type }}</td>
                                            <td>{{ $cr->weight }}</td>
                                            <td>{{ $cr->description }}</td>
                                            <td>
                                                <a href="{{ route('criteria.edit', $cr->id) }}"
                                                    class="btn btn-primary">Edit</a>
                                                <form action="{{ route('criteria.destroy', $cr->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button onclick="return confirm('confirmasi delete data?')"
                                                        class="btn btn-danger">Delete</button>
                                                </form>
                                            <td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No Data Found</td>
                                        </tr>
                                    @endforelse
                                </table>
                            </div>
                            <div class="float-right">
                                <nav>
                                    <ul class="pagination">
                                        {{-- {{ $criteriaModel->withQueryString()->links() }} --}}
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
