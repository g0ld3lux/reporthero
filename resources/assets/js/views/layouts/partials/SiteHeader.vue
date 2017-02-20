<template>
    <header class="site-header">
        <a href="#" class="brand-main">
            <img src="/logo-dark.png" id="logo-desk" alt="Laraspace Logo" class="hidden-sm-down">
            <img src="/assets/img/logo-mobile.png" id="logo-mobile" alt="Laraspace Logo" class="hidden-md-up">
        </a>

        <a href="#" class="nav-toggle" @click="onNavToggle">
            <div class="hamburger hamburger--htla">
                <span>toggle menu</span>
            </div>
        </a>

        <ul class="action-list">
            <li>
                <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="avatar"><img src="/assets/img/avatars/avatar.png" alt="Avatar"></a>
                <div class="dropdown-menu dropdown-menu-right notification-dropdown">
                    <router-link class="dropdown-item" to="/admin/settings"><i class="fa fa-cogs"></i> Settings</router-link>
                    <a href="#" class="dropdown-item" @click.prevent="logout"><i class="fa fa-sign-out"></i> Logout</a>
                </div>
            </li>
        </ul>
    </header>
</template>


<script type="text/babel">

    import Layout from '../../../helpers/layout'
    import Auth from '../../../services/auth'

    export default {
        data() {
            return {
                'header' : 'header'
            }
        },
        methods : {
            onNavToggle(){
                Layout.toggleSidebar()
            },
            logout(){
                Auth.logout().then(() => {
                    this.$router.replace('/login')
                })
            }
        }

    }
</script>