<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    public function espaces()
    {
        return $this->belongsToMany(Espace::class);
    }
}
