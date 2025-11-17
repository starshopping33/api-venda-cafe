<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class FilaCompra extends Model
{
    protected $fillable = ['user_id', 'posicao_fila'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}