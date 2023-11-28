<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto';

    protected $primaryKey = 'id_producto';

    public $timestamps = false;

    protected $fillable = [
        'marca',
        'modelo',
        'tipo_producto',
        'precio_costo',
        'precio_unitario',
        'precio_mayoreo',
        'id_proveedor'
    ];
}
