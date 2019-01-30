<template>
  <v-app>
    <v-content class="text-xs-left">
      <v-layout row wrap>
        <v-container fluid align-start style="padding-left:41px;padding-top:30px">
          <v-layout row wrap class="ma-2">
            <v-card width="90%">
              <v-flex md10 offset-md1>
                <v-card-title>{{heading}} by {{name}}</v-card-title>
                <v-card-text>
                  {{description}}
                </v-card-text>
                <v-card-actions>
                    <v-btn icon><v-icon>fa-thumbs-up</v-icon></v-btn>
                    <v-spacer></v-spacer>
                    <v-btn icon><v-icon>fa-thumbs-down</v-icon></v-btn>
                </v-card-actions>
                <v-card-text>
                  <v-textarea
                    v-model="answerdesc"
                    class="ma-2"
                    label="Answer this question"
                  ></v-textarea>
                  <v-btn @click="answer">Submit</v-btn>
                </v-card-text>
              </v-flex>
            </v-card>
          </v-layout>
          <span v-for="(answer,i) in answers" :key="i">
            <v-layout row wrap class="ma-2">
              <v-card width="90%">
                <v-flex md10 offset-md1>
                  <v-card-title>{{answer.name}}</v-card-title>
                  <v-card-text>
                    {{answer.ans}}
                  </v-card-text>
                  <v-card-actions>
                    <v-btn icon><v-icon>fa-thumbs-up</v-icon></v-btn>
                    <v-spacer></v-spacer>
                    <v-btn icon><v-icon>fa-thumbs-down</v-icon></v-btn>
                  </v-card-actions>
                </v-flex>
              </v-card>
            </v-layout>
          </span>
        </v-container>
      </v-layout>
    </v-content>
  </v-app>
</template>
<script>
import axios from 'axios'
export default {
  name: 'Question',
  data () {
    return {
      answers: [],
      qid: this.$route.params.qid,
      answerdesc: '',
      heading: '',
      name: '',
      description: '',
      loading: false,
      valid: true,
      rules: {
        required: value => !!value || 'Required.',
        min: v => v.length >= 8 || 'Min 8 characters'
      },
    }
  },
  methods: {
    answer () {
      let token = window.localStorage.getItem('token')
      var config = {
        headers: {'Authorization': "bearer " + token}
      }
      let obj = {
        question_id: this.$route.params.qid,
        user_id: 2,
        ans: this.answerdesc
      }
      axios.post('http://localhost:8000/api/answer/submit', obj,config)
        .then((res)=> {
          if(res.data.success) {
            this.answers.push(obj)
          }
        })
        this.answerdesc = ''
    }
  },
  created () {
    let token = window.localStorage.getItem('token')
    var config = {
      headers: {'Authorization': "bearer " + token}
    }
    let obj = {
      question_id: this.$route.params.qid
    }
    axios.post('http://localhost:8000/api/question',obj,config)
      .then((res) => {
        console.log(res)
          this.heading = res.data.questions[0].heading
          this.description = res.data.questions[0].description
          this.name = res.data.questions[0].name
          res.data.answer.forEach(element => {
            this.answers.push(element)
          })

      })
  }
}
</script>

