<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;

    public function flats()
    {
        return $this->belongsToMany(Flat::class);
    }

    protected $fillable = [
        'price',
        'duration',
    ];
}
