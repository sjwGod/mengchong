<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"E:\PYS\mengchong\public/../application/admin\view\rbac\role_add.html";i:1493105693;}*/ ?>
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
        <form method="post" class="form-x" action="<?php echo url('rbac/role_add'); ?>">
            <div class="form-group">
                <div class="label">
                    <label>角色名称：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" value="" name="rname" />
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>角色描述：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" value="" name="rcontent" />
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>是否启用：</label>
                </div>
                <div class="field">
                    <div class="button-group radio">

                        <label class="button active">
                            <span class="icon icon-check"></span>
                            <input name="status" value="1" type="radio" checked="checked">是
                        </label>

                        <label class="button active"><span class="icon icon-times"></span>
                            <input name="status" value="0"  type="radio" checked="checked">否
                        </label>
                    </div>
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