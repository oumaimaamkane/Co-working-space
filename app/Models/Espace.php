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
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'espace_service', 'espace_id', 'service_id');
    }
}
