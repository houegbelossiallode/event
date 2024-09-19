<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use FedaPay\FedaPay;
use App\Models\Event;
use App\Models\Order;
use App\Models\Ticket;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;
use FedaPay\Transaction;
use Illuminate\Support\Facades\Http;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{

    public function __construct()
    {
        // Configuration de FedaPay avec les clés API depuis le fichier .env
        FedaPay::setApiKey(env('FEDAPAY_SECRET_KEY'));
        FedaPay::setEnvironment(env('FEDAPAY_SANDBOX') ? 'sandbox' : 'live');
    }

public function checkout(Request $request)
{
    $event = Event::findOrFail($request->event_id);
    $quantity = $request->quantity;
    $totalPrice = $event->price * $quantity;

    // Créer une commande avec le statut 'pending'
    $order = Order::create([
        'user_id' => Auth::user()->id,
        'event_id' => $event->id,
        'quantity' => $quantity,
        'total_price' => $totalPrice,
        'payment_status' => 'pending',
    ]);

    // Créer la transaction FedaPay
   // $transaction = Transaction::create([
  //      'description' =>
  //      'amount' => // Montant en centimes
  //      'currency' => 'XOF',
 //       'callback_url' => route('payment.callback', ['orderId' => $order->id]), // URL de retour après paiement
 //       'customer' => [
 //           'firstname' => Auth::user()->name,
 //           'email' => Auth::user()->email,

 //       ]
 //   ]);
 // Préparer les données pour FedaPay
 $paymentData = [
     'amount' => $totalPrice,
     "currency" => ["iso" => "XOF"],
     'description' => "Commande pour l'événement " . $event->name,
     'callback_url' => route('payment.callback',['order_id'=>$order->id]),

 ];

 $transaction = \FedaPay\Transaction::create([
    'description' => $paymentData['description'],
    'amount' => $paymentData['amount'],
    'callback_url' => $paymentData['callback_url'],
    'currency' => ['iso'=>'XOF'],
 ]);
 //dd($transaction);
 $token = $transaction->generateToken()->url;
 //dd($token);
 //dd('https://me.fedapay.com/WqhPNuBW', $paymentData);
 // Envoyer la demande à FedaPay pour obtenir l'URL de paiement
 //$response = Http::post('https://me.fedapay.com/WqhPNuBW', $paymentData);

 // $transaction = Transaction::create(array());
 // $token = $transaction->generateToken();
 // return header('Location: ' . $token->url);


// Afficher la réponse brute pour débogage
//if ($response->failed()) {
 //   return response()->json([
  //      'error' => 'Erreur lors de la création du paiement',
 //       'status' => $response->status(),
 //       'body' => $response->body()
 //   ], $response->status());
//}

// Extraire l'URL de paiement de la réponse JSON
//$data = $response->json();
//$paymentUrl = $data['payment_url'] ?? null;

//if (!$paymentUrl) {
 //   return response()->json(['error' => 'URL de paiement non trouvée dans la réponse.'], 500);
//}

// Rediriger l'utilisateur vers l'URL de paiement
return redirect()->to($token);



}


public function paymentCallback(Request $request)
{
   // dd($request->all());
     // Vérifier le statut du paiement et récupérer l'ID de la commande
     $status = $request->query('status');
     $orderId = $request->query('order_id');

     // Rechercher la commande dans la base de données
     $order = Order::find($orderId);

     if ($status === 'approved' && $order) {
         // Mettre à jour le statut de paiement
         $order->payment_status = 'paid';
         $order->save();


         $ticketCode = Str::random(4); // Générer un code unique pour le ticket
        // Générer le QR code pour cette vente
        $result = Builder::create()
        ->writer(new PngWriter())
        ->data('code qr')
        ->encoding(new Encoding('UTF-8'))
        //->errorCorrectionLevel(new ErrorCorrectionLevelHigh)
        ->size(300)
        ->margin(10)
        ->build();

     // Sauvegarder l'image QR code dans le répertoire public
    $qrCodePath = 'qr_codes/' . $ticketCode . '.png';
    file_put_contents(public_path($qrCodePath), $result->getString());
   // Storage::put('public/' . $qrCodePath, $result->getString());
      // Créer un ticket pour l'utilisateur
         $ticket = Ticket::create([
                'user_id' => $order->user_id,
                'event_name' => $order->event->name,
                'ticket_code' => $ticketCode,
                'qr_code_path' => $qrCodePath,
         ]);

          // Retourner la réponse, par exemple une vue avec le QR Code
    return view('tickets.show', compact('ticketCode', 'ticket','result'));
     } else {
 // Rediriger en cas d'échec de paiement
       return redirect()->route('ticket.error')->with('error', 'Paiement non validé.');

      //  dd($commandeId);
        // Générer les tickets avec codes QR
      //  foreach (range(1, $order->quantity) as $i) {
      //      $ticketCode = Str::uuid(); // Générer un code unique pour le ticket
      //      $qrCodePath = 'qr_codes/' . $ticketCode . '.png';

            // Générer le QR Code
      //      QrCode::format('png')->size(300)->generate($ticketCode, public_path($qrCodePath));

            // Enregistrer chaque ticket
       //     Ticket::create([
       //         'user_id' => $order->user_id,
       //         'event_name' => $order->event->name,
      //          'ticket_code' => $ticketCode,
      //          'qr_code_path' => $qrCodePath,
      //      ]);
      //  }

        // Rediriger vers la page de confirmation avec les tickets générés
    //    return redirect()->route('event.index');
   // } else {
        // Paiement échoué, mise à jour du statut
    //    $order->update(['payment_status' => 'failed']);
    //    return redirect()->route('payment.failed', ['order_id' => $order->id]);
    }
}



public function success($id)
    {
        $ticket = Ticket::find($id);

        if ($ticket) {
            return view('tickets.success', compact('ticket'));
        } else {
            return redirect()->route('ticket.error')->with('error', 'Ticket non trouvé.');
       }
    }

    public function error()
    {

            return view('tickets.error');

    }












}