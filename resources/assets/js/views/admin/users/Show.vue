<template>
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">View User Profile</h3>
            <ol class="breadcrumb">
                <router-link class="breadcrumb-item" :to="{name: 'home'}" tag="li">Home</router-link>
                <router-link class="breadcrumb-item" :to="{ name: 'users.index'}" tag="li">Users</router-link>
                <router-link class="breadcrumb-item" :to="{ name: 'users.show', params: { id: user.id }}" tag="li">Show User</router-link>
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
                                    <input type="text" class="form-control" name="first_name" v-model="user.first_name" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-lg-2 form-control-label">Last Name</label>
                            <div class="col-md-8 col-lg-10">
                                <div class="input-icon">
                                    <i class="fa fa-pencil"></i>
                                    <input type="text" class="form-control" name="last_name" v-model="user.last_name" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-lg-2 form-control-label">Email Address</label>
                            <div class="col-md-8 col-lg-10">
                                <div class="input-icon">
                                    <i class="fa fa-envelope"></i>
                                    <input type="text" class="form-control" name="email" v-model="user.email" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-lg-2 form-control-label">Store Type</label>
                                <div class="col-md-8 col-lg-10">
                                    <div class="input-icon">
                                        <i class="fa fa-pencil"></i>
                                        <input type="text" class="form-control" name="store" readonly>
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
                                        <i class="fa fa-pencil"></i>
                                        <input type="text" class="form-control" name="public_key" v-model="klaviyo_keys.token" readonly>
                                    </div>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-lg-2 form-control-label">Klaviyo Api Key</label>
                                <div class="col-md-8 col-lg-10">
                                    <div class="input-icon">
                                        <i class="fa fa-pencil"></i>
                                        <input type="text" class="form-control" name="secret_key" v-model="klaviyo_keys.api_key" readonly>
                                    </div>
                                </div>
                        </div>
    
                        <button type="button" class="btn btn-info btn-full" @click="toggleView()"><span v-if="visible == false"><i class="fa fa-eye"></i>Show Api Keys</span><span v-else><i class="fa fa-eye-slash"></i>Hide Api Keys</span></button>
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
data() {
    return {
        visible: false
    }
},
    computed: {
            // Your Initial Data
            ...mapState({
                user: state => state.users.selected,
                klaviyo_keys: state => state.users.klaviyo_keys
            }),

        },
    methods: {
        ...mapActions({
                viewKlaviyoKeys: 'viewKlaviyoKeys',
                setSelectedUser: 'setSelectedUser'
            }),
            toggleView(){
                if(!this.visible){
                this.viewKlaviyoKeys(this.$route.params.id)
                this.visible = true;
            }
            else{
                let klaviyo_keys = {
                    token: '**********',
                    api_key: '***********'
                }
                this.$store.commit('setKlaviyoApiKeys', klaviyo_keys.token)
                this.$store.commit('setKlaviyoToken', klaviyo_keys.api_key)
                this.visible = false
            }
                
            }
    },
    mounted(){
        this.setSelectedUser(this.$route.params.id)
    },
    watcher: {

        user: {
               handler: function (user, oldValue) { 
                   // Do Something when a User Var Change 
                   console.log(user)
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
