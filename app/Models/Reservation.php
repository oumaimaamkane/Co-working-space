<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'check_in_date',
        'check_out_date',
        'total_price',
        'user_id',
        'espace_id',
        'status',
    ];

    public const STATUT_RADIO = [
        'confirmed' => 'confirmed',
        'canceled' => 'canceled',
    ];

    public function getStatut()
    {
        return self::STATUT_RADIO[$this->statut];
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function espace()
    {
        return $this->belongsTo(Espace::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
