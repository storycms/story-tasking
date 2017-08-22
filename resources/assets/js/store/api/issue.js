import api from './api'

export default {

  fetchIssuesForProject (projectId, succCb, errCb) {
    return api.get('project/' + projectId + '/issue', {}, succCb, errCb)
  },

  createIssueForProject (projectId, data, succCb, errCb) {
    return api.post('project/' + projectId + '/issue', data, succCb, errCb)
  },

  updateIssueForProject (projectId, issueId, data, succCb, errCb) {
    return api.put('project/' + projectId + '/issue/' + issueId, data, succCb, errCb)
  }

}
