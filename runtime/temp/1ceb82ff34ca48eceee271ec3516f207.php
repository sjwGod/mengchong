<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"E:\PYS\mengchong\public/../application/admin\view\index\menu.html";i:1493259896;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="renderer" content="webkit">
<title></title>
<link rel="stylesheet" href="__ROOT__/admin/css/pintuer.css">
<link rel="stylesheet" href="__ROOT__/admin/css/admin.css">
<script src="__ROOT__/admin/js/jquery.js"></script>
<script src="__ROOT__/admin/js/pintuer.js"></script>
</head>
<body>
<div class="panel admin-panel">
  <div class="panel-head"><strong class="icon-reorder"> 菜单列表</strong></div>
  <div class="padding border-bottom">
    <button type="button" class="button border-yellow" onclick="window.location.href='#add'"><span class="icon-plus-square-o"></span> 添加菜单</button>
  </div>
  <table class="table table-hover text-center">
    <tr>
      <th width="5%">ID</th>
      <th width="15%">分类名称</th>
      <th width="10%">跳转链接</th>
      <th width="10%">操作</th>
    </tr>
    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?>
     <tr>
      <td><?php echo $user['id']; ?></td>
      <td align="left"><?php echo $user['name']; ?></td>
      <td><?php echo $user['url']; ?></td>
      <td><div class="button-group"> <a class="button border-main" href="cateedit.html"><span class="icon-edit"></span> 修改</a> <a class="button border-red" href="<?php echo url('Index/del',['id'=>$user['id']]); ?>" onclick="return del(1,2)"><span class="icon-trash-o"></span> 删除</a> </div></td>
      </tr>
            <?php if(is_array($user['child']) || $user['child'] instanceof \think\Collection || $user['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $user['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i;?>
             <tr>
              <td><?php echo $child['id']; ?></td>
              <td align="left">-------<?php echo $child['name']; ?></td>
              <td><?php echo $child['url']; ?></td>
              <td><div class="button-group"> <a class="button border-main" href="cateedit.html"><span class="icon-edit"></span> 修改</a> <a class="button border-red" href="<?php echo url('Index/del',['id'=>$child['id']]); ?>" onclick="return del(1,2)"><span class="icon-trash-o"></span> 删除</a> </div></td>
              </tr> 
           <?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>  
  </table>
</div>
<script type="text/javascript">
function del(id,mid){
	if(confirm("您确定要删除吗?注意：如果删除主菜单，子菜单将同样删除！！！")){			
		
	}
}
</script>
<div class="panel admin-panel margin-top">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>添加内容</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="menu">
      <div class="form-group">
        <div class="label">
          <label>分类等级：</label>
        </div>
        <div class="field">
          <select name="parent" class="input w50">
            <option value="0">         顶级</option>
             <?php if(is_array($cate) || $cate instanceof \think\Collection || $cate instanceof \think\Paginator): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?>
              <option value="<?php echo $user['id']; ?>">      <?php echo $user['name']; ?></option>
             <?php endforeach; endif; else: echo "" ;endif; ?>       
          </select>
          <div class="tips">如果为顶级url项则可以不填</div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>分类名称：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="name" />
          <div class="tips"></div>
        </div>
      </div>

        <div class="form-group">
        <div class="label">
          <label>跳转方法：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="url" />
          <div class="tips"></div>
        </div>
      </div>
      
  
    
      
      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
        </div>
      </div>
    </form>
  </div>
</div>
</body>
</html>