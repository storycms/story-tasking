<template lang="pug">
  .module-wrapper-content
    .module-wrapper-list
      p(v-if="comments.length == 0")  There are no comments yet on this issue.
      comment-item(v-for="comment in comments" :comment="comment" :key="comment.id")

    comment-create(:issue="issue")
</template>

<script>
import CommentCreate from './create'
import CommentItem from './item'
export default {
  name: 'CommentList',

  components: {
    CommentCreate, CommentItem
  },

  data () {
    return {
      comments: []
    }
  },

  props: {
    issue: { type: Object, required: true }
  },

  mounted () {
    this.loadComments()

    EventHub.$on('comment-created', this.eventCreatedComment)
  },

  updated () {
    // this.loadComments()
  },

  methods: {
    loadComments () {
      this.$http.get('/tasking/api/issue/' + this.issue.id + '/comment')
        .then(response => {
          this.comments = response.data.data
        })
    },

    eventCreatedComment (comment) {
      this.comments.push(comment)
    }
  }

}
</script>
