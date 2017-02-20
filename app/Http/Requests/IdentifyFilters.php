<?php

namespace Reporthero\Http\Requests;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;

class IdentifyFilters
{
   public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function byProps()
    {
        $properties = $this->request->input('properties') ? $this->request->input('properties') : array();
        if ((!array_key_exists('$email', $properties) || empty($properties['$email'])) && (!array_key_exists('$id', $properties) || empty($properties['$id']))) {
                throw new Exception('You must identify a user by email or ID.');
        }
         return $properties;
        //  return $customer_properties = [
        //     '$email' => 'cisco7door@gmail.com',
        //     '$id' => 'xUznKa',
        //     '$first_name' => 'John',
        //     '$last_name' => 'Smith',
        //     'Plan' => 'Premium',
        //     'SignUpDate' => '2016-05-01 10:10:00'
        //  ]; // Sample
    }
}