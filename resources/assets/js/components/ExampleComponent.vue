<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" v-for="topic in topics">
                <div class="card card-default">
                    <div class="card-header"><img :src="topic.user.data.avatar" width="34" height="34" alt="" class="rounded"> {{ topic.user.data.username }}</div>
                    <div class="card-body">
                        {{ topic.title }}
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                topics:[],
                meta:null
            }
        },
        mounted() {
           this.getPage(2)
        },
        methods: {
            
            getPage(page) {
                axios.get('api/topics?page='+page)
                    .then(response => {
                        this.topics = response.data.data
                        this.meta = response.data.meta
                    })      
            }
        }
    };
</script>
