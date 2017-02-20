<template>
<div id="barChart" class="ct-chart-bar" v-show="fetch == true">

</div>
</template>

<script>
import  'chartist-plugin-legend'
export default {
    data() {
            return {
                labels: [],
                series:[
                    {
                        name: 'Revenue',
                        data: []
                    },
                    {
                        name: 'Abandonded Cart Revenue',
                        data: []
                    },
                ],
                metrics: [
                    {
                        name: 'Placed Order',
                        id: 'vFvk9B', 
                    },
                ],
                campaignName: this.$route.params.name,
                fetch: false
                
            }
    },
    mounted() {
            
            this.getPlacedOrder()
            this.getAbandonedCart()
            this.getLabels()
            this.getChart()
            this.fetch = true
            console.log(this.series)
        },
        created() {
            
        },
        methods: {
            // We get Last 7 Days Labels
            getLabels() {
                for (let i = 6; i >= 0; i--) {
                    if(i == 6) {
                        this.labels.push(moment().format('dddd'))
                    } else if(i < 6){
                        this.labels.unshift(moment().subtract(6-i,'d').format('dddd'))
                    }
                }
            },
            
            getPlacedOrder() {
                 axios.get('/api/v1/metric/' + this.metrics[0].id + '/export', {
                params: {
                start_date: moment().subtract(6,'d').format('YYYY-MM-DD'),
                end_date: moment().format('YYYY-MM-DD'),
                measurement: 'value',
                where: JSON.stringify([["Campaign Name","=", this.campaignName]])
                }
                }).then(({data}) => {

                    for (let i = 0; i < data.results[0].data.length; i++) {
                       this.series[0]['data'].push(data.results[0].data[i].values[0])
                    }

                });
            },
            getAbandonedCart() {

                let start_date = moment().subtract(6,'d').format('YYYY-MM-DD')
                let end_date = moment().format('YYYY-MM-DD')
                let measurement = 'value'
                let where1 = JSON.stringify([["Campaign Name","=", this.campaignID]])
                let where2 = JSON.stringify([["$attributed_message","=", 'Abandonded Cart: Email 1']])

                axios.get('/api/v1/metric/' + this.metrics[0].id + '/export?start_date=' + start_date +
                '&end_date=' + end_date +
                '&measurement=' + measurement +
                '&where=' + where1 +
                '&where=' + where2
                ).then(({data}) => {

                    for (let i = 0; i < data.results[0].data.length; i++) {
                       this.series[1]['data'].push(data.results[0].data[i].values[0])
                    }

                });

                
            },

            getChart() {
                new Chartist.Bar('.ct-chart-bar', {
                labels: this.labels,
                series: this.series
                }, {
                fullWidth: true,
                chartPadding: {
                right: 40
                },
                plugins: [
                Chartist.plugins.legend()
                ]
                });

            },
            
            renderChart(){

            }  
        },
        watch: {
        fetch: 'renderChart'
        }

        
}

</script>
