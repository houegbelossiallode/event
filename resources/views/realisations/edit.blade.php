<!DOCTYPE html>
<html>
<head>
    <title>Modifier la réalisation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Modifier la réalisation</h2>

    <!-- Afficher les erreurs de validation -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('realisation.update', $realisation->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="id_objectif">ID Objectif</label>
            <input type="text" name="id_objectif" class="form-control" value="{{ $realisation->id_objectif }}" required>
        </div>

        <div class="form-group">
            <label for="id_commercial">ID Commercial</label>
            <input type="text" name="id_commercial" class="form-control" value="{{ $realisation->id_commercial }}" required>
        </div>

        <div class="form-group">
            <label for="nombre_chiffre_affaires">Chiffre d'Affaires</label>
            <input type="text" name="chiffre" class="form-control" value="{{ $realisation->chiffre}}" required>
        </div>

        <div class="form-group">
            <label for="nombre">Nombre Chiffre d'Affaires</label>
            <input type="text" name="nombre" class="form-control" value="{{ $realisation->nombre}}" required>
        </div>

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date_realisation" class="form-control" value="{{ $realisation->date_realisation}}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Mettre à jour</button>
    </form>
</div>

</body>
</html>
