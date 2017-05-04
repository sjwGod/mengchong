<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:66:"E:\PYS\mengchong\public/../application/admin\view\service\add.html";i:1493259896;}*/ ?>
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
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>增加服务</strong></div>
  <div class="body-content">
    <form action="shopadd" enctype="multipart/form-data"  class="form-x"  method="post">

    <!-- <input type="hidden" name="__token__" value="<?php echo \think\Request::instance()->token(); ?>" /> -->

      <div class="form-group">
        <div class="label">
          <label>商户名称：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="" name="mname" data-validate="required:请输入商家名称" />
          <div class="tips"></div>
        </div>   
      </div>

      <div class="form-group">
        <div class="label">
          <label>商户电话：</label>0
        </div>
        <div class="field">
          <input type="text" class="input w50" value="" name="mtel" data-validate="required:请输入商家手机号" />
          <div class="tips"></div>
        </div>   
      </div>

       <div class="form-group">
        <div class="label">
          <label>商户地址：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="" name="maddress" data-validate="required:请输入商户地址" />
          <div class="tips"></div>
        </div>   
      </div>

      <div class="form-group">
        <div class="label">
          <label>详细地址：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="" name="mmessage" data-validate="required:请输入商家详细地址：" />
          <div class="tips"></div>
        </div>   
      </div>

       <div class="form-group">
        <div class="label">
          <label>营业时间</label>
        </div>
        <div class="field">
          <input type="date" class="input w50" value="" name="mtime" data-validate="required:请输入营业时间" />
          <div class="tips"></div>
        </div>   
      </div>


      <div class="form-group">
        <div class="label">
          <label>店铺图片：</label>
        </div>
        <div class="field">
        
          <input type="file" name="image" class="button bg-blue margin-left" id="image1" value="+ 浏览上传"  style="float:left;">
          <div class="tipss">图片尺寸：500*500</div>
        </div>
      </div>     
      
       <div class="form-group">
          <div class="label">
            <label>停车信息：</label>
          </div>
          <div class="field" style="padding-top:8px;"> 
            免费停车 <input id="ishome"  type="radio" value="免费停车" name="stopcar" />
            无 <input id="isvouch"  type="radio" value="无" name="stopcar"/>
          </div>
        </div>

      <div class="form-group">
          <div class="label">
            <label>免费wifi：</label>
          </div>
          <div class="field" style="padding-top:8px;"> 
            免费wifi <input id="ishome"  type="radio" value="免费wifi" name="wifi" />
            无 <input id="isvouch"  type="radio" value="无" name="wifi"/>
          </div>
        </div>

       <div class="form-group">
        <div class="label">
          <label>销量：</label>
        </div>
        <div class="field">
          <input type="date" class="input w50" value="" name="xiaoliang" data-validate="required:请输入销量" />
          <div class="tips"></div>
        </div>   
      </div>
     
      
      <div class="form-group">
        <div class="label">
          <label>商家描述：</label>
        </div>
        <div class="field">
          <textarea class="input" name="mcontent" style=" height:90px;"></textarea>
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

</body></html>