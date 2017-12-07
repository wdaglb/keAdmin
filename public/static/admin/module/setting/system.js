ke.create({
	data:{
		form:{},
		rules:{
			title: [
				{ required: true, message: '站点标题不能留空', trigger: 'blur' },
				{ max: 50, message: '站点标题应在 50 个字符内', trigger: 'blur' }
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
			this.form = this.data.item
		}
	}
})