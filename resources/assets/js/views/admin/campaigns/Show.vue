<template>

    <div class="main-content" id="dashboardPage">
        <div class="row">
            <div class="col-lg-8 col-xl-8">
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
            </div>
            <div class="col-lg-4 col-xl-4">
                <div class="row" id="campaign-calendar">
                    <vue-event-calendar :events="campaignEvents"></vue-event-calendar>
                 </div>
                 
            </div>
        </div>

       
        <div class="row">
        <div class="input-group input-daterange col-xl-2">

            <input type="text" class="form-control ls-datepicker" style="font-size: 13px;" v-model="date_from">
            <span class="input-group-addon">to</span>
            <input type="text" class="form-control ls-datepicker" style="font-size: 13px;" v-model="date_to">
        </div>
        <div class="col-xl-2">
        <!-- form-control ls-select2 -->
        <select class="" v-model="selected">
            <option value="xGqcAu">Clicked</option>
            <option value="xM3sVS">Opened</option>
            <option value="s7fMbn">Unsubscribed</option>
            <option value="vFvk9B">Place Order</option>
            <option value="teDBUH">Delivered</option>
        </select>

        </div>
 
        </div>
        <div class="row">
        
            <div class="col-lg-12 col-xl-6 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h6><i class="fa fa-line-chart text-warning"></i>{{ getCurrentMetric.name }}</h6>
                    </div>
                    <div class="card-block">
                        <metric-chart></metric-chart>
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
    import AllRevenueStats from '../../../components/Campaigns/AllRevenueStats.vue'
    import calendar from 'vue-datepicker'
    import 'vue-event-calendar/dist/style.css'
    import vueEventCalendar from 'vue-event-calendar'
    import placeOrder from '../../../components/Campaigns/PlaceOrder.vue'
    import rateOrder from '../../../components/Campaigns/RateOrder.vue'
    import totalRevenue from '../../../components/Campaigns/TotalRevenue.vue'
    import OpenRate from '../../../components/Campaigns/OpenRate.vue'
    import MetricChart from '../../../components/Campaigns/MetricChart.vue'
    Vue.use(vueEventCalendar, {locale: 'en'})
    export default {
        props: {
            date_from: {
                type: String,
                default() { 
                    return moment().subtract(30,'d').format('MM-DD-YYYY')
                }
            },
            date_to: {
                type: String,
                default() { 
                    return moment().format('MM-DD-YYYY')
                }
            },
            selected: {
                type: String,
                default() {
                    return 'xGqcAu'
                }
            }

        },
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
                    }],
            } // End Return
        },
        // create a method to get only the highest and lowest date to be assign as to and from date for the date filter
        components : {
        opened, delivered, clicked, unsubscribed, AllRevenueStats, calendar,placeOrder, rateOrder,totalRevenue, OpenRate, MetricChart
        },
         methods: {
            ...mapMutations({
                setSelectedMetric: 'setSelectedMetric'

            }),
            ...mapActions({
                setCurrentCampaign: 'setCurrentCampaign',
                listMetrics: 'listMetrics'
            }),

            setSelected() {
                this.setSelectedMetric(this.selected);
            },


            setCampaignEvents() {
                let desc = 'Your Campaign Has been Sent Successfully'
                if(this.campaign.status_label == 'Scheduled')
                {
                    desc = '@ ' + moment(this.campaign.send_time).format('YYYY-MM-DD')
                }

                let events = [{
                    date: this.campaign.created,
                    title: 'Created',
                    desc: '@ ' + moment(this.campaign.created).format('YYYY-MM-DD')
                },{
                    date: this.campaign.send_time,
                    title: this.campaign.status_label,
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
            },
            loadChart() {
                // get date_from , date_to , and  metric ID

                // user submit ajax request
                // button change to loading 
                // data retrive 
                // update chart 
                // return button back to normal
                console.log('chart loaded!')
            },
            
           

            // Declare other method
        },
        computed: {
            // Your Initial Data
            ...mapState({
                campaign: state => state.campaigns.current,
                metrics: state => state.metrics.all,
            }),
            ...mapGetters({
                getSelected: 'getSelected',
                getCurrentMetric: 'getCurrentMetric'
            }),
            
            // pass here the selectedMetricsID

            // Declare Other Computed Properties
        },
        mounted() {
            // fetch current campaign
            this.setCurrentCampaign(this.$route.params.id)
            // fetch all metrics
            this.listMetrics()
            Plugin.initPlugins(['Select2','BootstrapSelect','TimePickers','MultiSelect','DatePicker','SwitchToggles'])

        },
        watch: {
           campaign: 'setCampaignEvents',
           selected: 'setSelected'


        }
        

    }
</script>
<style lang="scss">
div.cal-wrapper {

}
div.item {
        width: 10% !important;
}
.weeks .item {
    font-size: 14px !important;
}
.date-num {
    font-size: 14px !important;
}
div#campaign-calendar.row {

}

.is-today {
    background-color: #fff176 !important;
    border-color: #fff176 !important;
}

h2.date{
background-color: #fff176 !important;



}
div.event-item {



}
p.time {
    display:none;
}
div.cal-wrapper {

   margin: 0 !important;
  padding: 0 !important;
}
div.events-wrapper {
    margin-left: 20px !important;
    margin-bottom: 20px !important;
    padding: 0 !important;
    background-color:transparent !important;
}
</style>