<template>
    <div class="header-bottom">
        <ul class="header-nav">
            <li :class="{ active: isActive('/campaigns') }">
                <router-link to="/campaigns/"><i class="fa fa-area-chart"></i> Campaigns</router-link>
            </li>

            <li :class="{ active: isActive('/campaign/') }" v-if="isActive('/campaign/')">
                <a href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-calendar"></i> Filter By Date</a>
                <div class="dropdown-menu">
                    <router-link to="/campaign/show7dayscomponent" class="dropdown-item">7 Days Report</router-link>
                </div>
            </li>
        </ul>
    </div>
</template>

<script type="text/babel">
    export default {
        data() {
            return {
                'sidebar' : 'sidebar'
            }
        },
        mounted(){
            $("#menu").metisMenu();
        },

        methods : {
            isActive(url){
                return (this.$route.path.indexOf(url) > -1)
            }
        }

    }
</script>