import VueRouter from 'vue-router'

let routes = [
	{
		path: '/',
		component: require('./views/Home.vue')
	},
	{
		path: '/topics/:id',
		component: require('./views/Topic.vue')
	},
]

export default new VueRouter({
	routes,
	linkActiveClass:'is-active',
	linkExactActiveClass:'is-active'
})