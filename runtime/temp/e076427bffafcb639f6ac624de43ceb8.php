<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"D:\web\UPUPW_AP5.6\vhosts\keAdmin\public/../application/admin\view\auth\login.html";i:1512322858;s:78:"D:\web\UPUPW_AP5.6\vhosts\keAdmin\public/../application/admin\view\layout.html";i:1512829479;}*/ ?>
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
    <link rel="stylesheet" href="//admin.cn/static/<?php echo request()->module();?>/css/login.css">
</head>
<body>
<div id="app" v-cloak>

<div class="bg">
	<div class="main">
		<div class="title">KE 后台登录</div>
		<el-form :model="form" :rules="rules" ref="ruleForm" label-width="100px">
		
		  <el-form-item label="登录名" prop="user">
		    <el-input v-model="form.user" @keyup.enter.native="onLogin"></el-input>
		  </el-form-item>
		
		  <el-form-item label="密码" prop="pass">
		    <el-input v-model="form.pass" @keyup.enter.native="onLogin" type="password"></el-input>
		  </el-form-item>

		  <el-form-item>
		    <el-button type="primary" @click="onLogin">登录</el-button>
		  </el-form-item>
		</el-form>
		<div class="copyright">
			<p>KE 通用后台</p>
		</div>
	</div>
</div>


</div>


<script src="//unpkg.com/vue@2.5.9/dist/vue.js"></script>
<script src="//unpkg.com/axios@0.14.0/dist/axios.min.js"></script>
<script src="//unpkg.com/element-ui@2.0.7/lib/index.js"></script>
<script src="//admin.cn/static/js/ke.js"></script>
<script>ke.init({<?php if(isset($__K_TO_VUE_URLS)){echo 'map:'.json_encode($__K_TO_VUE_URLS);}else{echo 'map:{ }';}if(isset($list)):?>,list:<?php echo (is_array($list) ? json_encode($list) : $list);endif;if(isset($data)):?>,data:<?php echo (is_array($data) ? json_encode($data) : $data);endif;?> })</script>
<script src="//admin.cn/static/<?php echo request()->module();?>/module/<?php echo config('modulejs');?>.js?v=<?php echo $_SERVER['REQUEST_TIME'];?>"></script>
</body>
</html>