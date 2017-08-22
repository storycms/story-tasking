<template lang="pug">
  .project.container-fluid
    h1 Project

    ul
      li(v-for="project in projects" v-if="project.slug")
        .project-item(href="" @click="toProject(project)")
          span.title {{ project.name }}
          span.summary {{ project.description }}
          span.stats

</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import ProjectCreate from './create.vue'

export default {
  name: 'Project',
  components: {
    ProjectCreate
  },
  computed: mapGetters({
    projects: 'allProjects'
  }),
  created () {
    this.$store.dispatch('fetchProjects')
  },
  mounted () {
    document.title = 'Tasking Project'
  },
  methods: {
    toProject (project) {
      this.$store.dispatch('setCurrentProject', project)
      this.$router.push({ name: 'project.dashboard', params: { id: project.id }})
    }
  }
}
</script>

<style lang="sass" scoped>
  ul, li
    margin: 0
    padding: 0
    list-style: none
  .project-item
    display: block
    padding: 10px 20px
    cursor: pointer
    &:hover,
    &:focus
      text-decoration: none
    &:hover
      background-color: rgba(222,222,222,0.2)
    span.title
      font-size: 18px
      width: 300px
      color: rgba(0,0,0,0.8)
      display: inline-block
    span.summary
      font-size: 13px
      color: rgba(0,0,0,0.44)
</style>

