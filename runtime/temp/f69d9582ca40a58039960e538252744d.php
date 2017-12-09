<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:83:"D:\web\UPUPW_AP5.6\vhosts\keAdmin\public/../application/admin\view\index\index.html";i:1512481786;s:77:"D:\web\UPUPW_AP5.6\vhosts\keAdmin\public/../application/admin\view\frame.html";i:1512829498;}*/ ?>
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
    <link rel="stylesheet" href="//admin.cn/static/<?php echo request()->module();?>/css/frame.css">
    
</head>
<body>
<?php $__K_TO_VUE_URLS['logout']=url('auth/logout',[],'.'.config('url_html_suffix'));$__K_TO_VUE_URLS['login']=url('auth/login',[],'.'.config('url_html_suffix'));$__K_TO_VUE_URLS['adminEditPass']=url('auth/pass',[],'.'.config('url_html_suffix'));?>
<div id="app" v-cloak>
	<div class="header" v-if="menulist">
		<div class="title">KE 后台管理</div>
		<ul class="nav">
			<li v-for="(item,index) in menulist" @click="onTopNav(index)">{{ item.title }}</li>
		</ul>
        <div class="pull-right">
            <el-dropdown class="right-nav" style="margin-right: 15px;"
                 @command="onCommand">
              <span class="el-dropdown-link" style="color:#f3f3f3">
                {{ admin.user }}&nbsp;<i class="el-icon-arrow-down el-icon--right"></i>
              </span>
              <el-dropdown-menu slot="dropdown">
                <el-dropdown-item command="editpass">修改密码</el-dropdown-item>
                <el-dropdown-item command="logout">退出登录</el-dropdown-item>
              </el-dropdown-menu>
            </el-dropdown>
        </div>
	</div>
    <div class="sidebar" v-if="menulist">
        <div class="title"><i :class="iconFormat('bars')"></i>&nbsp;菜单导航</div>
        <ul v-if="menulist[curr].children">
            <li v-for="item in menulist[curr].children" @click="onSidebar(item)"><i :class="iconFormat(item.icon)"></i>&nbsp;{{ item.title }}</li>
        </ul>
    </div>
    <div class="body">
	
<iframe class="iframe" :src="httpsrc"></iframe>


    </div>
</div>


<script src="//unpkg.com/vue@2.5.9/dist/vue.js"></script>
<script src="//unpkg.com/axios@0.14.0/dist/axios.min.js"></script>
<script src="//unpkg.com/element-ui@2.0.7/lib/index.js"></script>
<script src="//admin.cn/static/js/ke.js"></script>
<script>ke.init({<?php if(isset($__K_TO_VUE_URLS)){echo 'map:'.json_encode($__K_TO_VUE_URLS);}else{echo 'map:{ }';}if(isset($data)):?>,data:<?php echo (is_array($data) ? json_encode($data) : $data);endif;if(isset($menulist)):?>,menulist:<?php echo (is_array($menulist) ? json_encode($menulist) : $menulist);endif;if(isset($curr)):?>,curr:<?php echo (is_array($curr) ? json_encode($curr) : $curr);endif;?> })</script>
<script src="//admin.cn/static/<?php echo request()->module();?>/module/<?php echo config('modulejs');?>.js?v=<?php echo $_SERVER['REQUEST_TIME'];?>"></script>
</body>
</html>