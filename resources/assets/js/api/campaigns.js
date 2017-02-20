export default {
  index (query={page: 0, count: 50}) {
    return axios.get('/api/v1/campaigns/', {
            params: {
                page: query.page,
                count: query.count
            }
        })
  },

  create () {
    
  },

  show(id) {
    return axios.get('/api/v1/campaign/' + id)
  },

  update() {

  },

  send() {

  },

  schedule() {

  },

  cancel() {

  },

  clone() {
      
  }

}