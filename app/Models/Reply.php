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



}
