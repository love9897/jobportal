{{-- @php
    dd($employerdata);
@endphp --}}




<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">

        <img class="mx-2" src="{{ Storage::url('public/upload/user/') . $employerdata->image }}" alt="..."
            height="40px" width="40px" style="object-fit: cover; border-radius: 50%;">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('dashboad') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/" class="text-white">Jobs</a>
                </li>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">

                <li class="nav-item">
                    <a href="{{ route('chat.employee') }}"> <img src="{{ asset('assets/img/icons8-message-75.png') }}"
                            class="rounded-circle mr-1" alt="" width="35" height="35"> </a>
                </li>
                <li class="nav-item dropdown profile-menu">

                    <a class="nav-link dropdown-toggle mx-2" id="userDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{-- {{ $employerdata->name }} --}}
                        <i class="fas fa-user fs-5 mx-1 "></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="userDropdown">

                        <li>
                            <a class="dropdown-item" href="{{ route('employee.profile') }}"><i
                                    class="fas fa-sliders-h fa-fw"></i> profile</a>
                        </li>

                        <li><a class="dropdown-item" href="{{ route('logout') }}"><i
                                    class="fas fa-sign-out-alt fa-fw"></i> Log
                                Out</a></li>
                    </ul>
                </li>

            </ul>

        </div>
    </div>
</nav>
