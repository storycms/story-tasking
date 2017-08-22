<template lang="pug">
  .project-issue
    p Project Issue

    <issue-create />
</template>

<script>
import IssueCreate from './create.vue'

export default {
  name: 'Issues',

  components: {
    IssueCreate
  },

  data () {
    return {
      issues: []
    }
  },

  mounted() {
    this.loadIssue()
  },

  methods: {
    loadIssue() {
      let project = this.$route.params.slug

      this.$http.get('/tasking/api/project/' + project + '/issue')
        .then(response => {
          this.issues = response.data.data
        })
    }
  }
}
</script>
