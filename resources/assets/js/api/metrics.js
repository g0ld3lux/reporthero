export default {
    // list all metrics
    index() {

    },
    // batch timeline for all event
    batchTimeline () {

    },
    // batcht timeline for specific event
    showBatchTimeline () {

    },
    // export metric data
    // this.metricID must be a state properties
    // we need to accept params as an object here
    // we need a form to specify the params such as
    // start date
    // end date
    // unit
    // measurement
    // where
    // by
    // count
    export() {
        axios.get('/api/v1/metric/' + this.metricID + '/export', {
            params: {
                measurement: 'count',
                where: JSON.stringify([["$attributed_message","=", this.campaignID]])
            }
        }).then(({data}) => this.fetchData = data.results[0].data);
        
        axios.get('/api/v1/metric/' + this.metricID + '/export', {
            params: {
                measurement: 'value',
                where: JSON.stringify([["$attributed_message","=", this.campaignID]])
            }
        }).then(({data}) => this.fetchData = data.results[0].data);
        
        axios.get('/api/v1/metric/' + this.metricID + '/export', {
            params: {
                where: JSON.stringify([["Campaign Name","=", this.campaignName]])
            }
        }).then(({data}) => this.fetchData = data.results[0].data);
        

        axios.get('/api/v1/metric/' + this.metricID + '/export', {
            params: {
                measurement: 'unique',
                where: JSON.stringify([["Campaign Name","=", this.campaignName]])
            }
            }).then(({data}) => this.clickEmailData = data.results[0].data);
    }
}