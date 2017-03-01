import api from '../../../api/flows'
import * as types from '../mutation-types'

// initial state of our campaings
// define here all the object we need
const state = {
  current: [],
  all: [],
  query: [],
  total: '',
  page: 1,
  count: 10,
}

// getters
// we can set here getters for computation rate
const getters = {
  getFlowLists: state => state.all,
  getcurrentFlow: state => state.current,
  getFlowQuery: state => state.query,
  getFlowTotal: state => state.total,
  getFlowPage: state => state.page,
  getFlowCount: state => state.count,

}

// actions
// we can do here our campaigns api call
const actions = {
  async setFlows({commit},query) {
    let payload = (await api.index(query)).data
    commit('setFlows', await payload.data)
    commit('setTotal', await payload.total)
    commit('setCount', await query.count)
  },
    async setCurrentFlow({commit},id) {
    let payload = (await api.show(id)).data
    commit('setCurrentFlow', await payload)
    

  }


}

// mutations
const mutations = {
    setFlows: (state, payload ) => {  state.all = payload},
    setQuery: (state, payload) => { state.query = payload },
    setTotal: (state, payload) => { state.total = payload },
    setCount: (state, payload) => { state.count = payload },
    setCurrentFlow: (state, payload) => { state.current = payload },
    
    // Make Sure to add this mutation type in your view
    ['flows/PAGINATE'](state, payload) {
              state.page = payload

    }
    
}

export default {
  state,
  getters,
  actions,
  mutations
}