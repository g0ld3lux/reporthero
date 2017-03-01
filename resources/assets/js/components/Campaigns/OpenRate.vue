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
                    return 'Open Rate'; 
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
            

        },
        data() {
            return {
                openMetricID: 'xM3sVS',
                deliverMetricID: 'teDBUH',
                bounceMetricID: 'sNU69p',
                openData: [],
                deliverData: [],
                bounceData: [],

                openCount: 0,
                deliverCount: 0,
                bounceCount: 0,
            }
        },
        mounted() {
            axios.all([this.getOpenData(), this.getDeliveryData(),this.getBounceData()])
            .then(axios.spread(function (opendata, deliverData, bounceData) {
                // Do Something in Data
            }));
        },
        methods: {
            
            getOpenData() {
            axios.get('/api/v1/metric/' + this.openMetricID + '/export', {
            params: {
                measurement: 'unique',
                where: JSON.stringify([["$message", "=" , this.$route.params.id]])
            }
            }).then(({data}) => this.openData = data.results[0].data);
            },
            getDeliveryData() {
            axios.get('/api/v1/metric/' + this.deliverMetricID + '/export', {
            params: {
                measurement: 'unique',
                where: JSON.stringify([["$message", "=" , this.$route.params.id]])
            }
            }).then(({data}) => this.deliverData = data.results[0].data);
            },
            getBounceData() {
            axios.get('/api/v1/metric/' + this.bounceMetricID + '/export', {
            params: {
                measurement: 'unique',
                where: JSON.stringify([["$message", "=" , this.$route.params.id]])
            }
            }).then(({data}) => this.bounceData = data.results[0].data);
            }
        },
        computed: {
            ...mapState({
                campaign: state => state.campaigns.current
            }),
            openTotal() {
            for(let data of this.openData)
            {
                this.openCount += parseInt(data.values[0]);
            }
            return this.openCount;
            },
            deliverTotal() {
            for(let data of this.deliverData)
            {
                this.deliverCount += parseInt(data.values[0]);
            }
            return this.deliverCount;
            },
            bounceTotal() {
            for(let data of this.bounceData)
            {
                this.bounceCount += parseInt(data.values[0]);
            }
            return this.bounceCount; 
            },
            // Total open
            // Successful Delivery
            // Bounce 
            rate() {
            return (this.openTotal / (this.deliverTotal - this.bounceTotal) * 100).toFixed(2)
            }
        
        },
        watch: {
        // campaignName: 'getData',
        // end_date: {
        //        handler: function (end_date, oldValue) { 
        //            let query = {
        //                start_date: this.start_date.time,
        //                end_date: end_date.time
        //            }
        //             this.$router.replace({ query })
        //          },
        //         deep: true
        //    },
        }
}
</script>