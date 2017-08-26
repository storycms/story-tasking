<template lang="pug">
  .project.container-fluid
    .pull-right
      project-create
    h1 Project

    ul
      li.project-item(v-for="project in projects"  @click="toProject(project)")
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
      width: 300px
      color: rgba(0,0,0,0.8)
      display: inline-block
    span.summary
      color: rgba(0,0,0,0.44)
      overflow: hidden
      text-overflow: ellipsis
      white-space: nowrap
      max-width: 40%
      display: inline-block
</style>

