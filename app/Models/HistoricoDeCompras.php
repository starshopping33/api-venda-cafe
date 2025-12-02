<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoricoDeCompras extends Model
{
    protected $table = 'historico_compras'; 

    protected $fillable = ['user_id', 'produto'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
