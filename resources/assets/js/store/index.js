import Vue from 'vue'
import Vuex from 'vuex'
import * as actions from './actions'
import * as getters from './getters'
import createLogger from 'vuex/dist/logger'

import projects from './modules/projects'
import issues from './modules/issues'
import comments from './modules/comments'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  actions,
  getters,
  modules: {
    projects, issues, comments
  },
  strict: debug,
  plugins: debug ? [createLogger()] : []
})
