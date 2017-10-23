<template>
  <div id="app">
    <router-view/>
  </div>
</template>

<script>
export default {
  name: 'app',
  data(){
    return {
      url: {
        home:'http://localhost/sash/book_shop_vue/server/api/',
        class: 'http://192.168.0.15/~user7/book_shop_vue/client/api/'
      },
      location: 'home'
    }
  },
  computed: {
    getUrl: function(){
      var self = this
      if(self.location == 'home'){
        return self.url.home
      }
      else
      {
        return self.url.class
      }
    }
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
