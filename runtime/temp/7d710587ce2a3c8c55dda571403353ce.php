<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"E:\PYS\mengchong\public/../application/index\view\index\two.html";i:1492159091;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimum-scale=1.0, maximum-scale=1.0">
<meta content="telephone=no" name="format-detection" />
<title>帮5买触屏版手机导购网站模板 - 小列表</title>

<link rel="stylesheet" href="__ROOT__/css/wap/index.css" type="text/css" />
<script type="text/javascript" src="__ROOT__/js/jquery.min.js"></script>

</head>
<body>
	


	<form id="searchForm" action="http://m.b5m.com:80/search/fuzzySearch.html" method="post">
		<input type="hidden" name="pageNo" value="0"/>
		<input type="hidden" name="pageSize" value="10"/>
		<input type="hidden" name="sort" value="default"/>
		<input type="hidden" name="sortType" value="desc"/>
		<nav class="topBar cfx">
			<div class="l">
				<a class="logo" href="__ROOT__/index.html"></a>
			</div>
			<h1>
				<input class="search sIcon" type="text" name="keyword" value="输入关键词搜索" id="keyword" onClick="subSearchForm()" readonly="readonly"/>
			</h1>
			<div class="r">
				<a onClick="subSearchForm()">搜索</a>
			</div>
		</nav>
	</form>


	
		<ul class="sortSub" id="sortSub">
				<?php if(is_array($arr) || $arr instanceof \think\Collection || $arr instanceof \think\Paginator): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
				<li>
					<a class="third" href="<?php echo Url('index',['c_id'=>$v['c_id']]); ?>"><span></span><?php echo $v['c_name']; ?></a>
				</li>
				<?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	
</body>
</html>