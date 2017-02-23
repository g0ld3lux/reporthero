<template>
<div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Calculator</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Calculator</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Projected Income Calculator</h6>
                    </div>
                    <div class="card-block">
                        <h5 class="section-semi-title">Traffic Input</h5>

                        <form>
                            <div class="form-group row">
                                <label for="inputSession" class="col-sm-2 form-control-label">Session / Month</label>

                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="inputSession" v-model="sessionPerMonth">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputUniqueUsers" class="col-sm-2 form-control-label">Projected Unique Users Per Month</label>

                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="inputUniqueUsers"
                                           v-model="uniqueUsers" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputConversionRatePerOrder" class="col-sm-2 form-control-label">Conversion Rate</label>

                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="inputConversionRatePerOrder" placeholder="0.2" readonly>
                                </div>
                            </div>

                            <div class="form-group has-success row">
                                <label class="form-control-label" for="inputRevenue">Basic Revenue</label>
                                <input type="number" class="form-control form-control-success" id="inputRevenue" :placeholder="basicRevenue" readonly>
                            </div>
                        </form>
                        <h5 class="section-semi-title mt-4">Choose Optimization</h5>

                        <form>
                         
                            
                            <input type="checkbox" id="newCustomerRate" value="newCustomerRate" v-model="checkedRates" :checked="checkedRates.includes('newCustomerRate')">
                            <label for="newCustomerRate">Welcome Rate Optimization</label>
                            <input type="checkbox" id="returningCustomerRate" value="returningCustomerRate" v-model="checkedRates">
                            <label for="returningCustomerRate">Returning Rate Optimization</label>
                            <input type="checkbox" id="abandonCartRate" value="abandonCartRate" v-model="checkedRates">
                            <label for="abandonCartRate">Abandon Cart Optimization</label>

                            <div class="form-group has-success row">
                                <label class="form-control-label" for="totalRevenue">Total Optimized Revenue</label>
                                <input type="number" class="form-control form-control-success" id="totalRevenue" :placeholder="totalRevenue" readonly>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                sessionPerMonth: 10000,
                uniqueRate: 0.67,
                conversionRate: .02,
                captureRate: 0,
                checkedRates: [],
                newCustomerRate: 0.002,
                returningRate: 0.003,
                abandonRate: 0.009,
                currentRate: 0,
                checkedNames: []
            }
        },
        mounted(){
            // Plugin.initPlugins(['SwitchToggles'])
            console.log('Calculator Ready!')
        },
        methods: {
            getTotalRevenue() {
                let addedRate = 0
                var vm = this;
                if(this.checkedRates.find(vm.isNewCustomerRateChecked)){addedRate += this.newCustomerRate}
                if(this.checkedRates.find(vm.isreturningCustomerRateChecked)){addedRate += this.returningRate}
                if(this.checkedRates.find(vm.isabandonCustomerRateChecked)){addedRate += this.abandonRate}
                 this.currentRate = addedRate
                return Vue.filter('currency')((this.currentRate + this.conversionRate) * this.sessionPerMonth)
               
            },
            isNewCustomerRateChecked(element) {
                if(element === 'newCustomerRate') return true;
            },
            isreturningCustomerRateChecked(element) {
                if(element === 'returningCustomerRate') return true;
            },
            isabandonCustomerRateChecked(element) {
                if(element === 'abandonCartRate') return true;
            }

        },
        computed: {
            uniqueUsers() {
                return this.sessionPerMonth * this.uniqueRate
            },
            basicRevenue() {
                return Vue.filter('currency')(this.sessionPerMonth * this.conversionRate)
            },
            totalRevenue() {
                return this.getTotalRevenue()

            }
        },
        watch: {
            checkedRates: 'getTotalRevenue'
        }
    }
</script>