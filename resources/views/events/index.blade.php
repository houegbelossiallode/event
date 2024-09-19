
<form action="{{ route('checkout') }}" method="POST">
    @csrf
    <label for="event">Choisir un événement :</label>
    <select name="event_id" required>
        @foreach($events as $event)
            <option value="{{ $event->id }}">{{ $event->name }} - {{ $event->price }}</option>
        @endforeach
    </select>

    <label for="quantity">Quantité de tickets :</label>
    <input type="number" name="quantity" min="1" required>

    <button type="submit">Procéder au paiement</button>
</form>

{{ $qrcode }}



