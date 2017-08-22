<template lang="pug">
  div(v-if="project.slug")
    app-sidebar(:slug="project.slug")
    .page-wrapper
      .container-fluid
        h1 Awesome Project Summary

        router-view(v-if="project.id")

</template>

<script>
import AppSidebar from '../../layouts/sidebar.vue'
import { mapGetters } from 'vuex'
export default {
  name: 'ProjectShow',
  components: {
    AppSidebar
  },

  computed: mapGetters({
    project: 'getCurrentProject'
  }),

  created () {
    if (!this.project.id) {
      this.loadCurrentProject(this.$route.params.id)
    }
  },

  /**
   * Prepare component
   */
  mounted () {

  },

  /**
   *
   */
  methods: {
    loadCurrentProject (id) {
      this.$store.dispatch('fetchProjectById', id)
    }
  }
}
</script>

