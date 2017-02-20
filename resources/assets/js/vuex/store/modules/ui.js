import * as types from '../mutation-types'

// initial state of our campaings
// define here all the object we need
const state = {
  sidenav: 'this is sidenav',
}

// getters
// we can set here getters for computation rate
const getters = {
  getSideNav: state => state.sidenav,
}

// actions
// we can do here our campaigns api call
const actions = {
  
}

// mutations
const mutations = {
 setSideNav: (state,sidenav) => { state.sidenav =  sidenav }
}

export default {
  state,
  getters,
  actions,
  mutations
}