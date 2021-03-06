<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user(){
       return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(category::class);
    }

    public function photos(){
        return $this->hasMany(Photo::class);
    }

    public function tags(){
        return $this->belongsToMany(Tags::class);
    }

}
