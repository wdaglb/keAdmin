
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
	data:{}
}
ke.init=function(menu){
	ke.data=menu
}
ke.create=function(options){
	options.el='#app'
	var vars={}

	// 全局方法
	var methods={
		// font awesome
		iconFormat(type){
			return 'fa fa-fw fa-'+type
		},
		onSidebar(item){
			location.href=item.url
		}
	}

	if(typeof ke.data != 'undefined'){
		vars=Object.assign(options.data,ke.data)
	}
	options.data=function(){
		return vars
	}
	if(typeof options.methods != 'undefined'){
		options.methods=Object.assign(options.methods,methods)
	}else{
		options.methods=methods
	}
	return new Vue(options)
}