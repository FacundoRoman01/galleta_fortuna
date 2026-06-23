<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

// Le decimos a Laravel qué columnas vamos a llenar manualmente
#[Fillable(['user_id', 'message', 'opened_at'])]
class CookieHistory extends Model
{
    use HasFactory;
}