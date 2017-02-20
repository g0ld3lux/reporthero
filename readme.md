<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## reporthero.io Official Repository

Is a Web Based Reporting System that Extract Data From Klaviyo and Display it On a More Productive Level

Utilize the Following Latest Stack of Technology

- [Laravel - BackEnd](https://laravel.com/).
- [Laradock - Servers](https://github.com/laradock/laradock)
- [VUEJS - Front End](https://vuejs.org/)
- [Klaviyo Api](https://www.klaviyo.com)

## Installation
1. git clone --recursive https://github.com/g0ld3lux/reporthero.io
2. composer install 
3. yarn install or npm install 
4. cp .env.example .env 
5. edit .env file
  - KLAVIYO_PUBLIC_API_KEY=yourpublickey
  - KLAVIYO_PRIVATE_API_KEY=yourprivatekey
  - KLAVIYO_EMAIL=yourklaviyoemail
  - KLAVIYO_API_VERSION=api/v1/


## List Of Api That Already has Working End Point via Laravel
1. ServerSide API
  - [x] Method (GET) /api/track
  - [x] Method (GET) /api/track-once
  - [x] Method (GET) /api/identify
2. Metrics API
  * ENDPOINTS : 
    - [x] Method (GET) /api/v1/metrics
      - Args (api_key:required,page:optional,count:optional)
    - [x] Method (GET) /api/v1/metrics/timeline
      - Args (api_key:required,since:optional,count:optional,sort:optional(asc, desc))
    - [x] Method (GET) /api/v1/metric/{{METRIC_ID}}/timeline
      - Param (Metric ID)
      - Args (api_key:required,since:optional,count:optional,sort:optional(asc, desc))
    - [x] Method (GET) /api/v1/metric/{{METRIC_ID}}/export
      - Param (Metric ID)
      - Args (api_key:required,start_date:optional,end_date:optional,measurement:optional,where:optional,by:optional,count:optional)
3. Profiles API
  * ENDPOINTS : 
    - [x] Method (GET) /api/v1/person/{PERSON_ID}
      - Param (PERSON ID)
      - Args (api_key:required)
    - [x] Method (PUT) /api/v1/person/{PERSON_ID}
      - Args (api_key:required,$id,$email,$first_name,$last_name,$phone_number,$title,$organization,$city,$region,$country,$zip)
    - [x] Method (GET) /api/v1/person/{{PERSON_ID}}/metrics/timeline
      - Param (PERSON ID)
      - Args (api_key:required,since:optional,count:optional,sort:optional(asc, desc))
    - [x] Method (GET) /api/v1/person/{{PERSON_ID}}/metric/{{METRIC_ID}}/timeline
      - Param (PERSON ID , METRIC ID)
      - Args (api_key:required,since:optional,count:optional,sort:optional(asc, desc))
4. Lists API
  * ENDPOINTS :
    - [x] Method (GET) /api/v1/lists
      - Args (api_key:required,page:optional,count:optional)
    - [x] Method (POST) /api/v1/lists
      - Args (api_key:required,name:required,list_type:required(default:standard))
    - [x] Method (GET) /api/v1/list/{LIST_ID}
      - Param (LIST_ID)
      - Args (api_key:required)
    - [x] Method (PUT) /api/v1/list/{LIST_ID}
      - Param (LIST_ID)
      - Args (api_key:required,name:required)
    - [x] Method (DELETE) /api/v1/list/{LIST_ID}
      - Param (LIST_ID)
      - Args (api_key:required)
    - [x] Method (GET) /api/v1/list/{LIST_ID}/members
      - Param (LIST_ID)
      - Args(api_key:required,email:required(array))
    - [x] Method (GET) /api/v1/segment/{SEGMENT_ID}/members
      - Param (SEGMENT_ID
      - Args (api_key:required,email:required(array))
    - [x] Method (POST) /api/v1/list/{LIST_ID}/members
      - Param (LIST_ID)
      - Args (api_key:required,email:required,properties:required(json),confirm_optn:optional(boolean))
    - [x] Method (POST) /api/v1/list/{LIST_ID}/members/batch
      - Param (LIST_ID)
      - Args (api_key:required,batch:required(json),confirm_optn:optional(boolean))
    - [x] Method (DELETE) /api/v1/list/{LIST_ID}/members/batch
      - Param (LIST_ID)
      - Args (api_key:required,batch:required(json))
    - [x] Method (POST) /api/v1/list/{LIST_ID}/members/exclude
      - Param (LIST_ID)
      - Args (api_key:required,email:required,timestamp:optional(unix_timestamp))
    - [x] Method (GET) /api/v1/list/{ LIST_ID }/exclusions
      - Param (LIST_ID)
      - Args (api_key:required,reason:optional(unsubscribed, bounced, invalid_email, reported_spam and manually_excluded),sort:optional(asc, desc)) 
    - [x] Method (GET) /api/v1/people/exclusions
      - Params (LIST_ID)
      - Args (api_key:required,reason:optional(unsubscribed, bounced, invalid_email, reported_spam and manually_excluded),sort:optional(asc, desc)) 
    - [x] Method (POST) /api/v1/people/exclusions
      - Args (api_key:required,email:required,timestamp:optional(unix_timestamp))
5. Campaign API
    - [x] Method (GET) /api/v1/campaigns
      - Args (api_key:required,page:optional,count:optional)
    - [x] Method (POST) /api/v1/campaigns
      - Args (api_key:required,list_id:)
    - [x] Method (GET) /api/v1/campaign/{CAMPAIGN_ID}
      - Params (CAMPAIGN_ID)
      - Args (api_key:required)
    - [x] Method (PUT) /api/v1/campaign/{CAMPAIGN_ID}
      - Params (CAMPAIGN_ID)
      - Args (api_key:required,list_id:optional(string), template_id:optional(string), from_email:optional(string), from_name:optional(string), subject:optional(string), use_smart_sending:optional(boolean), add_google_analytics(boolean))
    - [x] Method (POST) /api/v1/campaign/{CAMPAIGN_ID}/send
      - Params (CAMPAIGN_ID)
      - Args (api_key:required,)
    - [x] Method (POST) /api/v1/campaign/{CAMPAIGN_ID}/schedule
     - Params (CAMPAIGN_ID)
     - Args (api_key:required, send_time:datetime(format(%Y-%m-%d %H:%M:%S)))
    - [x] Method (POST) /api/v1/campaign/{CAMPAIGN_ID}/cancel
     - Params (CAMPAIGN_ID)
     - Args (api_key:required)
    - [x] Method (POST)/api/v1/campaign/{CAMPAIGN_ID}/clone
      - Params (CAMPAIGN_ID)
      - Args (api_key:required, name:required(string), list_id:required(string))
6. Templates API
    - [x] Method (GET) /api/v1/email-templates
      - Args (api_key:required)
    - [x] Method (POST) /api/v1/email-templates
      - Args (api_key:required,name:required(string), html:required(string)
    - [x] Method (PUT) /api/v1/email-template/{TEMPLATE_ID}
      - Params (TEMPLATE_ID)
      - Args (api_key:required,name:required(string), html:required(string)
    - [x] Method (DELETE) /api/v1/email-template/{TEMPLATE_ID}
      - Params (TEMPLATE_ID)
      - Args (api_key:required)
    - [x] Method (POST) /api/v1/email-template/{TEMPLATE_ID}/clone
      - Params (TEMPLATE_ID)
      - Args (api_key:required, name:required(string))
    - [x] Method (POST) /api/v1/email-template/{TEMPLATE_ID}/render
      - Params (TEMPLATE_ID)
      - Args (api_key:required, context:optional(json))
    - [x] Method (POST) /api/v1/email-template/{TEMPLATE_ID}/send
      - Params (TEMPLATE_ID)
      - Args (api_key:required, from_email:required(string),from_name:required(string), subject:required(string), context:optional(json)
      )



####  ApiController Example

```php
<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Klaviyo;

class ApiController extends Controller

public $api;

public function __construct(Klaviyo $klaviyo) {
        $this->api = $klaviyo;
    }
// Each Api Call Can Be Configure As Such
protected function sampleApiCall()
   {
    // If We Dont Override Api Key It Will Fetch Our Api Key From Config 
    $this->api->setApiKey($key);
    // This Will Populate Our Custom Props
    $customProps = $this->api->setCustomProps($this->api->getSampleContext());
    // This Will Populate Special Attribute Props
    $props = $this->api->setProps($this->api->getSampleContext());
    // This Will Override the Default Request Option which is query
    // Use for POST, PUT since they have different request option key [form_params ,body]
    $this->api->setRequestOption('form_params');
    // This are all the List of RequestOptions
    $allowed_keys = ['query', 'body', 'form_params', 'multipart', 'cookies', 'allow_redirects', 'stream' , 'verify',
        'connect_timeout', 'debug', 'decode_content', 'headers', 'http_errors', 'json', 'handler', 'progress', 'sink' , 'save_to'];
    // This Will Populate Filters
    $filters = $this->api->setFilters($this->api->getSampleContext());
    
    // This Code Will automatically Fetch All Data magically as long as you set 
    // Your Routes Properly and Set Proper Args For that Api Call 
    // If No Args Provided it will Use Only the Api Key Args 
    return $this->api->makeCall($this->api->getMethod(), $this->api->getEndPoint(), $this->api->buildArgs());
   }

```
#### Routes
Note: Your Url Path must be the same format as The List End Point 
So We Dont Have to Set the Endpoint Manually ,if Not We Can Set it using this method 
- $this->api->setEndpoint($url)  
the url variable should omit the api/v1 or the version of api...
```php
<?php
Route::group(['prefix' => 'lists'], function() {
    Route::get('/', 'ListApiController@index')->name('list::index');
    Route::get('/create', 'ListApiController@create')->name('list::create');
    Route::post('/', 'ListApiController@store')->name('list::store');
    Route::get('/{listID}', 'ListApiController@show')->name('list::show');
    Route::get('/{listID}/edit', 'ListApiController@edit')->name('list::edit');
    Route::put('/{listID}', 'ListApiController@update')->name('list::update');
    Route::delete('/{listID}', 'ListApiController@destroy')->name('list::destroy');

    Route::get('/{listID}/members', 'ListApiController@searchPeopleInList')->name('list::searchPeopleInList');
    
    Route::post('/{listID}/members', 'ListApiController@addSomeoneInList')->name('list::addSomeoneInList');
    Route::post('/{listID}/members/batch', 'ListApiController@batchAddPeopleToList')->name('list::batchAddPeopleToList');
    Route::delete('/{listID}/members/batch', 'ListApiController@batchRemovePeopleFromList')->name('list::batchRemovePeopleFromList');
    Route::post('/{listID}/members/exclude', 'ListApiController@unsubscribeSomeoneFromList')->name('list::unsubscribeSomeoneFromList');
    Route::get('/{listID}/exclusions', 'ListApiController@getAllExclusionForSpecificList')->name('list::getAllExclusionForSpecificList');

                  
});
```
####  ServerSide Api Guide Important Methods

- Note : That This 2 Api Only Returns 0 or 1 As Boolean Value for Success and Failure

```php
// This Method Will Differ Depending if You Are Using Track / Track once / Identify
// Track and track once has same params except for the other method that adds extra properties to our trackOnce method
protected function setTrackFilters()
{       
        // We Need to Change Api Version Since it is Not Using api/v1 for end point
        $this->api->setApiVersion('api');
        // This Will Override Any Token In Your Config 
        $this->api->setToken('Stringtoken');

        $this->api->setEvent($this->filter->byEvent());
        $this->api->setCustomerProperties($this->filter->byCustomerProps());
        $this->api->setProperties($this->filter->byProps());
        $this->api->setTime($this->filter->ByTime());
}

// The No of Params Differs Between in Track and Identify
// This is the Args $args that is passed to encodedData
// We Have 5 Method For Fecthing Params that can be Used in building Track/Track Once/ Identify
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
}

// This Method is In Charge in Encoding params Properly
$this->api->encodeData($args)

// We Send the Get Request Using this Method to the Proper API End point
$this->api->makeCall($this->api->getMethod(), $this->api->getEndPoint(), $this->api->encodeData($args))


// For Track Once We Need to Passed in Additional method inside encodeData
$this->api->encodeData($this->api->setTrackOnce($args))
```


## Routes That is Using VueRouter with Vue material Styling

- [x] Method (GET) /#/
- [x] Method (GET) /#/metrics
- [x] Method (GET) /#/lists
- [x] Method (GET) /#/campaigns
- [x] Method (GET) /#/templates
- [x] Method (GET) /#/person/:id



