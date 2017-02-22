<template>
<div class="col-md-12 col-lg-6 col-xl-3">
    <a class="dashbox" href="#">
        <i :class="[icon, color]"></i>
        <span class="title">
            {{ rate }}
        </span>
        <span class="desc">
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
            campaignName: {
                type: String
            }
            

        },
        data() {
            return {
                metricID: 'xM3sVS',
                fetchData: [],
                count: 0,
            }
        },
        mounted() {
            this.getData()
        },
        methods: {
            getData() {
            axios.get('/api/v1/metric/' + this.metricID + '/export', {
            params: {
                measurement: 'unique',
                where: JSON.stringify([["Campaign Name","=", this.campaignName]])
            }
            }).then(({data}) => this.fetchData = data.results[0].data);
            },
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
        
        },
        watch: {
        campaignName: 'getData'
        }
}
</script>