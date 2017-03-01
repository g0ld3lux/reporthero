<template>

    <div class="main-content" id="dashboardPage">
    <h6><span style="color:indianred;">Subject:</span> <strong style="color:cadetblue;">{{ campaign.subject }}</strong></h6>
        <div class="row">
            <div class="col-lg-8 col-xl-8">
                 <div class="row">
                    <opened></opened>
                    <open-rate></open-rate>
                    <clicked></clicked>
                    <click-rate></click-rate>
                </div>
                <div class="row">
                    <delivered></delivered>
                    <place-order></place-order>
                    <rate-order></rate-order>
                    <total-revenue></total-revenue>
                    
                </div>
            </div>

            <div class="col-lg-4 col-xl-4">
           
                <div class="row" id="campaign-calendar">
                    <vue-event-calendar :events="campaignEvents"></vue-event-calendar>
                 </div>
                
                
            </div>
  
            <!--
            <div class="col-lg-4 col-xl-4">
            <div class="row">
            <unsubscribed></unsubscribed>
            <bounced></bounced>
            <spam-count></spam-count>
            <total-recipients :total="campaign.num_recipients"></total-recipients>
            </div>
            <div class="row">
            </div>
            </div>
            -->
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
            <option value="yq4vyv">Spam</option>sNU69p
            <option value="sNU69p">Bounced</option>
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
    import ClickRate from '../../../components/Campaigns/ClickRate.vue'
    import Bounced from '../../../components/Campaigns/Bounced.vue'
    import SpamCount from '../../../components/Campaigns/SpamCount.vue'
    import TotalRecipients from '../../../components/Campaigns/TotalRecipients.vue'
    Vue.use(vueEventCalendar, {locale: 'en'})
    export default {
        props: {
            // Use Case of Props as Initial Data and Reference it Inside Your Data
            initialLimitFrom: {
                type: String,
                default() {
                    return moment().subtract(30,'d').format('YYYY-MM-DD')
                }
            },
            initialLimitTo: {
                type: String,
                default() {
                    return moment().format('YYYY-MM-DD')
                }
            },
            initialSelected: {
                type: String,
                default() {
                    return 'xGqcAu'
                }
            },
            initialStartDate: {
                type: Object,
                default() {
                    return {
                        time: moment().subtract(30,'d').format('YYYY-MM-DD')
                    }
                }
            },
            initialEndDate: {
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
                campaignEvents: [],
                selected: this.initialSelected,
                start_date: this.initialStartDate,
                end_date: this.initialEndDate,
                limitTo: this.initialLimitTo,
                limitFrom: this.initialLimitFrom

            } // End Return
        },
        components : {
        TotalRecipients,SpamCount,Bounced,ClickRate,datePicker, opened, delivered, clicked, unsubscribed,placeOrder, rateOrder,totalRevenue, OpenRate, MetricChart
        },
         methods: {
            ...mapMutations({
                setSelectedMetric: 'setSelectedMetric',
                setMetricQuery: 'setMetricQuery'

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

        },
        watch: {
           // Once we Have Our Campaign Object then Render The Campaign Events Component
           campaign: 'setCampaignEvents',
           // Once Selected is Change On Drop Down We Call setSelectedMetric Mutation
           selected: 'setSelected',
           // If we Are Watchin an Object it is Better to Use This Handler and Deep properties in Watcher
           end_date: {
               handler: function (end_date, oldValue) { 
                   let query = {
                       start_date: this.start_date.time,
                       end_date: end_date.time
                   }
                    this.$router.replace({ query })
                 },
                deep: true
           },
           start_date: {
                handler: function (start_date, oldValue) { 
                    let query = {
                       start_date: start_date.time,
                       end_date: this.end_date.time
                   }
                    this.$router.replace({ query })
                 },
                deep: true
           }


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