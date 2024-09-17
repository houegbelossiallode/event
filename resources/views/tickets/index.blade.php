<!DOCTYPE html>
<html>
<head>
    <title>Liste des Tickets</title>
</head>
<body>
    <h1>Liste des Tickets</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom de l'événement</th>
                <th>Code du ticket</th>
                <th>QR Code</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->event_name }}</td>
                    <td>{{ $ticket->ticket_code }}</td>
                    <td>
                        @if ($ticket->qr_code_base64)
                            <img src="{{ $ticket->qr_code_base64 }}" alt="QR Code" style="width: 100px; height: 100px;">
                        
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>