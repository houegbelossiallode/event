<div class="container">
    <h1>Paiement effectué avec succès</h1>
    <p>Votre paiement a été effectué avec succès.</p>
    
    <p>Code Du Ticket: {{ $ticketCode}}</p>
    <p>QR Code URL: {{ asset($ticket->qr_code_path) }}</p>
    <img src="{{ asset($ticket->qr_code_path) }}" alt="QR Code pour le ticket">
    <a href="#" class="btn btn-primary">Retour à l'accueil</a>
</div>