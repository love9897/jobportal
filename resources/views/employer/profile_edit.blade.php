@extends('employer-layout.default')
@section('content')
    {{-- @php
        dd($data);
    @endphp --}}
    <section>
        @if (Session::has('success'))
            <div class="alert alert-success text-center text-capitalize"><i class="fa-solid fa-check-double fa-lg"
                    style="color: #00ff40;"></i> {{ Session::get('success') }}</div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger text-center text-capitalize"><i class="fa-solid fa-circle-exclamation fa-lg"
                    style="color: #fb0000;"></i> {{ Session::get('error') }}</div>
        @endif
        <div class="container rounded bg-white mt-5 mb-5 card">

            <div class="row">
                <div class=" d-flex justify-content-center my-3">
                    <h4 class="text-right fs-3" style="font-family: poppins">Update Your Profile </h4>

                </div>
                <hr />
            </div>
            {{-- form --}}
            <form action="{{ route('subject.edit') }}" method="post">
                @csrf
                <div class="row">

                    <div class="col-md-3 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img
                                class="rounded-circle mt-5" width="170px" height="170px"
                                src="{{ Storage::url('public/upload/user/') . $data->image }}"
                                style=" object-fit: cover;"><span class="font-weight-bold">{{ $data->name }}</span><span
                                class="text-black-50">{{ $data->email }}</span><span> </span></div>
                    </div>

                    <div class="col-md-5 border-right">
                        <div class="p-3 py-4">
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels-input">Company Name </label>
                                    <input type="text" class="form-control" placeholder="Company Name" name="company"
                                        value="{{ isset($data->profile->company_name) ? $data->profile->company_name : old('company') }} ">
                                    @error('company')
                                        <div class="text-danger pt-2 px-3">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels-input">Address</label>
                                    <input type="text" class="form-control" placeholder="Company address" name="address"
                                        value="{{ isset($data->profile->location) ? $data->profile->location : old('address') }}">
                                    @error('address')
                                        <div class="text-danger pt-2 px-3">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels-input">Longitude</label>
                                    <input type="text" class="form-control" placeholder="Longitude" name="longitude"
                                        value="{{ isset($data->profile->lat) ? $data->profile->lat : old('longitude') }}">
                                    @error('longitude')
                                        <div class="text-danger pt-2 px-3">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="labels-input">Latitude</label>
                                    <input type="text" class="form-control" placeholder="Latitude" name="latitude"
                                        value="{{ isset($data->profile->long) ? $data->profile->long : old('latitude') }}">
                                    @error('latitude')
                                        <div class="text-danger pt-2 px-3">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels-input">Country</label>
                                    <select class="form-select" name="country_id">
                                        <option selected disabled>Select Country </option>
                                        @foreach ($country as $key => $val)
                                            <option value="{{ $val->id }}">{{ $val->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                        <div class="text-danger pt-2 px-3">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels-input">State/Region</label>
                                    <select class="form-select" name="state_id">
                                        <option selected disabled>Select State</option>
                                        @foreach ($states as $key => $val)
                                            <option value="{{ $val->id }}">{{ $val->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('state')
                                        <div class="text-danger pt-2 px-3">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels-input">City</label>
                                    <select class="form-select" name="city_id">
                                        <option selected disabled>Select City</option>
                                        @foreach ($cities as $key => $val)
                                            <option value="{{ $val->id }}">{{ $val->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                    @error('city')
                                        <div class="text-danger pt-2 px-3">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- submit btn --}}
                            <div class="mt-5 text-center">
                                <button class="btn btn-primary profile-button px-5" type="Submit">Save Profile</button>
                            </div>
                        </div>
                    </div>
                    {{-- experience --}}
                    <div class="col-md-4">
                        <div class="p-3 mt-4">

                            <div class="col-md-12"><label class="labels-input">Compony Contact Number </label>
                                <input type="text" class="form-control" placeholder="Company phone number" name="phone"
                                    value="{{ isset($data->profile->company_phone) ? $data->profile->company_phone : old('phone') }}">
                                @error('phone')
                                    <div class="text-danger pt-2 px-3">{{ $message }}</div>
                                @enderror
                            </div>





                        </div>
                    </div>


                </div>
            </form>
        </div>


    </section>
@endsection
