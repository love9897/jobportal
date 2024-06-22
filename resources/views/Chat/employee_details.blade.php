<div class="py-2 px-4 border-bottom d-none d-lg-block" >
    <div class="d-flex align-items-center py-1">
        <div class="position-relative">
            <img src="{{ Storage::url('public/upload/user/' . $employee->image) }}"
                class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
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
                    src="{{ asset('assets/img/profile.svg') }}" height="40px" width="40px"
                    alt="profile"></a>
            <a href=""><img src="{{ asset('assets/img/threedot.svg') }}" height="40px"
                    width="40px" alt="threedot"></a>
        </div>
    </div>
</div>