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
        'category_id',
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'espace-service', 'espace_id', 'service_id');
    }

    public function equipements()
    {
        return $this->belongsToMany(Equipement::class, 'espace-equipement', 'espace_id', 'equipement_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    protected $with = ['category'];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id' , 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}