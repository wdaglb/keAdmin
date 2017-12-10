<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:88:"D:\web\UPUPW_AP5.6\vhosts\keAdmin\public/../application/admin\view\user\group\lists.html";i:1512654188;s:78:"D:\web\UPUPW_AP5.6\vhosts\keAdmin\public/../application/admin\view\layout.html";i:1512829479;}*/ ?>
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

<?php $__K_TO_VUE_URLS['create']=url('create');$__K_TO_VUE_URLS['edit']=url('edit');$__K_TO_VUE_URLS['delete']=url('delete');$__K_TO_VUE_URLS['update']=url('update');?>
<div class="row">
	<div class="title">会员组管理</div>
	<div class="nav">
    <el-button type="info" size="mini" @click="maps('create')"><i :class="iconFormat('plus')"></i>&nbsp;添加会员组</el-button>
    <el-button type="info" size="mini" @click="onUpdateUserInfo"><i :class="iconFormat('refresh')"></i>&nbsp;更新用户会员组数据</el-button>
	</div>
</div>
<div class="margin-li">

  <!-- 筛选框 start -->
  <el-form :inline="true" :model="search" size="mini">


    <el-form-item label="关键词">
      <el-input v-model="search.key" @keyup.enter.native="onSearch" placeholder="组名"></el-input>
    </el-form-item>

    <el-form-item>
      <el-button type="primary" @click="onSearch">筛选</el-button>
    </el-form-item>
  </el-form>
  <!-- 筛选框 end -->


  <el-table
    v-loading="loadList"
    :data="list"
    border
    stripe>
      <el-table-column prop="id" label="ID" width="80">
  	</el-table-column>
    <el-table-column prop="name" label="会员组名称">
    	</el-table-column>
    <el-table-column prop="users_count" label="会员数" width="100">
      </el-table-column>
    <el-table-column prop="integral" label="所需积分" width="100">
      </el-table-column>
    <el-table-column label="操作" width="160">
        <template slot-scope="scope">
          <el-button size="mini"
            @click="maps('edit',{ id:scope.row.id })">编辑</el-button>
          <el-button size="mini" type="danger"
            @click="onDelete(scope.row.id)">删除</el-button>
        </template>
      </el-table-column>

  </el-table>




  <!-- 分页 start -->
  <div class="block">
    <el-pagination
      layout="sizes, total, prev, pager, next, jumper"
      :page-sizes="[10, 20, 50, 100]"
      :page-size="size"
      :total="total"
      @size-change="tabSize"
      @current-change="loadLists">
    </el-pagination>
  </div>
  <!-- 分页 end -->

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