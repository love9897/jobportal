@extends('employee.employee-layout')

@section('content')
    <section>
        <div class="container">
            <div class="main-body">
                <!-- /Breadcrumb -->
                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="{{ Storage::url('public/upload/user/') . $employer->image }}" alt="Admin"
                                        class="rounded-circle" width="150" height="150"
                                        style="border-radius:50%; border:1px solid rgb(3, 54, 163); padding:3px; object-fit:cover;">
                                    <div class="mt-3">
                                        <h4>{{ $employer->name ?? null }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    {{-- change --}}
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <h5 class="text-success py-1 px-4">Company Details</h5>
                                    <hr>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Company</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $data->company_name ?? 'N/A' }}

                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Location</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $data->location ?? 'N/A' }}

                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Company_Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $data->company_phone ?? 'N/A' }}

                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Longitude</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $data->long ?? 'N/A' }}

                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Latitude</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $data->lat ?? 'N/A' }}

                                    </div>
                                </div>
                                <hr>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
