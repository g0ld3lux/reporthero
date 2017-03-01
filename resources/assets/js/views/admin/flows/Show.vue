<template>
<div class="main-content" id="dashboardPage">
    <h6><span style="color:indianred;">Flow:</span> <strong style="color:cadetblue;">{{ flow.name }}</strong></h6>
        <div class="row">
            
        </div>
        
    </div>
</template>

<script>
import { mapGetters, mapActions , mapState , mapMutations } from 'vuex'
export default {
    methods: {
            ...mapActions({
                setCurrentFlow: 'setCurrentFlow'

            }),

            // Declare other method
        },
    computed: {
            // Your Initial Data
            ...mapState({
                flow: state => state.flows.current,
            }),
            ...mapGetters({
                getcurrentFlow: 'getcurrentFlow',
            }),

            // Declare Other Computed Properties
        },
    mounted() {
        // getCurrentFlow
        this.setCurrentFlow(this.$route.params.id)
    },
}

</script>

<style scoped>
</style>