<template>
  <div id="app">
    <v-app>
      <v-snackbar
        v-model="$store.getters.getSnack.state"
        :color="$store.getters.getSnack.color"
        top
        :timeout=1500
        >
        {{$store.getters.getSnack.content}}
      </v-snackbar>
      <router-view/>
    </v-app>
  </div>
</template>

<script>
export default {
  name: 'App'
}
</script>

<style>
#app {
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  font-family: "Montserrat", sans-serif;
  /* margin-top:10px; */
}
.display-1,
.title,
.headline,
.subheading,
.body-2,
.body-1,
.display-2 {
  font-family: "Montserrat", sans-serif !important;
}
</style>