<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:88:"D:\web\UPUPW_AP5.6\vhosts\keAdmin\public/../application/admin\view\auth\group\lists.html";i:1512558978;s:78:"D:\web\UPUPW_AP5.6\vhosts\keAdmin\public/../application/admin\view\layout.html";i:1512829479;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <title>KE 后台管理</title>
    <link rel="stylesheet" href="//unpkg.com/element-ui@2.0.7/lib/theme-chalk/index.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//admin.cn/static/<?php echo request()->module();?>/css/common.css">
    
</head>
<body>
<div id="app" v-cloak>

<?php $__K_TO_VUE_URLS['create']=url('create');$__K_TO_VUE_URLS['edit']=url('edit');$__K_TO_VUE_URLS['delete']=url('delete');$__K_TO_VUE_URLS['listsRole']=url('listsRole');$__K_TO_VUE_URLS['createRole']=url('createRole');$__K_TO_VUE_URLS['editRole']=url('editRole');$__K_TO_VUE_URLS['deleteRole']=url('deleteRole');?>
<div class="row">
	<div class="title">权限管理</div>
	<div class="nav">
	</div>
</div>
<el-row class="trees">
  <el-col :span="6">
  	<el-button-group style="margin:0 10px;">
    	<el-button size="small" type="info" @click="onCreate(0)">新建分组</el-button>
    	<el-button size="small" type="warning" @click="onEdit(0)" :disabled="onAction">编辑</el-button>
    	<el-button size="small" type="danger" @click="onDelete(0)" :disabled="onAction">删除</el-button>

    </el-button-group>
  	<div class="m-l">
		<el-tree
		  :props="props"
		  :load="loadNode"
		  highlight-current
		  node-key="id"
		  :default-expanded-keys="[0]"
		  @node-click="onNodeClick"
		  lazy>
		</el-tree>
	</div>
  </el-col>
  <el-col :span="18">
  	<el-button-group style="margin:0 10px;;margin-bottom: 6px;">
    	<el-button size="small" type="info" @click="onCreate(1)">新建角色</el-button>
    	<el-button size="small" type="warning" @click="onEdit(1)" :disabled="onRoleAction">编辑</el-button>
    	<el-button size="small" type="danger" @click="onDelete(1)" :disabled="onRoleAction">删除</el-button>

    </el-button-group>
    <el-table
    v-loading="loadList"
    :data="rolelist"
    border
    stripe
    highlight-current-row
    @current-change="onTableChange">
        <el-table-column type="index" width="55">
			</el-table-column>
	    <el-table-column prop="group" label="分组" width="100">
	    	</el-table-column>
	    <el-table-column prop="name" label="角色名称" width="100">
	    	</el-table-column>
	    <el-table-column prop="content" label="备注">
	    	</el-table-column>
  	</el-table>
  </el-col>
</el-row>

</div>


<script src="//unpkg.com/vue@2.5.9/dist/vue.js"></script>
<script src="//unpkg.com/axios@0.14.0/dist/axios.min.js"></script>
<script src="//unpkg.com/element-ui@2.0.7/lib/index.js"></script>
<script src="//admin.cn/static/js/ke.js"></script>
<script>ke.init({<?php if(isset($__K_TO_VUE_URLS)){echo 'map:'.json_encode($__K_TO_VUE_URLS);}else{echo 'map:{ }';}if(isset($list)):?>,list:<?php echo (is_array($list) ? json_encode($list) : $list);endif;if(isset($data)):?>,data:<?php echo (is_array($data) ? json_encode($data) : $data);endif;?> })</script>
<script src="//admin.cn/static/<?php echo request()->module();?>/module/<?php echo config('modulejs');?>.js?v=<?php echo $_SERVER['REQUEST_TIME'];?>"></script>
</body>
</html>