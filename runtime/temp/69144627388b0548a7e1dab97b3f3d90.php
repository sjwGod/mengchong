<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"E:\PYS\mengchong\public/../application/admin\view\rbac\userRole.html";i:1493124893;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <base href="__ROOT__/admin/">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title></title>
    <link rel="stylesheet" href="css/pintuer.css">
    <link rel="stylesheet" href="css/admin.css">
    <script src="js/jquery.js"></script>
    <script src="js/pintuer.js"></script>
</head>
<body>
<div class="panel admin-panel">
    <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>添加角色</strong></div>
    <div class="body-content">
        <form method="post" class="form-x" action="<?php echo url('rbac/'); ?>">
            <div class="form-group">
                <div class="label">
                    <label>用户名：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" value="<?php echo $res['uname'];?>" name="uname" />
                    <input type="hidden" class="input w50" value="<?php echo $res['uid'];?>" name="uid" />
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>所属角色：</label>
                </div>
                <div class="field">
                    <?php foreach($role as $k=>$v){?>
                    <input type="checkbox" value="" name="" />
                    <?php echo $v['rname'];}?>
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label></label>
                </div>
                <div class="field">
                    <button class="button bg-main icon-check-square-o" type="submit"> 添加</button>
                </div>
            </div>
        </form>
    </div>
</div>

</body></html>