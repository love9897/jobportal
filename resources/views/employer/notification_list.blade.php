<div>
    <table class="table">

        <tbody>
            @if (empty($notification_list))
                <img src="{{ asset('assets/img/no-notification.jpg') }}" alt="No inquery found" class="rounded mx-auto d-block"
                    width="200" height="200">
            @endif
            @foreach ($notification_list as $key => $val)
                <tr>
                    <td>{{ $val->employee->name }},{{ $val->employee->email }},<a href=""
                            class="text-secondary">view</a></td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
