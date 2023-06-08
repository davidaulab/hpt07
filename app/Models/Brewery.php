<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brewery extends Model
{
    use HasFactory;

    public $fillable = ['name', 'place', 'description', 'latitude', 'longitude', 'img'];

    public function user () {        
        return $this->belongsTo(User::class);
    }

    public function images () {
        return $this->hasMany(Image::class);
    }

    public function beers () {
        return $this->belongsToMany(Beer::class, 'beer_brewery');
    }
}
