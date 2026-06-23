<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cookie_histories', function (Blueprint $table) {
            $table->id();
            
            // --- AGREGAMOS ESTAS 3 LÍNEAS ---
            // 1. Vinculamos con el usuario (si se borra el usuario, se borra su historial)
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            // 2. Guardamos la frase que le salió
            $table->text('message'); 
            // 3. Guardamos la fecha y hora exacta
            $table->timestamp('opened_at'); 
            // ---------------------------------
            
            $table->timestamps(); // Esto deja el created_at y updated_at por defecto
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cookie_histories');
    }
};