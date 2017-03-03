<template>
    <header class="site-header">
        <a href="#" class="brand-main">
            <img src="/reporthero-logo-01.png" id="logo-desk" alt="Report Hero Logo" class="hidden-sm-down">
            <img src="/reporthero-logo-02.png" id="logo-mobile" alt="Report Hero Logo" class="hidden-md-up">
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
                    <router-link class="dropdown-item" to="/profile"><i class="fa fa-cogs"></i> Profile</router-link>
                    <a href="#" class="dropdown-item" @click.prevent="logout"><i class="fa fa-sign-out"></i> Logout</a>
                </div>
            </li>
        </ul>
    </header>
</template>


<script>

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

<style>
.brand-main img {
    height: 50px;
    margin-top: -10px;

}
.site-header {
    background-color: #b3e5fc !important;
}

.header-nav {
    background-color: #0288d1 !important;
}
.active {
    color: #e6ee9c !important;
}
</style>