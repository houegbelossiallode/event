<div class="container">
    <h1>Paiement Réussi</h1>
    <p>Votre paiement a été effectué avec succès.</p>
    <p>Ticket ID: {{ $ticket->id }}</p>
    <p>Code du ticket: {{ $ticket-> }} XOF</p>
    <p>Numéro de commande: {{ $ticket->order_id }}</p>
    <img src="{{ asset($qrCodePath) }}" alt="QR Code pour le ticket">
    <a href="#" class="btn btn-primary">Retour à l'accueil</a>
</div>