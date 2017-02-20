<?php

namespace Reporthero\Http\Controllers\Api;

use Illuminate\Http\Request;
use Reporthero\Http\Controllers\Controller;
use Reporthero\Klaviyo;
use Reporthero\Http\Requests\TrackFilters;

class TrackController extends Controller
{
    protected $api;

    protected $filter;

    public function __construct(Klaviyo $klaviyo, TrackFilters $filter) {
        $this->api = $klaviyo;
        $this->filter = $filter;
    }
    /**
     * Arguments for Endpoint
     * https://www.klaviyo.com/docs/http-api#track
     * @return array of args
     */
    protected function setTrackFilters()
    {
        $this->api->setApiVersion('api');
        // $this->api->setToken('xNSPkV'); // Sample Account Token
        $this->api->setEvent($this->filter->byEvent());
        $this->api->setCustomerProperties($this->filter->byCustomerProps());
        $this->api->setProperties($this->filter->byProps());
        $this->api->setTime($this->filter->ByTime());
    }
    // we have Extracted the Build Params Method Since It Has Difference Implementation for Identify Api
    protected function buildParams()
    {
        // Set the Token
        $args = $this->api->getBaseParam();
        // Set the Event
       $args = $this->api->addEventParam($args);
        // Set Properties
       $args = $this->api->addPropertyParams($args);
       // Set Customer Properties
       $args = $this->api->addCustomerPropertyParams($args);
       // Set Time
       $args = $this->api->addTimeParams($args);

        return $args;

    }


    /**
     * Used to track when someone takes an action or does something
     *
     * @return  Boolean 1 for Success , 0 for Failure
     *
     */
    public function track()
    {  
        $this->setTrackFilters();
        $args = $this->buildParams();
        // we Use a Different Method encodeData for Our params
        $data = $this->api->makeCall($this->api->getMethod(), $this->api->getEndPoint(), $this->api->encodeData($args));
        return $data;
    }
     /**
     * If you only want to track the first occurrance of an event and ignore subsequent events
     *
     * @return  Boolean 1 for Success , 0 for Failure
     *
     */
    public function trackOnce()
    {   
        $this->setTrackFilters();
        $args = $this->buildParams();
        // Additional setTrackOnce Method for Our Args to be Encoded!
        $data = $this->api->makeCall($this->api->getMethod(), $this->api->getEndPoint(), $this->api->encodeData($this->api->setTrackOnce($args)));
        return $data;
    }

}