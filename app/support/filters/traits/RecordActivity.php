<?php


namespace App\support\filters\traits;

use App\Models\Activity;

trait RecordActivity
{
    protected static function bootRecordActivity(){

        static::deleting(function ($item){
            $item->activities()->each->delete();
        });

        if(auth()->guest()) return ;
        foreach (static::activitiesTypes() as $type) {
            static::$type(fn($item) => $item->makeActivity($type));
        }
    }

    public static function activitiesTypes(){
             return ['created'];
    }

    public function makeActivity($event){

        $this->activities()->create([
            'user_id'=>auth()->id(),
            'type'=>$this->getType($event),
        ]);
    }
    public function getType($event){
        $type=strtolower((new \ReflectionClass($this))->getShortName());
        return "{$event}_{$type}";
    }

    public function activities(){
        return $this->morphMany(Activity::class,'subject');
    }
}
