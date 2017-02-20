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
                        // name: 'Clicked Email',
                        data: []
                    },
                    {
                        // name: 'Opened Email',
                        data: []
                    },
                    {
                        // name: 'Unsubscribe Email',
                        data: []
                    },
                    {
                        // name: 'Placed Order',
                        data: []
                    },
                    {
                        // name: 'Abandonded Cart Order',
                        data: []
                    },
                ],
                metrics: [
                    {
                       name: 'Clicked Email',
                        id: 'xGqcAu', 
                    },
                    {
                       name: 'Opened Email',
                        id: 'xM3sVS',
                    },
                    {
                       name: 'Unsubscribe Email',
                        id: 's7fMbn',
                    },
                    {
                        name: 'Placed Order',
                        id: 'vFvk9B', 
                    },
                    {
                        name: 'Ordered Product',
                        id: 'uXR3bA'
                    }
                ],
                campaignName: this.$route.params.name,
                fetch: false,
                click: 0,
                open: 0,
                unsubscribe: 0,
                placeOrder: 0,
                abandonCart: 0,

                
            }
    },
    mounted() {
            this.getClickedEmail()
            this.getOpenedEmail()
            this.getUnsubscribedEmail()
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
            // We get Labels 
            getLabels() {
                for (let i = 0; i < this.series.length; i++) {
                        this.labels.unshift(this.series[i].name)
                }
            }
            // Unique Clicked Email Last 30 Days
            getClickedEmail() {
                axios.get('/api/v1/metric/' + this.metrics[0].id + '/export', {
                params: {
                start_date: moment().subtract(29,'d').format('YYYY-MM-DD'),
                end_date: moment().format('YYYY-MM-DD'),
                measurement: 'unique',
                where: JSON.stringify([["Campaign Name","=", this.campaignName]])
                }
                }).then(({data}) => {
 
                    for(let data of data.results[0].data)
                    {
                        this.click += parseInt(data.values[0]);
                    }
                    this.series[0]['data'].push(this.click)
                    }
                });
            },
            getOpenedEmail() {
                 axios.get('/api/v1/metric/' + this.metrics[1].id + '/export', {
                params: {
                start_date: moment().subtract(29,'d').format('YYYY-MM-DD'),
                end_date: moment().format('YYYY-MM-DD'),
                measurement: 'unique',
                where: JSON.stringify([["Campaign Name","=", this.campaignName]])
                }
                }).then(({data}) => {

                    for(let data of data.results[0].data)
                    {
                        this.open += parseInt(data.values[0]);
                    }
                    this.series[1]['data'].push(this.open)
                    }

                });
            },
            getUnsubscribedEmail() {
                 axios.get('/api/v1/metric/' + this.metrics[2].id + '/export', {
                params: {
                start_date: moment().subtract(29,'d').format('YYYY-MM-DD'),
                end_date: moment().format('YYYY-MM-DD'),
                measurement: 'unique',
                where: JSON.stringify([["Campaign Name","=", this.campaignName]])
                }
                }).then(({data}) => {

                    for(let data of data.results[0].data)
                    {
                        this.unsubscribe += parseInt(data.values[0]);
                    }
                    this.series[2]['data'].push(this.unsubscribe)
                    }

                });
            },
            getPlacedOrder() {
                 axios.get('/api/v1/metric/' + this.metrics[3].id + '/export', {
                params: {
                start_date: moment().subtract(29,'d').format('YYYY-MM-DD'),
                end_date: moment().format('YYYY-MM-DD'),
                measurement: 'unique',
                where: JSON.stringify([["Campaign Name","=", this.campaignName]])
                }
                }).then(({data}) => {

                    for(let data of data.results[0].data)
                    {
                        this.placeOrder += parseInt(data.values[0]);
                    }
                    this.series[3]['data'].push(this.placeOrder)
                    }

                });
            },
            getAbandonedCart() {

                let start_date = moment().subtract(29,'d').format('YYYY-MM-DD')
                let end_date = moment().format('YYYY-MM-DD')
                let measurement = 'count'
                let where1 = JSON.stringify([["Campaign Name","=", this.campaignID]])
                let where2 = JSON.stringify([["$attributed_message","=", 'Abandonded Cart: Email 1']])

                axios.get('/api/v1/metric/' + this.metrics[3].id + '/export?start_date=' + start_date + '&end_date=' + end_date + '&measurement=' + measurement + '&where=' + where1 + '&where=' + where2).then(({data}) => {

                    for(let data of data.results[0].data)
                    {
                        this.abandonCart += parseInt(data.values[0]);
                    }
                    this.series[4]['data'].push(this.abandonCart)
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
                // plugins: [
                // Chartist.plugins.legend()
                // ]
                });

            },
            
            renderChart(){
                console.log('chart rendered!')
            }  
        },
        watch: {
        fetch: 'renderChart'
        }

        
}

</script>
