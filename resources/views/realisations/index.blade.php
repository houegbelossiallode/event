<!DOCTYPE html>
<html>
<head>
    <title>Liste des réalisations</title>
    <!-- Ajouter Bootstrap pour le style (optionnel) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Liste des réalisations</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Objectif</th>
                <th>ID Commercial</th>
                <th>Chiffre d'Affaires</th>
                <th>Nombre de client</th>
                <th>Date de la réalisation</th>
            </tr>
        </thead>
        <tbody>
            @foreach($realisations as $realisation)
            <tr>
                <td>{{ $realisation->id_objectif }}</td>
                <td>{{ $realisation->id_commercial }}</td>
                <td>{{ $realisation->chiffre}}</td>
                <td>{{ $realisation->nombre}}</td>
                <td>{{ $realisation->date_realisation}}</td>
                <td>
                    <a href="{{ route('realisation.edit', $realisation->id) }}" class="btn btn-warning btn-sm">Modifier</a>

                    <form action="{{ route('realisation.destroy', $realisation->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réalisation ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
