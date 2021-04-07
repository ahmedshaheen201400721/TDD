<?php


namespace App\support\filters\traits;


use App\Models\Like;

trait likeable
{
    public function likes(){
        return $this->morphMany(Like::class,'likeable');
    }
    public function incrementLikes(){
        if(!$this->likes()->where("user_id",auth()->id())->exists()){
            $this->likes()->create(['user_id'=>auth()->id()]);
            return response('liked',200);
        }else{
            $this->likes()->where('user_id',auth()->id())->delete();
            return response('unliked',200);
        }
    }
    public function isLiked(){
        return $this->likes->where('user_id',auth()->id())->isNotEmpty();
    }
    public function likeCount(){
        return $this->likes->count();
    }

}
