<?php

namespace App\Models;

use App\support\filters\traits\likeable;
use App\support\filters\traits\RecordActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{

    use HasFactory,likeable,RecordActivity;
    protected $guarded=[];
    protected $with=['owner','likes'];

    public function owner(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function thread(){
        return $this->belongsTo(Thread::class);
    }




}
