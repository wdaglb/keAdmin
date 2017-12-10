ke.create({
	data:{
		loadList:true,
		list:[],
		total:0,
		size:20,

		search:{
			key:'',
			status:-1,
			date:''
		},

		dialog:{
			status:false,
			form:{},
			rules:{
				value:[
					{ required: true, message: '请输入充值数值', trigger: 'blur' }
				]
			},
			title:null,
			label:null,
			post:null
		}
	},
	methods:{
		tabSize(s){
			this.size = s
			this.loadLists(1)
		},
		loadLists(p){
			this.loadList = true
			http.get({
				params:{
					size:this.size,
					page:p,
					key:this.search.key,
					status:this.search.status,
					date:this.search.date,
				},
				success:(res) => {
					this.loadList = false
					if(res.code ===0 ){
						this.$message.error(res.msg)
					}else{
						this.list = res.data.list
						this.total = res.data.total
						this.scrollTop()
					}
				}
			})
		},
		onUserAction(obj){
			switch (obj.type) {
				case 'money':
					this.dialog.status = true
					this.dialog.title = '充值金额'
					this.dialog.label = '金额'
					this.dialog.form.id = obj.item.id
					this.dialog.post = this.map.money

					break;
				case 'integral':
					this.dialog.status = true
					this.dialog.title = '充值积分'
					this.dialog.label = '数值'
					this.dialog.form.id = obj.item.id
					this.dialog.post = this.map.integral

					break;
				case 'edit':
					this.maps('edit', {id: obj.item.id})
					break;
				case 'delete':
					this.onDelete(obj.item.id)
					break;
				default:
					break;
			}
		},
		onDialogResetFields(){
			this.$refs['dialogForm'].resetFields()
		},
		onDialogSubmit(type){
			if(type){
				this.$refs['dialogForm'].validate((valid) => {
					if (valid) {
						http.post({
							url: this.dialog.post,
							data: this.dialog.form,
							success:(res) => {
								if(res.code===0){
									this.$message.error(res.msg)
								}else{
									this.$message.success('充值成功')
									this.dialog.status = false
								}
							}
						})
					}
				})
			}else{
				this.dialog.status = false
			}

		},
		onDelete(id){
			this.$confirm('此操作将彻底删除该记录，是否继续？','提示').then(() => {
				http.post({
					url:this.map.delete,
					data:{id:id},
					success:(res) => {
						if(res.code===0){
							this.$message.error(res.msg)
						}else{
							this.$message.success('删除成功')
							setTimeout(() => {
								this.reload()
							},800)
						}
					}
				})
			})
		},
		onSearch(){
			this.loadLists(1)
		}
	},
	created(){
		this.loadLists(1)
	}
})