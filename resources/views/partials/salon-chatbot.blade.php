<style>
    .salon-chatbot { position: fixed; right: 24px; bottom: 24px; z-index: 100; font-family: inherit; }
    .salon-chatbot-panel { display: none; width: min(380px, calc(100vw - 32px)); height: min(540px, calc(100vh - 110px)); margin-bottom: 14px; overflow: hidden; flex-direction: column; background: #fff; border: 1px solid #e5e7eb; box-shadow: 0 24px 70px rgba(0,0,0,0.22); }
    .salon-chatbot.open .salon-chatbot-panel { display: flex; }
    .salon-chatbot-header { display: flex; justify-content: space-between; gap: 16px; padding: 18px 20px; background: #111; color: #fff; }
    .salon-chatbot-title { margin: 0; font-size: 13px; font-weight: 900; letter-spacing: 0.14em; text-transform: uppercase; }
    .salon-chatbot-status { margin: 5px 0 0; color: #d1d5db; font-size: 12px; line-height: 1.45; }
    .salon-chatbot-status.connected { color: #86efac; }
    .salon-chatbot-close, .salon-chatbot-toggle, .salon-chatbot-chip, .salon-chatbot-send { border: 0; cursor: pointer; font: inherit; }
    .salon-chatbot-close { width: 32px; height: 32px; background: #262626; color: #fff; font-size: 20px; line-height: 1; }
    .salon-chatbot-messages { flex: 1; overflow-y: auto; padding: 16px; background: #fafaf9; }
    .salon-chatbot-message { max-width: 88%; margin-bottom: 12px; padding: 11px 13px; font-size: 14px; line-height: 1.55; white-space: pre-line; }
    .salon-chatbot-message.bot { background: #fff; color: #374151; border: 1px solid #eee7dd; }
    .salon-chatbot-message.user { margin-left: auto; background: #111; color: #fff; }
    .salon-chatbot-chips { display: flex; flex-wrap: wrap; gap: 8px; padding: 0 16px 14px; background: #fafaf9; }
    .salon-chatbot-chip { padding: 8px 10px; border: 1px solid #e5e7eb; background: #fff; color: #111; font-size: 11px; font-weight: 800; letter-spacing: 0.08em; text-transform: uppercase; }
    .salon-chatbot-form { display: flex; gap: 10px; padding: 14px; border-top: 1px solid #e5e7eb; background: #fff; }
    .salon-chatbot-input { min-width: 0; flex: 1; padding: 11px 12px; border: 1px solid #d1d5db; color: #111; outline: none; }
    .salon-chatbot-input:focus { border-color: #d97706; box-shadow: 0 0 0 3px rgba(217,119,6,0.12); }
    .salon-chatbot-send { padding: 0 15px; background: #d97706; color: #111; font-size: 12px; font-weight: 900; text-transform: uppercase; }
    .salon-chatbot-toggle { width: 68px; height: 68px; margin-left: auto; background: #111; color: #fff; box-shadow: 0 16px 44px rgba(0,0,0,0.28); font-size: 12px; font-weight: 900; letter-spacing: 0.08em; text-transform: uppercase; }
    @media (max-width: 640px) { .salon-chatbot { right: 16px; bottom: 16px; } }
</style>

<div class="salon-chatbot" data-salon-chatbot>
    <section class="salon-chatbot-panel" aria-label="Salon TwentyTwo chatbot">
        <div class="salon-chatbot-header">
            <div>
                <h2 class="salon-chatbot-title">Salon Assistant</h2>
                <p class="salon-chatbot-status" data-chatbot-status>Connecting to WebSocket...</p>
            </div>
            <button type="button" class="salon-chatbot-close" data-chatbot-close aria-label="Close chatbot">&times;</button>
        </div>

        <div class="salon-chatbot-messages" data-chatbot-messages></div>

        <div class="salon-chatbot-chips">
            <button type="button" class="salon-chatbot-chip" data-chatbot-question="What time are you open?">Hours</button>
            <button type="button" class="salon-chatbot-chip" data-chatbot-question="Where are you located?">Location</button>
            <button type="button" class="salon-chatbot-chip" data-chatbot-question="How do I book?">Booking</button>
            <button type="button" class="salon-chatbot-chip" data-chatbot-question="What services do you offer?">Services</button>
        </div>

        <form class="salon-chatbot-form" data-chatbot-form>
            <input class="salon-chatbot-input" data-chatbot-input type="text" placeholder="Ask Salon TwentyTwo..." autocomplete="off">
            <button class="salon-chatbot-send" type="submit">Send</button>
        </form>
    </section>

    <button type="button" class="salon-chatbot-toggle" data-chatbot-toggle>Chat</button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const widget = document.querySelector('[data-salon-chatbot]');
        if (!widget) return;

        const status = widget.querySelector('[data-chatbot-status]');
        const messages = widget.querySelector('[data-chatbot-messages]');
        const input = widget.querySelector('[data-chatbot-input]');
        const form = widget.querySelector('[data-chatbot-form]');
        const toggle = widget.querySelector('[data-chatbot-toggle]');
        const close = widget.querySelector('[data-chatbot-close]');
        const chips = widget.querySelectorAll('[data-chatbot-question]');
        let socket = null;

        function addMessage(text, sender) {
            const bubble = document.createElement('div');
            bubble.className = 'salon-chatbot-message ' + sender;
            bubble.textContent = text;
            messages.appendChild(bubble);
            messages.scrollTop = messages.scrollHeight;
        }

        function setStatus(text, connected) {
            status.textContent = text;
            status.classList.toggle('connected', connected);
        }

        function connect() {
            socket = new WebSocket('ws://127.0.0.1:8091');
            setStatus('Connecting to ws://127.0.0.1:8091', false);

            socket.addEventListener('open', function () {
                setStatus('Connected with WebSocket', true);
            });

            socket.addEventListener('message', function (event) {
                try {
                    const payload = JSON.parse(event.data);
                    addMessage(payload.message || event.data, 'bot');
                } catch (error) {
                    addMessage(event.data, 'bot');
                }
            });

            socket.addEventListener('close', function () {
                setStatus('Disconnected. Reconnecting...', false);
                window.setTimeout(connect, 2000);
            });

            socket.addEventListener('error', function () {
                setStatus('Server offline. Run: php artisan salon-chatbot:serve', false);
            });
        }

        function sendQuestion(question) {
            const cleaned = question.trim();
            if (!cleaned) return;

            addMessage(cleaned, 'user');
            input.value = '';

            if (!socket || socket.readyState !== WebSocket.OPEN) {
                addMessage('WebSocket server is not connected. Start it with: php artisan salon-chatbot:serve', 'bot');
                return;
            }

            socket.send(JSON.stringify({
                type: 'user-message',
                message: cleaned
            }));
        }

        toggle.addEventListener('click', function () {
            widget.classList.toggle('open');
            if (widget.classList.contains('open')) input.focus();
        });

        close.addEventListener('click', function () {
            widget.classList.remove('open');
        });

        form.addEventListener('submit', function (event) {
            event.preventDefault();
            sendQuestion(input.value);
        });

        chips.forEach(function (chip) {
            chip.addEventListener('click', function () {
                sendQuestion(chip.dataset.chatbotQuestion || chip.textContent);
            });
        });

        connect();
    });
</script>
