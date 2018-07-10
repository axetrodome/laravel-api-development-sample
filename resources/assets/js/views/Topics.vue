<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-8" v-for="topic in topics">
                <div class="card card-default">
                    <div class="card-header"><img :src="topic.user.data.avatar" width="34" height="34" alt="" class="rounded"> {{ topic.user.data.username }}</div>
                    <div class="card-body">
                        <router-link :to="'/topics/'+ topic.id">{{ topic.title }}</router-link>
                    </div>
                </div>
                <br>
            </div>
        </div>
        <nav aria-label="Page navigation example" class="row justify-content-center">
          <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#" @click="getPage(meta.current_page - 1 )">Previous</a></li>
            <li class="page-item" v-for="index in total_pages"><a class="page-link" @click="getPage(index)" href="#">{{ index }}</a></li>
            <li class="page-item"><a class="page-link" href="#" @click="getPage(meta.current_page + 1 )">Next</a></li>
          </ul>
        </nav>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                topics:[],
                meta:null,
                total_pages:null
            }
        },
        mounted() {
           this.getPage(1)
           console.log(this.total_pages)
        },
        methods: {
            getPage(page) {
                axios.get('api/topics?page='+page)
                    .then(response => {
                        this.topics = response.data.data
                        this.meta = response.data.meta.pagination
                        this.total_pages = response.data.meta.pagination.total_pages

                    })      
            }
        }
    };
</script>
