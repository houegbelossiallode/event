<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\RealisationImport;
use App\Models\Realisation;
use Maatwebsite\Excel\Facades\Excel;

class RealisationController extends Controller
{
    public function import(Request $request)
    {
        // Validation du fichier Excel
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);

        // Importer les données du fichier Excel dans la table `realisation`
        Excel::import(new RealisationImport, $request->file('file'));

        // Rediriger avec un message de succès
        return back()->with('success', 'Les données ont été importées avec succès.');
    }

    public function index()
    {
        // Récupérer toutes les réalisations
        $realisations = Realisation::all();

        // Passer les réalisations à la vue
        return view('realisations.index', compact('realisations'));
    }


    public function edit($id)
{
    // Trouver la réalisation par son ID
    $realisation = Realisation::findOrFail($id);

    // Retourner la vue pour l'édition avec les données de la réalisation
    return view('realisations.edit', compact('realisation'));
}

public function update(Request $request, $id)
{
    // Valider les données envoyées
    $request->validate([
        'id_objectif' => 'required|integer',
        'id_commercial' => 'required|integer',
        'chiffre' => 'required|numeric',
        'nombre' => 'required|numeric',
        'date_realisation' => 'required|date',
    ]);

    // Trouver la réalisation par son ID et mettre à jour ses informations
    $realisation = Realisation::findOrFail($id);
    $realisation->update($request->all());

    // Rediriger avec un message de succès
    return redirect()->route('realisation.index')->with('success', 'Réalisation mise à jour avec succès.');
}


public function destroy($id)
{
    // Trouver et supprimer la réalisation
    $realisation = Realisation::findOrFail($id);
    $realisation->delete();

    // Rediriger avec un message de succès
    return redirect()->route('realisation.index')->with('success', 'Réalisation supprimée avec succès.');
}




}