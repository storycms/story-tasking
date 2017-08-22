<template lang="pug">
  div
    .sprint-heading
      span.sprint-title {{ sprint.name }}
      span.sprint-meta {{ data.length }} issues
    .sprint-issue-container
      .sprint-issues(v-if="data.length == 0")
        p Plan a sprint by dragging the sprint footer down below some issues, or by dragging issues here
      issue-item(v-for="issue in data" :issue="issue" :key="issue.id" v-else)

</template>

<script>
import _ from 'lodash'
import IssueItem from './item.vue'
export default {
  name: 'IssueList',

  components: {
    IssueItem
  },

  props: {
    issues: { type: Array, required: true },
    sprint: { type: Object, required: true }
  },

  computed: {
    data () {
      return _.filter(this.issues, {sprint_id: this.sprint.id})
    }
  }
}
</script>
