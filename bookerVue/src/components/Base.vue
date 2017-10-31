<template>
    <div class="base">
        <h2>The booker</h2>
        <p class="author"><span>Data: </span></p>
        <p v-for="month in months" class="month">{{month}}/ </p>
        </p>
        <div>
            <ul v-for="month in months">
                <li ><a href="#">{{month}}</a></li>
            </ul>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
            export default {
            name: 'Base',
                    data () {
            return {
            months: [],
                    name: '',
                            id: ''
                }
            },
                    methods: {
                    getMonth: function () {
                    var self = this
//      axios.get(getUrl() + 'authors/')
                            axios.get('http://localhost/book_shop/bookShopRest/server/api/authors/')
                            .then(function (response) {
                            console.log(response.data)
                                    if (Array.isArray(response.data))
                            {
                            self.authors = response.data
                            }
                            else {
                            self.errorMsg = response.data
                            }
                            })
                            .catch(function (error) {
                            console.log(error)
                            })
                    }
                    }
            }
</script>