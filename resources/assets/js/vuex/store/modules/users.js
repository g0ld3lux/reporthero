import api from '../../../api/users'
import * as types from '../mutation-types'


const state = {
  auth: {},
  isAdmin: false,
  all: [],
  deleted: {},
  deleted_list: [],
  selected: {},
  klaviyo_keys: {
      token: '**********',
      api_key: '***********'
  },
  query: [],
  total: '',
  page: 1,
  count: 50,
}

const getters = {
  getAllUsers: state => state.all,
  getAllUsersCount: state => state.all.length,
  getAuthUser: state => state.auth,
  getIsAdmin: state => state.isAdmin,
  getAuthQuery: state => state.query,
  getDeletedList: state => state.deleted_list,
  getAuthTotal: state => state.total,
  getAuthPage: state => state.page,
  getAuthCount: state => state.count,
  getAllDeletedUsers: state => state.deleted,
  getAllDeletedUsersCount: state => state.deleted_list.length,
  getSelectedUser: state => state.selected,
  getKlaviyoKeys: state => state.klaviyo_keys
}

// actions
// we can do here our campaigns api call
const actions = {
  async setAllUsers ({commit}) {
    let payload = (await api.index()).data
    commit('setAllUsers', await payload.users)
  },
  async setAuthUser ({commit}) {
    let payload = (await api.me()).data
    commit('setAuthUser', await payload.auth)
    commit('setIsAdmin', await payload.admin)
  },
  async setKlaviyoApiKeys ({commit},query) {
    let payload = (await api.addKlaviyoKeys(query)).data
    commit('setKlaviyoApiKeys', await payload.klaviyo_keys)
  },
  async setSelectedUser({commit}, id){
    let payload = (await api.showUser(id)).data

    commit('setSelectedUser', await payload.user)
  },
  async viewKlaviyoKeys({commit},id){
    let payload = (await api.viewApiKeys(id)).data
    commit('setKlaviyoApiKeys', await payload.klaviyo_api.api_key)
    commit('setKlaviyoToken', await payload.klaviyo_api.token)
  },
  async deleteUser({commit},id){
    let payload = (await api.deleteUser(id)).data
    commit('deleteUser', await payload.user)
    // remove user from all array
    // add user to deleted array
  },
  async recoverUser({commit},id){
    let payload = (await api.recoverUser(id)).data
    commit('recoverUser', await payload.user)
    // remove user from deleted array
    // add user to the all array
  },
  async permaDeleteUser({commit}, id){
    let payload = (await api.permaDeleteUser(id)).data
    commit('permaDeleteUser', await payload.user)
    // remove user from deleted array
  },
  async updateUser({commit,state}, query){
    console.log(state.selected.id)
    let payload = (await api.updateUser(state.selected.id,query)).data
    console.log(payload)
    commit('updateUser', await payload.user)
  },
  async addUser({commit},query){
    let payload = (await api.addUser(query)).data
    commit('addUser',await payload.user)
  },
  async showDeletedUsers({commit}) {
    let payload = (await api.showDeletedUsers()).data
    commit('setDeletedList', await payload.users)
  },
  async updateFirstName({commit,state},first_name){
  let payload = (await api.updateFirstName(state.selected.id,first_name)).data
  commit('updateUser', await payload.user)
  },
  async updateLastName({commit,state},last_name){
  let payload = (await api.updateLastName(state.selected.id,last_name)).data
  commit('updateUser', await payload.user)
  },
  async updateEmail({commit,state},email){
  let payload = (await api.updateEmail(state.selected.id,email)).data
  commit('updateUser', await payload.user)
  },
  async updatePassword({commit,state},password){
  let payload = (await api.updatePassword(state.selected.id,password)).data
  commit('updateUser', await payload.user)
  },
  async updateStoreType({commit,state},store_type){
  let payload = (await api.updateStoreType(state.selected.id,store_type)).data
  commit('updateUser', await payload.user)
  },
  async updateToken({commit,state},token){
  let payload = (await api.updateToken(state.selected.id,token)).data
  commit('updateUser', await payload.user)
  },
  async updateApiKey({commit,state},api_key){
  let payload = (await api.updateApiKey(state.selected.id,api_key)).data
  commit('updateUser', await payload.user)
  },


}

// mutations
const mutations = {
    setAllUsers: (state,payload) => { state.all = payload },
    addUser: (state,payload) => {state.all.push(payload)},
    updateUser: (state,payload) => {
      // const user = state.all.find(user => {
      //   return user.id == payload.id
      // })
      state.selected = payload
    },
    setAuthUser: (state, payload ) => {  state.auth = payload},
    setIsAdmin: (state,payload) => { state.isAdmin = payload },
    setSelectedUser: (state,payload) => { state.selected = payload },
    setKlaviyoApiKeys: (state,payload) => { state.klaviyo_keys.api_key = payload },
    setKlaviyoToken: (state,payload) => { state.klaviyo_keys.token = payload },
    deleteUser: (state,payload) => { 
      const user = state.all.find(user => {
        return user.id == payload.id
      })
      // We Remove User From Users Lists
      state.all.splice(state.all.indexOf(user),1)
      // We Add User From Deleted Lists
      state.deleted_list.unshift(payload) 
    },
    recoverUser: (state,payload) => { 
      const user = state.deleted_list.find(user => {
        return user.id == payload.id
      })
      // We Remove User From Deleted List
      state.deleted_list.splice(state.deleted_list.indexOf(user),1)
      // We Add User From Users Lists
      state.all.unshift(payload)
     },
     permaDeleteUser: (state,payload) => {
      const user = state.deleted_list.find(user => {
        return user.id == payload.id
      })
      state.deleted_list.splice(state.deleted_list.indexOf(user),1)
     },
     setDeletedList: (state,payload) => { state.deleted_list = payload },
     updateFirstName: (state,payload) => {state.selected.first_name = payload },
     updateLastName: (state,payload) => {state.selected.last_name = payload },

     updateEmail: (state,payload) => {state.selected.email = payload },

     updatePassword: (state,payload) => {state.selected.password = payload },

     updateStoreType: (state,payload) => {state.selected.store_type = payload },

     updateToken: (state,payload) => {state.klaviyo_keys.token = payload },

     updateApiKey: (state,payload) => {state.klaviyo_keys.api_key = payload },



    // DELETE_USER: (state, payload) => { state.query = payload },
    // FORCE_DELETE_USER: (state, payload) => { state.total = payload },
    // RESTORE_USER: (state, payload) => { state.count = payload },
    // EDIT_USER: (state, payload) => { state.current = payload },
    // ADD_KLAVIYO_KEYS: (state, payload) => { state.start_date = { time:payload } } ,
    // CHANGEPASS: (state, payload) => { state.end_date = { time:payload } },
    // EDIT_PROFILE: (state, payload) => { state.user = payload},
    
    // Added vue pagination mutation
    ['users/PAGINATE'](state, payload) {
              state.page = payload

    }
    
}

export default {
  state,
  getters,
  actions,
  mutations
}