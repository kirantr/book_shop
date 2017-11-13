<template>
    <div class="base">
        <div v-if="authUser == ''">
            <login></login>
        </div>
        <div  v-else>
            <div>
                <div class="hello ">
                    <p>Hello, {{user.login}}</p>
                </div>
                  <div class="calendar">
                        <calendar>:role="user.role" :user="user"</calendar>
                  </div>
            </div>
            <div class="logout col-md-offset-3 col-md-6">
                    <p>
                        <button v-on:click="logout()">Logout</button>
                    </p>
            </div>
        </div>
    </div>
</template>

<script>
             import axios from 'axios'
             import Login from './Login'
             import Calendar from './Calendar'
             export default {
             name: 'Main',
                   data () {
             return {
                     authUser: '',
                      role: '',
                      user: {},
                }
             },
                   methods: {
                         authUserCreate: function()
                         {
                         var self = this
                               if (localStorage['user'])
                         {
                         self.user = JSON.parse(localStorage['user'])
                               axios.get(getUrl() + 'users/' + self.user.id)
                               .then(function (response) {
                               console.log(response.data)
                                     if (Array.isArray(response.data)){
                               if (self.user === response.data[0])
                                    {
                                          self.user.login = response.data[0].login
                                          self.user.role = response.data[0].role
                                          self.authUser = 1;
                                          return true
                                    }
                                    else
                                    {
                                          delete localStorage['user']
                                          self.authUser = ''
                                          return false
                                    }
                               }
                               else {
                                        delete localStorage['user']
                                        self.errorMsg = response.data
                                        return false
                                    }
                               })
                               .catch(function (error) {
                               console.log(error)
                               });
                         }
                         else
                            {
                                  self.authUser = ''
                                  return false
                            }
                        }
                 },
                   logout: function(){
                        var self = this
                              if (localStorage['user'])
                        {
                                  delete localStorage['user']
                                  self.user = {},
                                  self.authUser = ''
                                  return true
                        }
                        else
                        {
                                 return false
                        }
                   },
                   created(){
                        this.authUserCreate()
                    },
                   components: {
                         'Login': Login,
                         'Calendar': Calendar
                   }
         }
</script>

<style>
.calendar{
      background: #bce8f1;
}

.hello{
      color: green;
      font-size: 24px;
}
.logout{
      padding: 30px;
}
</style>
