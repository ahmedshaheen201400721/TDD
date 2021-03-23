<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $with=['owner'];

    public function owner(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function thread(){
        return $this->belongsTo(Thread::class);
    }

    public function likes(){
        return $this->morphMany(Like::class,'likeable');
    }
    public function incrementLikes(){
        if(!$this->likes()->where("user_id",auth()->id())->exists()){
            $this->likes()->create(['user_id'=>auth()->id()]);
        }
    }

}
