<template>
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">User Management</h3>
            <ol class="breadcrumb">
                <router-link class="breadcrumb-item" :to="{name: 'home'}" tag="li">Home</router-link>
                <router-link class="breadcrumb-item" :to="{ name: 'users.index'}" tag="li">Users</router-link>
                <div class="pull-right">
            <router-link class="btn btn-icon btn-outline-info" :to="{ name: 'users.create'}" tag="button"><i
                                                class="fa fa-user-plus"></i>Create New User</router-link>
            </div>
            </ol>
            
        </div>
        
        <div class="row">
            <div class="col-sm-12">

                <div class="card">
                    <div class="card-header">
                        <h6>Users Lists</h6>
                    </div>
                    <div class="card-block">
                        <table id="responsive-datatable" class="table " cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Date Created</th>
                                <th>Date Updated</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Date Created</th>
                                <th>Date Updated</th>
                                <th>Actions</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <tr v-for="user in users">
                                <td>{{ user.id }}</td>
                                <td>{{ name(user) }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ createAt(user) }}</td>
                                <td>{{ updatedAt(user) }}</td>
                                <td>
                                <div class="btn-group mr-2" role="group" aria-label="First group">
                                        <button type="button" class="btn btn-icon btn-outline-info" @click="view(user)"><i
                                                class="fa fa-eye"></i></button>
                                        <button type="button" class="btn btn-icon btn-outline-info" @click="editUser(user)"><i
                                        class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-icon btn-outline-info" @click="userDelete(user.id)"><i
                                                class="fa fa-trash"></i></button>
                                        
                                </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions , mapState , mapMutations } from 'vuex'

    export default {

        methods: {
            ...mapActions({
                setAllUsers: 'setAllUsers',
                setAuthUser: 'setAuthUser',
                deleteUser: 'deleteUser'

            }),
            name(user){
                return `${user.first_name} ${user.last_name}`
            },
            createAt(user)
            {
                return moment(new Date(user.created_at)).calendar()
            },
            updatedAt(user){
                return moment(new Date(user.updated_at)).calendar()
            },
            view(user){
                this.$router.push({ name: 'users.show', params: { id: user.id }})

            },
            editUser(user){
                this.$router.push({ name: 'users.edit', params: { id: user.id }})

            },
            userDelete(id){
             this.deleteUser(id)
            },

        },
        computed: {
            ...mapState({
                users: state => state.users.all,
                admin: state => state.users.admin,
            })
            

        },
        mounted: function () {
            this.setAllUsers()
            // Temporary Fix for DataTables Not Being Rendered
            setTimeout(function() { $('#responsive-datatable').DataTable({
                responsive: true
            }); }, 3000)
            

        },
        watcher: {
        users: {
        handler: function (users, oldValue) { 

            console.log(users)

            },
        deep: true
        },
        admin: {
        handler: function (admin, oldValue) { 

            console.log(admin)

            },
        deep: false
        },
    }
    }
</script>