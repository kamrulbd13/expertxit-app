@php
    $isCustomer = $userType === 'customer';
    $authUser = $isCustomer ? auth('customer')->user() : auth()->user();
    $authId = $authUser->id;
    $authName = $authUser->name ?? 'U';
    $authImage = $authUser->image_path ?? null;
    if ($authImage && !str_starts_with($authImage, 'http')) {
        $authImage = asset($authImage);
    }
    $recipientId = 1; // Change as needed
    $recipientType = $isCustomer ? 'admin' : 'customer';
@endphp


<style>
    #chat-icon {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 48px;
        height: 48px;
        background: #471877;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 9999;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }


  /*chat icon   */


    /*chat icon   */
    #chat-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(145deg, #4e1e94, #3a1360); /* gradient for depth */
        box-shadow:
            10px 10px 18px #31115a,   /* dark shadow for depth */
            -10px -10px 18px #632db6; /* light highlight */
        border: 7px groove #4e1e94;
        overflow: hidden;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        font-weight: bold;
        color: #fff;
        font-size: 20px;
        padding: 4px 0;

        transition:
            transform 0.3s ease,
            background 0.3s ease,
            box-shadow 0.3s ease;
    }

    #chat-icon:hover {
        background: linear-gradient(145deg, #5f2ec9, #4e1e90); /* lighter gradient on hover */
        transform: scale(1.1);
        box-shadow:
            6px 6px 12px #2a0e52,
            -6px -6px 12px #7439db,
            inset 0 0 8px rgba(255, 255, 255, 0.2); /* subtle inner glow */

    }

    /* Keep your text styling */
    .live-chat-text {
        font-size: 14px;
        margin-top: 2px;
        color: #fff;
        line-height: 1;
        user-select: none;
        text-align: center;
        letter-spacing: 0.1em;
        font-family: "Courier New", Courier, monospace;
        text-shadow: 0 1px 2px rgba(0,0,0,0.6); /* subtle text shadow for depth */
    }



    #chat-box {
        position: fixed;
        bottom: 85px;
        right: 20px;
        width: 300px;
        max-height: 400px;
        background: white;
        border: 1px solid #ddd;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        display: none;
        flex-direction: column;
        resize: both; /* ✅ Allow height resizing */
        overflow: auto;
        z-index: 9999;
    }
    #chat-box.show { display: flex; animation: fadeInUp 0.3s ease-out; }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    #chat-box.show {
        animation: fadeInUp 0.3s ease-out;
    }


    .chat-header {
        animation: fadeInDown 0.3s ease-out;
        background: #471877;
        color: white;
        padding: 7px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }
    .chat-header .close-btn {
        background: none;
        border: none;
        font-size: 20px;
        color: white;
        cursor: pointer;
    }

    .chat-messages {
        flex: 1;
        padding: 10px;
        overflow-y: auto;
        background: #f8f9fa;
        scroll-behavior: smooth;
    }

    .chat-input {
        padding: 5px;
        border-top: 1px solid #dee2e6;
        background: white;
    }

    .input-wrapper {
        display: flex;
        align-items: center;
        gap: 3px;
    }

    .message-input {
        flex: 1;
        border: 1px solid #ccc;
        border-radius: 6px;
        padding: 5px;
    }

    .send-btn {
        background: #471877;
        color: white;
        border: none;
        border-radius: 6px;
        padding: 5px 8px;
        cursor: pointer;
        margin-right: 3px;
    }

    .attachment-icon {
        font-size: 20px;
        cursor: pointer;
        color: #471877;
    }

    .message-container {
        display: flex;
        margin-bottom: 12px;
        align-items: flex-end;
    }

    .message-container.you { justify-content: flex-end; }
    .message-container.them { justify-content: flex-start; }

    .bubble-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #471877;
        margin: 0 8px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
        font-size: 14px;
        color: #fff;
    }

    .bubble-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .message {
        max-width: 70%;
        padding: 8px 10px;
        border-radius: 15px;
        background: #e9ecef;
        word-wrap: break-word;
        position: relative;
        margin-bottom: 10px;
    }

    /* Sent by user - align right with bubble tail */
    .message.you {
        background: #d1e7dd;
        border-bottom-right-radius: 0;
        margin-left: auto;
    }

    /* Received message - align left with bubble tail */
    .message.them {
        background: #e9ecef;
        border-bottom-left-radius: 0;
        margin-right: auto;
    }

    .message {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
    }

    .message.you { background: #d1e7dd; }

    .day-separator {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 10px 0;
        font-size: 10px;
        color: darkgrey;
        font-weight: 400;
        user-select: none;
    }

    .day-separator::before,
    .day-separator::after {
        content: "";
        flex-grow: 1;
        height: 1px;
        background: darkgrey;
        margin: 0 8px;
    }

    .message-time {
        display: block;
        font-size: 0.55rem;
        color: #999;
        margin-top: 4px;
        text-align: right;
        user-select: none;
    }
</style>



{{--chat icon--}}
<div id="chat-icon" class="shadow" title="Live Chat">
{{--    <div class="user-bubble"><i class="ti-comments"></i></div>--}}
    <strong class="live-chat-text"><b>live</b> <br> <small class="">chat</small> </strong>
</div>





<div id="chat-box">
    <div class="chat-header">



<span>
    {{ $isCustomer ? 'Help Desk Assistant' : 'Admin Support' }}
    <sup>
        <span class="{{ optional($admin)->isOnline() ? 'text-muted ' : 'text-success' }}">
            {{ optional($admin)->isOnline() ? 'Offline' : 'Online' }}
        </span>
    </sup>
</span>


        <button class="close-btn">&times;</button>
    </div>
    <div class="chat-messages" id="chat-messages"></div>
    <div class="chat-input">
        <div class="input-wrapper">
            <span id="attachment-icon" class="attachment-icon">📎</span>
            <input type="file" id="fileInput" hidden>
            <input type="text" id="messageInput" class="message-input" placeholder="Type a message..." autofocus="false">
            <button id="sendBtn" class="send-btn">Send</button>
        </div>
    </div>
</div>

<script>
    (() => {
        const chatIcon = document.getElementById('chat-icon');
        const chatBox = document.getElementById('chat-box');
        const chatMessages = document.getElementById('chat-messages');
        const closeBtn = document.querySelector('.close-btn');
        const fileInput = document.getElementById('fileInput');
        const messageInput = document.getElementById('messageInput');
        const sendBtn = document.getElementById('sendBtn');
        const attachmentIcon = document.getElementById('attachment-icon');

        const userType = @json($userType);
        const currentUserId = @json($authId);
        const currentUserName = @json($authName);
        const currentUserImage = @json($authImage);
        const toId = @json($recipientId);
        const toType = @json($recipientType);
        const csrfToken = @json(csrf_token());

        let lastFetchedMessageCount = 0;
        let pollingInterval = null;

        function formatDateSeparator(dateStr) {
            const date = new Date(dateStr);
            const today = new Date();
            const yesterday = new Date(today);
            yesterday.setDate(today.getDate() - 1);

            const options = { year: 'numeric', month: 'short', day: 'numeric' };
            if (date.toDateString() === today.toDateString()) return 'Today';
            if (date.toDateString() === yesterday.toDateString()) return 'Yesterday';
            return date.toLocaleDateString(undefined, options);
        }

        // Format time as hh:mm am/pm
        function formatTime(dateStr) {
            const date = new Date(dateStr);
            let hours = date.getHours();
            const minutes = date.getMinutes().toString().padStart(2, '0');
            const ampm = hours >= 12 ? 'pm' : 'am';
            hours = hours % 12;
            hours = hours ? hours : 12; // hour 0 should be 12
            return `${hours}:${minutes} ${ampm}`;
        }

        function toggleChat() {
            chatBox.classList.toggle('show');
            if (chatBox.classList.contains('show')) {
                fetchMessages();
                if (!pollingInterval) {
                    pollingInterval = setInterval(fetchMessages, 5000);
                }
            } else {
                clearInterval(pollingInterval);
                pollingInterval = null;
            }
        }

        async function fetchMessages() {
            const url = userType === 'customer' ? '/customer/chat/messages' : '/admin/chat/messages';

            try {
                const response = await fetch(url);
                const messages = await response.json();
                if (messages.length === lastFetchedMessageCount) return;
                lastFetchedMessageCount = messages.length;

                const shouldScroll = chatMessages.scrollTop + chatMessages.clientHeight >= chatMessages.scrollHeight - 100;

                chatMessages.innerHTML = '';
                let lastDate = null;

                messages.forEach(msg => {
                    const msgDate = new Date(msg.created_at).toDateString();
                    if (msgDate !== lastDate) {
                        lastDate = msgDate;
                        const separator = document.createElement('div');
                        separator.className = 'day-separator';
                        separator.textContent = formatDateSeparator(msg.created_at);
                        chatMessages.appendChild(separator);
                    }

                    const isYou = msg.from_id === currentUserId;
                    const container = document.createElement('div');
                    container.className = `message-container ${isYou ? 'you' : 'them'}`;

                    const bubble = document.createElement('div');
                    bubble.className = 'bubble-avatar';
                    if (msg.from_image_url) {
                        const img = document.createElement('img');
                        img.src = msg.from_image_url;
                        img.alt = msg.from_name ? msg.from_name[0] : 'U';
                        bubble.appendChild(img);
                    } else {
                        bubble.textContent = (msg.from_name || 'U')[0].toUpperCase();
                    }

                    const message = document.createElement('div');
                    message.className = `message ${isYou ? 'you' : ''}`;

                    if (msg.type === 'file' && msg.file_url) {
                        const link = document.createElement('a');
                        link.href = msg.file_url;
                        link.textContent = msg.message || 'Attachment';
                        link.target = '_blank';
                        message.appendChild(link);
                    } else {
                        message.textContent = msg.message;
                    }

                    // Create and append time span inside message bubble
                    const timeSpan = document.createElement('span');
                    timeSpan.className = 'message-time';
                    timeSpan.textContent = formatTime(msg.created_at);
                    message.appendChild(timeSpan);

                    if (!isYou) container.appendChild(bubble);
                    container.appendChild(message);
                    if (isYou) container.appendChild(bubble);

                    chatMessages.appendChild(container);
                });

                if (shouldScroll) chatMessages.scrollTop = chatMessages.scrollHeight;
            } catch (err) {
                console.error('Error fetching messages:', err);
            }
        }

        async function sendMessage() {
            const msg = messageInput.value.trim();
            if (!msg) return;

            const url = userType === 'customer' ? '/customer/chat/send' : '/admin/chat/send';

            try {
                await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ message: msg, to_id: toId, to_type: toType, type: 'text' })
                });
                messageInput.value = '';
                fetchMessages();
            } catch (err) {
                console.error('Send failed:', err);
            }
        }

        async function sendFile(file) {
            const formData = new FormData();
            formData.append('file', file);
            formData.append('to_id', toId);
            formData.append('to_type', toType);
            formData.append('type', 'file');
            formData.append('_token', csrfToken);

            const url = userType === 'customer' ? '/customer/chat/send-file' : '/admin/chat/send-file';

            try {
                await fetch(url, { method: 'POST', body: formData });
                fetchMessages();
            } catch (err) {
                console.error('File upload failed:', err);
            }
        }

        chatIcon.addEventListener('click', toggleChat);
        closeBtn.addEventListener('click', toggleChat);
        sendBtn.addEventListener('click', sendMessage);
        messageInput.addEventListener('keydown', e => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });
        attachmentIcon.addEventListener('click', () => fileInput.click());
        fileInput.addEventListener('change', () => {
            if (fileInput.files.length > 0) {
                sendFile(fileInput.files[0]);
                fileInput.value = '';
            }
        });
    })();
</script>

