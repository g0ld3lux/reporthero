<template>

<div class="card-block">
<div id="pieChart" class="ct-chart-pie">
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
                    return moment().subtract(30,'d').format('YYYY-MM-DD')
                }
            },
            endDate: {
                type: String,
                default() { 
                    return moment().format('YYYY-MM-DD')
                }
            },
            metricID: {
                type: String,
                default() {
                    return 'vFvk9B'
                }
            },
            attributedFlowID: {
                type: String,
                default() {
                    return 'y6WggH'
                }
            },
            measurement: {
                type: String,
                default() {
                    return 'value'
                }
            },
            

        },
    data() {
            return {
                labels: ['Total' ,'Current'],
                series: [],
                total: 0,
                current: 0,
                realcurrent: 0,
            }
    },
    mounted() {
            this.getoverAllData()
            this.getcurrentData()
            this.getChart()
        },
        methods: {
            getoverAllData() {
                axios.get('/api/v1/metric/' + this.metricID + '/export', {
                params: {
                    measurement: 'value',
                    where: JSON.stringify([["$attributed_flow","=", this.attributedFlowID]])
                }
            }).then(({data}) => {
                
                    for (let i = 0; i < data.results[0].data.length; i++) {
                    
                       this.total += parseFloat(data.results[0].data[i].values[0])

                    }
                    this.series[0] = this.total

                }).catch((error) => {console.log(error)});

            },
            getcurrentData() {

                let start_date = this.starteDate
                let end_date = this.endDate
                let measurement = 'unique'
                let where1 = JSON.stringify([["Campaign Name","=", this.campaignID]])
                let where2 = JSON.stringify([["$attributed_flow","=", this.attributedFlowID]])

                axios.get('/api/v1/metric/' + this.metricID + '/export?start_date=' + start_date +
                '&end_date=' + end_date +
                '&measurement=' + measurement +
                '&where=' + where1 +
                '&where=' + where2
                )
                
                .then(({data}) => {
                    
                    for (let i = 0; i < data.results[0].data.length; i++) {
                    
                       this.current += parseFloat(data.results[0].data[i].values[0])

                    }
                    this.series[1] = this.current
                }).catch((error) => {console.log(error)});

                
            },
            getChart() {
                new Chartist.Pie('.ct-chart-pie', {
                    labels: ['Total', 'Current'],
                    series: this.series
                }, {
                    showLabel: true,
                    
                });
            }

        },

        watch: {
        totalCount: 'getChart',
        totalCurrent: 'getChart'
        },
        computed: {
            totalCount() {
                return this.total
            },
            totalCurrent() {
                return this.current
            }
        }
        

        
}

</script>
