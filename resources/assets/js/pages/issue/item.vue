<template lang="pug">
  .issue-item(@click="showIssue")
    .issue-type
      span.icon(:class="type.class")
        i.material-icons {{ type.icon }}
    .issue-summary
      span {{ issue.name }}
    .issue-meta
</template>

<script>
import _ from 'lodash'
import { Types } from '../../config/issue'
export default {
  name: 'IssueItem',

  props: {
    issue: { type: Object, required: true}
  },

  computed: {
    type () {
      return _.find(Types, {id: this.issue.type_id})
    }
  },

  methods: {
    showIssue () {
      EventHub.$emit('issue-selected', this.issue)
    }
  }
}
</script>
