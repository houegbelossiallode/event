<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>QR Code Vente {{ $ticket->id }}</title>
    <style>
        body {
            font-family: sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .qr-code {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <h1>Ticket #{{ $ticket->id }}</h1>
    <p>Description: {{ $ticket->ticket_code}}</p>
    <div class="qr-code">
        <img src="{{ public_path($ticket->qr_code_path) }}" alt="QR Code">
    </div>
</body>
</html>
