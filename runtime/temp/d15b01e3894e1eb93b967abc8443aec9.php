<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:90:"D:\web\UPUPW_AP5.6\vhosts\keAdmin\public/../application/admin\view\user\finance\lists.html";i:1512827820;s:78:"D:\web\UPUPW_AP5.6\vhosts\keAdmin\public/../application/admin\view\layout.html";i:1512829479;}*/ ?>
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

<?php $__K_TO_VUE_URLS['create']=url('create');$__K_TO_VUE_URLS['edit']=url('edit');$__K_TO_VUE_URLS['delete']=url('delete');$__K_TO_VUE_URLS['users']=url('user/edit',[],'.'.config('url_html_suffix'));?>
<div class="row">
	<div class="title">财务管理</div>
</div>
<div class="margin-li">

  <!-- 筛选框 start -->
  <el-form :inline="true" :model="search" size="mini">


    <el-form-item label="关键词">
      <el-input v-model="search.key" @keyup.enter.native="onSearch" placeholder="订单ID/会员ID"></el-input>
    </el-form-item>


    <el-form-item label="状态">
      <el-select v-model="search.status" style="width:100px">
        <el-option :value="-1" label="全部"></el-option>
        <el-option :value="0" label="未付款"></el-option>
        <el-option :value="-2" label="已关闭"></el-option>
        <el-option :value="1" label="已完成"></el-option>
      </el-select>
    </el-form-item>


    <el-form-item label="类型">
      <el-select v-model="search.types" style="width:80px">
        <el-option :value="-1" label="全部"></el-option>
        <el-option :value="0" label="金额"></el-option>
        <el-option :value="1" label="积分"></el-option>
      </el-select>
    </el-form-item>

    <el-form-item label="金额" class="input-duan">
      <el-form-item>
        <el-input v-model="search.money[0]" @keyup.enter.native="onSearch"></el-input>
        -
        <el-input v-model="search.money[1]" @keyup.enter.native="onSearch"></el-input>
      </el-form-item>
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
      <el-table-column prop="id" label="订单ID" width="300" align="center">
  	</el-table-column>
    <el-table-column label="会员ID" width="80" align="center">
      <template slot-scope="item">
        <a @click="maps('users',{id:item.row.user_id})">{{ item.row.user_id }}</a>
      </template>
      </el-table-column>
    <el-table-column prop="money" label="金额" width="80" align="center">
      </el-table-column>
    <el-table-column prop="create_time" label="操作时间" width="160">
      </el-table-column>
    <el-table-column prop="typesName" label="类型" width="80" align="center">
      </el-table-column>
    <el-table-column prop="payTypes" label="付款类型" width="120" align="center">
      </el-table-column>
    <el-table-column prop="status" label="状态" width="80" align="center">
      <template slot-scope="item">
        <span v-if="item.row.status == 0">未付款</span>
        <span v-else-if="item.row.status == 1">已完成</span>
        <span v-else-if="item.row.status == -2">已关闭</span>
      </template>
      </el-table-column>
    <el-table-column prop="desc" label="备注">
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