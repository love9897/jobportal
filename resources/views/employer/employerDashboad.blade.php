@extends('employer-layout.default')
@section('content')
    @if (profileCheck())
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">jobs</th>
                        <th scope="col">Description</th>
                        <th scope="col">Salary</th>
                        <th scope="col">experience</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobs_list as $key => $val)
                        <tr>
                            <th scope="row">{{ $val->id }}</th>
                            <td>{{ $val->job_title }}</td>
                            <td>{{ substr($val->job_description, 0, 50) . '.........' }}</td>
                            <td>{{ $val->getSalary->salary }}</td>
                            <td>{{ $val->getExperience->experience }}</td>
                            <td><a href="{{ route('inquer.details') }}/{{ $val->id }}"
                                    class="btn btn-primary">Inquery</a>
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
            Please complete the profile before adding post
        </div>
    @endif
@endsection

@include('modal.notification_modal')
