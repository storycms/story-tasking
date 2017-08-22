import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: 'tasking',
  routes: [
    { path: '/', 'redirect': '/dashboard' },
    { path: '/dashboard', component: require('./pages/dashboard.vue' ), name: 'dashboard' },
    { path: '/project', component: require('./pages/project/index.vue'), name: 'projects' },

    {
      path: '/project/:id',
      component: require('./pages/project/show.vue'),
      children: [
        { path: '', component: require('./pages/project/dashboard.vue'), name: 'project.dashboard' },
        { path: 'backlog', component: require('./pages/backlog/index.vue'), name: 'project.backlog' },
        { path: 'issue', component: require('./pages/issue/index.vue'), name: 'project.issue' },
        { path: 'board', component: require('./pages/board/index.vue'), name: 'project.board' },
        { path: 'report', component: require('./pages/report/index.vue'), name: 'project.report' }
      ]
    },
  ]
})
