ke.create({
	data:{
		form:{
			name:null,
			contnet:null,
			parent_id:0,
			valid:0,
			auth:[]
		},
		rules:{
			name: [
				{ required: true, message: '请输入用户组名称', trigger: 'blur' },
				{ max: 20, message: '用户组名称应在 20 个字符内', trigger: 'blur' }
			],
		}
	},
	methods:{
		returnLists(){
			this.url(this.map.lists+'?pid='+this.data.parent.id)
		},
		submitForm(){
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

		},
		resetForm(){
			this.$refs['form'].resetFields();
		},
		onAuthChange(index,indexs){
			var all = this.data.rule[index]

			if(typeof indexs!='undefined'){
				// 判断同胞是否有选择的项
				console.log(all.children)
				var bo=false
				for(var key in all.children){
					if(this.form.auth[all.children[key].id]){
						bo=true
						break;
					}
				}
				// 上级选择
				this.form.auth[all.children[indexs].parent_id]=bo

			}else{
				// 全选
				for(var key in all.children){
					this.form.auth[all.children[key].id] = this.form.auth[all.id]
				}
			}
		}
	},
	created(){
		if(this.data.item){
			this.form=this.data.item
		}else{
			this.form.parent_id = this.data.parent.id
		}
	}
})