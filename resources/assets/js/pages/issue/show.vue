<template lang="pug">
  .issue-show
    .issue-show-tools
    .issue-show-container
      .issue-heading
        .pull-right
          button.btn.btn-link.btn-sm(@click="closedIssue")
            i.material-icons close
        p # {{ issue.id }}
      issue-show-title(:issue="issue")
      .issue-body.issue-section
        h5 Description
        p(v-if="!issue.description") Click to add description
        p(v-else) {{ issue.description }}
      .issue-details.issue-section
        h5 Details
        ul.issue-detail-list.list-unstyled
          li.issue-detail-item
            .clearfix
              strong.name Status :
              span.value TODO
          li.issue-detail-item
            .clearfix
              strong.name Priority :
              span.value Medium
          li.issue-detail-item
            .clearfix
              strong.name Lables :
              span.value Medium

      .issue-people.issue-section
        h5 People
        ul.issue-detail-list.list-unstyled
          li.issue-detail-item
            .clearfix
              strong.name Reporter :
              span.value {{ issue.reporter.name }}
          li.issue-detail-item
            .clearfix
              strong.name Assigne :
              span.value Medium
      .issue-date.issue-section
        h5 Dates
        ul.issue-detail-list.list-unstyled
          li.issue-detail-item
            .clearfix
              strong.name Created at :
              span.value {{ issue.created_at }}
          li.issue-detail-item
            .clearfix
              strong.name Updated at :
              span.value {{ issue.updated_at }}
      .issue-comments.issue-section
        h5 Comments
        comment-list(:issue="issue")

      .issue-subtasks.issue-section
        h5 Sub Task


</template>

<script>
import CommentList from '../comment/list.vue'
import IssueShowTitle from './show/title.vue'

export default {
  name: 'IssueShow',

  components: {
    CommentList,
    IssueShowTitle
  },

  props: {
    issue: { type: Object, required: true}
  },

  mounted () {
    EventHub.$on('issue-updated', this.eventIssueUpdated)
  },

  methods: {
    closedIssue () {
      EventHub.$emit('issue-closed')
    },

    eventIssueUpdated (issue) {
      this.$http.put('/tasking/api/issue/' + issue.id)
    }
  }
}
</script>

