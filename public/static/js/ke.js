var inArray=function(arr){
	for(var i=0;i<arr.length;i++){
		if(this==arr[i]){
			return true
		}
	}
	return false
}
String.prototype.inArray = inArray
Number.prototype.inArray = inArray

window.onload=function(){
	// 拦截element-ui单个表单回车提交事件
	var s=document.getElementsByClassName('el-form')
	for(var i=0;i<s.length;i++){
		s[i].onsubmit=function(){
			return false
		}
	}
}

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
	},
	put(options){
		var url=options.url || ''
		var fd=new FormData()
		fd.append('file',options.data)
		axios.request({
			method: 'post',
			url: url,
			params:options.params,
			data: fd
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
		onTopNav(index){
			this.curr = index
		},
		onSidebar(item){
			this.httpsrc = item.url
		},
		url(url){
			top.vm.httpsrc = url
		},
		maps(url,params){
			var u = this.map[url]
			if(params){
				u += '?'
				for(var k in params){
					u += k + '=' + params[k] + '&'
				}
				u = u.substring(0,u.length-1)
			}

			top.vm.httpsrc = u

		},
		reload(){
			location.reload()
		},
		scrollTop(){
			document.body.scrollTop = 0
			document.documentElement.scrollTop = 0
		}
	}

	if(options.data){
		if(typeof ke.data != 'undefined'){
			vars=Object.assign(options.data,ke.data)
		}
	}else{
		vars=ke.data
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