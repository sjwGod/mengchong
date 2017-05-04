<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"E:\PYS\mengchong\public/../application/admin\view\show\brand.html";i:1493168955;}*/ ?>
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
  <form action="<?php echo Url('brandPro'); ?>" method="post" enctype="multipart/form-data" >
    <table>
      <tr>
        <td>品牌名称：</td>
        <td><input type="text" name="brand_name"></td>
      </tr>
      <tr>
        <td>品牌Logo：</td>
        <td><input type="file" name="myfile"></td>
      </tr>
      <tr>
        <td>品牌简介：</td>
        <td><textarea name="brand_desc" cols="30" rows="10"></textarea></td>
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