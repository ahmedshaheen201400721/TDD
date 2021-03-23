<?php


namespace App\support\filters;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    protected $request;
    protected $builder;

    public function __construct(Request $request)
    {
        $this->request=$request;
    }


    public function filters(){
        return $this->request->all();
    }


    public function apply(Builder  $builder){
        $this->builder=$builder;
        foreach ($this->filters() as $method=>$arg){
            if(method_exists($this,$method)){
                call_user_func_array([$this,$method],array_filter([$arg]));
            }
        }
        return $this->builder;
    }
}
