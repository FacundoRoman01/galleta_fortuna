<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CookieHistory;
use App\Models\FortuneMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; 

class FortuneController extends Controller
{
    public function abrir()
    {
      
        $mensajeElegido = FortuneMessage::inRandomOrder()->first();
        $fechaActual = now(); 

        
        CookieHistory::create([
            'user_id' => Auth::id(),
            'message' => $mensajeElegido->content,
            'opened_at' => $fechaActual,
        ]);

       
        $logMessage = "[" . $fechaActual->format('Y-m-d H:i:s') . "] ACCIÓN: Galleta abierta - USUARIO: " . Auth::user()->username;
        Storage::append('auditoria.log', $logMessage);

        
        return view('resultado', [
            'mensaje' => $mensajeElegido->content,
            'fecha' => $fechaActual->format('d/m/Y H:i:s')
        ]);
    }
}