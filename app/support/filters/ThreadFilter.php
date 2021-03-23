<?php


namespace App\support\filters;


use App\Models\User;

class ThreadFilter extends QueryFilter
{
    public function author($author){
         return $this->builder->where('user_id',function ($query) use($author){
              $query->select('id')->from('users')->where('name',$author);
         });
    }

    public function popular(){
        return $this->builder->withCount('replies')->orderBy('replies_count','desc');
    }

}
