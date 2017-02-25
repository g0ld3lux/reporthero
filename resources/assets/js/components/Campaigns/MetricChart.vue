<template>
<div>
<div id="metricChart" class="ct-chart-line">
<div
</div>
</template>

<script>
export default {
        props: {
            // Pass in name of Event i.e : Clicked
            action: {
                type: String,
                required: true
            },
            // Pass The Campaign Name
            name: {
                type: String,
                required: true
            },
            // Pass the Metric ID
            id: {
                type: String,
                required: true
            },
            measurement: {
                type: String,
                default() { 
                    return 'count';
                }
            }
            

        },
        data() {
            return {
                series: [],
                data: [],
                count: 0,
            }
        },
        mounted() {
            this.getData()
            this.loadChart()
        },
        methods: {
            getData() {
            axios.get('/api/v1/metric/' + this.id + '/export', {
            params: {
                measurement: this.measurement,
                where: JSON.stringify([["Campaign Name","=", this.name]])
            }
            }).then(({data}) => this.series = data.results[0].data);
            },
            loadChart() {
                let data = []
                for (let i = 0; i < this.series.length; i++) {
                      data[i].x.push(this.series[i].date)
                       data[i].y.push(this.series[i].values[0])
                }
                this.data = data
                var chart = new Chartist.Line('#metricChart', {
                series: [
                {
                    name: this.action,
                    data
                }
                ]
                }, {
                axisX: {
                type: Chartist.FixedScaleAxis,
                divisor: this.series.length,
                labelInterpolationFnc: function(value) {
                    return moment(value).format('MM D');
                }
                }
                });
            }
        },
        // If We Already Fetch the Series Data then Watch For it and Load Chart!
        // watch: {
        // series: 'loadChart'
        // }
}
</script>