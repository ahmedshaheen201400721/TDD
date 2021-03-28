<?php


namespace App\support\filters\traits;

use App\Models\Activity;

trait RecordActivity
{
    protected static function bootRecordActivity(){
        if(auth()->guest()) return ;
        foreach (static::activitiesTypes() as $type) {
            static::$type(fn($item) => $item->recordActivity($type));
        }
    }

    public static function activitiesTypes(){
             return ['created','deleted'];
    }

    public function recordActivity($event){

        $this->activities()->create([
            'user_id'=>auth()->id(),
            'type'=>$this->recordType($event),
        ]);
    }
    public function recordType($event){
        $type=strtolower((new \ReflectionClass($this))->getShortName());
        return "{$event}_{$type}";
    }

    public function activities(){
        return $this->morphMany(Activity::class,'subject');
    }
}
