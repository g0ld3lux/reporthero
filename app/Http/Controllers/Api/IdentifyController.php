<?php

namespace Reporthero\Http\Controllers\Api;

use Illuminate\Http\Request;
use Reporthero\Http\Controllers\Controller;
use Reporthero\Klaviyo;
use Reporthero\Http\Requests\IdentifyFilters;

class IdentifyController extends Controller
{
    protected $api;

    protected $filter;

    public function __construct(Klaviyo $klaviyo, IdentifyFilters $filter) {
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
        $this->api->setProperties($this->filter->byProps());
    }
    protected function buildParams()
    {
        // Set the Token
        $args = $this->api->getBaseParam();
        // Set Properties
       $args = $this->api->addPropertyParams($args);

        return $args;

    }

    public function identify()
    {
        $this->setTrackFilters();
        $args = $this->buildParams();
        // we Use a Different Method encodeData for Our params
        $data = $this->api->makeCall($this->api->getMethod(), $this->api->getEndPoint(), $this->api->encodeData($args));
        return $data;
    }

}