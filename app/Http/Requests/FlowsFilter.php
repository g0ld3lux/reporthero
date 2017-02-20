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

   
    
}
