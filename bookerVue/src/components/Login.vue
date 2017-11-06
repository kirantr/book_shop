<template>
    <div class="login">
    <div>
      <p>{{errMessage}}</p>
        <div>
            <h1>Log in</h1>
        </div>
        <div>
          <h3>Login</h3>
          <div>
              <input v-model="login" type="text">
          </div>
        </div>
        <div>
          <h3>Password</h3>
          <div>
              <input v-model="pass" type="password">
          </div>
        </div>
        <div>
          <div>
              <p><button v-on:click="getLogin()">Submit</button></p>
          </div>
        </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'loginForm',
  data () {
    return {
      message: '',
      errMessage: '',
      login: '',
      pass: ''
    }
  },
  methods: {
    getLogin: function(){
      var self = this
      self.errMessage = ''
      if (self.login && self.pass)
        {
            axios.put(getUrl() + 'users/', {
            login: self.login,
            pass: self.pass
          }, axConf)
          .then(function (response) {
            if (response.data.id && response.data)
                {
                    self.$parent.user.id = response.data.id
                    self.$parent.user = response.data 
                    localStorage['user'] = JSON.stringify(self.$parent.user)
                    self.$parent.user.login = response.data.login
                    self.$parent.user.role = response.data.role
                    self.$parent.user.userName = response.data.username
                    self.$parent.authUser=1
                }
            else {
                     self.errMessage = response.data
                }
          })
          .catch(function (error) {
            console.log(error)
          })
        }
        else
        {
          self.errMessage = 'Enter data in all fields!'
        }
    }
  }
}
</script>

<style scoped>
.login{
  background-image: url(/static/img/login_img.jpg);
  background-repeat: no-repeat;
  height:1024px;
}

h1{
    color: white;
}
</style>
