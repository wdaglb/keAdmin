ke.create({
	data:{
		list:[],
		props:{
			label:'name',
			isLeaf:'leaf'
		},
		checkId:0
	},
	methods:{
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