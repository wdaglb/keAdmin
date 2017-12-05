
axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';

axios.interceptors.request.use(
	config => {
		config.headers['X-Requested-With']='XMLHttpRequest'

		config.paramsSerializer=function(params) {
			var p=''
			for(var key in params){
				p += key + '=' + params[key] + '&'
			}
			p = p.substring(0,p.length-1)
			return p
		}
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
		axios.request({
			method: 'get',
			url: url,
			params:options.params
		}).then(options.success).catch(options.fail)
	},
	post(options){
		var url=options.url || ''
		axios.request({
			method: 'post',
			url: url,
			params:options.params,
			data: options.data
		}).then(options.success).catch(options.fail)
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
			this.httpsrc = item.url
		},
		url(url){
			top.vm.httpsrc = url
		}
	}

	if(typeof ke.data != 'undefined'){
		vars=Object.assign(options.data,ke.data)
	}
	vars.httpsrc=null
	options.data=function(){
		return vars
	}
	if(typeof options.methods != 'undefined'){
		options.methods=Object.assign(options.methods,methods)
	}else{
		options.methods=methods
	}
	vm=new Vue(options)
}