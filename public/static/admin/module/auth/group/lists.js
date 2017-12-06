ke.create({
	data:{
		list:[],
		rolelist:[],
		props:{
			label:'name',
			isLeaf:'leaf'
		},
		checkId:0,

		editState:true,
		deleteState:true,

		loadList:true,


		checkRoleId:0,

	},
	computed:{
		onAction(){
			return parseInt(this.checkId) == 0
		},
		onRoleAction(){
			return parseInt(this.checkRoleId) == 0
		}

	},
	methods:{
		onCreate(type){
			if(type===0){
				this.url(this.map.create+'?pid='+this.checkId)
			}else{
				this.url(this.map.createRole+'?gid='+this.checkId)
			}
		},
		onEdit(type){
			if(type===0){
				this.url(this.map.edit+'?id='+this.checkId)
			}else{
				this.url(this.map.editRole+'?id='+this.checkRoleId)
			}
		},
		onDelete(type){
			this.$confirm('此操作将彻底删除该记录，是否继续？','提示').then(() => {
				var url = ''
				var id
				if(type===0){
					url = this.map.delete
					id = this.checkId
				}else{
					url = this.map.deleteRole
					id = this.checkRoleId
				}
				http.post({
					url:url,
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
		// 读取分组数据
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
						this.loadRole()
					}

				}
			})
		},
		// 读取角色数据
		loadRole(){
			this.loadList = true
			this.rolelist=[]
			http.get({
				url:this.map.listsRole,
				params:{
					gid:this.checkId
				},
				success:(res) => {
					if(res.code===1){
						this.rolelist = res.data.list
						this.loadList = false
					}
				}
			})
		},
		onNodeClick(item){
			this.checkId=item.id
			this.loadRole()
		},
		loadNode(item,resolve){
			if(item.level === 0){
				return resolve([{name:'顶级栏目',id:0}])
			}
			this.loadData(item,resolve)
		},
		onTableChange(item){
			this.checkRoleId = item.id
		}
	},
	created(){
	}
})