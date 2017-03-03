export default {
  index () {
    return axios.get('/api/admin/users/')
  },

  showDeletedUsers () {
    return axios.get('/api/admin/users/showDeletedUsers')
  },

  addUser(query) {
    return axios.post('/api/admin/users/addUser', {
            params: {
                first_name: query.first_name,
                last_name: query.last_name,
                password: query.password,
                email: query.email
            }
        })
  },

  deleteUser(id) {
    return axios.get('/api/admin/users/deleteUser/'+id)
  },

  recoverUser(id) {
    return axios.get('/api/admin/users/recoverUser/'+id)
  },

  permaDeleteUser(id) {
    return axios.get('/api/admin/users/permaDeleteUser/'+id)
  },

  me() {
    return axios.get('/api/@me')
  },

  addKlaviyoKeys(query) {
    return axios.post('/api/@me/addKlaviyoApiKeys', {
            params: {
                public_key: query.public_key,
                secret_key: query.secret_key,
            }
        })
  },
  changePassword(query) {
        return axios.post('/api/@me/addKlaviyoApiKeys', {
            params: {
                password: query.password
            }
        })
  },
  viewApiKeys(query) {
      return axios.get('/api/@me/viewApiKeys')
  },
  editProfile() {
        return axios.post('/api/@me/editProfile', {
            params: {
                first_name: query.first_name,
                last_name: query.last_name,
            }
        })
  },
  editUser(id) {
    return axios.post('/api/admin/users/editUser' + id, {
            params: {
                first_name: query.first_name,
                last_name: query.last_name,
                password: query.password,
                email: query.email,
                klaviyo_api: quer.klaviyo_api
            }
        })
  }

}