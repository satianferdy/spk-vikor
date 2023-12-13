@extends('layouts.app')

@section('title', 'User List')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add Data Alternatif</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">Form Validation</h2>
            <p class="section-lead">Form validation using default from Bootstrap 4</p>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-12">
                    <div class="card">
                        <form>
                            <div class="card-header">
                                <h4>Default Validation</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Your Name</label>
                                    <input type="text" class="form-control" required="" />
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" required="" />
                                </div>
                                <div class="form-group">
                                    <label>Subject</label>
                                    <input type="email" class="form-control" />
                                </div>
                                <div class="form-group mb-0">
                                    <label>Message</label>
                                    <textarea class="form-control" required=""></textarea>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('sidebar')
