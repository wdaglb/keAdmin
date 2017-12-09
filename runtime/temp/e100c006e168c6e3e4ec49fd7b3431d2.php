<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"D:\web\UPUPW_AP5.6\vhosts\keAdmin\public/../application/admin\view\file\lists.html";i:1512837486;s:78:"D:\web\UPUPW_AP5.6\vhosts\keAdmin\public/../application/admin\view\layout.html";i:1512829479;}*/ ?>
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

<?php $__K_TO_VUE_URLS['create']=url('create');$__K_TO_VUE_URLS['edit']=url('edit');$__K_TO_VUE_URLS['delete']=url('delete');$__K_TO_VUE_URLS['money']=url('money');$__K_TO_VUE_URLS['integral']=url('integral');$__K_TO_VUE_URLS['attachment']=url('@attachment',[],'');?>
<div class="row">
	<div class="title">附件管理</div>
</div>
<div class="margin-li">

  <!-- 筛选框 start -->
  <el-form :inline="true" :model="search" size="mini">


    <el-form-item label="关键词">
      <el-input v-model="search.key" @keyup.enter.native="onSearch" placeholder="ID/文件名"></el-input>
    </el-form-item>

    <el-form-item label="状态">
      <el-select v-model="search.status" style="width:80px">
        <el-option :value="-1" label="全部"></el-option>
        <el-option :value="0" label="在用"></el-option>
        <el-option :value="1" label="未用"></el-option>
      </el-select>
    </el-form-item>

    <el-form-item label="上传时间">
      <el-date-picker
        v-model="search.date"
        type="daterange"
        align="right"
        unlink-panels
        range-separator="至"
        start-placeholder="开始日期"
        end-placeholder="结束日期">
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
      <el-table-column prop="id" label="FID">
  	</el-table-column>
    <el-table-column label="文件名">
      <template slot-scope="item">
        {{ item.row.names }}

        <el-popover
          placement="right"
          trigger="click"
          :content="map.attachment + '?id=' + item.row.id">
          <el-button type="text" slot="reference">查看地址</el-button>
        </el-popover>


        <el-popover
          placement="right"
          trigger="click"
          :content="item.row.srcs">
          <el-button type="text" slot="reference">保存位置</el-button>
        </el-popover>
        
      </template>
    	</el-table-column>
    <el-table-column prop="mime" label="MIME" width="160" align="center">
      </el-table-column>
    <el-table-column prop="uploadDate" label="上传时间" width="120" align="center">
      </el-table-column>
    <el-table-column label="状态" width="80" align="center">
      <template slot-scope="item">
        <el-tag type="danger" v-if="item.row.status == 0">未用</el-tag>
        <el-tag type="info" v-else>在用</el-tag>
      </template>
      </el-table-column>
    <el-table-column label="操作" width="80">
        <template slot-scope="scope">
          <el-dropdown trigger="click" @command="onUserAction">
            <span class="el-dropdown-link">
              操作<i class="el-icon-arrow-down el-icon--right"></i>
            </span>
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item :command="{ type: 'edit', item:scope.row }">修改文件</el-dropdown-item>
              <el-dropdown-item :command="{ type: 'move', item:scope.row }">移动</el-dropdown-item>
              <el-dropdown-item :command="{ type: 'delete', item:scope.row }">删除</el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
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

<!-- 充值窗口 start -->
<el-dialog :title="dialog.title" :visible.sync="dialog.status"
    :close-on-click-modal="false"
    width="400px"
    @close="onDialogResetFields"
    @before-close="onDialogResetFields">
  <el-form :model="dialog.form" :rules="dialog.rules" ref="dialogForm">
    <el-form-item :label="dialog.label" prop="value" label-width="60px">
      <el-input v-model="dialog.form.value" auto-complete="off"></el-input>
    </el-form-item>
  </el-form>
  <div slot="footer" class="dialog-footer">
    <el-button @click="onDialogSubmit(0)">取 消</el-button>
    <el-button type="primary" @click="onDialogSubmit(1)">确 定</el-button>
  </div>
</el-dialog>
<!-- 充值窗口 end -->

</div>


<script src="//unpkg.com/vue@2.5.9/dist/vue.js"></script>
<script src="//unpkg.com/axios@0.14.0/dist/axios.min.js"></script>
<script src="//unpkg.com/element-ui@2.0.7/lib/index.js"></script>
<script src="//admin.cn/static/js/ke.js"></script>
<script>ke.init({<?php if(isset($__K_TO_VUE_URLS)){echo 'map:'.json_encode($__K_TO_VUE_URLS);}else{echo 'map:{ }';}if(isset($list)):?>,list:<?php echo (is_array($list) ? json_encode($list) : $list);endif;if(isset($data)):?>,data:<?php echo (is_array($data) ? json_encode($data) : $data);endif;?> })</script>
<script src="//admin.cn/static/<?php echo request()->module();?>/module/<?php echo config('modulejs');?>.js?v=<?php echo $_SERVER['REQUEST_TIME'];?>"></script>
</body>
</html>