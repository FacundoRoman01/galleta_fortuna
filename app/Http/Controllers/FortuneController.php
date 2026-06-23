<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CookieHistory;
use App\Models\FortuneMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Importamos la clase para manejar archivos

class FortuneController extends Controller
{
    public function abrir()
    {
        // Traemos mensaje aleatorio
        $mensajeElegido = FortuneMessage::inRandomOrder()->first();
        $fechaActual = now(); 

        // 1. Guardamos en Base de Datos
        CookieHistory::create([
            'user_id' => Auth::id(),
            'message' => $mensajeElegido->content,
            'opened_at' => $fechaActual,
        ]);

        // 2. Operación de Escritura de Archivos (Auditoría)
        $logMessage = "[" . $fechaActual->format('Y-m-d H:i:s') . "] ACCIÓN: Galleta abierta - USUARIO: " . Auth::user()->username;
        Storage::append('auditoria.log', $logMessage);

        // 3. Devolvemos la vista
        return view('resultado', [
            'mensaje' => $mensajeElegido->content,
            'fecha' => $fechaActual->format('d/m/Y H:i:s')
        ]);
    }
}