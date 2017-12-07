ke.create({
	data:{
		admin:{}
	},
	methods:{
		onCommand(type){
			if(type=='editpass'){
				this.maps('adminEditPass')
			}else if(type=='logout'){
				this.$confirm('确定要退出系统吗？','询问').then(()=>{
					http.get({
						url:this.map.logout,
						success:(res) => {
							if(res===0){
								this.$alert(res.msg)
							}else{
								this.maps('login')
							}
						}

					})
				})
			}
		}
	},
	created(){
		this.admin = this.data.admin
	}
})