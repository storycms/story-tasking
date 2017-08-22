import * as types from '../mutation-types'
import api from '../api/issue'

// initial state
const state = {
  all: [],
  current: null
}

const getters = {
  getIssuesForProject: (state) => projectId => {
    return state.all.filter(issue => issue.project_id === projectId)
  },
  getIssue: state => state.all
}

const actions = {
  fetchIssuesForProject ({ commit }, projectId) {
    api.fetchIssuesForProject(projectId, response => {
      commit(types.RECEIVE_ISSUES, response.data.data)
    })
  }
}

const mutations = {
  [types.RECEIVE_ISSUES] (state, issues) {
    state.all = issues
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
