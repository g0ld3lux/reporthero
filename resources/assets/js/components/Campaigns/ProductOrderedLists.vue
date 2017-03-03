<template>
<div>
<p>Product List:</p>
{{ getDateWithValue }}
{{  getSegmentThatMatchesDate }}
{{ matches }}

</div>
</template>

<script>
export default {
    data() {
            return {
                // Ordered Product Metric
                metricID: 'uXR3bA',
                fetchData: [],
                productList: [],
                orderData: [],
                count: 0,
                foundValue: [],
                matches: []
            }
    },
    methods: {
            getData() {
            axios.get('/api/v1/metric/' + this.metricID + '/export', {

            params: {
                measurement: 'value',
                where: JSON.stringify([["$attributed_message", "=" , this.$route.params.id]])
            }
            }).then(({data}) => this.fetchData = data.results[0].data);
        },
            getOrderedProductsByName() {
            axios.get('/api/v1/metric/' + this.metricID + '/export', {

            params: {
                by: 'Name'
            }
        }).then(({data}) => {
             let results = data.results
             this.orderData = results
             

                for(let i = 0; i < results.length; i++ ){
                    
                    this.productList.push(results[i].segment)
                }
               
            });
        }
        // Get All The Date Where GetData has a Value
        // We will Need to Filter  Each Segment For the Same Exact Date in the OrderData
    },
    mounted() {
        this.getData()
        this.getOrderedProductsByName()
    },
    computed: {
        getDateWithValue() {
            let foundValue = this.fetchData.filter(value => {
                return parseInt(value.values[0]) > 0
            })
            return this.foundValue = foundValue
        },
        getSegmentThatMatchesDate() {
            let dateArray = []
            for(let value of this.foundValue)
            {
                dateArray.push(value.date)
            }
            dateArray.forEach(function(date) {
                // we filter OrderData for the date that will match
               console.log(date);
               let matches = []
               let orders = this.orderData.filter(function(order) {
                   order.data.filter(function(item){
                       // Note that item values here can be so large ... since it can also
                       // be bought on other campaign...
                       // So using the values is really useless
                       // we need to find another identifier
                       if(item.date == date && parseFloat(item.values[0]) >=  parseFloat(19.9)){
                           matches.push({
                               segment: order.segment,
                               value: parseFloat(item.values[0])
                            })
                       }
                   })
               },this)
               this.matches = matches;
            }, this);
            
        }
    }
}

</script>


<style>

</style>