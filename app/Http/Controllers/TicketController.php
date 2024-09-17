<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function liste()
    {
        // Récupérer tous les tickets
        $tickets = Ticket::all();
    
        // Parcourir les tickets pour convertir le chemin des QR codes en base64
        foreach ($tickets as $ticket) {
            $qrCodePath = public_path('qr_codes/' . $ticket->qr_code_path); // Assurez-vous que le chemin est correct
            $ticket->qr_code_base64 = $this->convertImageToBase64($qrCodePath);
        }
    
        // Passer les tickets à la vue
        return view('tickets.index', ['tickets' => $tickets]);
    }
    
    private function convertImageToBase64($path)
    {
        if (file_exists($path)) {
            $imageData = file_get_contents($path);
            $mimeType = mime_content_type($path);
            return 'data:' . $mimeType . ';base64,' . base64_encode($imageData);
        }
        return null;
    }
}