
require.config({
	baseUrl: "/static/admin/module/",
	urlArgs: 'ver='+new Date().getTime(),
	paths: {
	}
});

axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';

axios.interceptors.request.use(
	config => {
		config.headers['X-Requested-With']='XMLHttpRequest'
		return config
	}
)
axios.interceptors.response.use(
	config => {
		return config.data
	}
)

http={
	get(options){
		var url=options.url || ''
		axios.get(url).then(options.success).catch(options.fail)
	},
	post(options){
		var url=options.url || ''
		axios.post(url,options.data).then(options.success).catch(options.fail)
	}
}

ke={
	init(options){
		options.el='#app'
		return new Vue(options)
	}
}