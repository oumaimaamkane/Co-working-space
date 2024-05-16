<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Espace extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
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
