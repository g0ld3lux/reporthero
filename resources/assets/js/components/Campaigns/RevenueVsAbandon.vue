<template>
<div>
<p>Revenue Weekly Total: {{ revenue }}</p>
</br>
<div id="barChart" class="ct-chart-bar">

</div>
</div>
</template>

<script>
import  'chartist-plugin-legend'
export default {
    props: {
            campaignName: {
                type: String
            },
            campaignID: {
                type: String
            },
            starteDate: {
                type: String,
                default() { 
                    return moment().subtract(6,'d').format('YYYY-MM-DD')
                }
            },
            endDate: {
                type: String,
                default() { 
                    return moment().format('YYYY-MM-DD')
                }
            }
            

        },
    data() {
            return {
                labels: [],
                series:[
                    {
                        name: 'Revenue',
                        data: []
                    }

                ],
                metrics: [
                    {
                        name: 'Placed Order',
                        id: 'vFvk9B', 
                    },
                ],

                revenueCount: null

                
            }
    },
    mounted() {
            this.getLabels()
            this.getPlacedOrder()
            this.getChart()
        },
        methods: {
            // We get Last 7 Days Labels
            getLabels() {
                this.labels = [];
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
                where: JSON.stringify([["$attributed_message","=", this.$route.params.id]])
                }
                }).then(({data}) => {

                    for (let i = 0; i < data.results[0].data.length; i++) {
                       this.series[0]['data'].push(data.results[0].data[i].values[0])
                    }

                }).catch((error) => {console.log(error)});
 
            },

            getChart() {
                new Chartist.Bar('#barChart', {
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
        },
        watch: {
 
        revenueCount: 'getChart'


        },
        computed: {
            
            revenue() {
            for(let data of this.series[0].data)
            {
                this.revenueCount += parseInt(data);
            }
            return this.revenueCount; 
            }
        }

        
}

</script>
