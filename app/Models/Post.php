<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
       'likes',
        'caption',
        'file_path',
        'image_data',

    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

   // public function comments(){
        //return $this->hasMany(Comment::class);
    //}

}
