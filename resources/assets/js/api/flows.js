export default {
  index (query={page: 0, count: 10}) {
    return axios.get('/api/v1/flows/', {
            params: {
                page: query.page,
                count: query.count
            }
        })
  },
// We can Pass here an Object of Params but can be null
  show(id, params) {
    return axios.get('/api/v1/flow/' + id, {
            params
        })
  },



}