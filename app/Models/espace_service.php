<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class espace_service extends Model
{
    use HasFactory;
    protected $fillable = [
        'espace_id',
        'service_id',
    ];
}
