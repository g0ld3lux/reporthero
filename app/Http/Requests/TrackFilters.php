<?php

namespace Reporthero\Http\Requests;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;

class TrackFilters
{

    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function byEvent()
    {
        return $this->request->input('event');
        // return 'Placed Order'; // Sample
    }

    public function byCustomerProps()
    {

        $customer_properties = $this->request->input('customer_properties') ? $this->request->input('customer_properties') : array();
        //  $customer_properties = [
        //     '$email' => 'cisco7door@gmail.com',
        //     '$id' => 'xUznKa'
        //  ]; // Sample
        if ((!array_key_exists('$email', $customer_properties) || empty($customer_properties['$email'])) && (!array_key_exists('$id', $customer_properties) || empty($customer_properties['$id']))) {
                throw new Exception('You must identify a user by email or ID.');
        }
         return $customer_properties;
    }
    // this is Optional and can be NUll
    // Special  Event Properties We Can Optionally Include 
    //  ($event_id) if note specified default to the timestamp of the event
    // and ($value)
    public function byProps()
    {
        return $this->request->input('properties') ? $this->request->input('properties') : array();
        //  return $properties = [
        //     // '$event_id' => '1477616206',
        //     // '$event_id' => '1477616206',
        //     '$value' => 29.97,
        //     'ItemsPurchased' => ["Gold", "Silver", "Bronze"]
        //  ]; // Sample
    }
    // By default, Klaviyo assumes events happen when a request is made. 
    //If you'd like to track and event that happened in past, use this property.
    public function byTime()
    {
        $timestamp = $this->request->input('time');
        if ($this->isValidTimeStamp($timestamp) && !is_null($timestamp)) {
            return $timestamp;
        }
    }

    protected function isValidTimeStamp($timestamp)
    {
    return ((string) (int) $timestamp === $timestamp) 
        && ($timestamp <= PHP_INT_MAX)
        && ($timestamp >= ~PHP_INT_MAX);
    }
}