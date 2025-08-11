@extends('backend.layout.master')

@section('mainContent')
    <style>
        /* Light background color for selected customer */
        #customers-list .list-group-item.active {
            background-color: #e9f5ff !important; /* Light blue */
            color: #000; /* Optional: ensure text is readable */
            border-color: #b6e0fe !important;
        }
        .date-separator .border-top {
            border-top: 1px solid #ced4da;
        }

/*day line seperate */
        .date-separator {
            color: grey;
            user-select: none;
        }

        .date-separator .border-top {
            border-top: 1px solid #ced4da;
        }

    </style>


    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div id="top-alert" style="position: fixed; top: 20px; right: 20px; z-index: 1050; min-width: 250px; display: none;">
        <div id="top-alert-message" class="alert alert-danger mb-0" role="alert"></div>
    </div>

    <div class="card" style="height: 150vh;">
        <div class="card-body d-flex flex-column">
            <h4 class="card-title text-center font-weight-bold text-uppercase">
                <div class="card bg-primary text-white shadow-md w-25 mx-auto p-2">
                    Admin Chat Panel
                </div>
            </h4>
            <hr class="w-50 mx-auto p-0 m-0">

            <div class="row flex-grow-1" style="overflow: hidden;">
                {{-- Left: Customer List --}}
                <div class="col-md-4 mt-3  overflow-auto">
                    {{-- Search Bar --}}
                    <div class="mb-1">
                        <input type="text" class="form-control rounded rounded-2 " placeholder="Search" id="customer-search">
                    </div>
                    <div style="max-height: 100vh; overflow-y: auto;">
                        <ul class="list-group list-group-flush" id="customers-list" style="cursor: pointer;">
                            @foreach ($customers as $customer)
                                <li class="list-group-item rounded rounded-2 list-group-item-action d-flex justify-content-between align-items-start p-1" data-id="{{ $customer->id }}">
                                    <div class="d-flex align-items-start">
                                        @if (!empty($customer->image_path) && file_exists(public_path($customer->image_path)))
                                            <img src="{{ asset($customer->image_path) }}"
                                                 class="rounded rounded-3"
                                                 width="45"
                                                 height="45"
                                                 alt="Avatar">
                                        @else
                                            <div class="border rounded rounded-2 border-3 bg-primary text-white d-flex align-items-center justify-content-center me-2"
                                                 style="width: 45px; height: 45px; font-size: 18px;">
                                                {{ strtoupper(substr($customer->name, 0, 1)) }}
                                            </div>
                                        @endif

                                        <div style="margin-left: 8px;">
                                            <strong>{{ $customer->name }}</strong>
                                            <div class="text-muted small">
                                                {{$customer->occupation ?? '' }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <small class="fw-bold d-block" style="color: {{ $customer->isOnline() ? 'green' : '#e74c3c' }}; text-align: end;">
                                            {{ $customer->isOnline() ? 'Online' : 'Offline' }}
                                        </small>
                                        <small class="{{ $customer->lastSeenHuman() === 'available' ? 'text-success' : 'text-muted' }}" style="text-align: end;">
                                            {{ $customer->lastSeenHuman() }}
                                        </small>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                {{-- Right: Chat Panel --}}
                <div class="col-md-8 d-flex flex-column" style="height: 100%;">
                    <div id="chat-header" class=" p-3">
                        <h5 id="chat-with" class="mb-0">Select a participant to chat with...</h5>
                    </div>

                    <div id="chat-messages" class="flex-grow-1 p-3 bg-light border"
                         style="font-size: 14px; height: 300px; overflow-y: auto; border-radius: 8px;">
                        <!-- Chat messages will load here -->
                    </div>
                    {{--                    Loading...--}}
                    <div id="loading-spinner" class="d-flex justify-content-center align-items-center my-2" style="display:none;">
                        <div class="spinner-border text-primary" role="status" aria-hidden="true"></div>
                        <span class="ms-2"></span>
                    </div>

                    <div class="p-3 border-top d-flex gap-2">
                        <input type="file" id="fileInput" style="display:none;" aria-label="Attach file">

                        <button class="btn btn-outline-secondary" id="attachBtn" type="button" title="Attach file">📎</button>

                        <input type="text" id="messageInput" class="form-control" placeholder="Type a message" autocomplete="off" aria-label="Message input" disabled>

                        <button class="btn btn-primary" id="sendBtn" type="button" disabled>Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let selectedCustomerId = null;
            let lastMessageId = null;
            let lastDisplayedDateLabel = null;

            const customersList = document.getElementById('customers-list');
            const chatMessages = document.getElementById('chat-messages');
            const chatWith = document.getElementById('chat-with');
            const messageInput = document.getElementById('messageInput');
            const sendBtn = document.getElementById('sendBtn');
            const attachBtn = document.getElementById('attachBtn');
            const fileInput = document.getElementById('fileInput');
            const topAlert = document.getElementById('top-alert');
            const topAlertMessage = document.getElementById('top-alert-message');
            const loadingSpinner = document.getElementById('loading-spinner');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            function escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }

            function showError(msg) {
                topAlertMessage.textContent = msg;
                topAlert.style.display = 'block';
                setTimeout(() => topAlert.style.display = 'none', 5000);
            }

            function clearMessages() {
                chatMessages.innerHTML = '';
                lastDisplayedDateLabel = null;
            }

            function showLoading() {
                loadingSpinner.style.display = 'flex';
            }

            function hideLoading() {
                loadingSpinner.style.display = 'none';
            }

            function formatDateLabel(date) {
                const today = new Date();
                const yesterday = new Date();
                yesterday.setDate(today.getDate() - 1);

                const isSameDay = (d1, d2) =>
                    d1.getDate() === d2.getDate() &&
                    d1.getMonth() === d2.getMonth() &&
                    d1.getFullYear() === d2.getFullYear();

                if (isSameDay(date, today)) return 'Today';
                if (isSameDay(date, yesterday)) return 'Yesterday';

                const day = date.getDate().toString().padStart(2, '0');
                const month = date.toLocaleString('en-GB', { month: 'long' }); // e.g., May
                const year = date.getFullYear();

                return `${day} ${month} ${year}`; // e.g., 26 May 2025
            }

            function insertDateSeparator(dateLabel) {
                const separator = document.createElement('div');
                separator.classList.add('text-center', 'text-muted', 'my-3', 'date-separator');
                separator.innerHTML = `
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="flex-grow-1 border-top"></div>
                <span class="px-3 small fw-semibold">${dateLabel}</span>
                <div class="flex-grow-1 border-top"></div>
            </div>
        `;
                chatMessages.appendChild(separator);
            }

            function appendMessage(msg) {
                const isAdmin = msg.from_type === 'admin';
                const msgDate = new Date(msg.created_at);
                const dateLabel = formatDateLabel(msgDate);

                if (lastDisplayedDateLabel !== dateLabel) {
                    insertDateSeparator(dateLabel);
                    lastDisplayedDateLabel = dateLabel;
                }

                const wrapper = document.createElement('div');
                wrapper.classList.add('d-flex', 'mb-3');
                wrapper.style.justifyContent = isAdmin ? 'flex-end' : 'flex-start';

                const messageRow = document.createElement('div');
                messageRow.classList.add('d-flex', 'align-items-end');
                messageRow.style.maxWidth = '80%';
                messageRow.style.flexDirection = isAdmin ? 'row-reverse' : 'row';

                const avatarWrapper = document.createElement('div');
                avatarWrapper.classList.add('rounded-circle', 'd-flex', 'justify-content-center', 'align-items-center', 'mx-2');
                avatarWrapper.style.width = '35px';
                avatarWrapper.style.height = '35px';
                avatarWrapper.style.backgroundColor = isAdmin ? '#6f42c1' : '#0d6efd';
                avatarWrapper.style.color = '#fff';
                avatarWrapper.style.fontWeight = 'bold';
                avatarWrapper.style.fontSize = '14px';
                avatarWrapper.style.flexShrink = '0';

                function setLetterFallback() {
                    avatarWrapper.innerHTML = '';
                    avatarWrapper.textContent = (msg.from_name && msg.from_name.length > 0)
                        ? msg.from_name.charAt(0).toUpperCase()
                        : '?';
                }

                if (msg.from_avatar_url) {
                    const avatarImg = document.createElement('img');
                    avatarImg.src = msg.from_avatar_url;
                    avatarImg.alt = 'Avatar';
                    avatarImg.style.width = '100%';
                    avatarImg.style.height = '100%';
                    avatarImg.style.objectFit = 'cover';
                    avatarImg.style.borderRadius = '50%';

                    avatarImg.onerror = () => {
                        // If image fails to load, fallback to first letter
                        setLetterFallback();
                    };

                    avatarWrapper.innerHTML = '';
                    avatarWrapper.appendChild(avatarImg);
                } else {
                    setLetterFallback();
                }

                const messageBubble = document.createElement('div');
                messageBubble.classList.add('p-2', 'rounded');
                messageBubble.style.maxWidth = '100%';
                messageBubble.style.backgroundColor = isAdmin ? '#F5EFFF' : '#e9ecef';
                messageBubble.style.color = 'black';

                if (msg.message) {
                    const messageText = document.createElement('div');
                    messageText.innerHTML = escapeHtml(msg.message).replace(/\n/g, '<br>');
                    messageBubble.appendChild(messageText);
                }

                if (msg.file_url) {
                    if (msg.file_type && msg.file_type.startsWith('image')) {
                        const img = document.createElement('img');
                        img.src = msg.file_url;
                        img.alt = 'Image attachment';
                        img.style.maxWidth = '100%';
                        img.style.marginTop = '5px';
                        messageBubble.appendChild(img);
                    } else {
                        const fileLink = document.createElement('a');
                        fileLink.href = msg.file_url;
                        fileLink.target = '_blank';
                        fileLink.textContent = 'Download attachment';
                        fileLink.style.display = 'block';
                        fileLink.style.marginTop = '5px';
                        messageBubble.appendChild(fileLink);
                    }
                }

                const timestamp = document.createElement('div');
                timestamp.style.fontSize = '0.75rem';
                timestamp.style.opacity = '0.7';
                timestamp.style.marginTop = '3px';
                timestamp.textContent = msgDate.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                messageBubble.appendChild(timestamp);

                messageRow.appendChild(avatarWrapper);
                messageRow.appendChild(messageBubble);
                wrapper.appendChild(messageRow);
                chatMessages.appendChild(wrapper);
            }

            async function loadMessages(customerId) {
                if (!customerId) return;

                showLoading();

                try {
                    const response = await fetch(`/admin/chat/messages/${customerId}`, {
                        headers: { 'Accept': 'application/json' },
                        credentials: 'same-origin',
                    });

                    if (!response.ok) throw new Error('Failed to load messages');

                    const messages = await response.json();

                    if (messages.length === 0) {
                        if (!lastMessageId) {
                            clearMessages();
                            chatMessages.innerHTML = '<p class="text-muted text-center mt-4">No messages yet.</p>';
                        }
                        hideLoading();
                        return;
                    }

                    if (lastMessageId === null) {
                        clearMessages();
                    }

                    let newMessagesAdded = false;

                    for (const msg of messages) {
                        if (!lastMessageId || msg.id > lastMessageId) {
                            appendMessage(msg);
                            lastMessageId = msg.id;
                            newMessagesAdded = true;
                        }
                    }

                    const nearBottom = chatMessages.scrollHeight - chatMessages.scrollTop - chatMessages.clientHeight < 50;
                    if (newMessagesAdded && nearBottom) {
                        chatMessages.scrollTop = chatMessages.scrollHeight;
                    }

                } catch (error) {
                    showError('Error loading messages.');
                    console.error(error);
                } finally {
                    hideLoading();
                }
            }

            async function sendMessage() {
                if (!selectedCustomerId) {
                    showError('Please select a customer.');
                    return;
                }

                const text = messageInput.value.trim();
                const file = fileInput.files[0];

                if (!text && !file) {
                    showError('Please enter a message or select a file.');
                    return;
                }

                sendBtn.disabled = true;
                messageInput.disabled = true;
                attachBtn.disabled = true;

                const formData = new FormData();
                formData.append('to_id', selectedCustomerId);
                if (text) formData.append('message', text);
                if (file) formData.append('file', file);

                try {
                    const response = await fetch('/admin/chat/send', {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': csrfToken },
                        body: formData,
                        credentials: 'same-origin',
                    });

                    const data = await response.json();

                    if (!response.ok || data.error) {
                        showError(data.error || 'Failed to send message.');
                        return;
                    }

                    messageInput.value = '';
                    fileInput.value = '';

                    await loadMessages(selectedCustomerId);

                } catch (error) {
                    showError('Failed to send message.');
                    console.error(error);
                } finally {
                    sendBtn.disabled = false;
                    messageInput.disabled = false;
                    attachBtn.disabled = false;
                    messageInput.focus();
                }
            }

            customersList.addEventListener('click', (e) => {
                const li = e.target.closest('li.list-group-item');
                if (!li) return;

                customersList.querySelectorAll('li').forEach(item => item.classList.remove('active'));
                li.classList.add('active');

                selectedCustomerId = li.dataset.id;
                lastMessageId = null;

                const customerName = li.querySelector('strong')?.textContent?.trim() || 'Unknown';
                chatWith.textContent = `Chat with: ${customerName}`;
                messageInput.disabled = false;
                sendBtn.disabled = false;
                attachBtn.disabled = false;

                messageInput.value = '';
                fileInput.value = '';
                clearMessages();

                loadMessages(selectedCustomerId);
            });

            sendBtn.addEventListener('click', () => sendMessage());

            messageInput.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    sendMessage();
                }
            });

            attachBtn.addEventListener('click', () => {
                fileInput.click();
            });

            setInterval(() => {
                if (selectedCustomerId) {
                    loadMessages(selectedCustomerId);
                }
            }, 3000);
        });
    </script>


@endsection
