<?php

namespace Reporthero\Http\Requests;

use Illuminate\Http\Request;
use Carbon\Carbon;

class FlowsFilter
{
   public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function byPage()
    {
        // page default is 0
        $page = $this->request->input('page');
        if(empty($page)){
            $page = 0;
        // deduct 1 if page is greater than 0
        }elseif($page>0){
            $page = $page - 1;
        // if negative number is provided return 0
        }else{
            $page = 0;
        }
        return $page;

    }

    public function byCount()
    {
        // count default is 50, max is 100
        $count = $this->request->input('count');
        if(empty($count)){
            $count = 50;
       // if count provided is greater than 100 just return 100
        }elseif($count >= 100){
            $count = 100;
        }
        return $count;

    }
   
    
}
