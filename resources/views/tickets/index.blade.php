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
                            <img src="{{ asset($ticket->qr_code_path)}}" alt="QR Code" style="width: 100px; height: 100px;">
                    </td>
                    <td>
                        <a href="{{ route('tickets.imprimer', $ticket->id) }}" class="btn btn-primary">
                            Imprimer le QR code
                        </a>
                    </td>
                    

                </tr>
            @endforeach


        </tbody>
    </table>
</body>
</html>


