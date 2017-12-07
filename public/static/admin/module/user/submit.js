ke.create({
	data:{
		form:{},
		rules:{
			name: [
				{ required: true, message: '请输入会员组名称', trigger: 'blur' },
				{ max: 20, message: '会员名称应在 20 个字符内', trigger: 'blur' }
			],
		}
	},
	computed:{
		title(){
			if(this.data){
				if(this.data.item){
					return '编辑会员信息'
				}
			}
			return '添加会员'
		}
	},
	methods:{
		submitForm(){
			this.$refs['form'].validate((valid) => {
				if (valid) {
					http.post({
						data:this.form,
						success:(res) => {
							if(res.code === 0){
								this.$message.error(res.msg)
							}else{
								this.$message.success('信息保存成功')
								setTimeout( () => {
									this.url(this.map.lists)
								},1500)
							}

						}
					})
				}
			})

		},
		resetForm(){
			this.$refs['form'].resetFields();
		}
	},
	created(){
		if(this.data && this.data.item){
			this.form=this.data.item
		}
	}
})