<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Espace extends Model
{
    use HasFactory;
    protected $fillable = [
        'floor',
        'description',
        'status',
        'price',
        'capacity',
        'client_categorie',
        'images',
    ];
}
