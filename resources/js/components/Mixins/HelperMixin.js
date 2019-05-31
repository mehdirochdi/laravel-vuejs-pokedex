export default {
	
    methods:{
    	asset(param) {
			return url + '/' + param
		},
		redirect(routeName, params=null){
			window.location = params? route(routeName, params):route(routeName);
		},
		isRoute(routeName) {
			return (route().current(routeName)) ? 'isActive' : ''
			// let currentSidebarLeft = (currentSidebarLeft === 'home') ? '/' : currentSidebarLeft
			// return (routeName === currentSidebarLeft) ? 'isActive' : ''
		},
		route: route
	}
}