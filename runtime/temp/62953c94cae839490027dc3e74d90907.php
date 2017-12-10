<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:91:"D:\web\UPUPW_AP5.6\vhosts\keAdmin\public/../application/admin\view\auth\group\rolepost.html";i:1512645542;s:78:"D:\web\UPUPW_AP5.6\vhosts\keAdmin\public/../application/admin\view\layout.html";i:1512829479;}*/ ?>
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

<?php $__K_TO_VUE_URLS['lists']=url('lists',[],'.'.config('url_html_suffix'));?>
<div class="row">
	<div class="title">新建角色</div>
	<div class="nav">
		<el-button @click="returnLists" size="small">返回列表</el-button>
	</div>
</div>

<el-row>
  <el-col :span="16">
	<el-form :model="form" :rules="rules" ref="form" label-width="160px">

	  <el-form-item label="分组">
	    <el-input v-model="data.parent.name" :disabled="true"></el-input>
	  </el-form-item>

	  <el-form-item label="角色名称" prop="name">
	    <el-input v-model="form.name"></el-input>
	  </el-form-item>

	  <el-form-item label="备注内容">
	    <el-input v-model="form.content" type="textarea"></el-input>
	  </el-form-item>

	  <el-form-item label="设置权限">
	  	<template v-for="(item,index) in data.rule">
			<el-checkbox v-model="form.auth[item.id]" :label="item.id" @change="onAuthChange(item.id)">{{ item.title }}</el-checkbox>
			<div style="margin-left: 35px">
				<el-checkbox v-for="(items,indexs) in item.children" @change="onAuthChange(item.id,items.id)" :key="items.id" v-model="form.auth[items.id]" :label="items.id">{{ items.title }}</el-checkbox>
			</div>
	  	</template>
	  	<span class="help">不勾选则获得所有权限</span>
	  </el-form-item>


	  <el-form-item>
	    <el-button type="primary" @click="submitForm">保存信息</el-button>
	    <el-button @click="resetForm">重置</el-button>
	  </el-form-item>
	</el-form>
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