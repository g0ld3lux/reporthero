<?php

namespace Reporthero;
use GuzzleHttp\Client;

class Klaviyo
{
    public $host;

    public $api_key;

    public $token;

    public $email;

    public $api_version;

    public $props;

    public $custom_props;

    public $filters;

    public $tag = '$';

    public $request_option;

    public $TRACK_ONCE_KEY = '__track_once__';

    public $customer_properties;

    public $properties;

    public $event;

    public $time;

    public $track_once_enable;
    

    public function getClient()
    {
         return new Client(['base_uri' => $this->getHost()]);
    }

    public function getMethod()
    {
        return request()->method();
    }

    public function getRequestOption()
    {
        return $this->request_option ? $this->request_option : 'query';
    }

    public function setRequestOption($option)
    {
        return $this->request_option = $option;
    }
    public function makeCall($method = 'GET' ,$endpoint ,$args)
    {
        $client = $this->getClient();
        $response = $client->request($method, $endpoint , [$this->getRequestOption() => $args]);
        $data = $response->getBody()->getContents();
        $data = json_decode($data,true);
        return $data;
    }

    public function getApiVersion()
    {
        return $this->api_version = config('services.klaviyo.version');
    }
    public function setApiVersion($version)
    {
        return $this->api_version = $version;
    }

    public function setEndPoint($url)
    {
        return $endpoint = $this->getApiVersion() . $url;
    }

    public function getEndPoint()
    {
        return $endpoint = request()->path();
    }

    public function getHost()
    {
        return $this->host = config('services.klaviyo.host');
    }

    public function setHost($url)
    {
        return $this->host = $url;
    }
    public function getApiKey()
    {
        return $this->api_key = config('services.klaviyo.api_key');
    }

    public function setApiKey($key)
    {
        return $this->api_key = $key;
    }

    public function getToken()
    {
        return $this->token = config('services.klaviyo.token');
    }

    public function setToken($token)
    {
        return $this->token = $token;
    }

    public function getEmail()
    {
        return $this->email = config('services.klaviyo.email');
    }

    public function setEmail($email)
    {
        return $this->email = $email;
    }

    public function getBaseArg()
    {
        return $array = ['api_key' => $this->api_key ? $this->api_key : $this->getApikey()];
    }

    public function getSampleContext()
    {
        return $context = [
        '$id' => 'zYw4uK',
        '$email'=> 'leebinx@gmail.com ',
        '$first_name' => 'Glenn',
        '$last_name'=> 'Livingstone',
        '$organization' => 'U.S. Government', // none
        '$title'=> 'Ex-president', // none
        '$city' => 'Mount Vernon', // London
        '$region'=> 'Virginia', // None
        '$zip' => '22121', // SE19SG
        '$country'=> 'United States', // United Kingdom
        '$timezone' => 'US/Eastern', // none
        '$phone_number'=>  '123456789', // none
        'test' => 'this is a test',
        'favorite_icecream' => 'double dutch'
        ]; 
    }
    public function setProps($context)
    {
        $except = ['$object', '$id', 'object', 'id'];
        foreach($context as $key => $value)
        {
            $withTag = strpos($key, $this->tag);
            
            if($withTag !== false && !in_array($key, $except, true))
            {
            $this->addProps($key , $value);
            }
        }
        return $this->props;
        
    }

    public function addProps($key , $value)
    {
      return $this->props[$key] = $value;  
    }
    public function getProps()
    {
        return $this->props;
    }
    public function setCustomProps($context)
    {
        $except = ['$object', '$id', 'object', 'id'];
        foreach($context as $key => $value)
        {
            $withTag = strpos($key, $this->tag);
            if($withTag===false && !in_array($key, $except, true))
            {
            $this->addCustomProps($key,$value);
            }
        }
        return $this->custom_props;

    }

    public function addCustomProps($key,$value)
    {
        return $this->custom_props[$key] = $value;
    }
    public function getCustomProps()
    {
        return $this->custom_props;

    }

    public function setFilters($filters)
    {
        foreach($filters as $key => $value)
        {
            $this->addFilters($key,$value);
        }
        return $this->filters;
    }

    public function addFilters($key,$value)
    {
        return $this->filters[$key] = $value;
    }

    public function getFilters()
    {
        return $this->filters;
    }
    // this is useful for profiles
    public function buildArgs()
    {
        // this will get the Api Args 
        $args = $this->getBaseArg();
        // Special Arg , the one with $ prefix except, object and ID

        $attributes = $this->getProps();

        if(!is_null($attributes)){
            foreach ($attributes as $key => $value){
            $args = array_add($args, $key,$value);
            }
        }
        
        // Custom Args , the One We Create On the Fly
        $custom = $this->getCustomProps();
        if(!is_null($custom)){
            foreach ($custom as $key => $value) {
            $args = array_add($args, $key ,$value);
            }
        }

        // Filter Args 

        $filters = $this->getFilters();
        if(!is_null($filters)){
            foreach($filters as $key => $value) {
                $args = array_add($args, $key ,$value);
            }
        }
        // Return All Args
        return $args;
    }
    // We Use this For Server Side Track and Track Once Api
    public function encodeData($data)
    {
        
        return $data = [
            'data' => urlencode(base64_encode(json_encode($data)))
        ];
    }

    public function getProperties()
    {
        return $this->properties;
    }

    public function setProperties($context)
    {
        foreach($context as $key => $value)
        {
            $this->addProperties($key,$value);
        }
        return $this->properties;
    }

    public function addProperties($key , $value)
    {
      return $this->properties[$key] = $value;
    }

    public function setCustomerProperties($context)
    {
        foreach($context as $key => $value)
        {
            $this->addCustomerProperties($key,$value);
        }
        return $this->customer_properties;
    }

    public function addCustomerProperties($key , $value)
    {
      return $this->customer_properties[$key] = $value;
    }

    public function getCustomerProperties()
    {
        return $this->customer_properties;
    }

    public function setEvent($event)
    {
        return $this->event = $event;
    }
    public function getEvent()
    {
        return $this->event ? $this->event : request()->input('event');
    }

    public function getBaseParam()
    {
        return $array = ['token' => $this->token ? $this->token : $this->getToken()];
    }

    public function addEventParam($args)
    {
        return $args = array_add($args, 'event', $this->getEvent());
    }

    public function addPropertyParams($args)
    {
        return $args = array_add($args, 'properties', $this->getProperties());
    }

    public function addCustomerPropertyParams($args)
    {
        return $args = array_add($args, 'customer_properties', $this->getCustomerProperties());
    }

    public function setTime($time)
    {
        return $this->time = $time;
    }

    public function getTime()
    {
        return $this->time ? $this->time : request()->input('time');
    }

    public function addTimeParams($args)
    {
        return $args = array_add($args, 'time', $this->getTime());
    }

    public function setTrackOnce($args)
    {
        $track_once = array_set($args,'properties.__track_once__', true);
        return array_add($args,'properties',$track_once);
    }


   
}
