<template lang="pug">
  .menu-wrapper.fixed
    nav
      ul
        li
          router-link.main-menu(:to="{ name: 'project.dashboard', params: { slug: slug }}")
            i.material-icons apps
        li
          router-link.main-menu(:to="{ name: 'project.backlog', params: { slug: slug }}")
            i.material-icons dns
        li
          router-link.main-menu(:to="{ name: 'project.board', params: { slug: slug }}")
            i.material-icons view_column
        li
          router-link.main-menu(:to="{ name: 'project.report', params: { slug: slug }}")
            i.material-icons donut_small
        li
          router-link.main-menu(:to="{ name: 'project.issue', params: { slug: slug }}")
            i.material-icons bug_report

</template>

<script>

  export default {
    name: 'AppSidebar',
    components: {

    },

    data () {
      return {

      }
    },

    props: {
      slug: {}
    }

  }
</script>
