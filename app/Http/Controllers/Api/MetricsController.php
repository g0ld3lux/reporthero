<?php

namespace Reporthero\Http\Controllers\Api;

use Illuminate\Http\Request;
use Reporthero\Http\Controllers\Controller;
use Reporthero\Http\Requests\MetricFilters;
use Reporthero\Klaviyo;

class MetricsController extends Controller
{
    protected $api;

    protected $filter;

    public function __construct(Klaviyo $klaviyo,MetricFilters $filter) {
        $this->api = $klaviyo;
        $this->filter = $filter;
    }

    /**
     * Argument for Listing Metrics
     * https://www.klaviyo.com/docs/api/metrics#metrics
     * @return array of args
     */
    protected function listingMetricsArgs()
    {
        return [
           'page' => $this->filter->byPage(), 
           'count' => $this->filter->byCount()
           ]; 
    }

    /**
     * Display All The Data For Metrics
     *
     * @return  data property that contains an array of all the metrics
     */
    public function listingMetrics()
    {
        // Set Our Filters For this Api
        $filters = $this->api->setFilters($this->listingMetricsArgs());
        // Get the Data
        $data = $this->api->makeCall($this->api->getMethod(), $this->api->getEndPoint(), $this->api->buildArgs());

        return $data;
    }
    /**
     * Argument for Listing Metrics
     * https://www.klaviyo.com/docs/api/metrics#metrics
     * @return array of args
     */
    protected function specificMetricTimelineArgs()
    {
        return [
            'since' => $this->filter->bySince(),
            'count' => $this->filter->byCount(),
            'sort' => $this->filter->bySort(),
        ];
    }
     /**
     * Display All The Data For Metrics
     *
     * @return  A batched timeline of all events in your Klaviyo account.
     */
    public function specificMetricTimeline($metricID)
    {
        // We Have Access Here Of $metricID if we Ever Needed it in the Future!

        // Set Our Filters For this Api
        $filters = $this->api->setFilters($this->specificMetricTimelineArgs());
        // Get the Data
        $data = $this->api->makeCall($this->api->getMethod(), $this->api->getEndPoint(), $this->api->buildArgs());

        return $data;

    }
    /**
     * Argument for Listing Metrics
     * https://www.klaviyo.com/docs/api/metrics#metric-export
     * @return array of args
     */
    protected function exportMetricDataArgs()
    {
        return [
           'start_date' => $this->filter->byStartDate(), 
           'end_date' => $this->filter->byEndDate(), 
           'unit' => $this->filter->byUnit(),
           'measurement' => $this->filter->byMeasurement(),
           'where' => $this->filter->byWhere(),
           'by' => $this->filter->by(),
           'count' => $this->filter->byCount(),
           ]; 
    }
    /**
     * Display All The Data For Metrics
     *
     * @return  Export event data from Klaviyo, optionally filtering and segmented on available event properties.
     */
    public function exportMetricData($metricID, $endpoint = false, $params = [])
    {
        // We Have Access Here Of $metricID if we Ever Needed it in the Future!+
        
        if($endpoint === true){
        
        $url = 'metric/'.$metricID . '/export';
        // api/v1/ is appended in setEndPoint
        $this->api->setEndPoint($url);

        }
        // Use this for report , since we will not pass request object , but use data in the controller
        if(!empty($params))
        {
        $this->api->setCustomProps($params);
        }

        // Set Our Filters For this Api
        $filters = $this->api->setFilters($this->exportMetricDataArgs());

        // Get the Data
        $data = $this->api->makeCall($this->api->getMethod(), $this->api->getEndPoint(), $this->api->buildArgs());

        return $data;

    }

    
}
