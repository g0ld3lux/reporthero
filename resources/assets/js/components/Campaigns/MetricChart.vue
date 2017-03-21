<template>
<div>
<div id="metricToolTip">
<b>Data Value: </b>
</div>
<div id="metricChart" class="ct-chart-line">
</div>
</div>

</template>

<script>

import { mapGetters, mapActions , mapState , mapMutations } from 'vuex'
export default {
        data() {
            return {
                series: [],
                data: [],
                count: 0,
                label: []
            }
        },
        mounted() {

        },
        created() {

        },
        methods: {
            ...mapMutations({
                setSelectedMetric: 'setSelectedMetric',
                setCurrentMetric: 'setCurrentMetric',
                setMetricQuery: 'setMetricQuery',
            }),
            ...mapActions({
                getMetricData: 'getMetricData',

            }),
            getData() {
            // access query =  this.$route.query.where and params = this.$route.params.id
            // we get query here....
            let query = {

                start_date: this.$route.query.start_date,
                end_date: this.$route.query.end_date,
                measurement: 'unique',
                where: JSON.stringify([["$message","=", this.$route.params.id]]) 
            }
            this.getMetricData(query);
            },
            
        },
        computed: {
            ...mapState({
                campaign: state => state.campaigns.current,
                query: state => state.metrics.query,
                selected: state => state.metrics.selected,
                metric: state => state.metrics.current,
                start_date: state => state.campaigns.start_date,
                end_date: state => state.campaigns.end_date

            }),
            ...mapGetters({
                metrics: 'getAllMetrics',

            }),
        },
        // If We Already Fetch the Series Data then Watch For it and Load Chart!
        watch: {
        campaign: 'getData',
        // selected is the metric ID selected
        selected() {
            this.getData()

        }
        }
}
</script>

<style>
.ct-end{
display: none;
}
</style>