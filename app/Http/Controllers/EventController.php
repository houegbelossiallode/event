<?php

namespace App\Http\Controllers;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Event;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use FedaPay\Transaction;

class EventController extends Controller
{
    public function index()
{
       # 2. On génère un QR code de taille 200 x 200 px
    	$qrcode = QrCode::size(110)->generate("Je suis un QR Code");


    $events = Event::all(); // Récupérer tous les événements
    return view('events.index', compact('events','qrcode'));
}



















}