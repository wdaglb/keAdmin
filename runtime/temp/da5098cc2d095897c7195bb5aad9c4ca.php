<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"D:\web\UPUPW_AP5.6\vhosts\keAdmin\public/../application/admin\view\user\lists.html";i:1512662278;s:78:"D:\web\UPUPW_AP5.6\vhosts\keAdmin\public/../application/admin\view\layout.html";i:1512829479;}*/ ?>
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

<?php $__K_TO_VUE_URLS['create']=url('create');$__K_TO_VUE_URLS['edit']=url('edit');$__K_TO_VUE_URLS['delete']=url('delete');$__K_TO_VUE_URLS['money']=url('money');$__K_TO_VUE_URLS['integral']=url('integral');?>
<div class="row">
	<div class="title">会员管理</div>
</div>
<div class="margin-li">

  <!-- 筛选框 start -->
  <el-form :inline="true" :model="search" size="mini">


    <el-form-item label="关键词">
      <el-input v-model="search.key" @keyup.enter.native="onSearch" placeholder="ID/账号/昵称"></el-input>
    </el-form-item>


    <el-form-item label="性别">
      <el-select v-model="search.sex" style="width:80px">
        <el-option :value="-1" label="全部"></el-option>
        <el-option :value="0" label="女"></el-option>
        <el-option :value="1" label="男"></el-option>
      </el-select>
    </el-form-item>

    <el-form-item label="状态">
      <el-select v-model="search.status" style="width:80px">
        <el-option :value="-1" label="全部"></el-option>
        <el-option :value="0" label="正常"></el-option>
        <el-option :value="1" label="锁定"></el-option>
      </el-select>
    </el-form-item>

    <el-form-item label="年龄段" class="input-duan">
      <el-form-item>
        <el-input v-model="search.age[0]" @keyup.enter.native="onSearch"></el-input>
        -
        <el-input v-model="search.age[1]" @keyup.enter.native="onSearch"></el-input>
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
      <el-table-column prop="id" label="UID" width="80" align="center">
  	</el-table-column>
    <el-table-column prop="group" label="用户组" width="100">
    	</el-table-column>
    <el-table-column prop="user" label="登录账号">
      </el-table-column>
    <el-table-column prop="nick" label="昵称">
      </el-table-column>
    <el-table-column label="性别" width="50" align="center">
      <template slot-scope="item">
        {{ item.row.sex==0 ? '女' : '男'}}
      </template>
      </el-table-column>
    <el-table-column prop="age" label="年龄" width="50" align="center">
      </el-table-column>
    <el-table-column prop="update_time" label="最后活跃" width="160">
      </el-table-column>
    <el-table-column prop="create_time" label="注册时间" width="160">
      </el-table-column>
    <el-table-column prop="money" label="余额" width="80" align="center">
      </el-table-column>
    <el-table-column prop="integral" label="积分" width="80" align="center">
      </el-table-column>
    <el-table-column label="状态" width="80" align="center">
      <template slot-scope="item">
        <el-tag type="info" v-if="item.row.status == 0">正常</el-tag>
        <el-tag type="danger" v-else>锁定</el-tag>
      </template>
      </el-table-column>
    <el-table-column label="操作" width="80">
        <template slot-scope="scope">
          <el-dropdown trigger="click" @command="onUserAction">
            <span class="el-dropdown-link">
              操作<i class="el-icon-arrow-down el-icon--right"></i>
            </span>
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item :command="{ type: 'money', item:scope.row }">充值金额</el-dropdown-item>
              <el-dropdown-item :command="{ type: 'integral', item:scope.row }">充值积分</el-dropdown-item>
              <el-dropdown-item :command="{ type: 'edit', item:scope.row }">编辑</el-dropdown-item>
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