<template>
    <div class="main-content" id="dashboardPage">
        <div class="row">
            <delivered :campaignName="campaign.name"></delivered>
            <opened :campaignName="campaign.name"></opened>
            <clicked :campaignName="campaign.name"></clicked>
            <unsubscribed :campaignName="campaign.name"></unsubscribed>
        </div>
        <div class="row">
            <div class="col-lg-12 col-xl-6 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h6><i class="fa fa-line-chart text-warning"></i> Revenue & Abandon Cart Revenue</h6>
                    </div>
                    <div class="card-block">
                        <revenue-vs-abandon :campaignName="campaign.name" :campaignID="campaign.id"></revenue-vs-abandon>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xl-6 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h6><i class="fa fa-bar-chart text-success"></i> Abandon Cart Revenue</h6>
                    </div>
                    <div class="card-block">
                        <total-vs-current-abandon-cart :campaignName="campaign.name" :campaignID="campaign.id"> </total-vs-current-abandon-cart>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</template>

<script type="text/babel">
    import { mapGetters, mapActions , mapState , mapMutations } from 'vuex'
    import LineGraph from '../../../components/LineGraph.vue'
    import BarGraph from '../../../components/BarGraph.vue'
    import PieGraph from '../../../components/PieGraph.vue'
    import opened from '../../../components/Campaigns/Opened.vue'
    import delivered from '../../../components/Campaigns/Delivered.vue'
    import clicked from '../../../components/Campaigns/Clicked.vue'
    import unsubscribed from '../../../components/Campaigns/Unsubscribed.vue'
    import RevenueVsAbandon from '../../../components/Campaigns/RevenueVsAbandon.vue'
    import TotalVsCurrentAbandonCart from '../../../components/Campaigns/TotalVsCurrentAbandonCart.vue'
    export default {
        data() {
            return {
                'header' : 'header'
            }
        },
        components : {
            LineGraph , BarGraph , PieGraph , opened, delivered, clicked, unsubscribed, RevenueVsAbandon , TotalVsCurrentAbandonCart
        },
         methods: {
            ...mapMutations({
                setQuery: 'setQuery',
                setCurrentCampaign: 'setCurrentCampaign'
            }),
            ...mapActions({
                setCurrentCampaign: 'setCurrentCampaign'
            }),
            // Declare other method
        },
        computed: {
            // Your Initial Data
            ...mapState({
                campaign: state => state.campaigns.current,
                query: state => state.campaigns.query
            }),
            ...mapGetters({
                currentCampaign: 'currentCampaign',
                getQuery: 'getQuery'
            })
            // Declare Other Computed Properties
        },
        mounted() {
            this.setCurrentCampaign(this.$route.params.id)
        }

    }
</script>
