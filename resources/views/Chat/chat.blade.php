@extends(url()->current() == url('/employee/message') ? 'employee.employee-layout' : 'employer-layout.default')
@section('content')
    @if (isset($employee) || isset($employer) || false)
        <main class="content">
            <div class="container p-0">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-12 col-lg-5 col-xl-3 border-right">

                            <div class="px-4 d-none d-md-block">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">

                                        <input type="text" class="form-control my-3 search" placeholder="Search...">


                                    </div>

                                </div>
                                <div id="searchResults" class="search-results employee-id">
                                </div>

                            </div>



                            @if (isset($employee_id))
                                @foreach ($employee_id as $details)
                                    @php
                                        $detail = \App\Models\User::find($details);
                                    @endphp

                                    <a href="" data-eid="{{ $detail->id }}"
                                        class="list-group-item list-group-item-action border-0 employee-id">
                                        <div class="d-flex align-items-start">
                                            <img src="{{ Storage::url('public/upload/user/' . $detail->image) }}"
                                                class="rounded-circle mr-1" alt="Sharon Lessman" width="40"
                                                height="40">
                                            <div class="flex-grow-1 ml-3">
                                                {{ $detail->name }}
                                                <div class="small"><span class="fas fa-circle chat-online"></span> Online
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @else
                                @foreach ($employer_id as $id)
                                    @php
                                        $user = \App\Models\User::find($id);
                                    @endphp
                                    <a href="" data-eid="{{ $user->id }}"
                                        class="list-group-item list-group-item-action border-0 employee-id">
                                        <div class="d-flex align-items-start">
                                            <img src="{{ Storage::url('public/upload/user/' . $user->image) }}"
                                                class="rounded-circle mr-1" alt="Sharon Lessman" width="40"
                                                height="40">
                                            <div class="flex-grow-1 ml-3">
                                                {{ $user->name }}
                                                <div class="small"><span class="fas fa-circle chat-online"></span> Online
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @endif
                            <hr class="d-block d-lg-none mt-1 mb-0">
                        </div>


                        <div class="col-12 col-lg-7 col-xl-9 ">


                            @if (isset($employee))
                                <div class="employee-new"></div>
                                <div class="py-2 px-4 border-bottom d-none d-lg-block" id="employee-default">
                                    <div class="d-flex align-items-center py-1">
                                        <div class="position-relative">
                                            <img src="{{ Storage::url('public/upload/user/' . $employee->image) }}"
                                                class="rounded-circle mr-1" alt="Sharon Lessman" width="40"
                                                height="40">
                                        </div>
                                        <div class="flex-grow-1 pl-3">
                                            <strong>{{ $employee->name }}</strong>

                                            <div class="text-muted small"><em>Typing...</em></div>
                                        </div>
                                        <div>
                                            <a href="{{ Storage::url('public/upload/cv/') . $employee->empProfile->resume }}"
                                                target="_blank">
                                                <img src="{{ asset('assets/img/resume.svg') }}" alt="resume"></a>
                                            <a href="{{ route('chat.employee.profile') . '/' . $employee->id }}"><img
                                                    src="{{ asset('assets/img/profile.svg') }}" height="40px"
                                                    width="40px" alt="profile"></a>
                                            <a href=""><img src="{{ asset('assets/img/threedot.svg') }}"
                                                    height="40px" width="40px" alt="threedot"></a>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="employer-new"></div>
                                <div class="py-2 px-4 border-bottom d-none d-lg-block" id="employer-default">
                                    <div class="d-flex align-items-center py-1">
                                        <div class="position-relative">
                                            <img src="{{ Storage::url('public/upload/user/' . $employer->image) }}"
                                                class="rounded-circle mr-1" alt="Sharon Lessman" width="40"
                                                height="40">
                                        </div>
                                        <div class="flex-grow-1 pl-3">
                                            <strong>{{ $employer->name }}</strong>

                                            <div class="text-muted small"><em>Typing...</em></div>
                                        </div>
                                        <div>
                                            <a href="{{ url('job') }}/{{ $employer->id }}" target="_blank">
                                                <img src="{{ asset('assets/img/jobs.svg') }}" height="30px" width="40px"
                                                    alt="jobs"></a>
                                            <a href="{{ route('chat.employer.profile') . '/' . $employer->id }}"><img
                                                    src="{{ asset('assets/img/profile.svg') }}" height="40px"
                                                    width="40px" alt="profile"></a>
                                            <a href=""><img src="{{ asset('assets/img/threedot.svg') }}"
                                                    height="40px" width="40px" alt="threedot"></a>
                                        </div>
                                    </div>
                                </div>
                            @endif



                            <div class="position-relative">
                                <div class="chat-messages p-4">



                                    <div class="chat"></div>
                                </div>
                            </div>

                            <div class="flex-grow-0 py-3 px-4 border-top">

                                <form class="input-group message-send">
                                    <input type="hidden" name="reciever_id" class="dynamic-reciever-id"
                                        value="{{ $employee->id ?? $employer->id }}">
                                    <input type="text" class="form-control" name="message"
                                        placeholder="Type your message">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </form>
                            </div>


                        </div>

                    </div>

                </div>
            </div>
            </div>
        </main>
    @else
        <img src="{{ asset('assets/img/nothing.png') }}" alt="No inquery" class="rounded mx-auto d-block"
            width="600" height="400" style="margin-top:80px">
    @endif
@endsection
