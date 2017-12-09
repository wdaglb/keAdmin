ke.create({
	data:{
		headimg:null,
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
		},
		handleAvatarSuccess(res, file) {
			console.log(res)
			this.headimg = URL.createObjectURL(file.raw);
		},
		onUploadStart(data){
			var file=data.file
			var isLt2M = file.size / 1024 / 1024 < 2
			var isU = (file.type === 'image/jpeg' || file.type === 'image/png' || file.type === 'image/bmp');

			if (!isU) {
				this.$message.error('上传头像图片只能是 jpg/png/bmp 格式!')
				return
			}
			if (!isLt2M) {
				this.$message.error('上传头像图片大小不能超过 2MB!')
				return
			}
			http.put({
				url:this.map.uploadimg,
				data:file,
				success:(res) => {
					if(res.code===0){
						this.$message.error(res.msg)
					}else{
						this.$message.success('头像上传成功')
						this.headimg = res.data.src
						this.form.useFileId = res.data.id
					}
				}
			})

		}
	},
	created(){
		if(this.data && this.data.item){
			this.form=this.data.item
			if(this.form.headimg!=''){
				this.headimg=this.form.headimg
			}
		}
	}
})