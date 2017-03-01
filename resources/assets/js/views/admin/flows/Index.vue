<template>
<div class="container">
<pagination  for="flows" :records="parseInt(total)" :per-page="parseInt(query.count)" :chunk="10">
</pagination>
             
<div class="row">
    <div class="col-sm-12" v-for="(flow, index)  in flows">
        <div class="card">
            <div class="card-header">
                <div class="caption">
                    <h6>Flow Name: {{ flow.name }} , Flow ID: {{ flow.id }} </h6>
                </div>
                <div class="actions">
                    <button class="btn btn-success btn-sm" v-if="flow.status == 'draft'"> <i class="fa fa-calendar-minus-o"></i> Created - {{ createdAt(flow) }}</button>
                    <button class="btn btn-primary btn-sm" @click="viewFlow(flow.id)"> <i class="fa fa-area-chart"></i>View</button>
                    
                </div>
            </div>
            
            <!--
            <div class="card-block">
                <p>Condition 2</p>
                <p>Metric ID: {{ flow.customer_filter.stanzas[1].criteria[0].statistic }}</p>
                <p>Operator: {{ flow.customer_filter.stanzas[1].criteria[0].operator }} </p>
                <p>Filter {{ flow.customer_filter.stanzas[1].criteria[0].statistic_filters.value }}</p>
                <p>Customer Filter Operator {{ flow.customer_filter.stanzas[1].criteria[0].statistic_filters.operator }}</p>
                <p>Time Frame {{ flow.customer_filter.stanzas[1].criteria[0].timeframe }}</p>
            </div>
            -->
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
                count: this.$route.query.count ? this.$route.query.count : 10,
                page: this.$route.query.page ? this.$route.query.page : 0
            }
            this.setQuery(query)
            this.setFlows(query)


        },
        methods: {
            ...mapMutations({
                setQuery: 'setQuery'

            }),
            ...mapActions({
                setFlows: 'setFlows',
                setCurrentFlow: 'setCurrentFlow'
            }),
            // Declare Other Methods Here
             changePage() {
             let query = {
                count: this.count,
                page: this.page
            }    
            this.setFlows(query)
            },
            viewFlow(id) {
                this.$router.push({ name: 'flows.show', params: { id }})
                
            },
            createdAt(flow) {
               return moment(flow.created).calendar()
            },
            

        },
        computed: {
            // Your Initial Data
            ...mapState({
                flows: state => state.flows.all,
                current: state => state.flows.current,
                query: state => state.flows.query,
                total: state => state.flows.total,
                page: state => state.flows.page,
                count: state => state.flows.count,

            }),
            ...mapGetters({
                getFlowLists: 'getFlowLists',
                getcurrentFlow: 'getcurrentFlow',
                getFlowQuery: 'getFlowQuery',
                getFlowTotal: 'getFlowTotal',
                getFlowPage: 'getFlowPage',
                getFlowCount: 'getFlowCount'

            }),

            
            // Declare Other Computed Properties
        },
        watch: {
        '$route' (to,from) {
            let query = {
                count: to.query.count ? to.query.count: 10,
                page: to.query.page ? to.query.page : 0
            }
            this.setQuery(query)
            this.setFlows(query)

         },
        page: {
        handler: function (page, oldValue) { 
            let query = {
                count: this.count,
                page
            }
            this.$router.replace({ query })

            },
        deep: false
        },
        count: {
        handler: function (count, oldValue) { 
        let query = {
            count,
            page: this.page
        }
        this.$router.replace({ query })

        },
        deep: false
        },

    },
    }
</script>

<style scope>
.VuePagination {
    padding-top: 100px;
}
</style>