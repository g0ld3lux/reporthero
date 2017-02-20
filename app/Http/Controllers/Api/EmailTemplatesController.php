<?php

namespace Reporthero\Http\Controllers\Api;

use Illuminate\Http\Request;
use Reporthero\Http\Controllers\Controller;
use Reporthero\Klaviyo;
use Reporthero\Http\Requests\TemplateFilters;

class EmailTemplatesController extends Controller
{
    protected $api;

    protected $filter;

    public function __construct(Klaviyo $klaviyo, TemplateFilters $filter) {
        $this->api = $klaviyo;
        $this->filter = $filter;
    }

    public function getAllTemplates()
    {
        return $data = $this->api->makeCall($this->api->getMethod(), $this->api->getEndPoint(), $this->api->buildArgs());
    }

    protected function templateArgs()
    {
        return [
           'name' => $this->filter->byName(), 
           'html' => $this->filter->byHtml()
           ];
    }

    public function createNewTemplate()
    {
        $filters = $this->api->setCustomProps($this->templateArgs());
        $this->api->setRequestOption('form_params');
        $data = $this->api->makeCall('POST', $this->api->setEndPoint('email-templates'), $this->api->buildArgs());
        return $data;
    }

    public function updateTemplate($templateID)
    {
        $filters = $this->api->setCustomProps($this->templateArgs());
        $this->api->setRequestOption('form_params');
        $data = $this->api->makeCall('PUT', $this->api->setEndPoint('email-template/'.$templateID), $this->api->buildArgs());
        return $data;
    }

    public function deleteTemplate($templateID)
    {
        $this->api->setRequestOption('form_params');
        $data = $this->api->makeCall('DELETE', $this->api->setEndPoint('email-template/'.$templateID), $this->api->buildArgs());
        return $data;
    }

    protected function cloneArg()
    {
        return [
           'name' => $this->filter->byName()
           ];
    }
    public function cloneTemplate($templateID)
    {
        $filters = $this->api->setCustomProps($this->cloneArg());
        $this->api->setRequestOption('form_params');
        $data = $this->api->makeCall('POST', $this->api->getEndPoint(), $this->api->buildArgs());
        return $data;
    }

    protected function renderArg()
    {
        return [
           'context' => $this->filter->byContext()
           ];
    }

    public function renderTemplate()
    {
        $filters = $this->api->setCustomProps($this->renderArg());
        $this->api->setRequestOption('form_params');
        $data = $this->api->makeCall('POST', $this->api->getEndPoint(), $this->api->buildArgs());
        return $data;
    }

    protected function sendEmailArg()
    {
        return [
           'from_email' => $this->filter->byFromEmail(),
           'from_name'  => $this->filter->byFromName(),
           'subject'    => $this->filter->bySubject(),
           'to'         => $this->filter->byTo(),
           'context'    => $this->filter->byContext()
           ];
    }

    public function sendTemplate()
    {
        $filters = $this->api->setCustomProps($this->sendEmailArg());
        $this->api->setRequestOption('form_params');
        $data = $this->api->makeCall('POST', $this->api->getEndPoint(), $this->api->buildArgs());
        return $data;
    }
}
