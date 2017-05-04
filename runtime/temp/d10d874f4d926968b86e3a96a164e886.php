<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"E:\PYS\mengchong\public/../application/admin\view\show\goodslist.html";i:1493168955;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title></title>  
    <link rel="stylesheet" href="__ROOT__/css/pintuer.css">
    <link rel="stylesheet" href="__ROOT__/css/admin.css">
    <script src="__ROOT__/js/jquery.js"></script>
    <script src="__ROOT__/js/pintuer.js"></script>  
</head>
<body>
<form method="post" action="<?php echo Url('delgoods'); ?>">
<input type="hidden" class="goods_id" name="goods_id">
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 品牌管理</strong></div>
    <div class="padding border-bottom">
      <ul class="search">
        <li>
          <button type="button"  class="button border-green" id="checkall"><span class="icon-check"></span> 全选</button>
          <input type="submit" value="批量删除" class="submit button border-red">
        </li>
      </ul>
    </div>
    <table class="table table-hover text-center">
      <tr>
        <th width="120">编号</th>
        <th>姓名</th>       
        <th width="25%">内容</th>
        <th>Logo</th>
        <th>价格</th>
        <th>添加时间</th>
        <th>操作</th>       
      </tr> 
        <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
        <tr>
          <td><input type="checkbox" name="id[]" class="checkAll" goods_id="<?php echo $v['goods_id']; ?>" />
            <?php echo $v['goods_id']; ?></td>
          <td><?php echo $v['goods_name']; ?></td>     
          <td class="td" goods_id="<?php echo $v['goods_id']; ?>"><span class="click"><?php echo $v['goods_desc']; ?></span></td>
          <td><img src="http://omlcihjm9.bkt.clouddn.com/<?php echo $v['goods_img']; ?>" alt="" width="100"></td>
          <td><?php echo $v['price']; ?></td>
          <td><?php echo $v['add_time']; ?></td>
          <td><div class="button-group"> <a class="button border-red" href="<?php echo url('delgoods',['goods_id'=>$v['goods_id']]); ?>" ><span class="icon-trash-o"></span> 删除</a> </div></td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      <tr>
        <td colspan="8">
          <div class="pagelist"> 
            <a href="<?php echo url('goodslist',['page'=>$up]); ?>">上一页</a>

            <?php
              for($i=1;$i<=$total;$i++)
              {
                if($i == $page)
                {?>
                  <span class="current"><?php echo $page; ?></span>
                <?php }
                else
                {?>
                  <a href="<?php echo url('goodslist',['page'=>$i]); ?>"><?php echo $i; ?></a>
                <?php }
              }
            ?>

            <a href="<?php echo url('goodslist',['page'=>$down]); ?>">下一页</a>
          </div>
        </td>
      </tr>
    </table>
  </div>
</form>
<script type="text/javascript">
//全选全不选
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

//批删
  $('.submit').click(function()
  {
    var checkAll = $('.checkAll');
    var len = checkAll.length;
    var id = '';
    for(var i=0;i<len;i++)
    {
      if(checkAll.eq(i).prop('checked') == true)
      {
        id += ','+checkAll.eq(i).attr('goods_id');
      }
      
    }
    id = id.substr(1);
    $('.goods_id').val(id);
  })

  //即点即改
  $(document).on('click','.click',function()
  {
    var sp = $(this);
    var td = sp.parent();
    var val = sp.html();
    var goods_id = td.attr('goods_id');
    var textarea = $("<textarea>"+val+"</textarea>");
    td.html(textarea);
    //失去焦点后触发
    textarea.blur(function()
    {
      var new_val = $(this).val();
      if(new_val == val)
      {
        td.html("<span class='click'>"+val+"</span>");
      }
      else
      {
        //使用ajax修改
        $.post("<?php echo Url('up'); ?>",{goods_desc:new_val,goods_id:goods_id},function(msg)
        {
          if(msg == 1)
          {
            td.html("<span class='click'>"+new_val+"</span>");
          }
          else
          {
            td.html("<span class='click'>"+val+"</span>");
          }
        })
      }
    })
  })

</script>
</body></html>