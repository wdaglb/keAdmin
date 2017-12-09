<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:83:"D:\web\UPUPW_AP5.6\vhosts\keAdmin\public/../application/admin\view\user\submit.html";i:1512834502;s:78:"D:\web\UPUPW_AP5.6\vhosts\keAdmin\public/../application/admin\view\layout.html";i:1512829479;}*/ ?>
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
    
<style type="text/css">
  .avatar-uploader .el-upload {
    border: 1px dashed #d9d9d9;
    border-radius: 6px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
  }
  .avatar-uploader .el-upload:hover {
    border-color: #409EFF;
  }
  .avatar-uploader-icon {
    font-size: 28px;
    color: #8c939d;
    width: 128px;
    height: 128px;
    line-height: 128px;
    text-align: center;
  }
  .avatar {
    width: 128px;
    height: 128px;
    display: block;
  }
</style>

</head>
<body>
<div id="app" v-cloak>

<?php $__K_TO_VUE_URLS['lists']=url('lists');$__K_TO_VUE_URLS['uploadimg']=url('uploadimg');?>
<div class="row">
	<div class="title">{{ title }}</div>
	<div class="nav">
		<el-button @click="maps('lists')" size="small">返回列表</el-button>
	</div>
</div>

<el-row>
  <el-col :span="16">
	<el-form :model="form" :rules="rules" ref="form" label-width="160px">
	  <el-form-item label="头像" prop="user">
		<el-upload
		  class="avatar-uploader"
		  :action="map.uploadimg"
		  :show-file-list="false"
		  :http-request="onUploadStart">
		  <img v-if="headimg" :src="headimg" class="avatar">
		  <i v-else class="el-icon-plus avatar-uploader-icon"></i>
		</el-upload>
	  </el-form-item>

	  <el-form-item label="会员账号" prop="user">
	    <el-input v-model="form.user"></el-input>
	  </el-form-item>

	  <el-form-item label="会员昵称" prop="nick">
	    <el-input v-model="form.nick"></el-input>
	  </el-form-item>

	  <el-form-item label="登录密码" prop="pass">
	    <el-input v-model="form.pass" placeholder="如不修改请留空"></el-input>
	  </el-form-item>

	  <el-form-item label="积分" prop="integral">
	  	<el-input-number v-model="form.integral" v-if="form.id == 0"></el-input-number>
	  	<el-tag v-else>{{ form.integral }}</el-tag>
	  </el-form-item>

	  <el-form-item label="金额" prop="money">
	  	<el-input-number v-model="form.money" v-if="form.id == 0"></el-input-number>
	  	<el-tag v-else>{{ form.money }}</el-tag>
	  </el-form-item>

	  <el-form-item label="状态">
	      <el-radio v-model="form.status" :label="0">正常</el-radio>
  		  <el-radio v-model="form.status" :label="1">锁定</el-radio>
	  </el-form-item>

	  <el-form-item label="性别">
	      <el-radio v-model="form.sex" :label="0">女</el-radio>
  		  <el-radio v-model="form.sex" :label="1">男</el-radio>
	  </el-form-item>

	  <el-form-item label="年龄" prop="age">
	    <el-input v-model="form.age" style="width:100px"></el-input>
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