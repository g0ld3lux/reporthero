<template>
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Edit User Profile</h3>
            <ol class="breadcrumb">
                <router-link class="breadcrumb-item" :to="{name: 'home'}" tag="li">Home</router-link>
                <router-link class="breadcrumb-item" :to="{ name: 'users.index'}" tag="li">Users</router-link>
                <router-link class="breadcrumb-item" :to="{ name: 'users.edit', params: { id: $route.params.id }}" tag="li">Edit User</router-link>
            </ol>
        </div>
        <div class="row">

        
        <div class="card col-xl-6">
            <div class="card-header">
                <h6>Profile</h6>
            </div>
            <div class="card-block">

                <form>
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="col-md-4 col-lg-2 form-control-label">First Name</label>
                            <div class="col-md-8 col-lg-10">
                                <div class="input-icon">
                                    <i class="fa fa-pencil"></i>
                                    <input type="text" class="form-control" name="first_name" :value="first_name" @blur="updateFirstName">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-lg-2 form-control-label">Last Name</label>
                            <div class="col-md-8 col-lg-10">
                                <div class="input-icon">
                                    <i class="fa fa-pencil"></i>
                                    <input type="text" class="form-control" name="last_name" :value="last_name" @blur="updateLastName">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-lg-2 form-control-label">Email Address</label>
                            <div class="col-md-8 col-lg-10">
                                <div class="input-icon">
                                    <i class="fa fa-envelope"></i>
                                    <input type="text" class="form-control" name="email" :value="email" @blur="updateEmail">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-lg-2 form-control-label">Password</label>
                                <div class="col-md-8 col-lg-10">
                                    <div class="input-icon">
                                        <i class="fa fa-lock"></i>
                                        <input type="password" class="form-control" name="password" :value="password" @blur="updatePassword">
                                    </div>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-lg-2 form-control-label">Store Type</label>
                                <div class="col-md-8 col-lg-10">
                                    <div class="input-icon">
                                        <i class="fa fa-shopping-cart"></i>
                                        <input type="text" class="form-control" name="store" :value="store_type" @blur="updateStoreType">
                                    </div>
                                </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <div class="card col-xl-6">
            <div class="card-header">
                <h6>Klaviyo Settings</h6>
            </div>
            <div class="card-block">
                <form>
                    <div class="form-body">
                        
                        <div class="form-group row">
                            <label class="col-md-4 col-lg-2 form-control-label">Klaviyo Token</label>
                                <div class="col-md-8 col-lg-10">
                                    <div class="input-icon">
                                        <i class="fa fa-plug"></i>
                                        <input type="password" class="form-control" name="public_key" :value="token" @blur="updateToken">
                                    </div>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-lg-2 form-control-label">Klaviyo Api Key</label>
                                <div class="col-md-8 col-lg-10">
                                    <div class="input-icon">
                                        <i class="fa fa-user-secret"></i>
                                        <input type="password" class="form-control" name="secret_key" :value="api_key" @blur="updateApiKey">
                                    </div>
                                </div>
                        </div>
    
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import { mapGetters, mapActions , mapState , mapMutations } from 'vuex'
export default {
    computed: {
            // Your Initial Data
            ...mapState({
                user: state => state.users.selected,
                first_name: state => state.users.selected.first_name,
                last_name: state => state.users.selected.last_name,
                email: state => state.users.selected.email,
                password: state => state.users.selected.password,
                store_type: state => state.users.selected.store_type,
                token: state => state.users.selected.token,
                api_key: state => state.users.selected.api_key,
                klaviyo_keys: state => state.users.klaviyo_keys
            })

        },
    methods: {
        ...mapActions({
                viewKlaviyoKeys: 'viewKlaviyoKeys',
                setSelectedUser: 'setSelectedUser',
            }),
            updateFirstName (e) {
            this.$store.dispatch('updateFirstName', e.target.value)
            },
            updateLastName (e) {
            this.$store.dispatch('updateLastName', e.target.value)
            },
            updateEmail (e) {
            this.$store.dispatch('updateEmail', e.target.value)
            },
            updatePassword (e) {
            this.$store.dispatch('updatePassword', e.target.value)
            },
            updateStoreType (e) {
            this.$store.dispatch('updateStoreType', e.target.value)
            },
            updateToken (e) {
            this.$store.dispatch('updateToken', e.target.value)
            },
            updateApiKey (e) {
            this.$store.dispatch('updateApiKey', e.target.value)
            },

        
    },
    mounted(){
        this.setSelectedUser(this.$route.params.id)
    },
    watcher: {

        user: {
               handler: function (user, oldValue) { 
                
                 },
                deep: true
           },
        klaviyo_keys: {
               handler: function (klaviyo_keys, oldValue) { 
                   console.log(klaviyo_keys)
                 },
                deep: true
           },
    }
}
</script>

<style>
</style>
