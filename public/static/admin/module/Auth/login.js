define(function(){
	ke.init({
		data(){
			return {
				form:{},
				rules:{
					user: [
						{ required: true, message: '请输入登录名', trigger: 'blur' },
						{ max: 20, message: '登录名应在 20 个字符内', trigger: 'blur' }
					],
					pass: [
						{ required: true, message: '请输入密码', trigger: 'blur' },
						{ max: 20, message: '密码应在 20 个字符内', trigger: 'blur' }
					],
				}

			}
		},
		methods:{
			onLogin(){
				http.post({
					data: this.form,
					success:(res) => {
						if(res.code==0){
							this.$message.error(res.msg)
						}
					}
				})
			}
		}
	})
})