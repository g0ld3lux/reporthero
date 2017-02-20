import metrics from '../../../api/metrics'
import * as types from '../mutation-types'

// initial state of our campaings
// define here all the object we need
const state = {
  currentMetrics: [],
  newMetric: {},
  metrics: []
}

// getters
// we can set here getters for computation rate
const getters = {
  getAllMetrics: state => state.metrics
}

// actions
// we can do here our campaigns api call
const actions = {
  index({ commit, state }, args) {
    commit(types.METRIC_INDEX)
    metrics.index(args, 
    () => commit(types.METRIC_INDEX_SUCCESS, args),
    () => commit(types.METRIC_INDEX_FAILURE, args)
    )
  }
}

// mutations
const mutations = {
  [types.METRIC_INDEX] (state) {

  },
 
}

export default {
  state,
  getters,
  actions,
  mutations
}