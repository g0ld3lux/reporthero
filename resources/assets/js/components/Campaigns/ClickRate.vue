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
                    return 'Click Rate'; 
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
                    return 'text-info'; 
                }
            },
            campaignName: {
                type: String
            }
            

        },
        data() {
            return {
                openMetricID: 'xM3sVS',
                clickMetricID: 'xGqcAu',
                openData: [],
                clickData: [],
                openCount: 0,
                clickCount: 0
            }
        },
        mounted() {
            axios.all([this.getClickData(), this.getOpenData()])
            .then(axios.spread(function (clickdata, opendata) {
                // Do Something in Data
            }));
        },
        methods: {
            getClickData() {
            axios.get('/api/v1/metric/' + this.clickMetricID + '/export', {
            params: {
                measurement: 'unique',
                where: JSON.stringify([["$message", "=" , this.$route.params.id]])
            }
            }).then(({data}) => this.clickData = data.results[0].data);  
            },
            getOpenData() {
            axios.get('/api/v1/metric/' + this.openMetricID + '/export', {
            params: {
                measurement: 'unique',
                where: JSON.stringify([["$message", "=" , this.$route.params.id]])
            }
            }).then(({data}) => this.openData = data.results[0].data);
            },

        },
        computed: {
            ...mapState({
                campaign: state => state.campaigns.current
            }),
            clickTotal() {
            for(let data of this.clickData)
            {
                this.clickCount += parseInt(data.values[0]);
            }
            return this.clickCount;
            },
            openTotal() {
            for(let data of this.openData)
            {
                this.openCount += parseInt(data.values[0]);
            }
            return this.openCount;
            },

            // Click / Impression (view)
            rate() {
             let rate = (this.clickTotal / this.openTotal * 100)
            return rate.toFixed(2)
            }
        
        },

}
</script>