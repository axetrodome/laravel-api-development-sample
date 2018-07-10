<template>
	<div class="container">
		<div class="row justify-content-center">
		    <div class="col-md-8">
		        <div class="card card-default">
		            <div class="card-header"><img :src="poster.avatar" width="34" height="34" alt="" class="rounded"> {{ poster.username }}</div>

		            <div class="card-body">
						<h3>{{ topic.title }}</h3>
						<hr>
					    <div class="col-md-12" v-for="post in posts">
					        <div class="card card-default">
					            <div class="card-header"><img :src="post.user.data.avatar" width="34" height="34" alt="" class="rounded"> {{ post.user.data.username }}</div>

					            <div class="card-body">
									{{ post.body }}
									<hr>
									<span v-if="post.like_count > 0">{{ post.like_count }}</span><span v-else> Be the first one like. </span> 
					                <a href="#" class="card-link">
					                	Like</a>
					            </div>

					        </div>
					        <br>
					    </div>
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
				posts:[],
				topic:[],
				poster:[]
			}
		},
		created() {
			axios.get('api/topics/' + this.$route.params.id)
				.then(response => {
					this.posts = response.data.data.posts.data
					this.topic = response.data.data
					this.poster = response.data.data.user.data
				})
		}
	};
</script>
