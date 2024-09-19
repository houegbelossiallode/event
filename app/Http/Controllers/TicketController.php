<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

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
        $ticketCode = Str::random(4); // Générer un code unique pour le ticket

        // Passer les tickets à la vue
        return view('tickets.index', ['tickets' => $tickets]);
    }


    public function imprimer(Ticket $ticket)
    {
        // Vérifier si le QR code existe
        if (!$ticket->qr_code) {
            return redirect()->back()->with('error', 'Le QR code est introuvable.');
        }

        // Générer le PDF avec le QR code
        $pdf = Pdf::loadView('tickets.pdf', compact('ticket'));
// Définir le nom du fichier PDF
$filename = 'ticket_' . $ticket->id . '_qr_code.pdf';

// Télécharger le PDF avec les headers appropriés
return Response::make($pdf->output(), 200, [
    'Content-Type' => 'application/pdf',
    'Content-Disposition' => 'attachment; filename="' . $filename . '"',
]);
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