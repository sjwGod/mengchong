<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"E:\PYS\mengchong\public/../application/index\view\bbs\index.html";i:1493206134;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta name="format-detection" content="telephone=no" />
<link rel="apple-touch-startup-image" href="__ROOT__/qq/zn/icon.png" />
<link rel="apple-touch-icon" href="__ROOT__/qq/zn/icon57.png" />
<link rel="apple-touch-icon" sizes="72x72" href="__ROOT__/qq/zn/icon72.png" />
<link rel="apple-touch-icon" sizes="114x114" href="__ROOT__/qq/zn/icon114.png" />
<link rel="apple-touch-icon" sizes="144x144" href="__ROOT__/qq/zn/icon144.png" />
<link href="__ROOT__/qq/zn/style/common.css" rel="Stylesheet" type="text/css" />
<link href="__ROOT__/qq/zn/style/index.css" rel="Stylesheet" type="text/css" />
<title>萌宠管家 论坛首页</title>
<meta name="description" content="萌宠管家，为爱宠物的大家创建的交流中心" />
<meta name="keywords" content="萌宠管家" />
</head>
<body>
<!--头部-->

<script type="text/javascript" src="__ROOT__/qq/zn/script/zepto.min.js"></script>
<script type="text/javascript" src="__ROOT__/qq/zn/script/common.js"></script>
<script type="text/javascript" src="__ROOT__/qq/zn/script/index.js"></script>

<div id="dd_more">
	<a href="liebiao.html" class="dd_bt1 dd_bt">全部圈子</a>
	<a rel="nofollow" href="#" class="dd_bt2 dd_bt">我的圈圈</a>
	<a rel="nofollow" href="#" class="dd_bt3 dd_bt">我的好友</a>
	<a rel="nofollow" href="#" class="dd_bt4 dd_bt">退出登陆</a>
</div>
<div id="dd_msg">
	
		<script type="text/javascript" src="__ROOT__/qq/zn/script/msg.js"></script>
	
	<div class="msgLoading"></div>
	<p class="tC"><a href="zn/ShowMessage.html">查看更多&gt;</a></p>
</div>
<header id="header" class="ch m">
	<a class="log" href="<?php echo url('index/index'); ?>" title="首页">首页</a>
	<?php if($state==1): ?>
	<!--{}-->
	<!--未登录-->
		<div class="nolog">
			<a rel="nofollow" href="<?php echo url('login/login'); ?>">登录</a>
			|
			<a rel="nofollow" href="<?php echo url('login/reg'); ?>">注册</a>
		</div>
	<?php else: ?>
	<div class="nolog">
		欢迎<?php echo $username; ?>
	</div>
	<?php endif; ?>

	
</header>

<section id="main" class="m">
	<!--首页广告-->
	
<!--首页广告-->
<div id="ad">
	<div class="adwp">
		<ul id="ad_ul">
			<li>
				<a href="zhengwen?id=6" class="a" title="二哈的趣事">
					<img src="__ROOT__/upload/articleResource/20131206/gou.jpg" />
				</a>
			</li>
			<li>
				<a href="zhengwen?id=11" class="a" title="二次元萌宠~">
					<img src="__ROOT__/upload/articleResource/20131206/1386312612817.jpg" />
				</a>
			</li>
			<li>
				<a href="zhengwen?id=12" class="a" title="喵咪的零食！">
					<img src="__ROOT__/upload/articleResource/20131206/1386312490951.jpg" />
				</a>
			</li>
		</ul>
	</div>
	<div class="zz"></div>
	<div class="dot">
		<div class="rd r">
				<em class="on"><!--圆点--></em>
				<em><!--圆点--></em>
				<em><!--圆点--></em>
		</div>
		<!--只显示15字-->
			<a href="zhengwen.html" class="tx">二哈的趣事</a>
	</div>
</div>
<!--end首页广告-->

	<!--版块推荐-->
	<div id="tj_t" class="h2">
		<span class="ico ico_qztj txt" style="color: #00CC00;">版块推荐</span>

		<br class="c" />
	</div>
	<ul id="tj_m">
		<?php foreach($sections as $val): ?>
			<li>
				<a href="liebiao?id=<?php echo $val['sid']; ?>" class="qb wb" style="color: #5f47b0"><?php echo $val['sname']; ?></a>
			</li>
		<?php endforeach; ?>
		
	</ul>
	<!--END 圈子推荐-->
	
	<!--精彩推荐-->
	<div class="h2">
		<span class="ico ico_jctj txt" style="color: #00CC00;">最新精彩</span>
		<br class="c" />
	</div>
	<div id="jc_l">
		<div id="ajaxdata">
			<!--10条数据-->
<ul class="list">
		<?php foreach($data as $val): ?>
		<li>
			<a href="zhengwen?id=<?php echo $val['tid']; ?>" class="tx" style="color: #00aeee"><?php echo $val['topic']; ?></a>
			<br />
			<div class="tR">
				<a href="#" class="qq l" style="color: #4ebc30"><?php echo $val['tuname']; ?></a>
				<span class=""><?php echo $val['tclickcount']; ?></span>
				&nbsp;|&nbsp;
				<span class="tm"><?php echo $val['time']; ?></span>
			</div>
		</li>
	<?php endforeach; ?>
</ul>


		</div>
		<!--相关按钮换一批-->
		<!--<div class="info hyh">-->
			<!--<a href="javascript:void(0);" data-url="http://m.100bt.com/zn/LoadIndexTopics.html?limit=10" class="changeb wb">换一换</a>-->
		<!--</div>-->
	</div>
	<!--END 精彩推荐-->
	<?php if($state==1): ?>
	<div class="info">
		<a href="<?php echo url('login/login'); ?>" class="loginb bb">登录</a>
		<a href="<?php echo url('login/reg'); ?>" class="regb gb">注册</a>
		<br class="c" />
	</div>
	<?php else: endif; ?>
</section>



<footer id="footer">
	<!--底部暂时不写-->
 <!--<a href="index.html">首页</a>  <a href="liebiao.html">文章列表页</a>  <a href="zhengwen.html">正文页</a>-->
</footer>
<a href="#header" id="bTop" title="返回顶部"></a>

</body>
</html>