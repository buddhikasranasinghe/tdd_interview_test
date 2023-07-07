<template>
	<div>
		<nav-bar></nav-bar>
		<router-view></router-view>
	</div>
</template>

<script>
import NavBar from './components/NavBar.vue'
export default {
    name: 'App',
	components: {
		"nav-bar": NavBar
	},
	data() {
		return {
			form: {
				'title': '',
				'description': '',
				'website_id': ''
			}
		}
	},
}
</script>

<style>
</style>
