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
    $events = Event::all(); // Récupérer tous les événements
    return view('events.index', compact('events'));
}




  














}