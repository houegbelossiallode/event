<?php

namespace App\Imports;

use App\Models\Realisation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RealisationImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Realisation([
            'id_objectif'      => $row['id_objectif'],   // Assurez-vous que les noms de colonnes correspondent à ceux du fichier Excel
            'id_commercial'    => $row['id_commercial'],
            'chiffre' => $row['chiffre'],
            'nombre'            =>$row['nombre'],
            'date_realisation'             => \Carbon\Carbon::parse($row['date_realisation']),
        ]);
    }
}