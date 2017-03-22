<template>
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Create A New User</h3>
            <ol class="breadcrumb">
                <router-link class="breadcrumb-item" :to="{name: 'home'}" tag="li">Home</router-link>
                <router-link class="breadcrumb-item" :to="{ name: 'users.index'}" tag="li">Users</router-link>
                <router-link class="breadcrumb-item" :to="{ name: 'users.create'}" tag="li">Create User</router-link>
            </ol>
        </div>
        <div class="row">

        
        <div class="card col-xl-6">
            <div class="card-header">
                <h6>Create A New User</h6>
            </div>
            <div class="card-block">

                <form>
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="col-md-4 col-lg-2 form-control-label">First Name</label>
                            <div class="col-md-8 col-lg-10">
                                <div class="input-icon">
                                    <i class="fa fa-pencil"></i>
                                    <input type="text" class="form-control" name="first_name" v-model="user.first_name">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-lg-2 form-control-label">Last Name</label>
                            <div class="col-md-8 col-lg-10">
                                <div class="input-icon">
                                    <i class="fa fa-pencil"></i>
                                    <input type="text" class="form-control" name="last_name" v-model="user.last_name">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-lg-2 form-control-label">Email Address</label>
                            <div class="col-md-8 col-lg-10">
                                <div class="input-icon">
                                    <i class="fa fa-envelope"></i>
                                    <input type="text" class="form-control" name="email" v-model="user.email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-lg-2 form-control-label">Password</label>
                                <div class="col-md-8 col-lg-10">
                                    <div class="input-icon">
                                        <i class="fa fa-lock"></i>
                                        <input type="password" class="form-control" name="store" v-model="user.password">
                                    </div>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-lg-2 form-control-label">Store Type</label>
                                <div class="col-md-8 col-lg-10">
                                    <div class="input-icon">
                                        <i class="fa fa-pencil"></i>
                                        <input type="text" class="form-control" name="store" v-model="user.store_type">
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
                                        <input type="text" class="form-control" name="public_key" v-model="user.klaviyo_keys.token">
                                    </div>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-lg-2 form-control-label">Klaviyo Api Key</label>
                                <div class="col-md-8 col-lg-10">
                                    <div class="input-icon">
                                        <i class="fa fa-pencil"></i>
                                        <input type="text" class="form-control" name="secret_key" v-model="user.klaviyo_keys.api_key">
                                    </div>
                                </div>
                        </div>
    
                        <button type="button" class="btn btn-info btn-full" @click="createUser()"><i class="fa fa-eye"></i>Create</button>
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
            user: {
                first_name: null,
                last_name: null,
                email: null,
                password: null,
                store_type: null,
                klaviyo_keys: {
                    token: null,
                    api_key:null
                }
            }
        }
    },
    computed: {
           

        },
    methods: {
        ...mapActions({
                addUser: 'addUser',
            }),
            createUser() {
                let query = {
                    first_name: this.user.first_name,
                    last_name: this.user.last_name,
                    email: this.user.email,
                    password: this.user.password,
                    store_type: this.user.store_type,
                    klaviyo_keys: this.user.klaviyo_keys
                }
                this.addUser(query)
                this.resetUser()
            },
            resetUser(){
                this.user = {
                first_name: null,
                last_name: null,
                email: null,
                password: null,
                store_type: null,
                klaviyo_keys: {
                    token: null,
                    api_key:null
                }
            }
            }
    },
    mounted(){
        
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
                   // Do Something when a User Var Change 
                   console.log(klaviyo_keys)
                 },
                deep: true
           },
    }
}
</script>

<style>
</style>
