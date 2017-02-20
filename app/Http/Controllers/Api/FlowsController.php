<?php

namespace Reporthero\Http\Controllers\Api;

use Illuminate\Http\Request;
use Reporthero\Http\Controllers\Controller;
use Reporthero\Klaviyo;
use Reporthero\Http\Requests\FlowsFilter;

class FlowsController extends Controller
{
    protected $api;

    protected $filter;

    public function __construct(Klaviyo $klaviyo, FlowsFilter $filter) {
        $this->api = $klaviyo;
        $this->filter = $filter;
    }

    /**
     * Display All The Data For Metrics
     *
     * @return  data property that contains an array of all the metrics
     */
    public function getAllFlows()
    {
        // Get the Data
        $data = $this->api->makeCall($this->api->getMethod(), $this->api->getEndPoint(), $this->api->buildArgs());

        return $data['data'];
    }

    public function showFlow()
    {
        $data = $this->api->makeCall($this->api->getMethod(), $this->api->getEndPoint(), $this->api->buildArgs());

        return $data;
    }

   
}
