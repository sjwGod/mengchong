<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"E:\PYS\mengchong\public/../application/index\view\service\index.html";i:1493005418;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
	
		<meta charset="utf-8" />
		<title></title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <link rel="stylesheet" type="text/css" href="__ROOT__/css/style.css"/>
	    <script src="__ROOT__/js/swiper-3.4.0.min.js"></script>
	    <script src="__ROOT__/js/jquery-3.1.1.js"></script>
	</head>
	<body>
		<div class="box">
			<header>
				<div class="h_left">
					<a href="<?php echo url('index/index'); ?>">返回首页</a>
				</div>
				<div class="h_center">
					<input type="text"  placeholder="洗澡"/>
				</div>
				<div class="h_right">
					<a href="<?php echo url('index/personal'); ?>"><img src="__ROOT__/images/service/1_03.png"/></a>
				</div>
			</header>
			<section>
				<div class="banner">
					<div class="swiper-container">
				     <div class="swiper-wrapper">
				        <div class="swiper-slide"><img src="__ROOT__/images/service/1_101.jpg"/></div>
				        <div class="swiper-slide"><img src="__ROOT__/images/service/1_102.jpg"/></div>
				        <div class="swiper-slide"><img src="__ROOT__/images/service/1_103.jpg"/></div>
				        <div class="swiper-slide"><img src="__ROOT__/images/service/1_104.jpg"/></div>
				        <div class="swiper-slide"><img src="__ROOT__/images/service/1_105.jpg"/></div>
				        <div class="swiper-slide"><img src="__ROOT__/images/service/1_106.jpg"/></div>
				    </div>
				</div>
				</div>
				<div class="title">
					<div class="t_l">
					     <p>北京市海淀区软件园...</p>
					</div>
					<div class="t_r">
						<span>查看;历史定位></span>
					</div>
				</div>
				<div class="tab">
					<ul>
						<li class="active">
							<a href="javascript:;">狗狗生活服务</a>
						</li>
						<li>
							<a href="javascript:;">猫咪生活服务</a>
						</li>
					</ul>
				</div>
				<div class="content">
					<dl>
					    <a href="lists.html">
						<dt><img src="__ROOT__/images/service/1_13.png"/></dt>
						<dd>洗护</dd>
						</a>
					</dl>
					<dl>
					    <a href="lists.html">
						<dt><img src="__ROOT__/images/service/1_15.png"/></dt>
						<dd>造型</dd>
						</a>
					</dl>
					<dl><a href="lists.html">
						<dt><img src="__ROOT__/images/service/1_19.png"/></dt>
						<dd>寄样</dd></a>
					</dl>
					<dl><a href="lists.html">
						<dt><img src="__ROOT__/images/service/1_25.png"/></dt>
						<dd>体检</dd></a>
					</dl>
				</div>
				<div class="content_t">
					<dl><a href="lists.html">
						<dt><img src="__ROOT__/images/service/1_26.png"/></dt>
						<dd>医疗</dd></a>
					</dl>
					<dl><a href="lists.html">
						<dt><img src="__ROOT__/images/service/1_27.png"/></dt>
						<dd>摄影</dd></a>
					</dl>
					<dl><a href="lists.html">
						<dt><img src="__ROOT__/images/service/1_17.png"/></dt>
						<dd>绝育</dd></a>
					</dl>
					<dl><a href="lists.html">
						<dt><img src="__ROOT__/images/service/1_28.png"/></dt>
						<dd>更多</dd></a>
					</dl>
				</div>
				<div class="jieshao">
					<div class="j_l">
					  <h2>附近推荐</h2>
					</div>
					<span>查看更多</span>
				</div>
				<?php foreach($data as $k=>$v){?>
				<a href="<?php echo url('service/show',['id'=>$v['mid']]); ?>">
				<div class="list">
					<dl>
						<dt><img src="__ROOT__/images/service/2_03.png"/></dt>
						<dd>
							<h2><?php echo $v['mname']?>(<?php echo $v['maddress']?>)</h2>
							<p>
							<img src="__ROOT__/images/service/2_06.png"/>
							<img src="__ROOT__/images/service/2_06.png"/>
							<img src="__ROOT__/images/service/2_06.png"/>
							<img src="__ROOT__/images/service/2_06.png"/>
							<img src="__ROOT__/images/service/2_06.png"/>
							<img src="__ROOT__/images/service/2_06.png"/>
							</p>
							<span>销量<?php echo $v['xiaoliang']?></span>
			               <ul>
			               	<li><img src="__ROOT__/images/service/2_15.png" alt="" /><p>小拍摄的萨克巨大</p></li>
			               	<li><img src="__ROOT__/images/service/2_18.png"/><p>是放的规划设计恢复到</p></li>
			               </ul>
						</dd>
					</dl>
				</div>
				</a>
				<?php }?>
	</body>
	<script> 
	var mySwiper = new Swiper('.swiper-container',{
	autoplay : 3000,
	speed:300,
	})
	   $(".tab ul li").click(function(){
	   	$(this).addClass('active').siblings().removeClass('active');
	   })
</script>
</html>
