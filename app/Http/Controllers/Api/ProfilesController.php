<?php

namespace Reporthero\Http\Controllers\Api;

use Illuminate\Http\Request;
use Reporthero\Http\Controllers\Controller;
use Reporthero\Http\Requests\ProfileFilters;
use Reporthero\Klaviyo;

class ProfilesController extends Controller
{
    protected $api;

    protected $filter;

    public function __construct(Klaviyo $klaviyo, ProfileFilters $filter) {
        $this->api = $klaviyo;
        $this->filter = $filter;
    }
    /**
     * Arguments for Endpoint
     * https://www.klaviyo.com/docs/api/people#metrics-timeline
     * https://www.klaviyo.com/docs/api/people#metric-timeline
     * @return array of args
     */
    protected function getProfileFilters()
    {
        return [
           'since' => $this->filter->bySince(), 
           'count' => $this->filter->byCount(),
           'sort'  => $this->filter->bySort()
           ];
    }
    /**
     * Retrieve all the data attributes for a person, based on the Klaviyo Person ID.
     *
     * @return  Returns a Person object. Any attributes that start with '$' are special Klaviyo attributes. 
     *          With the exception od 'id' and 'object', 
     *          any attributes that do no start with '$' are your custom-defined attributes.
     */
    public function getPersonData($personID)
    {
        
        $data = $this->api->makeCall($this->api->getMethod(), $this->api->getEndPoint(), $this->api->buildArgs());
        return $data;
    }

    /**
     *  Special Person attributes , all starting with $(dollar) sign Except Object and ID
     * https://www.klaviyo.com/docs/api/people#person
     * This must be submitted From Our Form!
     * @return array of args for person special attributes 
     */

    protected function requestProps()
    {
        return $props = $this->api->setProps(request()->all());
    }
    /**
     *  Custom Person attributes 
     * https://www.klaviyo.com/docs/api/people#person
     * This must be Submitted From Our Form!
     * @return array of args for person custom attributes 
     */
    protected function requestCustomProps()
    {
        return $customProps = $this->api->setCustomProps(request()->all());
    }
    /**
     * Update all the requested attributes for a person.
     *
     * @return  Returns a Person object.
     */
    public function updatePersonData($personID)
    {
        // Get All Props
        $props = $this->requestProps();
        // Get All Custom Props
        $custom_props = $this->requestCustomProps();
        // We Override Our Endpoint To Avoid Conflict , Since we Are Using Get Request
        $data = $this->api->makeCall('PUT', $this->api->setEndPoint('person/'.$personID), $this->api->buildArgs());
        return $data;
    }
    /**
     * Listing a person's complete event timeline
     *
     * @return  Returns a batched timeline of all events for a person.
     */
    public function batchTimelineAllEvent($personID)
    {
        
        $filters = $this->api->setFilters($this->getProfileFilters());

        $data = $this->api->makeCall($this->api->getMethod(), $this->api->getEndPoint(), $this->api->buildArgs());

        return $data;
    }
    /**
     * Listing a person's event timeline for a particular metric
     *
     * @return  Returns a person's batched timeline for one specific event type.
     */
    public function batchTimelineSpecificEvent($personID,$metricID)
    {
        $filters = $this->api->setFilters($this->getProfileFilters());
        $data = $this->api->makeCall($this->api->getMethod(), $this->api->getEndPoint(), $this->api->buildArgs());

        return $data;
    }
}
