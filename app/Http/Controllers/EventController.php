<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use FedaPay\Transaction;

class EventController extends Controller
{
    public function index()
{
      //  Event::create([
        //    'name'=> 'Concert de Jazz',
      //      'description'=>'Un concert de jazz avec des artistes locaux.',
          //  'date'=> '2024-10-01',
            //'price'=> '15000.00',
           // 'available_tickets'=> '100'
     //   ]);

       
    $events = Event::all(); // Récupérer tous les événements
    return view('events.index', compact('events'));
}




  














}