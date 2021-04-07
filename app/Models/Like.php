<?php

namespace App\Models;

use App\support\filters\traits\RecordActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory,RecordActivity;
    protected $guarded=[];
//    protected $with=['likeable'];

    public function likeable(){
        return $this->morphTo();
    }
}
