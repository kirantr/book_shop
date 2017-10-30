<template>
    <div class="base">
        <h2>The book shop</h2>
        <p class="author"><span>Authors: </span></p>
        <p v-for="author in authors" class="author">{{author.name}}/ </p>
        </p>
        <div>
            <ul v-for="author in authors">
                <li ><a href="#">{{author.name}}</a></li>
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
            authors: [],
                    name: '',
                            id: ''
                }
            },
                    methods: {
                    getAuthors: function () {
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