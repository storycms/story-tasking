import * as types from '../mutation-types'
import api from '../api/project'

let defaults = []

// initial state
const state = {
  all: Object.assign([], defaults),
  current: {}
}

const getters = {
  allProjects: state => state.all,
  getCurrentProject: state => state.current
}

const actions = {
  fetchProjects ({ commit }) {
    api.fetchProjects(response => {
      commit(types.RECEIVE_PROJECT, response.data.data)
    })
  },

  createProject ({ commit, state }, data) {
    api.createProject(data, response => {
      commit(types.RECEIVE_PROJECT, response.data.data)
    })
  },

  fetchProjectById ({ commit }, id) {
    api.fetchProjectById(id, response => {
      commit(types.SET_CURRENT_PROJECT, response.data.data)
    })
  },

  setCurrentProject ({ commit }, project) {
    commit(types.SET_CURRENT_PROJECT, project)
  }
}

const mutations = {
  [types.RECEIVE_PROJECT] (state, project) {
    if (state.all.length === 0 || project.length !== 1) {
      state.all = project
    } else {
      state.all.push(project)
    }
  },
  [types.SET_CURRENT_PROJECT] (state, data) {
    state.current = data
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
