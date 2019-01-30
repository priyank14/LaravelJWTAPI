<template>
  <v-app>
    <v-content class="text-xs-left">
      <v-layout row wrap>
        <v-container fluid align-start style="padding-left:41px;padding-top:30px">
          <v-layout row wrap>
            <v-flex xs12 sm12 md10 offset-md-1 class="pa-2">
              <v-list three-line subheader style="background-color:#fafafa">
                <v-list-tile style="background-color:#FFFFFF" v-for="question in questions" :key="question.id" class="mb-3 pa-2 elevation-2">
                  <v-list-tile-content class="pl-2" @click="questionClick(question.id)">
                    <v-list-tile-title class="caption" style="color:#707475">Q.no {{question.id}} by {{question.name}}</v-list-tile-title>
                    <v-list-tile-title class="text--primary">{{question.heading}}</v-list-tile-title>
                    <v-list-tile-title>{{question.description}}</v-list-tile-title>
                  </v-list-tile-content>
                </v-list-tile>
              </v-list>
            </v-flex>
          </v-layout>
        </v-container>
      </v-layout>
    </v-content>
  </v-app>
</template>
<script>
import axios from 'axios'
export default {
  name: 'Home',
  data () {
    return {
      questions: []
    }
  },
  methods: {
    questionClick (e) {
      this.$router.push('/app/question/' + e)
    }
  },
  created () {
    let token = window.localStorage.getItem('token')
    var config = {
      headers: {'Authorization': "bearer " + token}
    }
    axios.get('http://localhost:8000/api/questions',config)
      .then((res) => {
        // console.log(res)
        res.data.forEach(element => {
          this.questions.push(element)
        });
        console.log(this.questions)
      })
      .catch(() => {
        this.$store.commit('networkError')
        this.loading = false
      })
  }
}
</script>
