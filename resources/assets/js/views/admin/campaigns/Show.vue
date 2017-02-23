<template>

    <div class="main-content" id="dashboardPage">
        <div class="row" id="campaign-calendar">
         <vue-event-calendar :events="campaignEvents"></vue-event-calendar>
         <br><br>
        </div>
        <div class="row">
       
            <delivered :campaignName="campaign.name"></delivered>
            <opened :campaignName="campaign.name"></opened>
            <clicked :campaignName="campaign.name"></clicked>
            <unsubscribed :campaignName="campaign.name"></unsubscribed>
        </div>
        <div class="row">
            <place-order></place-order>
            <rate-order></rate-order>
            <total-revenue></total-revenue>
            <open-rate :campaignName="campaign.name"></open-rate>
        </div>
        <calendar :date="date" :option="option" :limit="limit">
        </calendar>
        <div class="row">
        
            <div class="col-lg-12 col-xl-6 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h6><i class="fa fa-line-chart text-warning"></i>Last 7 Day Revenue</h6>
                    </div>
                    <div class="card-block">
                        <revenue-vs-abandon :campaignName="campaign.name" :campaignID="campaign.id"></revenue-vs-abandon>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xl-6 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h6><i class="fa fa-bar-chart text-success"></i> Overall Revenue Breakdown</h6>
                    </div>
                    <div class="card-block">
                        <all-revenue-stats> </all-revenue-stats>
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>
</template>

<script>
    import { mapGetters, mapActions , mapState , mapMutations } from 'vuex'
    import opened from '../../../components/Campaigns/Opened.vue'
    import delivered from '../../../components/Campaigns/Delivered.vue'
    import clicked from '../../../components/Campaigns/Clicked.vue'
    import unsubscribed from '../../../components/Campaigns/Unsubscribed.vue'
    import RevenueVsAbandon from '../../../components/Campaigns/RevenueVsAbandon.vue'
    import AllRevenueStats from '../../../components/Campaigns/AllRevenueStats.vue'
    import calendar from 'vue-datepicker'
    import 'vue-event-calendar/dist/style.css'
    import vueEventCalendar from 'vue-event-calendar'
    import placeOrder from '../../../components/Campaigns/PlaceOrder.vue'
    import rateOrder from '../../../components/Campaigns/RateOrder.vue'
    import totalRevenue from '../../../components/Campaigns/TotalRevenue.vue'
    import OpenRate from '../../../components/Campaigns/OpenRate.vue'
    Vue.use(vueEventCalendar, {locale: 'en'})
    export default {
        data() {
            return {
                'header' : 'header',
                date: {
                    time: '' // string
                },
                campaignEvents: [],
                option: {
                    // allow to pick multi-day
                    type: 'multi-day',
                    week: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
                    month: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    format: 'YYYY-MM-DD',
                    placeholder: 'Filter By Date',
                    inputStyle: {
                    'display': 'inline-block',
                    'padding': '12px',
                    'line-height': '22px',
                    'font-size': '16px',
                    'border': '2px solid #fff',
                    'box-shadow': '0 1px 3px 0 rgba(0, 0, 0, 0.2)',
                    'text-align': 'center',
                    'border-radius': '2px',
                    // Color of Text in Input
                    'color': '#ffd54f'
                    },
                    color: {
                    header: '#ffca28',
                    headerText: '#eceff1'
                    },
                    buttons: {
                    ok: 'Ok',
                    cancel: 'Cancel'
                    },
                    overlayOpacity: 0.5, // 0.5 as default
                    dismissible: true // as true as default
                    },
                    timeoption: {
                        type: 'min',
                        week: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
                        month: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                        format: 'YYYY-MM-DD HH:mm'
                    },
                    multiOption: {
                        type: 'multi-day',
                        week: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
                        month: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                        format:"YYYY-MM-DD HH:mm"
                    },
                    limit: [{
                        type: 'week',
                        available: [1,2,3,4,5]
                    },
                    {
                        type: 'fromto',
                        from: moment().subtract(30,'d').format('YYYY-MM-DD'), // Created Date
                        to: moment().format() // Present Date
                    }]
            } // End Return
        },
        // create a method to get only the highest and lowest date to be assign as to and from date for the date filter
        components : {
        opened, delivered, clicked, unsubscribed, RevenueVsAbandon , AllRevenueStats, calendar,placeOrder, rateOrder,totalRevenue, OpenRate
        },
         methods: {
            ...mapActions({
                setCurrentCampaign: 'setCurrentCampaign'
            }),
            setCampaignEvents() {

                let desc = 'Your Campaign Has been Sent Successfully'
                if(!this.campaign.status_label=='Sent')
                {
                    desc = 'Campaign is About to Be Send On ' + moment(this.campaign.send_time).format(YYYY-MM-DD)
                }

                let events = [{
                    date: this.campaign.created,
                    title: 'Campaign Created',
                    desc: 'You Have Successfully Createad Your Campaign'
                },{
                    date: this.campaign.send_time,
                    title: 'Campaign ' + this.campaign.status_label,
                    desc
                }]
                this.campaignEvents = events
            },

            setCampaignEvents() {
                let desc = 'Your Campaign Has been Sent Successfully'
                if(!this.campaign.status_label=='Sent')
                {
                    desc = 'Campaign is About to Be Send On ' + moment(this.campaign.send_time).format(YYYY-MM-DD)
                }

                let events = [{
                    date: this.campaign.created,
                    title: 'Campaign Created',
                    desc: 'You Have Successfully Createad Your Campaign'
                },{
                    date: this.campaign.send_time,
                    title: 'Campaign ' + this.campaign.status_label,
                    desc
                }]
                this.campaignEvents = events
                let limit= 
                [{
                    type: 'week',
                    available: [1,2,3,4,5]
                },
                {
                    type: 'fromto',
                    from: this.campaign.created, // Created Date
                    to: moment().format() // Present Date
                }]
                this.limit = limit
            }
            // Declare other method
        },
        computed: {
            // Your Initial Data
            ...mapState({
                campaign: state => state.campaigns.current
            }),
            ...mapGetters({
                currentCampaign: 'currentCampaign'
            })
            // Declare Other Computed Properties
        },
        mounted() {
            this.setCurrentCampaign(this.$route.params.id)

        },
        watch: {
           campaign: 'setCampaignEvents'

        }
        

    }
</script>
<style lang="scss">

div#campaign-calendar.row {
    max-height: 365px !important;
    margin-top: -25px;
    padding-bottom: 25px;
}
h2.date{
    background-color: #ffd54f !important;
}
div.cal-wrapper {
    float: left;
   margin: 0 !important;
  padding: 0 !important;
}
div.events-wrapper {
    float: right;
    margin-top: 0 !important;
    margin-bottom: 0 !important;
    margin-left: 0 !important;
    background-color: #fff59d !important;


}
</style>