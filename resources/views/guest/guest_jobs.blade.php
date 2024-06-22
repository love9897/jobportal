@php
    $resume = getResume();
    $is_applied_job_ids = isApplied();
    // dd(count($is_applied_job_ids));
    $current_date = date('d-m-Y');
@endphp

@extends('guest_layout.guest_default')
@section('content')
    <section>
        @if (Session::has('result'))
            {{ $jobs = Session::get('result') }}
        @endif
        <div class="container my-5">
            <div class="alert alert-success hide_error msg text-center ">

            </div>
            <div class="row">
                <div class="col-3">
                    <div class="">
                        <h1>Filters</h1>
                    </div>
                    <div class="col-12">
                        <h6><i class="fa-regular fa-file-lines"></i> Experience</h6>
                        <div style=" overflow: auto; height:200px; scrollbar-width: thin;">
                            @foreach ($all_experience as $key => $val)
                                <div class="form-check" style="font-size: 15px;">
                                    <input class="form-check-input filter_exp" type="radio" name="flexRadioDefault1"
                                        id="flexRadioDefault1" value="{{ $val->id }}"
                                        {{ $val->id == $experience_id ? 'checked' : '' }}>

                                    <label class="form-check-label" for="flexRadioDefault1">
                                        {{ $val->experience }}
                                    </label>
                                </div>
                            @endforeach

                        </div>
                        <hr>
                    </div>
                    <div class="col-12">
                        <h6> <i class="fa-solid fa-dollar-sign"></i> Salary</h6>
                        <div style=" overflow: auto; height:200px; scrollbar-width: thin;">
                            @foreach ($all_salary as $key => $val)
                                <div class="form-check" style="font-size: 15px;">
                                    <input class="form-check-input filter_salary" type="radio" name="flexRadioDefault3"
                                        id="flexRadioDefault3" value="{{ $val->id }}"
                                        {{ $val->id == $salary_id ? 'checked' : '' }}>

                                    <label class="form-check-label" for="flexRadioDefault3">
                                        {{ $val->salary }}
                                    </label>
                                </div>
                            @endforeach

                        </div>
                        <hr>
                    </div>
                    <div class="col-12">
                        <h6>Skill</h6>
                        <div style=" overflow: auto; height:200px; scrollbar-width: thin;">
                            @foreach ($all_skills as $key => $val)
                                <div class="form-check" style="font-size: 15px;">
                                    <input class="form-check-input filter_skill" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault1" value="{{ $val->id }}"
                                        {{ $val->id == $skill_id ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        {{ $val->skills }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                    </div>
                </div>
                {{-- ----------------------------- --}}
                <div class="col-9 ">
                    @foreach ($jobs as $key => $val)
                        <?php
                        // dd($val->getExperience);
                        $skills = [];
                        
                        if ($val->getSkill->count() > 0) {
                            foreach ($val->getSkill as $job_skill) {
                                $skills[] = $job_skill->getSkillName->skills;
                            }
                        }
                        
                        ?>
                        <div class="d-flex justify-content-center ">

                            <div class=" rounded-5 my-4 "
                                style="min-height:200px; width:70%;  box-shadow: 0 3px 10px rgba(143, 143, 143, 0.19), 0 6px 6px rgba(143, 142, 142, 0.23);">
                                <a href="#" class=" text-decoration-none  text-dark">
                                    <div class="p-4">
                                        {{-- title --}}
                                        <div>
                                            <span class="fw-bold">{{ $val->job_title }}</span>
                                        </div>
                                        {{-- company name --}}
                                        <div class=" pb-1 ">
                                            <span class="text-secondary" style="font-size: 15px;">
                                                {{ $val->getEmployer->company_name ?? 'N/A' }}</span>
                                        </div>
                                        <div>
                                            <span class="text-secondary" style="font-size: 13px;"> <i
                                                    class="fa-solid fa-briefcase px-1"></i>
                                                {{ $val->getExperience->experience ?? 'No Experience' }}
                                            </span>
                                            <span> | </span>
                                            <span class="text-secondary" style="font-size: 13px;"><i
                                                    class="fa-solid fa-indian-rupee-sign px-1 "></i>
                                                {{ $val->getSalary->salary ?? 'Not Disclosed' }}
                                            </span>
                                            <span> | </span>
                                            <span class="text-secondary" style="font-size: 13px;"> <i
                                                    class="fa-solid fa-location-dot px-1"></i>

                                                <?php echo $val->getEmployer ? $val->getEmployer->getState->name : null; ?>
                                            </span>
                                        </div>
                                        <div>
                                            <div class="text-secondary"
                                                style=" white-space: nowrap; 
                                            width: 80%; 
                                            overflow: hidden;
                                            text-overflow: ellipsis; 
                                            font-size: 15px;                                            
                                            ">
                                                <i class="fa-regular fa-file-lines"></i>
                                                {{ $val->job_description ?? 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <span class="text-secondary" style="font-size: 13px;">Skills :
                                                {{ count($skills) > 0 ? implode(' / ', $skills) : 'No Skills' }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span class="text-secondary" style="font-size: 12px;"><?php echo date('d/m/Y', strtotime($val->created_at)); ?></span>

                                            <span>

                                                <a href="###" class=" text-decoration-none text-dark">

                                                    <i class="fa-regular fa-bookmark"></i> Save

                                                </a>

                                                @if (strtotime($current_date) <= strtotime($val->job_validity))
                                                    {{-- <a href="###" class="text-decoration-none text-dark mx-5">

                                                <i class="fa-regular fa-bookmark"></i> Save

                                            </a> --}}

                                                    <!-- Button trigger modal -->
                                                    @if (isApplied($val->id))
                                                        <span class="text-success py-0 px-3 mx-2">
                                                            <i class="fa-solid fa-check-double fa-lg fa-fw "
                                                                style="color: #25ff11;"></i>
                                                            Applied
                                                        </span>
                                                    @else
                                                        <button type="button" data-id="{{ $val->id }}"
                                                            data-job-title="{{ $val->job_title }}"
                                                            class="btn  py-0 px-3 mx-2 modal_job move-up wcp-apply-{{ $val->id }} "
                                                            data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                            <i class="fa-solid fa-caret-right fa-lg"
                                                                style="color: #000000;"></i>
                                                            <span class="wcp-apply-{{ $val->id }}">

                                                                Apply
                                                            </span>
                                                            <i class="fa-solid fa-caret-left fa-lg"
                                                                style="color: #000000;"></i>
                                                        </button>
                                                    @endif
                                                @else
                                                    <span class="text-danger text-decoration-none "
                                                        style=" cursor:not-allowed">
                                                        <i class="fa-solid fa-circle-exclamation fa-fw"
                                                            style="color: #e60000;"></i>
                                                        Expired
                                                @endif
                                            </span>
                                        </div>

                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach

                    @if ($jobs->hasPages())
                        <div class="d-flex justify-content-center my-5">
                            <div class="pagination-wrapper">
                                {{ $jobs->links() }}
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>




        <!-- Modal -->


        @if ($resume)
            <!-- apply job Modal -->

            <div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Job Form</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <form id="job-form">
                            <div class="modal-body">

                                <div class="alert alert-success text-center">
                                    You are applying for <span class="text-primary modal_Job_title"></span>. Do you want to
                                    proceed.
                                </div>

                                <input type="hidden" class="form-control modal_job_id" id="job_id"
                                    value="{{ $val->id }}">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary px-4"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-outline-primary px-4"
                                    data-bs-dismiss="modal">Apply</button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                {{-- alert  modal --}}

                <div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Job Form</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form id="job-form" enctype="multipart/form-data">
                                <div class="modal-body">

                                    <div class=" alert alert-danger text-center py-1">
                                        <i class="fa-solid fa-triangle-exclamation fa-fw fa-lg"
                                            style="color: #e0180a;"></i>
                                        Register your Self and Complete your profile : <a
                                            href="{{ route('register') }}">Click
                                            Hear</a>
                                    </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        @endif

    </section>
@endsection
