<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:66:"E:\PYS\mengchong\public/../application/index\view\index\index.html";i:1493206134;}*/ ?>
<?php 
use think\Session;
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimum-scale=1.0, maximum-scale=1.0">
<meta content="telephone=no" name="format-detection" />
<title>萌宠商城</title>
<link rel="stylesheet" href="__ROOT__/css/wap/index.css" type="text/css" />
<script type="text/javascript" src="__ROOT__/js/jquery.min.js"></script>
</head>
<body>
	<header>
	<form action="" method="post">
		<nav class="topBar cfx">
			<div class="l">
				<a class="logo" href="index.html"></a>
			</div>
			<h1>
				<input class="search sIcon" type="text" name="keyword" placeholder="输入关键词搜索" id="keyword" />
			</h1>
			<div class="r">
				<a href="<?php echo Url('index'); ?>" class="search_a">搜索</a>
			</div>
		</nav>
	</form>
	<script>
		$('.search_a').click(function()
		{
			var keyword = $('#keyword').val();
			$(this).prop('href',"<?php echo Url('index'); ?>?goods_name="+keyword);
		})
	</script>


<section class="nav">
	<a class="nav1" href="<?php echo url('index/category'); ?>"><img
		src="__ROOT__/images/blank.gif" alt=""><span>商品分类</span>
	</a><a class="nav2" href="<?php echo url('index/personal'); ?>"><img src="__ROOT__/images/blank.gif"
		alt="" /><span>个人中心</span>
	</a><a class="nav3" href="<?php echo url('service/index'); ?>"><img src="__ROOT__/images/blank.gif"
		alt="" /><span>萌宠服务</span>
	</a><a class="nav4" href="<?php echo url('bbs/index'); ?>"><img
		src="__ROOT__/images/blank.gif" alt="" /><span>萌宠论坛</span>
	</a>
</section>
	<ul class="menu">
		
			<?php if(is_array($model_category) || $model_category instanceof \think\Collection || $model_category instanceof \think\Paginator): $i = 0; $__LIST__ = $model_category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
			<li><a href="<?php echo url('first',['c_id'=>$v['c_id']]); ?>"><?php echo $v['c_name']; ?></a></li>
			<?php endforeach; endif; else: echo "" ;endif; ?>
	</ul>
	</header>
	<div class="content">
		<h3 class="tit">
			<img class="icSale" src="__ROOT__/images/blank.gif" alt="" />最新品
			<span><a href="<?php echo url('more'); ?>">更多</a></span>
		</h3>
		<div class="icHot sec">
			<!-- begin -->
			<ul>
			<?php if(is_array($data_new) || $data_new instanceof \think\Collection || $data_new instanceof \think\Paginator): $i = 0; $__LIST__ = $data_new;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
			<li>
						<a href="<?php echo url('detail',['goods_id'=>$v['goods_id']]); ?>" onClick="_gaq.push([ '_trackEvent', 'm.b5m.com', 'clicked', '热门主题' ]);">
							<img src="__ROOT__/uploads/<?php echo $v['goods_img']; ?>"/>
							<h4><?php echo $v['goods_name']; ?></h4>
							<p><?php echo $v['goods_desc']; ?></p>
						</a>
					</li>
			<?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			<!-- end -->
			<div class="cl"></div>
		</div>
		<h3 class="tit">
			<img class="icHot" src="__ROOT__/images/blank.gif" alt="" />最热品
			<span><a href="<?php echo url('more'); ?>">更多</a></span>
		</h3>
		<div class="icHot sec">
			<ul>
				<!-- begin -->
					<?php if(is_array($data_hot) || $data_hot instanceof \think\Collection || $data_hot instanceof \think\Paginator): $i = 0; $__LIST__ = $data_hot;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
					<li>
						<a href="<?php echo url('detail',['goods_id'=>$v['goods_id']]); ?>" onClick="_gaq.push([ '_trackEvent', 'm.b5m.com', 'clicked', '热门主题' ]);">
							<img src="__ROOT__/uploads/<?php echo $v['goods_img']; ?>"/>
							<h4><?php echo $v['goods_name']; ?></h4>
							<p><?php echo $v['goods_desc']; ?></p>
						</a>
					</li>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				<!-- end -->
			</ul>
			<div class="cl"></div>
		</div>
	</div>
<footer class="footer">
	<div class="top">
		<?php $session = Session::get('username'); if($status == 0): ?>
			<a href="<?php echo url('login/login'); ?>" onClick="_gaq.push([ '_trackEvent', 'm.b5m.com', 'clicked', '登录' ]);">登录</a>|
			<a href="<?php echo url('login/reg'); ?>" onClick="_gaq.push([ '_trackEvent', 'm.b5m.com', 'clicked', '注册' ]);">注册</a>
			<a class="btn" href="#">Top</a>
			<?php else: ?>
			欢迎<span style="color:red"><?php echo $session[1]; ?></span>登录<span style="color:red;">萌宠商城
			<a href="<?php echo url('index/layout'); ?>" >退出账号</a>
			<?php endif; ?>
		
		<!-- <a href=""></a><a href=""></a><a class="btn" href="#">Top</a> -->
	</div>

	<p>Copyright&nbsp;&nbsp;&nbsp;萌宠商城 版权所有</p>
</footer>
</body>
</html>
