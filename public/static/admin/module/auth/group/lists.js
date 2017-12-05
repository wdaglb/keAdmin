ke.create({
	data:{
		list:[],
		props:{
			label:'name',
			isLeaf:'leaf'
		},
		checkId:0,

		editState:true,
		deleteState:true,
	},
	computed:{
		onAction(){
			return parseInt(this.checkId) == 0
		}

	},
	methods:{
		onCreate(){
			this.url(this.map.create+'?pid='+this.checkId)
		},
		onEdit(){
			this.url(this.map.edit+'?id='+this.checkId)
		},
		onDelete(){
			this.$confirm('此操作将彻底删除该记录，是否继续？','提示').then(() => {
				http.post({
					url:this.map.delete,
					data:{id:this.checkId},
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
		loadData(item,resolve){
			http.get({
				params:{
					pid:item.data.id
				},
				success:(res) => {
					if(res.code===0){
						this.$message.error(res.msg)
					}else{
						resolve(res.data.list)
					}

				}
			})
		},
		onNodeClick(item){
			this.checkId=item.id
		},
		loadNode(item,resolve){
			if(item.level === 0){
				return resolve([{name:'顶级栏目',id:0}])
			}
			this.loadData(item,resolve)
		}
	},
	created(){
	}
})