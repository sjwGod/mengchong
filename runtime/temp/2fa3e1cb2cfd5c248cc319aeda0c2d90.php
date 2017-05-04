<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"E:\PYS\mengchong\public/../application/admin\view\bbs\examreply.html";i:1493206134;}*/ ?>
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
    <div class="panel-head"><strong class="icon-reorder"> 评论管理</strong></div>
    <div class="padding border-bottom">
      <ul class="search">
        <li>
          <button type="button"  class="button border-green" id="checkall"><span class="icon-check"></span> 全选</button>
            <!--<div class="button-group" > <a class="button border-green " href="javascript:void(0)" id="exam"> 审核通过</a> </div>-->
            <div class="button-group" > <a class="button border-red " href="javascript:void(0)" id="delall"><span class="icon-trash-o"></span> 批量删除</a> </div>
        </li>
      </ul>
    </div>
    <table class="table table-hover text-center">
      <tr>
        <th width="120">ID</th>
        <th>评论人</th>
        <th width="50%">内容</th>
         <th width="120">发帖时间</th>
        <th>操作</th>       
      </tr>
      <?php foreach($replydata as $val): ?>
        <tr valid="<?php echo $val['rid']; ?>">
          <td><input type="checkbox" name="id[]" value="<?php echo $val['rid']; ?>" />
            <?php echo $val['rid']; ?></td>
          <td><?php echo $val['rname']; ?></td>
          <td><?php echo $val['rcontents']; ?></td>
          <td><?php echo $val['rtime']; ?></td>
          <td><div class="button-group" > <a class="button border-red del" href="javascript:void(0)" ><span class="icon-trash-o"></span> 删除</a> </div></td>
        </tr>
      <?php endforeach; ?>
      <tr>
        <td colspan="8"><div class="pagelist"> <a href="reply?page=<?php echo $up; ?>">上一页</a><?php $__FOR_START_25488__=1;$__FOR_END_25488__=count($pageshow)+1;for($i=$__FOR_START_25488__;$i < $__FOR_END_25488__;$i+=1){ ?><a href="reply?page=<?php echo $i; ?>"><?php echo $i; ?></a><?php } ?><a href="reply?page=<?php echo $down; ?>">下一页</a></div></td>
      </tr>
    </table>
  </div>
</form>
<script type="text/javascript">

//单个删除
$(".del").click(function (){
    var id= $(this).parents('tr').attr('valid');
    var obj=$(this);
    $.ajax({
        type:'post',
        url:"<?php echo url('delreply'); ?>",
        data:{
            id:id
        },
        success:function (msg) {
            if(msg==1){
                obj.parents('tr').remove()
            }
        }

    })
})

//全选反选
    $("#checkall").click(function(){
  $("input[name='id[]']").each(function(){
	  if (this.checked) {
		  this.checked = false;
	  }
	  else {
		  this.checked = true;
	  }
  });
});

//点击批删
$('#delall').click(function () {
    var check=$("input[name='id[]']");//找到
    var ids='';//定义一个空的
    for(var i=0;i<=check.length;i++){
        if(check.eq(i).prop('checked')){
            ids+=','+check.eq(i).val();
        }
    }
    ids=ids.substr(1);//拿到要删除数据id
   // alert(ids);
    $.ajax({
        type:'post',
        url:"<?php echo url('delsreply'); ?>",
        data:{
            ids:ids
        },
        dataType:"json",
        success:function (msg) {
          //  alert(msg)
            for(i=0;i<check.length;i++){
                for(j=0;j<msg.length;j++){
                    if(check.eq(i).val()==msg[j]){
                        check.eq(i).parent().parent().remove();
                    }
                }
            }
        }

    })

})
    //点击批审
$('#exam').click(function () {
    var check=$("input[name='id[]']");//找到
    var ids='';//定义一个空的
    for(var i=0;i<=check.length;i++){
        if(check.eq(i).prop('checked')){
            ids+=','+check.eq(i).val();
        }
    }
    ids=ids.substr(1);//拿到要删除数据id
    // alert(ids);
    $.ajax({
        type:'post',
        url:"<?php echo url('examreply'); ?>",
        data:{
            ids:ids
        },
        dataType:"json",
        success:function (msg) {
            //  alert(msg)
            for(i=0;i<check.length;i++){
                for(j=0;j<msg.length;j++){
                    if(check.eq(i).val()==msg[j]){
                        check.eq(i).parent().parent().remove();
                    }
                }
            }
        }

    })

})

</script>
</body></html>