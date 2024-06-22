<div class="py-2 px-4 border-bottom d-none d-lg-block" id="employer-default">
    <div class="d-flex align-items-center py-1">
        <div class="position-relative">
            <img src="{{ Storage::url('public/upload/user/' . $employer->image) }}" class="rounded-circle mr-1"
                alt="Sharon Lessman" width="40" height="40">
        </div>
        <div class="flex-grow-1 pl-3">
            <strong>{{ $employer->name }}</strong>

            <div class="text-muted small"><em>Typing...</em></div>
        </div>
        <div>
            <a href="{{url('job')}}/{{$employer->id}}">
                <img src="{{ asset('assets/img/jobs.svg') }}" height="30px" width="40px" alt="jobs"></a>
            <a href="{{ route('chat.employer.profile') . '/' . $employer->id }}"><img
                    src="{{ asset('assets/img/profile.svg') }}" height="40px" width="40px" alt="profile"></a>
            <a href=""><img src="{{ asset('assets/img/threedot.svg') }}" height="40px" width="40px"
                    alt="threedot"></a>
        </div>
    </div>
</div>
