ke.create({
	data:{
		loadList:true,
		list:[],
		total:0,
		size:20,

		search:{
			key:''
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
					key:this.search.key
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