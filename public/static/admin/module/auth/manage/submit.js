ke.create({
	data:{
		form:{},
		passtext:null,
		rules:{
			user: [
				{ required: true, message: '请输入登录账号', trigger: 'blur' },
				{ max: 20, message: '账号应在 20 个字符内', trigger: 'blur' }
			],
			pass: [
				{ required: true, message: '请输入登录密码', trigger: 'blur' },
				{ max: 20, message: '密码应在 20 个字符内', trigger: 'blur' }
			],
		}
	},
	methods:{
		submitForm(){
			http.post({
				data:this.form,
				success:(res) => {
					if(res.code===0){
						this.$message.error(res.msg)
					}else{
						this.$message.success('信息保存成功')
						setTimeout(()=>{
							this.maps('lists')
						},1500)
					}
				}
			})
		},
		resetForm(){
			this.$refs['form'].resetFields();
		}

	},
	created(){
		if(this.data.item){
			this.passtext='如不修改请留空'
			this.form = this.data.item
		}
	}
})