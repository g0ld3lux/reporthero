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
                email: query.email,
                store_type: query.store_type,
                klaviyo_keys: query.klaviyo_keys
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

  showUser(id) {
    return axios.get('/api/admin/users/'+id)
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
  viewApiKeys(id) {
      return axios.get('/api/@me/viewApiKeys', {
          params: {
            id
          }
      })
  },
  editProfile() {
        return axios.post('/api/@me/editProfile', {
            params: {
                first_name: query.first_name,
                last_name: query.last_name,
            }
        })
  },
  updateUser(id,query) {
    return axios.post('/api/admin/users/editUser/' + id, {
            params: {
                first_name: query.first_name,
                last_name: query.last_name,
                password: query.password,
                email: query.email,
                store_type: query.store_type,
                klaviyo_keys: query.klaviyo_keys
            }
        })
  },
  updateFirstName(id,first_name) {
    return axios.post('/api/admin/users/updateFirstName/' + id, {
            params: {
                first_name
            }
        })
  },
  updateLastName(id,last_name) {
    return axios.post('/api/admin/users/updateLastName/' + id, {
            params: {
                last_name
            }
        })
  },
  updateEmail(id,email) {
    return axios.post('/api/admin/users/updateEmail/' + id, {
            params: {
                email
            }
        })
  },
  updatePassword(id,password) {
    return axios.post('/api/admin/users/updatePassword/' + id, {
            params: {
                password
            }
        })
  },
  updateStoreType(id,store_type) {
    return axios.post('/api/admin/users/updateStoreType/' + id, {
            params: {
                store_type
            }
        })
  },
  updateToken(id,token) {
    return axios.post('/api/admin/users/updateToken/' + id, {
            params: {
                token
            }
        })
  },
  updateApiKey(id,api_key) {
    return axios.post('/api/admin/users/updateApiKey/' + id, {
            params: {
                api_key
            }
        })
  },

}