<?php

namespace Reporthero\Http\Controllers\Api;

use Illuminate\Http\Request;
use Reporthero\Http\Controllers\Controller;
use Reporthero\Klaviyo;
use Reporthero\Http\Requests\CampaignFilters;

class CampaignsController extends Controller
{
    protected $api;

    protected $filter;

    public function __construct(Klaviyo $klaviyo, CampaignFilters $filter) {
        $this->api = $klaviyo;
        $this->filter = $filter;
    }

    protected function getAllCampaignArgs()
    {
        return [
           'page' => $this->filter->byPage(), 
           'count' => $this->filter->byCount()
           ]; 
    }

    public function getAllCampaign($endpoint = false, $params = [])
    {
        if($endpoint === true){
        
        $url = 'campaigns';
        // api/v1/ is appended in setEndPoint
        $this->api->setEndPoint($url);

        }
        if(!empty($params))
        {
        $this->api->setCustomProps($params);
        }


        $filters = $this->api->setFilters($this->getAllCampaignArgs());
        return $data = $this->api->makeCall($this->api->getMethod(), $this->api->getEndPoint(), $this->api->buildArgs());
    }

    protected function campaignArgs()
    {
        return [
            'list_id' => $this->filter->byListID(),
            'template_id' => $this->filter->byTemplateID(),
            'from_email' => $this->filter->byFromEmail(),
            'from_name' => $this->filter->byFromName(),
            'subject' => $this->filter->bySubject(),
            'name' => $this->filter->byName(),
            'use_smart_sending' => $this->filter->bySendTime(),
            'add_google_analytics' => $this->filter->byGoogleAnalytics()
        ];
    }

    public function createNewCampaign()
    {
        $filters = $this->api->setCustomProps($this->campaignArgs());
        $this->api->setRequestOption('form_params');
        $data = $this->api->makeCall('POST', $this->api->setEndPoint('campaigns'), $this->api->buildArgs());
        return $data;
    }

    public function getCampaign($campaignID)
    {
        return $data = $this->api->makeCall($this->api->getMethod(), $this->api->getEndPoint(), $this->api->buildArgs());  
    }

    public function updateCampaign($campaignID)
    {
        $filters = $this->api->setCustomProps($this->campaignArgs());
        $this->api->setRequestOption('form_params');
        $data = $this->api->makeCall('PUT', $this->api->setEndPoint('campaign/'.$campaignID), $this->api->buildArgs());
        return $data;
    }

    public function sendCampaign($campaignID)
    {
        $this->api->setRequestOption('form_params');
        $data = $this->api->makeCall('POST', $this->api->getEndPoint(), $this->api->buildArgs());
        return $data;

    }

    protected function sendTimeArg()
    {
       return [
           'send_time' => $this->filter->bySendTime()
           ]; 
    }
    public function scheduleCampaign($campaignID)
    {
        $filters = $this->api->setFilters($this->sendTimeArg());
        $this->api->setRequestOption('form_params');
        $data = $this->api->makeCall('POST', $this->api->getEndPoint(), $this->api->buildArgs());
        return $data;
        
    }

    public function cancelCampaign($campaignID)
    {
        $this->api->setRequestOption('form_params');
        $data = $this->api->makeCall('POST', $this->api->getEndPoint(), $this->api->buildArgs());
        return $data;
        
    }

    protected function cloneArgs()
    {
       return [
           'name' => $this->filter->byName(),
           'list_id' => $this->filter->byListID()
           ]; 
    }
    public function cloneCampaign()
    {
        $filters = $this->api->setCustomProps($this->cloneArgs());
        $this->api->setRequestOption('form_params');
        $data = $this->api->makeCall('POST', $this->api->getEndPoint(), $this->api->buildArgs());
        return $data;
    }
}
