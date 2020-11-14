<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'category_id', 'title', 'content', 'thumbnail','status',
    ];

    public function category(){
        return $this->belongsTo(Category::class)->select('id','name','slug');
    }

    public function user(){
        return $this->belongsTo(User::class)->select('id','name');
    }
}
