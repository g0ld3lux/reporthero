<template>
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">User Management</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active">Deleted Users</li>
            </ol>

        </div>
        <div class="row">
            <div class="col-sm-12">

                <div class="card">
                    <div class="card-header">
                        <h6>Responsive</h6>
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
                                        <button type="button" class="btn btn-icon btn-outline-info" @click="recover(user)"><i
                                                class="fa fa-refresh"></i></button>
                                        <button type="button" class="btn btn-icon btn-outline-info" @click="permaDelete(user)"><i
                                                class="fa fa-user-times"></i></button>
                                        
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
                showDeletedUsers: 'showDeletedUsers',
                recoverUser: 'recoverUser',
                permaDeleteUser: 'permaDeleteUser',

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
            recover(user){
                // this.$router.push({ name: 'users.show', params: { id: user.id }})
                this.recoverUser(user.id)
            },
            permaDelete(user){
             this.permaDeleteUser(user.id)
            },

        },
        computed: {
            ...mapState({
                users: state => state.users.deleted_list,
            }),
            ...mapGetters({
                getAllDeletedUsersCount: 'getAllDeletedUsersCount',
            }),
            

        },
        mounted: function () {
            this.showDeletedUsers()
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
        }

    }
    }
</script>