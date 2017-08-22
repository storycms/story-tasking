<template lang="pug">
  .issue-create
    .issue-widget(v-if="form")
      .issue-type
        dropdown(:dropup="true")
          button.btn.btn-link.btn-sm(data-role="trigger")
            span.icon(:class="selected.type.class")
              i.material-icons {{ selected.type.icon }}
            span.caret
          template(slot="dropdown")
            li(v-for="type in types" @click="typeSelected(type)")
              span.icon(:class="type.class")
                i.material-icons {{ type.icon }}
              span.title {{ type.name }}

      .issue-form-area
        .form-group
          input.form-control(type="text" placeholder="What needs to be done?" v-model="issue.name" @keyup.enter="createIssue")
          .help-block
            .pull-right
              button.btn.btn-link.btn-sm(@click="form = false") Cancel
            small New story in
            dropdown
              button.btn.btn-link.btn-sm(data-role="trigger")
                span {{ selected.sprint.name }} &nbsp;
                span.caret
              template(slot="dropdown")
                li(v-if="issue.sprint_id!=''")
                  a(@click="sprintSelected({id: '', name: 'Backlog'})") Backlog
                li(v-for="sprint in sprints" v-if="issue.sprint_id != sprint.id")
                  a(@click="sprintSelected(sprint)") {{ sprint.name }}


    button.btn.btn-link.btn-sm(@click="form = true" v-else)
      i.material-icons add_box
      | Create Issue
</template>

<script>
import { Dropdown } from 'uiv'
import { Types } from '../../config/issue'

let defaults = {
  name: '',
  description: '',
  type_id: 1,
  sprint_id: ''
}

export default {
  name: 'IssueCreate',

  components: {
    Dropdown
  },

  data () {
    return {
      issue: Object.assign({}, defaults),
      selected: {
        sprint: {},
        type: Types[0]
      },
      types: Types,
      form: false
    }
  },

  props: {
    sprints: { type: Array, required: true },
    sprint: { type: Object, required: false }
  },

  mounted () {
    if (this.sprint) {
      this.sprintSelected(this.sprint)
    }
  },

  methods: {
    createIssue () {
      let project = this.$route.params.slug
      this.$http.post('/tasking/api/project/' + project + '/issue', this.issue)
        .then(response => {
          EventHub.$emit('issue-created', response.data.data)

          this.issue.name = ''
        });
    },

    sprintSelected(sprint) {
      this.selected.sprint = sprint
      this.issue.sprint_id = sprint.id
      return false
    },

    typeSelected(type) {
      this.selected.type = type
      this.issue.type_id = type.id
    }
  }
}
</script>

