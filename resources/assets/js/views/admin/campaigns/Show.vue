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
        <div class="input-group input-daterange col-xl-2 col-sm-4 col-md-4">

           <date-picker placeholder="Start Date" :date="start_date" :limitFrom="limitFrom" :limitTo="limitTo"></date-picker>
           
        </div>
        <div class="input-group input-daterange col-xl-2 col-sm-4 col-md-4">

           <date-picker placeholder="End Date" :date="end_date" :limitFrom="limitFrom" :limitTo="limitTo"></date-picker>   
           
        </div>
        <div class="col-xl-2 col-sm-4 col-md-4">
        <!-- form-control ls-select2 -->
        <select class="styled-select slate" v-model="selected">
            <option value="xGqcAu">Clicked</option>
            <option value="xM3sVS">Opened</option>
            <option value="s7fMbn">Unsubscribed</option>
            <option value="teDBUH">Delivered</option>
        </select>

        </div>
 
        </div>
        <div class="row">
        
            <div class="col-lg-12 col-xl-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h6><i class="fa fa-line-chart text-warning"></i>{{ getCurrentMetric.name }}</h6>
                    </div>
                    <div class="card-block">
                        <metric-chart></metric-chart>
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
    import datePicker from '../../../components/Campaigns/DatePicker.vue'
    import unsubscribed from '../../../components/Campaigns/Unsubscribed.vue'
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
            // Set You Go Campaign Object
            // but we provided a default which is 1 month before
            limitFrom: {
                type: String,
                default() {
                    return moment().subtract(30,'d').format('YYYY-MM-DD')
                }
            },
            limitTo: {
                type: String,
                default() {
                    return moment().format('YYYY-MM-DD')
                }
            },
            selected: {
                type: String,
                default() {
                    return 'xGqcAu'
                }
            },
            start_date: {
                tpe: Object,
                default() {
                    return {
                        time: moment().subtract(30,'d').format('YYYY-MM-DD')
                    }
                }
            },
            end_date: {
                type: Object,
                default() {
                    return {
                        time: moment().format('YYYY-MM-DD')
                    }
                }
            }

        },
        data() {
            return {
                // laraspace specific properties
                'header' : 'header',
                campaignEvents: []

            } // End Return
        },
        // create a method to get only the highest and lowest date to be assign as to and from date for the date filter
        components : {
        datePicker, opened, delivered, clicked, unsubscribed,placeOrder, rateOrder,totalRevenue, OpenRate, MetricChart
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
            // Use Jquery Plugins
            Plugin.initPlugins(['DatePicker'])

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
.styled-select {
   background: url(http://i62.tinypic.com/15xvbd5.png) no-repeat 96% 0;
   height: 29px;
   overflow: hidden;
   width: 100%;
   -webkit-appearance: none;
}
.styled-select select {
   background: transparent;
   border: none;
   font-size: 14px;
   height: 29px;
   padding: 5px; /* If you add too much padding here, the options won't show in IE */
   width: 100%;
}
.styled-select.slate {
   background: url(http://i62.tinypic.com/2e3ybe1.jpg) no-repeat right center;
   height: 34px;
   width: 100%;

}

.styled-select.slate select {
   border: 5px solid #ccc;
   font-size: 16px;
   height: 34px;
   width: 100%;
}
.slate   { background-color: #ddd; }
.slate select   { color: #000; }

</style>