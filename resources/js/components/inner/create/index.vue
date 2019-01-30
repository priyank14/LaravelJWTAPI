<template>
  <v-app>
    <v-content class="text-xs-left">
      <v-layout justify-center>
      <v-flex xs12 sm6>
        <v-card class="pa-4">
          <v-card-title primary-title class="headline mb-0">
            Create Question
          </v-card-title>
          <div>
            <v-form>
              <v-container fluid>
                <v-layout row wrap>
                  <v-flex md10 offset-md1>
                    <v-text-field
                      v-model="heading"
                      :rules="[rules.required, rules.min]"
                      label="Question Heading"
                    ></v-text-field>
                  </v-flex>
                  <v-flex md10 offset-md1>
                    <v-textarea
                      v-model="description"
                      :rules="[rules.required, rules.min]"
                      label="Question Description"
                    ></v-textarea>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-form>
          </div>
          <v-card-actions>
            <v-layout justify-center>
              <v-btn :disabled="!valid" @click="login" :loading="loading" color="orange">create</v-btn>
              <v-btn :disabled="!valid" @click="test" :loading="loading" color="orange">Test</v-btn>
            </v-layout>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
    </v-content>
  </v-app>
</template>
<script>
import axios from 'axios'
export default {
  name: 'create',
  data () {
    return {
      heading: '',
      description: '',
      loading: false,
      valid: true,
      rules: {
        required: value => !!value || 'Required.',
        min: v => v.length >= 8 || 'Min 8 characters'
      }
    }
  },
  methods: {
    login () {
      this.loading = true
      let obj = {
        'user_id': 1,
        'heading': this.heading,
        'description': this.description
      }
      let token = window.localStorage.getItem('token')
      var config = {
        headers: {'Authorization': "bearer " + token}
      }
       axios.post('http://localhost:8000/api/questions/create', obj,config)
        .then((res) => {
          console.log(res)
           if (res.data.success) {
            this.$store.commit('createSnackbar', {
              color: 'green',
              content: 'Question created successfuly'
            })
          } else {
            this.$store.commit('createSnackbar', {
              color: 'red',
              content: res.data.reason
            })
          }
        })
        .catch(() => {
          this.$store.commit('networkError')
          this.loading = false
        })
        this.$router.push({path: '/app/home'})
    },
    test() {
      let token = window.localStorage.getItem('token')
      var config = {
        headers: {'Authorization': "bearer " + token}
      }
      axios.get('http://localhost:8000/api/test',config)
        .then((res)=> {
          console.log(res)
        })
    }
  }
}
</script>