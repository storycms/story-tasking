import api from './api'

export default {

  fetchProjects (succCb) {
    return api.get('project', {}, succCb)
  },

  createProject (data, succCb, errCb) {
    return api.post('project', data, succCb, errCb)
  },

  fetchProjectById (id, succCb, errCb) {
    return api.get('project/' + id, {}, succCb, errCb)
  }

}
