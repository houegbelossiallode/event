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
}