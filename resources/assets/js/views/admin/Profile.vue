<template>
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Account</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="#">Edit Profile</a></li>
            </ol>
        </div>
        <div class="row">

        
        <div class="card col-xl-6">
            <div class="card-header">
                <h6>Edit Profile</h6>
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
                            <label class="col-md-4 col-lg-2 form-control-label">Store Type</label>
                                <div class="col-md-8 col-lg-10">
                                    <div class="input-icon">
                                        <i class="fa fa-pencil"></i>
                                        <input type="text" class="form-control" name="store">
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
                                        <input type="text" class="form-control" name="public_key" v-model="klaviyo_keys.token">
                                    </div>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-lg-2 form-control-label">Klaviyo Api Key</label>
                                <div class="col-md-8 col-lg-10">
                                    <div class="input-icon">
                                        <i class="fa fa-pencil"></i>
                                        <input type="text" class="form-control" name="secret_key" v-model="klaviyo_keys.api_key">
                                    </div>
                                </div>
                        </div>
    
                        <button type="button" class="btn btn-info btn-full"><i class="fa fa-eye"></i>Show Api Keys</button>
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
                user: state => state.users.auth,
                admin: state => state.users.admin,
                klaviyo_keys: state => state.users.klaviyo_keys
            }),

        },
    watcher: {

        user: {
               handler: function (user, oldValue) { 
                   // Do Something when a User Var Change 
                   console.log(user)
                 },
                deep: true
           },
    }
}
</script>

<style>
</style>
