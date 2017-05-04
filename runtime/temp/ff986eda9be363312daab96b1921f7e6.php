<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"E:\PYS\mengchong\public/../application/index\view\index\detail.html";i:1493168955;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimum-scale=1.0, maximum-scale=1.0">
<meta content="telephone=no" name="format-detection" />
<title>帮5买触屏版手机导购网站模板 - 文章正文</title>


<link rel="stylesheet" href="__ROOT__/css/wap/index.css" type="text/css" />
<script type="text/javascript" src="__ROOT__/js/jquery.min.js"></script>

<link rel="stylesheet" href="__ROOT__/css/wap/korea.css" />

</head>
<body>
    <div class="news">
        <div class="news-fixed">
            <!-- <span class="fl">&lt;</span> -->
            <a href="javascript:history.go(-1);" class="fl"></a>
            <h1>商品详情</h1>
        </div>
        <div class="news-article">
            <h2>欢迎来到萌宠商城商品详情中心</h2>
            <h3>宠物店加盟项目在国内市场已进入一个高速发展的时期。随着宠物数量的增长，庞大的宠物服务的消费需求不断扩大，对投资的需求也相对日趋旺盛，中国的宠物行业将迈上一个新的台阶。</h3>
            <div class="news-content" style="display: none">
            	<img src="__ROOT__/uploads/<?php echo $data['brand_logo']; ?>" width="100"><br /><br />
            	<div style="color:red;">品牌简介：<?php echo $data['brand_desc']; ?></div>
            </div>
        </div>
        	
	        <div class="news-recommend">
	        <center>
	            <div>
	            	<h3>商品图片：</h3>
	            	<img src="__ROOT__/uploads/<?php echo $data['goods_img']; ?>" width="100"/>
	            </div>
	            <div>
					<h3>商品名称：</h3>
					<h3 style="color:#279;"><?php echo $data['goods_name']; ?></h3>
	            </div>
	            <div>
					<h3>商品品牌：</h3>
					<h3 style="color:green;"><?php echo $data['brand_name']; ?></h3>
	            </div>
	            <div>
					<h3>商品价格：</h3>
					<h3 style="color:#541;"><?php echo $data['price']; ?></h3>
	            </div>
	            <div>
					<form action="<?php echo Url('cart'); ?>" method="post" >
						<input type="hidden" name="price" value="<?php echo $data['price']; ?>">
						<input type="hidden" name="goods_id" value="<?php echo $data['goods_id']; ?>">
						<tr>
							<td>请选择购买数量：</td>
							<td><input type="text" name="num" value="1" size="1"></td>
						</tr>
						<td>
							<td></td>
							<?php if($status == 0): ?>
							<td><input type="submit" value="加入购物车" disabled="disabled"></td>
							<span style="color: red;">你还没有登录，请登录后再加入购物车</span>
							<?php else: ?>
							<td><input type="submit" value="加入购物车"></td>
							<?php endif; ?>
						</td>
					</form>
	            </div>
	        </center>
	        </div>
        
    </div>
    <br>
    


<footer class="footer">
	<div class="top">
		
		
			<?php if($status == 0): ?>
			<a href="<?php echo url('login/login'); ?>" onClick="_gaq.push([ '_trackEvent', 'm.b5m.com', 'clicked', '登录' ]);">登录</a>|
			<a href="<?php echo url('login/reg'); ?>" onClick="_gaq.push([ '_trackEvent', 'm.b5m.com', 'clicked', '注册' ]);">注册</a>
			<a class="btn" href="#">Top</a>
			<?php else: ?>
			欢迎登录<span style="color:red;">萌宠商城</span>
			<a href="<?php echo url('login/login'); ?>" >退出账号</a>
			<?php endif; ?>
		
		<!-- <a href=""></a><a href=""></a><a class="btn" href="#">Top</a> -->
	</div>

	<p>Copyright&nbsp;&nbsp;&nbsp;萌宠商城 版权所有</p>
</footer>


<script src="__ROOT__/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript">
	$(function(){
		var kdiv = $(".news-content");
		kdiv.find('p').find("font").remove();
		kdiv.find("p").removeClass();//attr("class","");
		kdiv.find("p").attr("style","");
		kdiv.find("span").attr("style","");
		kdiv.find("img").each(function(){
			$(this).parents('p').addClass("tc");
			
		});
		kdiv.find("br").hide();
		kdiv.find("p").each(function(){
			if($(this).find("img").length > 0){
				var img = $(this).find("img");
				$(this).empty();
				$(this).append(img);
			}
			
		});
		kdiv.find("p").each(function(){
			var $this = $(this),
				txt = $this.html();
			if (/\[flash\]/g.test(txt)) $this.remove();
		});
		kdiv.show();
	});
</script>


</body>
</html>