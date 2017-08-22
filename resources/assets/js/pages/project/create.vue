<template lang="pug">
  div
    h1 Create Project

    div
      .form-group
        label Project Name
        input.form-control(type="text" v-model="form.name")

      .form-group
        label Slug
        input.form-control(type="text" v-model="form.slug")

      .form-group
        label Description
        textarea.form-control(v-model="form.description")

      .form-group
        button.btn.btn-primary.btn-sm(@click="createProject") Create Project

</template>

<script>
import { mapGetters } from 'vuex'

let defaults = {
  name: '', slug: '', description: ''
}
export default {
  name: 'ProjectCreate',
  data () {
    return {
      form: Object.assign({}, defaults)
    }
  },
  methods: {
    createProject() {
      this.$store.dispatch('createProject', this.form)
      this.form = Object.assign({}, defaults)
    }
  }
}
</script>

