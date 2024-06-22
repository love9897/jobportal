@extends('employee.employee-layout')
@section('content')
    <?php $current_date = date('d-m-Y'); ?>
    <div class="row" style="margin: 0px;">
        @foreach ($jobs as $key => $val)
            <div class="col-md-6 col-lg-4">
                <div class="d-flex justify-content-center ">

                    <div class="rounded-5 my-4"
                        style=" min-height:200px; width:70%;  box-shadow: 0 3px 10px rgba(143, 143, 143, 0.19), 0 6px 6px rgba(143, 142, 142, 0.23);">
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
                                {{-- <div class="mb-2">
                            <span class="text-secondary" style="font-size: 13px;">Skills :
                                {{ count($skills) > 0 ? implode(' / ', $skills) : 'No Skills' }}</span>
                        </div> --}}
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
                                                    <i class="fa-solid fa-caret-right fa-lg" style="color: #000000;"></i>
                                                    <span class="wcp-apply-{{ $val->id }}">

                                                        Apply
                                                    </span>
                                                    <i class="fa-solid fa-caret-left fa-lg" style="color: #000000;"></i>
                                                </button>
                                            @endif
                                        @else
                                            <span class="text-danger text-decoration-none " style=" cursor:not-allowed">
                                                <i class="fa-solid fa-circle-exclamation fa-fw" style="color: #e60000;"></i>
                                                Expired
                                        @endif
                                    </span>
                                </div>

                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
