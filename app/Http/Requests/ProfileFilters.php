<?php 

namespace Reporthero\Http\Requests;

use Illuminate\Http\Request;

class ProfileFilters
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function byCount()
    {
        // count default is 100 for profiles
        $count = $this->request->input('count');
        if(empty($count)){
            $count = 100;
        }
        return $count;
    }

    public function bySince()
    {
        $since = $this->request->input('since');
        // check if valid timestamp and check if a valid uuid
        if($this->isValidTimeStamp($since) && $this->isValidUuid($since) && !empty($since)){
        return $since;
        }
        // else just return the current timestamp
        return  $since = \Carbon\Carbon::now()->timestamp;  
    }
    protected function isValidUuid($guid)
    {
        return preg_match("/^(\{)?[a-f\d]{8}(-[a-f\d]{4}){4}[a-f\d]{8}(?(1)\})$/i", $guid);
    }

    protected function isValidTimeStamp($timestamp)
    {
    return ((string) (int) $timestamp === $timestamp) 
        && ($timestamp <= PHP_INT_MAX)
        && ($timestamp >= ~PHP_INT_MAX);
    }
    // Note their API always return Null if we Pass in ASC
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

}