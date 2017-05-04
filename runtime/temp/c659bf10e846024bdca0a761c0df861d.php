<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"E:\PYS\mengchong\public/../application/index\view\service\lists.html";i:1492996009;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <link rel="stylesheet" type="text/css" href="__ROOT__/css/shangping.css"/>
	</head>
	<body>
		<div class="box">
			<header>
					<div class="h_left">
					<a href="javascript:void(0)" onclick="history.back()"><img src="__ROOT__/images/service/3_03.png"/></a>
				     </div>
				<div class="h_center">
					<h2>商品列表</h2>
				</div>
				<div class="h_right">
					<img src="__ROOT__/images/service/3_05.png"/>
				</div>
			</header>
			<section>
				<div class="tilte">
					<ul>
						<li><a href="#">全部</a><img src="__ROOT__/images/service/3_12.png"/></li>
						<li><a href="#">类型</a><img src="__ROOT__/images/service/3_12.png"/></li>
						<li><a href="#">排序</a><img src="__ROOT__/images/service/3_12.png"/></li>
						<li><a href="#">筛选</a><img src="__ROOT__/images/service/3_12.png"/></li>
					</ul>
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

			</section>
		</div>
	</body>
</html>
