import api from '../../../api/users'
import * as types from '../mutation-types'


const state = {
  auth: {},
  isAdmin: false,
  all: [],
  deleted: [],
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
  getAuthUser: state => state.auth,
  getAuthQuery: state => state.query,
  getAuthTotal: state => state.total,
  getAuthPage: state => state.page,
  getAuthCount: state => state.count,
  getAllDeletedUsers: state => state.deleted,
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

}

// mutations
const mutations = {
    setAllUsers: (state,payload) => { state.all = payload },
    setAuthUser: (state, payload ) => {  state.auth = payload},
    setIsAdmin: (state,payload) => { state.isAdmin = payload },
    setKlaviyoApiKeys: (state,payload) => { state.klaviyo_keys = payload },

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