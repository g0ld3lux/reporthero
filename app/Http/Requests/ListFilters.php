<?php

namespace Reporthero\Http\Requests;

use Illuminate\Http\Request;
use Carbon\Carbon;

class ListFilters
{
   public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    // Default to 0
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
    // Default 50
    // Maximum is 100
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

    public function bySort()
    {
        $sort = $this->request->input('sort');
        // if empty provide default
        if(empty($sort)){
            $sort = 'desc';
       // if value provided is not found give the default value
        }
        $rule = ['desc', 'asc'];
        if (!in_array($sort, $rule, true)) {
          $sort = 'desc';
        }
        return $sort;

    }
    public function byName()
    {
        return $name = $this->request->input('name');

    }

    public function byListType()
    {
        $rule = ['standard' , 'dynamic'];
        $type = $this->request->input('list_type');
        if(in_array($type, $rule, true))
        {
            return $type;
        }
        // always default to standard
        return 'standard';
    }

    protected function isJson($string) {
    return !preg_match('/[^,:{}\\[\\]0-9.\\-+Eaeflnr-u \\n\\r\\t]/',
       preg_replace('/"(\\.|[^"\\\\])*"/', '', $string));
    
    }

    public function byEmail()
    {
        $emails = $this->request->input('email');

        return $emails;

    }

    public function byProperties()
    {
        $props = $this->request->input('properties');
        if($this->isJson($props)){
            return $props = json_decode($props);  
        }

    }

    public function byConfirmOptin()
    {
        $confirm = $this->request->input('confirm_optin');
        if(is_bool($confirm))
        {
            return $confirm;
        }
        return true;

    }

    public function byBatch()
    {
        $batch = $this->request->input('batch');

        if($this->isJson($batch)){
            return $batch = json_decode($batch);
        }
        return $batch;

    }

    public function byTimeStamp()
    {
        $time = $this->request->input('timestamp');
        
        if($this->isValidTimeStamp($time) && !empty($time)){
            return $time;
        }
        return $time = Carbon::now()->timestamp;
    }

    protected function isValidTimeStamp($timestamp)
    {
    return ((string) (int) $timestamp === $timestamp) 
        && ($timestamp <= PHP_INT_MAX)
        && ($timestamp >= ~PHP_INT_MAX);
    }

    public function byReason()
    {
        $reason = $this->request->input('reason');

        $reasons = ['unsubscribed', 'bounced', 'invalid_email', 'reported_spam', 'manually_excluded'];

        if (in_array($reason, $reasons, true)) {
          return $reason;
        }

    }
    
}
