@extends('backend.layout.master')
@section('mainContent')

    <div class="card ">
        <div class="card-body">
            <h4 class="card-title text-center font-weight-bold text-base text-uppercase">New chat Information</h4>
            <hr class="w-50 mx-auto">
            <p class="card-description">
              " Entry  Information "
            </p>


    <div class="card">

        @include('backend.layout.includes.chat',['userType' => 'admin'] )
{{--        @include('partials.chat-box', ['userType' => 'admin'])--}}
{{--        <div class="card-body">--}}
{{--            <div class="chat-box">--}}
{{--                <div id="chat-messages" style="height: 300px; overflow-y: scroll; border: 1px solid #ccc; padding: 10px;">--}}
{{--                    <!-- Messages will load here -->--}}
{{--                </div>--}}

{{--                <form id="chat-form" enctype="multipart/form-data">--}}
{{--                    @csrf--}}
{{--                    <input type="hidden" name="to_id" value="{{ $receiverId }}"> <!-- Set this dynamically -->--}}

{{--                    <textarea name="message" id="message" rows="2" placeholder="Type your message..."></textarea><br>--}}
{{--                    <input type="file" name="file" id="file"><br>--}}
{{--                    <button type="submit">Send</button>--}}
{{--                </form>--}}
{{--            </div>--}}

{{--            <script>--}}
{{--                document.getElementById('chat-form').addEventListener('submit', function(e) {--}}
{{--                    e.preventDefault();--}}

{{--                    let formData = new FormData(this);--}}

{{--                    fetch('/chat/send', {--}}
{{--                        method: 'POST',--}}
{{--                        headers: {--}}
{{--                            'X-CSRF-TOKEN': '{{ csrf_token() }}',--}}
{{--                        },--}}
{{--                        body: formData--}}
{{--                    })--}}
{{--                        .then(res => res.json())--}}
{{--                        .then(data => {--}}
{{--                            if (data.success) {--}}
{{--                                document.getElementById('message').value = '';--}}
{{--                                document.getElementById('file').value = '';--}}
{{--                                loadMessages(); // reload after sending--}}
{{--                            }--}}
{{--                        });--}}
{{--                });--}}

{{--                function loadMessages() {--}}
{{--                    fetch('/chat/messages?to_id={{ $receiverId }}')--}}
{{--                        .then(res => res.json())--}}
{{--                        .then(data => {--}}
{{--                            const box = document.getElementById('chat-messages');--}}
{{--                            box.innerHTML = '';--}}
{{--                            data.forEach(msg => {--}}
{{--                                box.innerHTML += `<p><strong>${msg.from_name}:</strong> ${msg.message} ${msg.file_url ? `<a href="${msg.file_url}" target="_blank">[File]</a>` : ''}</p>`;--}}
{{--                            });--}}
{{--                        });--}}
{{--                }--}}

{{--                loadMessages();--}}
{{--                setInterval(loadMessages, 5000); // auto-refresh every 5s--}}
{{--            </script>--}}

{{--        </div>--}}

    </div>
        </div>
    </div>

    <!-- toastr JS -->
    <script src="{{asset('/')}}backend/js/toastr.min.js"></script>
    @if (Session::has('message'))
        <script>
            toastr.options = {
                "progressBar" :true,
                "closeButton" : true,
            }
            toastr["success"]("Record has been saved successfully !","Success");
        </script>
    @endif



@endsection
