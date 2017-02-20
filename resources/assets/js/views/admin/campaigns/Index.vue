<template>
<div class="container">
<pagination  for="pagination" :records="parseInt(total)" :per-page="parseInt(query.count)" :chunk="10">
</pagination>
             
<div class="row">
    <div class="col-sm-12" v-for="(campaign, index)  in campaigns">
        <div class="card">
            <div class="card-header">
                <div class="caption">
                    <h6>{{ campaign.name }}</h6>
                </div>
                <div class="actions">
                    <button class="btn btn-warning btn-sm" v-if="campaign.status == 'queued'"> <i class="fa fa-calendar-minus-o"></i> {{ campaign.status_label }} - {{ sendAt }}</button>
                    <button class="btn btn-success btn-sm" v-if="campaign.status == 'sent'"> <i class="fa fa-check"></i> {{ campaign.status_label }} - {{ sendAt }}</button>
                    <button class="btn btn-primary btn-sm" @click="viewStats(campaign)"> <i class="fa fa-area-chart"></i>Stats</button>
                    
                </div>
            </div>
            <div class="card-block">
                <p>Subject: {{ campaign.subject }}</p> 
                <p>Recipients: {{ campaign.num_recipients }}</p>
                <p>List Name: {{ campaign.lists[0].name }}</p>
                <p>List Count: {{ campaign.lists[0].person_count }}</p>
            </div>
        </div>
        
    </div>
</div>
                


</div>
</template>

<script>
import { mapGetters, mapActions , mapState , mapMutations } from 'vuex'

export default {
        mounted() {
            let query = {
                count: this.$route.query.count ? this.$route.query.count : 50,
                page: this.$route.query.page ? this.$route.query.page : 0
            }

            this.setQuery(query);
            this.getCampaigns(this.query)


        },
        methods: {
            ...mapMutations({
                setQuery: 'setQuery',
                setCurrentCampaign: 'setCurrentCampaign'
            }),
            ...mapActions({
                getCampaigns: 'getCampaigns'
            }),
            // Declare Other Methods Here
             changePage() {
             let query = {
                count: this.count,
                page: this.page
            }    
            this.getCampaigns(query)
            },
            viewStats(campaign) {
                this.$router.push({ name: 'campaigns.show', params: { id: campaign.id }})
                this.setCurrentCampaign(campaign)
            }
            

        },
        computed: {
            // Your Initial Data
            ...mapState({
                campaigns: state => state.campaigns.all,
                current: state => state.campaigns.current,
                query: state => state.campaigns.query,
                total: state => state.campaigns.total,
                page: state => state.campaigns.page,
                count: state => state.campaigns.count,

            }),
            ...mapGetters({
                campaignlist: 'campaignlist',
                curentCampaign: 'campaignlist',
                getQuery: 'getQuery',
                getTotal: 'getTotal',
                getPage: 'getPage',

            }),
            sendAt(campaign) {
                return moment(campaign.sendtime).calendar()
            }
            // Declare Other Computed Properties
        },
        watch: {
        '$route' (to,from) {
            let query = {
                count: to.query.count ? to.query.count: 50,
                page: to.query.page ? to.query.page : 0
            }
            this.setQuery(query)
            this.getCampaigns(query)

         },
        page: 'changePage'
    },
    }
</script>

<style scope>
.VuePagination {
    padding-top: 100px;
}
</style>