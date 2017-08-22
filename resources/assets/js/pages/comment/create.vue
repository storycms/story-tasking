<template lang="pug">
  .module-wrapper-create
    .module-content(v-show="form == true")
      .form-group
        textarea.form-control(v-model="comment" rows="4")
      .form-group
        button.btn.btn-sm.btn-primary(@click="createComment") Add Comment
        button.btn.btn-sm.btn-link(@click="form = false") Cancel
    .module-button(v-show="form == false")
       .form-group
        button.btn.btn-sm.btn-default(@click="form = true") Create Comment

</template>

<script>
export default {
  name: 'CommentCreate',

  data () {
    return {
      comment: '',
      form: false
    }
  },

  props: {
    issue: { type: Object, required: true }
  },

  methods: {
    createComment () {
      this.$http.post('/tasking/api/issue/' + this.issue.id + '/comment', { comment: this.comment })
        .then(response => {
          EventHub.$emit('comment-created', response.data.data)
          this.comment = ''
        })
    }
  }

}
</script>
