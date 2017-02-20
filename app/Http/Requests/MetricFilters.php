<?php 

namespace Reporthero\Http\Requests;

use Illuminate\Http\Request;
use Carbon\Carbon;

class MetricFilters
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

    public function byStartDate()
    {
        $start_date = $this->request->input('start_date');

        // Do a Check and If Failed Provide Date Last Month
        if(empty($start_date) && !$this->checkIsAValidDate($start_date) && ($start_date >= Carbon::now()->toDateString()))
        {
            return $start_date = Carbon::now()->subMonth()->toDateString();
        }
        return $start_date;
    }

    protected function checkIsAValidDate($myDateString){
        return (bool)strtotime($myDateString);
    }

    public function byEndDate()
    {
        $end_date = $this->request->input('end_date');

        // Do a Check if Failed then Provide The Current Date
        if(empty($end_date) && !$this->checkIsAValidDate($end_date) && ($end_date > \Carbon\Carbon::now()->toDateString()))
        {
            return $end_date = Carbon::now()->toDateString();
        }
        return $end_date;
    }

    public function byUnit()
    {

        $unit = $this->request->input('unit');
        // if empty provide default which is 'day'
        $rule = ['day', 'week', 'month'];
        if(empty($unit) && !in_array($unit, $rule, true)){
            $unit = 'day';
        }
        return $unit;
    }
    public function byMeasurement()
    {
        $measurement = $this->request->input('measurement');
        
       // If it is in json Format then return the decoded json (Only Applicable for Sum Property)
       // ["sum","ItemCount"]
       if($this->isJson($measurement))
       {
         return $measurement = json_decode($measurement);  
       }
       
         // if value provided found from given array then return it
        $rule = ['unique', 'count', 'value'];
        if (in_array($measurement, $rule, true)) {
          return $measurement;
        }
        // return a default value for all...
        return $measurement = 'count'; 
    }
    protected function isJson($string) {
    return !preg_match('/[^,:{}\\[\\]0-9.\\-+Eaeflnr-u \\n\\r\\t]/',
       preg_replace('/"(\\.|[^"\\\\])*"/', '', $string));
    
    }
    
    public function byWhere()
    {
        // Return Null if None Was Given
         return $where = $this->request->input('where');

        // // Return the Decoded Json if it is Json
        // if($this->isJson($where))
        // {
        //     return $where = json_decode($where);
        // }

    }
    public function by()
    {
         $by = $this->request->input('by');
         return $by;
    }
}