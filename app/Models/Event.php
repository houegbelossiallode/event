<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'date',
        'price',
        'available_tickets',
    ];

    // Si nécessaire, vous pouvez également ajouter des relations ici
    // Exemple : un évènement peut avoir plusieurs commandes (tickets vendus)
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}