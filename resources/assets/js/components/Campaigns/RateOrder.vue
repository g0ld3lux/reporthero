<template>
<div class="col-md-12 col-lg-6 col-xl-3">
    <a class="dashbox" href="#">
        <i :class="[icon, color]"></i>
        <span class="title">
            {{ rate }}%
        </span>
        <span class="desc" style="font-size: 12px; text-align: right;">
            {{ name }}
        </span>
        <slot>
            
        </slot>
    </a>
</div>
</template>

<script>
import {mapState} from 'vuex';
export default {
        props: {
            name: {
                type: String,
                default() { 
                    return 'Conversion Rate'; 
                }
            },
            icon: {
                type: String,
                default() { 
                    return 'fa fa-percent'; 
                }
            },
            color: {
                type: String,
                default() { 
                    return 'text-success'; 
                }
            }
            

        },
        data() {
            return {
                metricID: 'vFvk9B',
                fetchData: [],
                count: 0,
            }
        },
        mounted: function () {
            this.getData();
        },
        methods: {
            getData() {
            axios.get('/api/v1/metric/' + this.metricID + '/export', {
            params: {
                measurement: 'count',
                where: JSON.stringify([["$attributed_message","=", this.$route.params.id]])
            }
            }).then(({data}) => this.fetchData = data.results[0].data);
            },
        },
        components : {
           
        },
        computed: {
            ...mapState({
                campaign: state => state.campaigns.current
            }),
            total() {
            for(let data of this.fetchData)
            {
                this.count += parseInt(data.values[0]);
            }
            return this.count;
            },
            rate() {
            return (this.total / this.campaign.num_recipients * 100).toFixed(2)

            }
        }
        
       
       
}
</script>

<style lang="scss">
.dash-panel {

}
</style>