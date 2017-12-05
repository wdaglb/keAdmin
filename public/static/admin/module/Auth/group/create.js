ke.create({
	data:{
		form:{
			name:null,
			contnet:null,
			valid:"0"
		},
		rules:{
			name: [
				{ required: true, message: '请输入用户组名称', trigger: 'blur' },
				{ max: 20, message: '用户组名称应在 20 个字符内', trigger: 'blur' }
			],
		}
	},
	methods:{
		submitForm(){
			http.post({
				data:this.form,
				success:(res) => {
					if(res.code === 0){
						this.$message.error(res.msg)
					}else{
						this.$message.success(res.msg)
						setTimeout( () => {
							this.url(res.url)
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
	}
})