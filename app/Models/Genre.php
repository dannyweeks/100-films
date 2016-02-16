<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = ['name'];

    // Relationships
    public function films()
    {
        return $this->belongsToMany(Film::class);
    }

    public function __toString()
    {
        return $this->name;
    }
}
