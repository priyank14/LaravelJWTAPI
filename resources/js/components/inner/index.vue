<template>
  <v-app>
    <div>
      <sidebar style="float:left"></sidebar>
      <router-view></router-view>
    </div>
  </v-app>
</template>
<script>
import sidebar from './utils/sidebar'
import axios from 'axios'
export default {
  name: 'inner',
  components: {
    sidebar
  },
  created () {
    if(window.localStorage.getItem('token')) {
      let token = window.localStorage.getItem('token')
      console.log('Token is present')
      // var config = {
      //   headers: {'Authorization': "bearer " + token}
      // }
      // axios.post('http://localhost:8000/api/getusers', config)
      //   .then((res) => {
      //     console.log(res)
      //   })
      //   .catch(() => {
      //     this.$store.commit('networkError')
      //     this.loading = false
      //   })
    }
    else {
      console.log('Token not present')
      this.$store.commit('createSnackbar', {
        color: 'red',
        content: 'Login Required'
      })
      this.$router.push({path: '/auth/login'})
    }
  }
}
</script>
