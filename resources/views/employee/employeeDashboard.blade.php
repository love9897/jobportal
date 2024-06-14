@extends('employee.employee-layout')
@section('content')

    @if (empProfileCheck())
        <div class="table-responsive">
            <table class="table">

                <thead>
                    <tr>
                        <th scope="col">Company</th>
                        <th scope="col">profile</th>
                        <th scope="col">applied on</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applied_jobs as $key => $val)
                        <tr>
                            <td>{{ $val->jobs->getEmployer->company_name }}</td>
                            <td>{{ $val->jobs->job_title }}</td>
                            <td>{{ date('d-m-Y', strtotime($val->jobs->created_at)) }}</td>
                            <td><a href="" data-jobid="{{ $val->job_id }}" class="review">review</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <span></span>
        <div class="alert alert-warning" role="alert">
            <img src="{{ asset('assets/img/warning_icon.png') }}" alt="warning">
            <h5></i>Complete your profile for furthor
                procedure. <a href="{{ url('/employee/profile/edit') }}">Click Here</a>
                to create profile.
            </h5>
        </div>
    @endif
@endsection


<div class="modal fade" id="review-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Job Application</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body review-details">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                
            </div>
        </div>
    </div>
</div>
