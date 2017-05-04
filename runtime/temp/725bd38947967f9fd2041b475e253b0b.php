<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"E:\PYS\mengchong\public/../application/admin\view\service\show.html";i:1493259896;}*/ ?>
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
<form method="post" action="">
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 商家管理</strong></div>
    <div class="padding border-bottom">
      <ul class="search">
        <li>
        <a href="<?php echo url('service/get',['id'=>2]); ?>">sfsdfsfsd </a>
          <button type="button"  class="button border-green" id="checkall"><span class="icon-check"></span> 全选</button>
          <button type="button" class="button border-red" onclick="DelSelect()"><span class="icon-trash-o"></span> 批量删除</button>
        </li>
      </ul>
    </div>
    <table class="table table-hover text-center">
      <tr>
        <th width="120">ID</th>
        <th>商家名称</th>       
        <th>商家地址</th>
        <th>详细地址</th>
        <th>商户电话</th>
        <th>营业时间</th>
         <th width="120">停车信息</th>
         <th width="120">停车信息</th>
        <th width="120" >商户简介</th>
        <th>商户销量</th>
        <th>商户照片</th>
        <th>操作</th>       
      </tr>  
      <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$shop): $mod = ($i % 2 );++$i;?>    
        <tr>
          <td><input type="checkbox" name="id[]" value="<?php echo $shop['mid']; ?>" id="<?php echo $shop['mid']; ?>" />
            <?php echo $shop['mid']; ?></td>
          <td><?php echo $shop['mname']; ?></td>
          <td><?php echo $shop['maddress']; ?></td>
          <td><?php echo $shop['mmessage']; ?></td>
          <td><?php echo $shop['mtel']; ?></td>
          <td><?php echo $shop['mtime']; ?></td>
          <td><?php echo $shop['stopcar']; ?></td>
          <td><?php echo $shop['wifi']; ?></td>
          <td><?php echo $shop['mcontent']; ?></td>
          <td><?php echo $shop['xiaoliang']; ?></td>
          <td><img src="__ROOT__/uploads/<?php echo $shop['img_path']; ?>" style="width: 100px;height: 100px;"></td>
          <td><div class="button-group"> <a class="button border-red" href="javascript:void(0)" onclick="return del(<?php echo $shop['mid']; ?>)"><span class="icon-trash-o"></span>删除</a> </div></td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
       
          
      
      <tr>

        <td colspan="8">
        <div class="pagelist"> 

      <!--   <a href="">上一页</a> 
        <span class="current">1</span><a href="">2</a><a href="">3</a>

        <a href="">下一页</a>
        <a href="">尾页</a> -->
  <?php echo $list->render(); ?>
        </div></td>
      </tr>
    </table>
  
  </div>
</form>
<script type="text/javascript">

function del(id){
	if(confirm("您确定要删除吗?")){	
    Delall(id);
   


	}
}

$("#checkall").click(function(){ 
  $("input[name='id[]']").each(function(){
	  if (this.checked) {
		  this.checked = false;
	  }
	  else {
		  this.checked = true;
	  }
  });
})

function DelSelect(){
	var Checkbox=false;
  var id = '';
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
      id = id+$(this).val()+',';
		Checkbox=true;	
	  }
	});
	if (Checkbox){
		var t=confirm("您确认要删除选中的内容吗？");
		if (t==false) return false;
    Delall(id);

	}
	else{
		alert("请选择您要删除的内容!");
		return false;
	}
}


function Delall(id){
  $.ajax({
    type:'post',
    url:"<?php echo url('service/dell'); ?>",
    data:{id:id},
    dataType:'json',
    success:function(msg){
      if(msg.status == 1){
        ids = msg.ids.split(',');
        for(var i=0; i<ids.length;i++){
           $("#"+ids[i]).parent().parent().remove();
        }
       location.reload();

 





      }else{
        alert('删除失败！！！！');
      }
    }

  })

}
</script>
</body></html>