<template>
<div>
<p>Total Revenue: {{ revenue | currency }}</p>
<p>WinBack Revenue: {{ winbackRevenue | currency }}</p>
<p>Welcome Revenue: {{ welcomeRevenue | currency }}</p>
<p>Abandon Revenue: {{ abandonRevenue | currency }}</p>
<p>Returning Revenue: {{ returningRevenue | currency }}</p>
<p>New Revenue: {{ newRevenue | currency }}</p>
</br>
<div id="overAllRevenueBreakDown" class="ct-chart-bar">

</div>
</div>
</template>

<script>
import  'chartist-plugin-legend'
export default {
    props: {
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
                        name: 'Total',
                        data: []
                    },
                    {
                        name: 'Welcome',
                        data: []
                    },
                    {
                        name: 'Winback',
                        data: []
                    },
                    {
                        name: 'Abandon',
                        data: []
                    },
                    {
                        name: 'Returning',
                        data: []
                    },
                    {
                        name: 'New',
                        data: []
                    },

                ],
                metrics: [
                    {
                        name: 'Placed Order',
                        id: 'vFvk9B', 
                    },
                ],

                revenueCount: null,
                abandonCount: null,
                welcomeCount: null,
                winbackCount: null,
                returningCount: null,
                newCount: null

                
            }
    },
    mounted() {
            this.getLabels()
            this.getPlacedOrder()
            this.getAbandonRevenue()
            this.getNewCustomerRevenue()
            this.getWinbackRevenue()
            this.getReturningRevenue()
            this.getNewRevenue()
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
                start_date: moment().subtract(7,'d').format('YYYY-MM-DD'),
                end_date: moment().format('YYYY-MM-DD'),
                measurement: 'value',
                }
                }).then(({data}) => {

                    for (let i = 0; i < data.results[0].data.length; i++) {
                       this.series[0]['data'].push(data.results[0].data[i].values[0])
                    }

                }).catch((error) => {console.log(error)});
 
            },

            getNewCustomerRevenue() {
                axios.get('/api/v1/metric/' + this.metrics[0].id + '/export', {
                params: {
                    start_date: moment().subtract(7,'d').format('YYYY-MM-DD'),
                    end_date: moment().format('YYYY-MM-DD'),
                    measurement: 'value',
                    where: JSON.stringify([["$attributed_flow","=", 'wpkpxU']])
                }
            }).then(({data}) => {
                
                    for (let i = 0; i < data.results[0].data.length; i++) {
                    
                       this.series[1]['data'].push(data.results[0].data[i].values[0])
                    }
                    
                }).catch((error) => {console.log(error)});
            },
            getReturningRevenue() {
                axios.get('/api/v1/metric/' + this.metrics[0].id + '/export', {
                params: {
                    start_date: moment().subtract(7,'d').format('YYYY-MM-DD'),
                    end_date: moment().format('YYYY-MM-DD'),
                    measurement: 'value',
                    where: JSON.stringify([["$new_vs_returning","=", 'Returning']])
                }
            }).then(({data}) => {
                
                    for (let i = 0; i < data.results[0].data.length; i++) {
                    
                       this.series[4]['data'].push(data.results[0].data[i].values[0])
                    }
                    
                }).catch((error) => {console.log(error)});
            },
            getNewRevenue() {
                axios.get('/api/v1/metric/' + this.metrics[0].id + '/export', {
                params: {
                    start_date: moment().subtract(7,'d').format('YYYY-MM-DD'),
                    end_date: moment().format('YYYY-MM-DD'),
                    measurement: 'value',
                    where: JSON.stringify([["$new_vs_returning","=", 'New']])
                }
            }).then(({data}) => {
                
                    for (let i = 0; i < data.results[0].data.length; i++) {
                    
                       this.series[5]['data'].push(data.results[0].data[i].values[0])
                    }
                    
                }).catch((error) => {console.log(error)});
            },

            getWinbackRevenue() {
                axios.get('/api/v1/metric/' + this.metrics[0].id + '/export', {
                params: {
                    start_date: moment().subtract(7,'d').format('YYYY-MM-DD'),
                    end_date: moment().format('YYYY-MM-DD'),
                    measurement: 'value',
                    where: JSON.stringify([["$attributed_flow","=", 'wHEEvc']])
                }
            }).then(({data}) => {
                
                    for (let i = 0; i < data.results[0].data.length; i++) {
                    
                       this.series[2]['data'].push(data.results[0].data[i].values[0])
                    }
                    
                }).catch((error) => {console.log(error)});
            },

            getAbandonRevenue() {
                axios.get('/api/v1/metric/' + this.metrics[0].id + '/export', {
                params: {
                    start_date: moment().subtract(7,'d').format('YYYY-MM-DD'),
                    end_date: moment().format('YYYY-MM-DD'),
                    measurement: 'value',
                    where: JSON.stringify([["$attributed_flow","=", 'y6WggH']])
                }
            }).then(({data}) => {
                
                    for (let i = 0; i < data.results[0].data.length; i++) {
                    
                       this.series[3]['data'].push(data.results[0].data[i].values[0])
                    }
                    
                }).catch((error) => {console.log(error)});
            },

            getChart() {
                new Chartist.Bar('#overAllRevenueBreakDown', {
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
        revenueCount: 'getChart',
        abandonCount: 'getChart',
        welcomeCount: 'getChart',
        winbackCount: 'getChart',
        returningCount: 'getChart',
        newCount: 'getChart'
        },
        computed: {
            
            revenue() {
            for(let data of this.series[0].data)
            {
                this.revenueCount += parseInt(data);
            }
            return this.revenueCount; 
            },
            
            welcomeRevenue() {
            for(let data of this.series[1].data)
            {
                this.welcomeCount += parseInt(data);
            }
            return this.welcomeCount;
            },
            winbackRevenue() {
            for(let data of this.series[2].data)
            {
                this.winbackCount += parseInt(data);
            }
            return this.winbackCount;
            },
            abandonRevenue() {
            for(let data of this.series[3].data)
            {
                this.abandonCount += parseInt(data);
            }
            return this.abandonCount; 
            },
            returningRevenue() {
            for(let data of this.series[4].data)
            {
                this.returningCount += parseInt(data);
            }
            return this.returningCount;
            },
            newRevenue() {
            for(let data of this.series[5].data)
            {
                this.newCount += parseInt(data);
            }
            return this.newCount;
            }
            
        }

        
}

</script>
