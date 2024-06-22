@foreach ($chats as $key => $chat)
    <div class="text-center"><span class="bg-white datee">
            <?php
            if ($key == date('Y-m-d')) {
                echo 'today';
            } else {
                if ($key == date('Y-m-d', strtotime('-1 days'))) {
                    echo 'yesterday';
                } else {
                    echo $key;
                }
            }
            ?>
        </span>
    </div>
    @foreach ($chat as $chat)
        @if ($chat->origin == Auth::id())
            <div class="chat-message-right pb-4">
                <div>
                    <img src="{{ Storage::url('public/upload/user/' . $chat->chatToEmployee->image) }}"
                        class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                    <div class="text-muted small text-nowrap mt-2">
                        {{ date('h:i a', strtotime($chat->created_at)) }}</div>
                </div>
                <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                    <div class="font-weight-bold mb-1">{{ $chat->chatToEmployee->name }}</div>
                    {{ $chat->msg }}
                </div>
            </div>
        @else
            <div class="chat-message-left pb-4">
                <div>
                    <img src="{{ Storage::url('public/upload/user/' . $chat->chatToEmployer->image) }}"
                        class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                    <div class="text-muted small text-nowrap mt-2">
                        {{ date('h:i a', strtotime($chat->created_at)) }}</div>
                </div>
                <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                    <div class="font-weight-bold mb-1">{{ $chat->chatToEmployer->name }}</div>
                    {{ $chat->msg }}
                </div>
            </div>
        @endif
    @endforeach
@endforeach
