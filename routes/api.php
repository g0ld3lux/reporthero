<?php


/*
|--------------------------------------------------------------------------
| Klaviyo Api Routes
|--------------------------------------------------------------------------
|
*/
Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api'], function() {

    Route::get('/metrics', 'MetricsController@listingMetrics')->name('klaviyo::listingMetrics');
    Route::get('/metric/{metricID}/timeline', 'MetricsController@specificMetricTimeline')->name('klaviyo::specificMetricTimeline');
    Route::get('/metric/{metricID}/export', 'MetricsController@exportMetricData')->name('klaviyo::exportMetricData');


    Route::get('/person/{personID}', 'ProfilesController@getPersonData')->name('klaviyo::getPersonData');
    Route::get('/person/{personID}/update', 'ProfilesController@updatePersonData')->name('klaviyo::updatePersonData');
    Route::get('/person/{personID}/metrics/timeline', 'ProfilesController@batchTimelineAllEvent')->name('klaviyo::batchTimelineAllEvent');
    Route::get('/person/{personID}/metric/{metricID}/timeline', 'ProfilesController@batchTimelineSpecificEvent')->name('klaviyo::batchTimelineSpecificEvent');


    Route::get('/lists', 'ListsController@listAllEmailTemplates')->name('klaviyo::listAllEmailTemplates');
    Route::get('/lists/create', 'ListsController@createNewList')->name('klaviyo::createNewList');
    Route::get('/list/{listID}/update', 'ListsController@updateList')->name('klaviyo::updateList');
    Route::get('/list/{listID}/delete', 'ListsController@deleteList')->name('klaviyo::deleteList');
    Route::get('/list/{listID}', 'ListsController@getList')->name('klaviyo::getList');
    Route::get('/list/{listID}/members', 'ListsController@getListMembers')->name('klaviyo::getListMembers');
    Route::get('/segment/{segmentID}/members', 'ListsController@getSegmentMembers')->name('klaviyo::getSegmentMembers');
    Route::get('/list/{listID}/members/add', 'ListsController@addToList')->name('klaviyo::addToList');
    Route::get('/list/{listID}/members/batchAdd', 'ListsController@batchAddToList')->name('klaviyo::batchAddToList');
    Route::get('/list/{listID}/members/batchRemove', 'ListsController@batchRemoveFromList')->name('klaviyo::batchRemoveFromList');
    Route::get('/list/{listID}/members/unsubscribe', 'ListsController@unsubscribeFromList')->name('klaviyo::unsubscribeFromList');
    Route::get('/list/{listID}/exclusions', 'ListsController@unsubscribeForAList')->name('klaviyo::unsubscribeForAList');
    Route::get('/people/getAllExclusions', 'ListsController@getGlobalExclusions')->name('klaviyo::getGlobalExclusions');
    Route::get('/people/exclusions', 'ListsController@unsubscribeFromAllEmail')->name('klaviyo::unsubscribeFromAllEmail');


    Route::get('campaigns', 'CampaignsController@getAllCampaign')->name('klaviyo::getAllCampaign');
    Route::get('campaigns/create', 'CampaignsController@createNewCampaign')->name('klaviyo::createNewCampaign');
    Route::get('campaign/{campaignID}', 'CampaignsController@getCampaign')->name('klaviyo::getCampaign');
    Route::get('campaign/{campaignID}/update', 'CampaignsController@updateCampaign')->name('klaviyo::updateCampaign');
    Route::get('campaign/{campaignID}/send', 'CampaignsController@sendCampaign')->name('klaviyo::sendCampaign');
    Route::get('campaign/{campaignID}/schedule', 'CampaignsController@scheduleCampaign')->name('klaviyo::scheduleCampaign');
    Route::get('campaign/{campaignID}/cancel', 'CampaignsController@cancelCampaign')->name('klaviyo::cancelCampaign');
    Route::get('campaign/{campaignID}/clone', 'CampaignsController@cloneCampaign')->name('klaviyo::cloneCampaign');


    Route::get('email-templates', 'EmailTemplatesController@getAllTemplates')->name('klaviyo::getAllTemplates');
    Route::get('email-templates/create', 'EmailTemplatesController@createNewTemplate')->name('klaviyo::createNewTemplate');
    Route::get('email-template/{templateID}', 'EmailTemplatesController@updateTemplate')->name('klaviyo::updateTemplate');
    Route::get('email-template/{templateID}/delete', 'EmailTemplatesController@deleteTemplate')->name('klaviyo::deleteTemplate');
    Route::get('email-template/{templateID}/clone', 'EmailTemplatesController@cloneTemplate')->name('klaviyo::cloneTemplate');
    Route::get('email-template/{templateID}/render', 'EmailTemplatesController@renderTemplate')->name('klaviyo::renderTemplate');
    Route::get('email-template/{templateID}/send', 'EmailTemplatesController@sendTemplate')->name('klaviyo::sendTemplate');

    Route::get('flows', 'FlowsController@getAllFlows')->name('klaviyo::getAllFlows');
    Route::get('flow/{flowID}', 'FlowsController@showFlow')->name('klaviyo::showFlow');
    
});

Route::get('track', 'Api\TrackController@track')->name('klaviyo::track');
Route::get('track-once', 'Api\TrackController@trackOnce')->name('klaviyo::trackOnce');
Route::get('identify', 'Api\IdentifyController@identify')->name('klaviyo::identify');
Route::group(['prefix' => 'auth'], function () {
    Route::post('login','AuthController@authenticate');
    Route::get('logout','AuthController@logout');
    Route::get('check','AuthController@check');
});

