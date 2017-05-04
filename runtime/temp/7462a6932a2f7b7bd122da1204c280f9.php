<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"E:\PYS\mengchong\public/../application/admin\view\index\pass.html";i:1493206134;}*/ ?>
<?php
use think\Session;

?>
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
  <div class="panel-head"><strong><span class="icon-key"></span> 修改会员密码</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="<?php echo url('index/updatepwd'); ?>">
      <div class="form-group">
        <div class="label">
          <label for="sitename">管理员帐号：</label>
        </div>
        <div class="field">
          <label style="line-height:33px;">
           <?php $session = Session::get('uname'); echo $session[1]; ?>
          </label>
        </div>
      </div>      
      <div class="form-group">
        <div class="label">
          <label for="sitename">原始密码：</label>
        </div>
        <div class="field">
          <input type="password" class="input w50" id="upwd" name="upwd" size="50" placeholder="请输入原始密码" data-validate="required:请输入原始密码" />       
        </div>
      </div>      
      <div class="form-group">
        <div class="label">
          <label for="sitename">新密码：</label>
        </div>
        <div class="field">
          <input type="password" class="input w50" name="npwd" id="npwd" size="50" placeholder="请输入新密码" data-validate="required:请输入新密码,length#>=5:新密码不能小于5位" />         
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label for="sitename">确认新密码：</label>
        </div>
        <div class="field">
          <input type="password" class="input w50" name="nspwd" id="nspwd" size="50" placeholder="请再次输入新密码" data-validate="required:请再次输入新密码,repeat#npwd:两次输入的密码不一致" />          
        </div>
      </div>
      
      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit" id="butt"> 提交</button>   
        </div>
      </div>      
    </form>
  </div>
</div>
</body>
</html>
<script>
  // $('#butt').click(function(){
  //   var upwd = $('#upwd').val();
  //   var npwd = $('#npwd').val();
  //   var nspwd = $('#nspwd').val();
  //   // if (npwd != nspwd) 
  //   //   {
  //   //     alert('密码输入不一致！');
  //   //     return false;
  //   //   };
  //   $.ajax({
  //     type:'post',
  //     url:"<?php echo url('index/updatepwd'); ?>",
  //     data:{'upwd':upwd,'npwd':npwd,'nspwd':nspwd},
  //     success:function(msg){

  //     }
  //   })
  // })
</script>