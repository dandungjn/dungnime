<script type="text/javascript">
	export default {
        components: {
            'user-menu-component': () => import('./UserMenu.vue'),
            'main-menu-component': () => import('./MainMenu.vue')
        },
		data: () => ({
            drawer: null,
        })
	}
</script>