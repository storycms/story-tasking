<template>
  <div id="app">

    <app-header/>
    <router-view />

  </div>
</template>

<script>
  import AppSidebar from './sidebar.vue'
  import AppFooter from './footer.vue'
  import AppHeader from './header.vue'

  export default {
    name: 'app',
    components: { AppHeader, AppFooter, AppSidebar}
  }
</script>
