@extends('layouts.app')

@section('title')
    Chat - Socialite
@endsection

@section('main')
    <div class="space-y-5 max-w-sm mx-auto">
        <h1 class="text-xl text-center font-bold">Chat with {{ $user->name }}</h1>

        <div class="h-[400px] border rounded-lg flex flex-col p-2.5">
            <div class="mt-auto"></div>
            <ul id="messages" class="text-sm flex flex-col gap-y-2 overflow-y-scroll">
                @if (count($messages) > 0)
                    @foreach ($messages as $message)
                        @if ($message->from_user === Auth::id())
                            <li class="to-user">
                                {{ $message->content }}
                            </li>
                        @else
                            <li class="from-user">
                                {{ $message->content }}
                            </li>
                        @endif
                    @endforeach
                @else
                    <em class="mt-auto text-center text-sm" id="nomsg">No messages available.</em>
                @endif
            </ul>
            <form id="message-form"
                class="mt-5 text-sm flex gap-x-1.5 [&>input]:outline-none [&>input]:border [&>input]:rounded [&>input]:p-2 [&>input]:flex-grow focus:[&>input]:ring-2 focus:[&>input]:ring-blue-400 focus:[&>input]:ring-offset-2 [&>button]:bg-blue-500 [&>button]:text-white [&>button]:p-2 [&>button]:rounded">
                <input type="text" name="content" id="content" placeholder="Your message...">
                <button type="submit">Send</button>
            </form>
        </div>
    </div>

    @push('head_scripts')
        <script src="https://cdn.socket.io/4.5.4/socket.io.min.js"></script>
    @endpush

    @push('body_scripts')
        <script defer>
            const socket = io('ws://localhost:5550', {
                transports: ['websocket']
            })

            const messages = document.querySelector('#messages')
            socket.on('chat_message', (payload) => {
                const li = document.createElement('li')
                li.textContent = payload?.content
                li.classList.add(payload?.from_user == '{{ Auth::id() }}' ? 'to-user' : 'from-user')
                messages.appendChild(li)
                messages.scrollTo(0, messages.scrollHeight)
            });

            document.querySelector('#message-form').addEventListener('submit', (e) => {
                e.preventDefault()

                let content = e.target.elements['content'].value

                if (content !== '') {
                    socket.emit('chat_message', {
                        from_user: "{{ Auth::id() }}",
                        to_user: "{{ Request::route('id') }}",
                        content: content
                    })

                    document.querySelector('#nomsg')?.remove()
                }

                e.target.reset()
            })
        </script>
    @endpush
@endsection
