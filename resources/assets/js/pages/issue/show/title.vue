<template lang="pug">
  .issue-section
    .issue-title {{ issue.name }}
</template>

<script>
  export default {
    name: 'IssueShowTitle',

    props: {
      issue: { type: Object, required: true }
    },

    methods: {
      onClickEdit () {

      },

      onSaveEdit () {

      }
    }
  }
</script>
