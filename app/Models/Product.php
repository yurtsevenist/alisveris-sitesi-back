<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function getPhoto()
    {
        return $this->hasMany('App\Models\Photo','urun_id','id');
    }
}
