<template>
    <div class="header-bottom">
        <ul class="header-nav">
            <li :class="{ active: isActive('/campaigns') }">
                <router-link to="/campaigns/"><i class="fa fa-flag"></i> Campaigns</router-link>
            </li>
            <li :class="{ active: isActive('/flows') }">
                <router-link to="/flows/"><i class="fa fa-usb"></i> Flows</router-link>
            </li>
            <li :class="{ active: isActive('/calculator') }">
                <router-link to="/calculator/"><i class="fa fa-calculator"></i> Calculator</router-link>
            </li>
            <li v-if="$store.state.users.isAdmin" :class="{ active: isActive('/users') }">
                <router-link to="/users/"><i class="fa fa-user"></i> Users</router-link>
            </li>

        </ul>
    </div>
</template>

<script>
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