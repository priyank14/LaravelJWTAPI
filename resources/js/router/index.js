import Vue from 'vue'
import Router from 'vue-router'

import inner from '../components/inner/index'
import Home from '../components/inner/home/index.vue'
import Create from '../components/inner/create/index'
import Question from '../components/inner/question/index'


import Outer from '../components/outer/index.vue'
import Login from '../components/outer/login/login.vue'
import Signup from '../components/outer/login/signup.vue'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      redirect: '/auth/login'
    },
    {
      path: '/app',
      redirect: '/app/home'
    },
    {
      path: '/',
      name: 'outer',
      component: Outer,
      children: [
        {path: '/auth/login', component: Login},
        {path: '/signup', component: Signup}
      ]
    },
    {
      path: '/app',
      name: 'inner',
      component: inner,
      children: [
        {path: '/app/home', component: Home, name: 'Home'},
        {path: '/app/create', component: Create, name: 'Create'},
        {path: '/app/question/:qid', component: Question, name: 'Question'}
      ]
    }
  ]
})
