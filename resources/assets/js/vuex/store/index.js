import Vue from 'vue'
import Vuex from 'vuex'
import * as actions from './actions'
import * as getters from './getters'
import campaigns from './modules/campaigns'
import metrics from './modules/metrics'
import createLogger from '../debug/logger'


Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  actions, // this holds global action
  getters, // this holds global getters
  modules: {
   campaigns,
   metrics,

   // add modules here
  },
  strict: debug,
  plugins: debug ? [createLogger()] : []
})