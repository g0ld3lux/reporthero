<?php

namespace Reporthero\Http\Requests;

use Illuminate\Http\Request;
use Carbon\Carbon;

class CampaignFilters
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

    // Create / Update Campaign Props
    // optional string
    public function byListID()
    {
        return $id = $this->request->input('list_id');

    }
    // optional string
    public function byTemplateID()
    {
        return $id = $this->request->input('template_id');
    }
    // optional string
    public function byFromEmail()
    {
        $email = $this->request->input('from_email');
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        return $email;
        }
    }
    // optional string
    public function byFromName()
    {
        return $name = $this->request->input('from_name');
    }
    // optional string
    public function bySubject()
    {
        return $subject = $this->request->input('subject');
    }
    // optional string
    // if none provided will default to  subject  of the campaign
    public function byName()
    {
        return $name = $this->request->input('name');
    }
    // optional boolean
    // defaults true
    public function byUseSmartSending()
    {
        $smartSending = $this->request->input('use_smart_sending');
        if(is_bool($smartSending))
        {
            return $smartSending;
        }
        return true;
    }
    // optional boolean
    // default false
    public function byGoogleAnalytics()
    {
        $googleAnalytics = $this->request->input('add_google_analytics');
        if(is_bool($googleAnalytics))
        {
            return $googleAnalytics;
        }
        return false;
    }
    // A timestamp of the format "%Y-%m-%d %H:%M:%S" in the UTC timezone.
    public function bySendTime()
    {
        $time = $this->request->input('send_time');
        // Parse Date then Format it to Correct Format
        return $time = Carbon::parse($time)->toDateTimeString();
    }

}
