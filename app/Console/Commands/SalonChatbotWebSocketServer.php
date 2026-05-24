<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SalonChatbotWebSocketServer extends Command
{
    protected $signature = 'salon-chatbot:serve {--host=127.0.0.1} {--port=8091}';

    protected $description = 'Start the Salon TwentyTwo chatbot WebSocket server.';

    /** @var array<int, resource> */
    private array $clients = [];

    public function handle(): int
    {
        $host = (string) $this->option('host');
        $port = (int) $this->option('port');
        $server = @stream_socket_server("tcp://{$host}:{$port}", $errno, $error);

        if (! $server) {
            $this->error("Could not start WebSocket server: {$error} ({$errno})");

            return self::FAILURE;
        }

        stream_set_blocking($server, false);
        $this->info("Salon chatbot WebSocket server running at ws://{$host}:{$port}");
        $this->line('Open the website with HTTP. Do not open this WebSocket URL directly in the browser.');

        while (true) {
            $read = array_merge([$server], $this->clients);
            $write = null;
            $except = null;

            if (@stream_select($read, $write, $except, null) === false) {
                continue;
            }

            foreach ($read as $socket) {
                if ($socket === $server) {
                    $this->acceptClient($server);
                    continue;
                }

                $this->handleClientMessage($socket);
            }
        }
    }

    /**
     * @param resource $server
     */
    private function acceptClient($server): void
    {
        $client = @stream_socket_accept($server, 0);

        if (! $client) {
            return;
        }

        stream_set_blocking($client, false);
        $this->clients[(int) $client] = $client;
    }

    /**
     * @param resource $client
     */
    private function handleClientMessage($client): void
    {
        $data = @fread($client, 4096);

        if ($data === '' || $data === false) {
            $this->disconnect($client);
            return;
        }

        if (str_contains($data, 'Sec-WebSocket-Key')) {
            $this->handshake($client, $data);
            $this->sendJson($client, [
                'type' => 'bot',
                'message' => 'Hi, welcome to Salon TwentyTwo. Ask me about booking, hours, location, services, contact, or socials.',
            ]);
            return;
        }

        if (str_starts_with($data, 'GET ') || str_starts_with($data, 'POST ')) {
            $this->sendHttpInfo($client);
            $this->disconnect($client);
            return;
        }

        $message = $this->decodeFrame($data);

        if ($message === null || trim($message) === '') {
            return;
        }

        $payload = json_decode($message, true);
        $question = is_array($payload) ? (string) ($payload['message'] ?? '') : $message;

        $this->sendJson($client, [
            'type' => 'bot',
            'message' => $this->answer($question),
        ]);
    }

    /**
     * @param resource $client
     */
    private function handshake($client, string $headers): void
    {
        preg_match('/Sec-WebSocket-Key:\s*(.*)\r\n/i', $headers, $matches);

        $key = trim($matches[1] ?? '');
        $accept = base64_encode(sha1($key . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11', true));
        $response = "HTTP/1.1 101 Switching Protocols\r\n"
            . "Upgrade: websocket\r\n"
            . "Connection: Upgrade\r\n"
            . "Sec-WebSocket-Accept: {$accept}\r\n\r\n";

        fwrite($client, $response);
    }

    private function decodeFrame(string $data): ?string
    {
        if (strlen($data) < 6) {
            return null;
        }

        $length = ord($data[1]) & 127;

        if ($length === 126) {
            $maskOffset = 4;
            $payloadOffset = 8;
        } elseif ($length === 127) {
            $maskOffset = 10;
            $payloadOffset = 14;
        } else {
            $maskOffset = 2;
            $payloadOffset = 6;
        }

        if (strlen($data) < $payloadOffset) {
            return null;
        }

        $masks = substr($data, $maskOffset, 4);
        $payload = substr($data, $payloadOffset);
        $decoded = '';

        for ($i = 0, $payloadLength = strlen($payload); $i < $payloadLength; $i++) {
            $decoded .= $payload[$i] ^ $masks[$i % 4];
        }

        return $decoded;
    }

    private function encodeFrame(string $message): string
    {
        $length = strlen($message);
        $header = chr(129);

        if ($length <= 125) {
            return $header . chr($length) . $message;
        }

        if ($length <= 65535) {
            return $header . chr(126) . pack('n', $length) . $message;
        }

        return $header . chr(127) . pack('J', $length) . $message;
    }

    /**
     * @param resource $client
     */
    private function sendHttpInfo($client): void
    {
        $body = '<!doctype html><html><head><meta charset="utf-8"><title>Salon Chatbot WebSocket</title></head>'
            . '<body style="font-family:Arial,sans-serif;padding:32px;line-height:1.6">'
            . '<h1>Salon Chatbot WebSocket Server</h1>'
            . '<p>This port is for WebSocket chatbot messages, not the website page.</p>'
            . '<p>Open the Laravel/XAMPP website URL instead, and the chatbot will connect here in the background.</p>'
            . '</body></html>';

        $response = "HTTP/1.1 426 Upgrade Required\r\n"
            . "Content-Type: text/html; charset=UTF-8\r\n"
            . 'Content-Length: ' . strlen($body) . "\r\n"
            . "Connection: close\r\n\r\n"
            . $body;

        @fwrite($client, $response);
    }

    /**
     * @param resource $client
     * @param array<string, string> $payload
     */
    private function sendJson($client, array $payload): void
    {
        @fwrite($client, $this->encodeFrame((string) json_encode($payload)));
    }

    /**
     * @param resource $client
     */
    private function disconnect($client): void
    {
        unset($this->clients[(int) $client]);
        @fclose($client);
    }

    private function answer(string $question): string
    {
        $normalized = strtolower($question);

        if ($this->matches($normalized, ['hour', 'open', 'close', 'time', 'schedule'])) {
            return 'Salon TwentyTwo is open every day from 10:00am to 10:00pm.';
        }

        if ($this->matches($normalized, ['location', 'address', 'where', 'map', 'pasig'])) {
            return 'We are located at Escentra Bldg, Dr. Pilapil St., Kapasigan, Pasig City.';
        }

        if ($this->matches($normalized, ['phone', 'number', 'call', 'contact', 'text'])) {
            return 'You can contact Salon TwentyTwo at 0924 132 1925, or send a message through the Contact page.';
        }

        if ($this->matches($normalized, ['book', 'booking', 'appointment', 'reserve'])) {
            return 'To book an appointment, click Book Now in the navigation. You can choose your service, stylist, date and time, and optionally pay a downpayment to secure your slot.';
        }

        if ($this->matches($normalized, ['service', 'haircut', 'cut', 'colour', 'color', 'style', 'styling', 'bridal', 'event'])) {
            return 'Our services include sculpted cuts, signature colour, event styling, and complimentary consultations.';
        }

        if ($this->matches($normalized, ['instagram', 'ig', 'facebook', 'social'])) {
            return "Instagram: https://www.instagram.com/twentytwo.salon/\nFacebook: https://www.facebook.com/profile.php?id=61562223720806";
        }

        if ($this->matches($normalized, ['email', 'message', 'inquiry', 'owner'])) {
            return 'Use the Contact page to email the salon owner. The client also receives a confirmation copy of their message.';
        }

        return 'I can help with Salon TwentyTwo hours, location, booking, services, contact details, and social links.';
    }

    /**
     * @param array<int, string> $keywords
     */
    private function matches(string $message, array $keywords): bool
    {
        foreach ($keywords as $keyword) {
            if (str_contains($message, $keyword)) {
                return true;
            }
        }

        return false;
    }
}
