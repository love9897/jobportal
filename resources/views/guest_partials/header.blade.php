<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand " href="{{ url('/') }}">JOB Portal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" name="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('subject.jobs') }}">JOB</a>
                </li>
            </ul>

            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <button class="btn btn-dark  " type="submit">

                            <a href="{{ route('dashboad') }}" class=" text-decoration-none text-white py-1 px-3">Home</a>
                        </button>
                    @else
                        <button class="btn btn-dark"type="submit">

                            <a href="{{ route('login') }}" class=" text-decoration-none text-white py-1 px-3">Login</a>
                        </button>

                        @if (Route::has('register'))
                            <button class="btn btn-dark  " type="submit">

                                <a href="{{ route('register') }}"
                                    class=" text-decoration-none text-white py-1 px-3 ">Register</a>
                            </button>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>
</nav>
