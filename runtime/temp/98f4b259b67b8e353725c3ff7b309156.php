<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"E:\PYS\mengchong\public/../application/admin\view\show\goods.html";i:1493168955;}*/ ?>
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
<script src="__ROOT__/js/jquery.min.js"></script>
<script src="__ROOT__/js/pintuer.js"></script>
</head>
<body>
<div class="panel admin-panel">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>增加内容</strong></div>
  <div class="body-content">
  <center>
  <form action="<?php echo Url('goodsPro'); ?>" method="post" enctype="multipart/form-data" >
    <table>
      <tr>
        <td>商品分类：</td>
        <td>
          <select name="c_id">
            <option value="">--请选择--</option>
            <?php if(is_array($category) || $category instanceof \think\Collection || $category instanceof \think\Paginator): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
            <option value="<?php echo $v['c_id']; ?>" <?php if($v['p_id'] == 0): ?>disabled="disabled"<?php endif; ?>>
              <?php
                echo str_repeat('--',$v['level']).$v['c_name'];
              ?>
            </option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </select>
        </td>
      </tr>

      <tr>
        <td>商品名称：</td>
        <td><input type="text" name="goods_name"></td>
      </tr>
      <tr>
        <td>品牌名称：</td>
        <td>
          <select name="brand_id">
            <option value="">--请选择--</option>
            <?php if(is_array($brand) || $brand instanceof \think\Collection || $brand instanceof \think\Paginator): $i = 0; $__LIST__ = $brand;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
            <option value="<?php echo $v['brand_id']; ?>"><?php echo $v['brand_name']; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>商品价格：</td>
        <td><input type="text" name="price"></td>
      </tr>
      <tr>
        <td>商品Logo：</td>
        <td><input type="file" name="myfile"></td>
      </tr>
      <tr>
        <td>商品简介：</td>
        <td><textarea name="goods_desc" cols="30" rows="10"></textarea></td>
      </tr>
      <tr>
        <td></td>
        <td><input type="submit" value="submit"></td>
      </tr>
    </table>
  </form>
  </center>
  </div>
</div>

</body></html> 