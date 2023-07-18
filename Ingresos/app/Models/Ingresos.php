<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingresos extends Model
{
    use HasFactory;
    protected $table = "ingresos";
    protected $guarded = [];
    public function sumaMensual () : int {
        return $this->whereBetween('fecha', [date('Y-m-01'), date('Y-m-31')])->sum('monto');
    }
}
