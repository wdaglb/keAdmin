ke.create({
	data:{
		form:{
			user:null,
			pass:null,
			newpass:null,
			checkPass:null
		},
		rules:{
			pass: [
				{ required: true, message: '请输入原密码', trigger: 'blur' },
				{ max: 20, message: '密码应在 20 个字符内', trigger: 'blur' }
			],
			newpass: [
				{ required: true, message: '请输入新的登录密码', trigger: 'blur' },
				{ max: 20, message: '登录密码应在 20 个字符内', trigger: 'blur' }
			],
			checkPass: [
				{ required: true, message: '请确认新的登录密码', trigger: 'blur' },
				{ max: 20, message: '登录密码应在 20 个字符内', trigger: 'blur' }
			],
		}
	},
	methods:{
		submitForm(){
	        this.$refs['form'].validate((valid) => {
	          if (valid) {
	          	http.post({
	          		data: this.form,
	          		success:(res) => {
	          			if(res.code===0){
	          				this.$message.error(res.msg)
	          			}else{
	          				this.$message.success(res.msg)
	          				setTimeout( () => {
	          					this.maps('login')
	          				},1500)
	          			}
	          		}
	          	})
	          }
	        })
		},
		resetForm(){
			this.$refs['form'].resetFields()
		}
	}
})