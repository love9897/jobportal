@extends('guest_layout.guest_default')
@section('content')
    <section>
        
        {{-- search bar --}}
        <div class="container" style="margin-top: 150px; width:100%; ">
            <div class="row rounded-5 bg-white"
                style="border:1px solid rgb(156, 154, 154); box-shadow: 0 3px 10px rgba(143, 143, 143, 0.19), 0 6px 6px rgba(143, 142, 142, 0.23);">
                <form action="{{ route('search.job') }}" method="GET">
                    {{-- @csrf --}}
                    <div class="row p-3 ">
                        <div class="col">
                            <select class="form-select" style="border:0; " name="skill_id">
                                <option selected disabled>Choose a Skill</option>
                                @foreach ($skill as $key => $val)
                                    <option value="{{ $val->id }}"> {{ $val->skills }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-select" style="border:0; " name="experience_id">
                                <option selected disabled>Your Experience</option>
                                @foreach ($experience as $key => $val)
                                    <option value="{{ $val->id }}"> {{ $val->experience }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-select" style="border:0; " name="location_id">
                                <option selected disabled>Select Location</option>
                                @foreach ($state as $key => $val)
                                    <option value="{{ $val->id }}"> {{ $val->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-outline-primary px-5 rounded-5">Submit</button>
                        </div>
                    </div>

                </form>

            </div>

        </div>



    </section>
@endsection
