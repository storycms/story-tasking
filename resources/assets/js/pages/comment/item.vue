<template lang="pug">
  .comment-item
    .pull-right
      .btn-group
        button.btn.btn-sm.btn-default Edit
        button.btn.btn-sm.btn-default Delete
    .comment-avatar.clearfix
      img(:src="comment.user.gravatar")
      .comment-meta
        .comment-author {{ comment.user.name }}
        .comment-date {{ comment.created_at }}
    .comment-content
      p {{ comment.comment }}

</template>

<script>
import { Dropdown } from 'uiv'
export default {
  name: 'CommentItem',

  components: {
    Dropdown
  },

  props: {
    comment: { type: Object, required: true }
  }
}
</script>


<style lang="sass">
  .comment-item
    padding: 10px
    border: 1px solid #ddd
    margin-bottom: 3px
  .comment-avatar
    margin-bottom: 10px
    img
      float: left
    .comment-meta
      float: left
      padding-left: 20px
      .comment-author
        font-size: 16px
      .comment-date
        font-size: 12px

</style>
