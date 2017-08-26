<template lang="pug">
  .project-create
    button.btn.btn-default.btn-sm(@click="modal=true") Create Project
    modal(title="Create Project" v-model="modal" @hide="dismissCallback")
      .form-group
        label Project Name
        input.form-control(type="text" v-model="form.name")
        span.help-block.text-danger(v-if="errors.name") {{ errors.name }}
      .form-group
        label Slug
        input.form-control(type="text" v-model="form.slug")
        span.help-block.text-danger(v-if="errors.slug") {{ errors.slug }}
      .form-group
        label Description
        textarea.form-control(v-model="form.description" rows="3")
        span.help-block.text-danger(v-if="errors.description") {{ errors.description }}
      .footer(slot="footer")
        button.btn.btn-primary.btn-sm(@click="createProject") Create Project

</template>

<script>
import { mapGetters } from 'vuex'
import { Modal } from 'uiv'
import api from '../../store/api/project'

let defaults = {
  name: '', slug: '', description: ''
}
export default {
  name: 'ProjectCreate',
  components: {
    Modal
  },
  data () {
    return {
      modal: false,
      form: Object.assign({}, defaults),
      errors: Object.assign({}, defaults)
    }
  },

  methods: {
    createProject () {
      api.createProject(this.form, response => {
        this.$store.dispatch('createProject', response.data.data)
        this.form = Object.assign({}, defaults)
        this.modal = false
      }, errors => {
        this.errors = errors.response.data
      })
    },
    dismissCallback () {
      this.form = Object.assign({}, defaults)
      this.errors = Object.assign({}, defaults)
    }
  }
}
</script>

