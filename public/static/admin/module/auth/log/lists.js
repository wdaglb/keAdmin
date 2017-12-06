ke.create({
	data:{
		loadList:true,
		list:[],
		total:0,
		size:20,

		search:{
			key:'',
			date:''
		},

		dateQuick: {
          disabledDate(time) {
            return time.getTime() > Date.now();
          },
          shortcuts: [{
            text: '最近一周',
            onClick(picker) {
              var end = new Date();
              var start = new Date();
              start.setTime(start.getTime() - 3600 * 1000 * 24 * 7);
              picker.$emit('pick', [start, end]);
            }
          }, {
            text: '最近一个月',
            onClick(picker) {
              var end = new Date();
              var start = new Date();
              start.setTime(start.getTime() - 3600 * 1000 * 24 * 30);
              picker.$emit('pick', [start, end]);
            }
          }, {
            text: '最近三个月',
            onClick(picker) {
              var end = new Date();
              var start = new Date();
              start.setTime(start.getTime() - 3600 * 1000 * 24 * 90);
              picker.$emit('pick', [start, end]);
            }
          }, {
            text: '半年内',
            onClick(picker) {
              var end = new Date();
              var start = new Date();
              start.setTime(start.getTime() - 3600 * 1000 * 24 * 180);
              picker.$emit('pick', [start, end]);
            }
          }
          ]
        },
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
					date:this.search.date
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
		this.$notify.info({
			title:'提示',
        	message: '日志只会保存最新的3000条'
        })
	}
})