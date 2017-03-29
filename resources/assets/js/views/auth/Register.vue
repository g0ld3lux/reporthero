<template>
    <form id="registerForm" method="post" @submit.prevent="validateBeforeSubmit">
        <div :class="{'form-group' : true , 'has-danger': errors.has('first_name') }">
            <input type="text" class="form-control form-control-danger" placeholder="First Name" name="first_name"
                   v-model="registerData.first_name" v-validate data-vv-rules="required">
        </div>
        <div :class="{'form-group' : true , 'has-danger': errors.has('last_name') }">
            <input type="text" class="form-control form-control-danger" placeholder="Last Name" name="last_name"
                   v-model="registerData.last_name" v-validate data-vv-rules="required">
        </div>
        <div :class="{'form-group' : true , 'has-danger': errors.has('email') }">
            <input type="email" class="form-control form-control-danger" placeholder="Enter email" name="email"
                   v-model="registerData.email" v-validate data-vv-rules="required|email">
        </div>
        <div :class="{'form-group' : true , 'has-danger': errors.has('password') }">
            <input type="password" class="form-control form-control-danger" placeholder="Enter Password" name="password"
                   v-model="registerData.password" v-validate data-vv-rules="required">
        </div>
        
        <button class="btn btn-theme btn-full">Register</button>
    </form>
</template>

<script>
    import Auth from '../../services/auth'

    export default {
        data() {
            return {
                registerData: {
                    first_name: '',
                    last_name: '',
                    email: '',
                    password: '',
                }
            }
        },
        methods: {
            validateBeforeSubmit(e){
                this.$validator.validateAll();

                if (!this.errors.any()) {
                    Auth.register(this.registerData)
                }
            }
        },
    }
</script>