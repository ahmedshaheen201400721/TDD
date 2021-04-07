<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Subscription extends Pivot
{
    use HasFactory;
    protected $guarded=[];
    public $incrementing = true;
    protected $table='subscriptions';
}
