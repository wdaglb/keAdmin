<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:86:"D:\web\UPUPW_AP5.6\vhosts\keAdmin\public/../application/admin\view\auth\log\lists.html";i:1512645542;s:78:"D:\web\UPUPW_AP5.6\vhosts\keAdmin\public/../application/admin\view\layout.html";i:1512829479;}*/ ?>
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

<?php $__K_TO_VUE_URLS['create']=url('create');$__K_TO_VUE_URLS['edit']=url('edit');$__K_TO_VUE_URLS['delete']=url('delete');$__K_TO_VUE_URLS['manageEdit']=url('auth.manage/edit',[],'.'.config('url_html_suffix'));?>
<div class="row">
  <div class="title">管理操作日志</div>
  <div class="nav">
  </div>
</div>
<div class="margin-li">

  <!-- 筛选框 start -->
  <el-form :inline="true" :model="search" size="mini">


    <el-form-item label="只看">
      <el-input v-model="search.key" @keyup.enter.native="onSearch" placeholder="管理ID"></el-input>
    </el-form-item>


    <el-form-item label="日期">
      <el-date-picker
        v-model="search.date"
        align="right"
        type="daterange"
        start-placeholder="开始日期"
        end-placeholder="结束日期"
        format="yyyy/MM/dd"
        value-format="yyyy-MM-dd"
        :picker-options="dateQuick">
      </el-date-picker>
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
    <el-table-column prop="id" label="ActionID" width="240">
      </el-table-column>
    <el-table-column prop="user_id" label="管理ID" width="80">
      <template slot-scope="scope">
        <a @click="maps('manageEdit',{ id: scope.row.user_id })">{{ scope.row.user_id }}</a>
      </template>
      </el-table-column>
    <el-table-column prop="create_time" label="操作时间" width="160">
      </el-table-column>
    <el-table-column prop="desc" label="描述">
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