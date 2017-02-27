import api from '../../../api/metrics'
import * as types from '../mutation-types'

// initial state of our campaings
// define here all the object we need
const state = {
  current: [],
  newMetric: {},
  all: [],
  query: [],
  // Selected Metric Id
  selected: 'xGqcAu',
  series: []
}

// getters
// we can set here getters for computation rate
const getters = {
  getAllMetrics: state => state.all,
  getSelected: state => state.selected,
  getCurrentMetric: state => state.current,
  getMetricsQuery: state => state.query
}

// actions
// we can do here our campaigns api call
const actions = {

  async listMetrics({commit,state},query) {
    // Using Await Allows You to Have the Date First Before you Execute the Command
    let payload = (await api.index(query)).data
    commit('setMetricList', await payload.data)
    
  },
  // Note we can only Pass 1 Arg which is Quey , so We need to Use State to get Metric ID of selected
  async getMetricData({commit,state, dispatch}, query) {
    let payload = (await api.getMetricData(query,state.selected)).data
    commit('setSeries', await payload.results[0].data)
    let current = state.all.filter(function(metric) {
      return metric.id == state.selected 
    })
    commit('setCurrentMetric', await current[0])
    await dispatch('loadChartData')
  },
   async loadChartData({commit, state}) {
      let labels = [];
      let series = [];
      for (let i = 0; i < state.series.length; i++) {
        
            labels.push(moment(state.series[i].date).format('D DD'))
            series.push(state.series[i].values[0])
      }
      let chart = new Chartist.Line('.ct-chart-line', {
      // this is the date....
      labels: labels,
      // this is the values[0]
      series: [series]
      }, {
      low: 0,
      showArea: true,
    });
    var addedEvents = false;
            chart.on('draw', function() {
            if (!addedEvents) {
                $('.ct-chart-line').on('mouseover', function() {
                if($(event.target).attr('ct:value') != undefined){
                $('#metricToolTip').html('<b>Data Value: </b>' + $(event.target).attr('ct:value'));
                }
                });

                $('.ct-chart-line').on('mouseout', function() {
                $('#metricToolTip').html('<b>Data Value:</b>');
                });
            }
            });

  }
}

// mutations
const mutations = {
  setMetricList: (state, payload ) => {  state.all = payload},
  setMetricQuery: (state, payload) => { state.query = payload },
  setCurrentMetric: (state, payload) => { state.current = payload },
  setSelectedMetric: (state ,payload) => { state.selected = payload },
  setSeries: (state, payload) => {state.series = payload}
}

export default {
  state,
  getters,
  actions,
  mutations
}