<template lang="pug">
  .project-issue
    p Project Backlog

    .page-columns
      .page-columns-container
        .page-column(:class="!issue.id ? 'backlog-column' : 'has-backlog-display'")
          .page-column-inner
            .backlog
              //- SPRINT ISSUES
              .sprint-container(v-for="sprint in sprints")
                issue-list(:issues="issues" :sprint="sprint")
                .sprint-tools(v-if="sprint")
                  issue-create(:sprints="sprints" :sprint="sprint")

              //- BACKLOG ISSUES
              .sprint-container
                .pull-right
                  button.btn.btn-sm.btn-default(@click="createSprint") Create Sprint
                issue-list(:issues="issues" :sprint="{id: null, name: 'Backlog'}")
                .sprint-tools
                  issue-create(:sprints="sprints" :sprint="{id: '', name: 'Backlog'}")

        .page-column.backlog-display(v-if="issue.id")
          .page-column-inner
            issue-show(:issue="issue")

</template>

<script>
import IssueCreate from '../issue/create.vue'
import IssueItem from '../issue/item.vue'
import IssueList from '../issue/list.vue'
import IssueShow from '../issue/show.vue'
import { mapGetters, mapActions } from 'vuex'
export default {
  name: 'Backlog',

  components: {
    IssueCreate, IssueItem, IssueList, IssueShow
  },

  // ...
  computed: {
    ...mapGetters({
      project: 'getCurrentProject'
    }),
    issues () { return this.$store.getters.getIssuesForProject(this.project.id) }
  },

  data () {
    return {
      sprints: [],
      issue: {}
    }
  },

  created () {
    this.$store.dispatch('fetchIssuesForProject', this.project.id)
  },

  mounted() {
    document.title = 'Project Backlog'

    // Listen to issue handling
    EventHub.$on('issue-created', this.eventCreatedIssue)
    EventHub.$on('issue-selected', this.eventSelectedIssue)
    EventHub.$on('issue-closed', this.eventClosedIssue)
  },

  methods: {
    createSprint() {
    //   this.$http.post('/tasking/api/project/' + this.$route.params.id + '/sprint')
    //     .then(response => {
    //       this.sprints.push(respsonse.data.data)
    //     })
    },

    loadSprint() {
    //   this.$http.get('/tasking/api/project/' + this.$route.params.id + '/sprint')
    //     .then(response => {
    //       this.sprints = response.data.data
    //     })
    },

    loadIssue () {

      // this.$http.get('/tasking/api/project/' + this.$route.params.id + '/issue')
      //   .then(response => {
      //     this.issues = response.data.data
      //   })
    },

    eventSelectedIssue(issue) {
      this.issue = issue
    },

    eventCreatedIssue(issue) {
      this.issues.push(issue)
    },

    eventClosedIssue() {
      this.issue = {}
    }
  }
}
</script>
