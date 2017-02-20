<?php

namespace Reporthero\Http\Controllers\Api;

use Illuminate\Http\Request;
use Reporthero\Http\Controllers\Controller;
use Reporthero\Klaviyo;
use Reporthero\Http\Requests\ListFilters;

class ListsController extends Controller
{
    protected $api;

    protected $filter;

    public function __construct(Klaviyo $klaviyo, ListFilters $filter) {
        $this->api = $klaviyo;
        $this->filter = $filter;
    }

    protected function listAllEmailTemplatesArgs()
    {
        return [
           'page' => $this->filter->byPage(), 
           'count' => $this->filter->byCount()
           ]; 
    }

    public function listAllEmailTemplates()
    {
        $filters = $this->api->setFilters($this->listAllEmailTemplatesArgs());
        return $data = $this->api->makeCall($this->api->getMethod(), $this->api->getEndPoint(), $this->api->buildArgs());
    }

    protected function createNewListArgs()
    {
        return [
           'name' => $this->filter->byName(), 
           'list_type' => $this->filter->byListType()
           ]; 
    }

    public function createNewList()
    {

        $filters = $this->api->setCustomProps($this->createNewListArgs());

        $this->api->setRequestOption('form_params');
        $data = $this->api->makeCall('POST', $this->api->setEndPoint('lists'), $this->api->buildArgs());
        return $data;
    }

    public function getList($listID)
    {

        return $data = $this->api->makeCall($this->api->getMethod(), $this->api->getEndPoint(), $this->api->buildArgs());
    }

    protected function updateListArgs()
    {
        return [
           'name' => $this->filter->byName()
           ];
    }

    public function updateList($listID)
    {

        $filters = $this->api->setFilters($this->updateListArgs());
        $this->api->setRequestOption('form_params');
        $data = $this->api->makeCall('PUT', $this->api->setEndPoint('list/'.$listID), $this->api->buildArgs());
        return $data;
    }


    public function deleteList($listID)
    {
        $data = $this->api->makeCall('DELETE', $this->api->setEndPoint('list/'.$listID), $this->api->buildArgs());
        return $data;
        
    }

    protected function getEmailArgs()
    {
        return [
           'email' => $this->filter->byEmail()
           ];
    }
    public function getListMembers()
    {
        $filters = $this->api->setFilters($this->getEmailArgs());
        return $data = $this->api->makeCall($this->api->getMethod(), $this->api->getEndPoint(), $this->api->buildArgs());
    }

    public function getSegmentMembers()
    {  
        $filters = $this->api->setFilters($this->getEmailArgs());
        return $data = $this->api->makeCall($this->api->getMethod(), $this->api->getEndPoint(), $this->api->buildArgs());
    }

    protected function addToListArgs()
    {
        return [
           'email' => $this->filter->byEmail(),
           'properties' => $this->filter->byProperties(),
           'confirm_optin' => $this->filter->byConfirmOptin()
           ];
    }

    public function addToList($listID)
    {
        
        $filters = $this->api->setFilters($this->addToListArgs());

        $this->api->setRequestOption('form_params');

        return $data = $this->api->makeCall('POST', $this->api->setEndPoint('list/'.$listID.'/members'), $this->api->buildArgs());

    }

    protected function batchAddToListArgs()
    {
        return [
           'batch' => $this->filter->byBatch(),
           'confirm_optin' => $this->filter->byConfirmOptin()
           ];
    }

    public function batchAddToList($listID)
    {

        $filters = $this->api->setFilters($this->batchAddToListArgs());

        $this->api->setRequestOption('form_params');

        return $data = $this->api->makeCall('POST', $this->api->setEndPoint('list/'.$listID.'/members/batch'), $this->api->buildArgs());
    }

    protected function batchRemoveFromListArgs()
    {
        return [
           'batch' => $this->filter->byBatch()
           ];
    }

    public function batchRemoveFromList($listID)
    {
        $filters = $this->api->setFilters($this->batchRemoveFromListArgs());
        $this->api->setRequestOption('form_params');
        return $data = $this->api->makeCall('DELETE', $this->api->setEndPoint('list/'.$listID.'/members/batch'), $this->api->buildArgs());
    }

    protected function unsubscribeFromListArgs()
    {
       return [
           'email' => $this->filter->byEmail(),
           'timestamp' => $this->filter->byTimestamp()
           ]; 
    }

    public function unsubscribeFromList($listID)
    {

       $filters = $this->api->setFilters($this->unsubscribeFromListArgs()); 
       $this->api->setRequestOption('form_params');
       return $data = $this->api->makeCall('POST', $this->api->setEndPoint('list/'.$listID.'/members/exclude'), $this->api->buildArgs());
       
    }

    protected function unsubscribeForAListArgs()
    {
        return [
           'reason' => $this->filter->byReason(),
           'sort' => $this->filter->bySort()
           ]; 
    }

    public function unsubscribeForAList($listID)
    {
       $filters = $this->api->setFilters($this->unsubscribeForAListArgs());
       return $data = $this->api->makeCall($this->api->getMethod(), $this->api->setEndPoint('list/'.$listID.'/exclusions'), $this->api->buildArgs());
        
    }

    public function getGlobalExclusions()
    {
        $filters = $this->api->setFilters($this->unsubscribeForAListArgs());
       return $data = $this->api->makeCall($this->api->getMethod(), $this->api->setEndPoint('people/exclusions'), $this->api->buildArgs());
        
    }
    protected function unsubscribeFromAllEmailArgs()
    {
       return [
           'email' => $this->filter->byEmail(),
           'timestamp' => $this->filter->byTimestamp()
           ]; 
    }
    public function unsubscribeFromAllEmail()
    {
        $filters = $this->api->setFilters($this->unsubscribeFromAllEmailArgs());
        $this->api->setRequestOption('form_params');
        return $data = $this->api->makeCall('POST', $this->api->setEndPoint('people/exclusions'), $this->api->buildArgs());
    }
}
