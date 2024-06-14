@extends('employer-layout.default')
@section('content')
    <section>

        @if (profileCheck())
            <div class="container">

                @if (Session::has('success'))
                    <div class="alert alert-success text-center text-capitalize">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger text-center text-capitalize">{{ Session::get('error') }}</div>
                @endif


                <div class="row">
                    <div class="col-6 p-5  ">
                        <h3 class="text-center ">Post A Job</h3>
                        <hr>
                        <form action="{{ route('job.create') }}" method="post">
                            @csrf


                            <div class="row mt-3 ">
                                <div class="col-md-12">
                                    <label class="labels-input">Job Title</label>
                                    <input type="text" class="form-control" placeholder="Post Title" name="job_title">
                                    @error('job_title')
                                        <span class="alert text-danger"> {{'*'. $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels-input">Skills</label>
                                    <select class="form-select" name="skill[]" id="skills" multiple>
                                        @foreach ($skills as $key => $val)
                                            <option value="{{ $val->id }}">{{ ucfirst($val->skills) }}</option>
                                        @endforeach
                                    </select>
                                    @error('skill')
                                        <span class="alert text-danger"> {{'*'. $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels-input">Experience</label>
                                    <select class="form-select" name="experience_id">
                                        <option selected disabled>Choose Experience</option>
                                        @foreach ($experience as $key => $val)
                                            <option value="{{ $val->id }}">{{ $val->experience }}</option>
                                        @endforeach
                                    </select>
                                    @error('experience_id')
                                        <span class="alert text-danger"> {{'*'. $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels-input">Languages</label>
                                    <select id="multiple" class="form-select js-states" name="language[]" multiple>
                                        @foreach ($languages as $key => $val)
                                            <option value="{{ $val->id }}">{{ ucfirst($val->languages) }}</option>
                                        @endforeach
                                    </select>
                                    @error('language')
                                        <span class="alert text-danger"> {{'*'. $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels-input">Salary</label>
                                    <select class="form-select" name="salary_id">
                                        <option selected disabled>Choose Experience</option>
                                        @foreach ($salary as $key => $val)
                                            <option value="{{ $val->id }}">{{ $val->salary }}</option>
                                        @endforeach
                                    </select>
                                    @error('salary_id')
                                        <span class="alert text-danger"> {{'*'. $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels-input">Description</label>
                                    <textarea class="form-control" placeholder="Job Description" rows="2" name="job_description"></textarea>
                                    @error('job_description')
                                        <span class="alert text-danger"> {{'*'. $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3 ">
                                <div class="col-md-12">
                                    <label class="labels-input">Job Valid Till</label>
                                    <input type="date" class="form-control" name="job_validity" id="datepicker">
                                    @error('job_validity')
                                        <div class="text-danger my-1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3 p-2">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-outline-success px-5 py-1 ">Submit</button>
                                </div>
                            </div>

                    </div>
                    </form>
                    <div class="col-6">
                        <div>
                            <img src="{{ asset('assets/img/jobpost.svg') }}" height="600px" width="650px" alt="..."
                                style="object-fit: cover;">
                        </div>
                    </div>
                </div>
            @else
                <span></span>
                <div class="alert alert-warning" role="alert">
                    <img src="{{ asset('assets/img/warning_icon.png') }}" alt="warning">
                    Please complete the profile before adding post
                </div>
        @endif
    </section>
@endsection
