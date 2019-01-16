<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:78:"D:\phpstudy\PHPTutorial\WWW\SeeRedis\application/index/view/command\index.html";i:1547650208;s:76:"D:\phpstudy\PHPTutorial\WWW\SeeRedis\application\index\view\base\header.html";i:1547620601;s:73:"D:\phpstudy\PHPTutorial\WWW\SeeRedis\application\index\view\base\nav.html";i:1547649958;s:74:"D:\phpstudy\PHPTutorial\WWW\SeeRedis\application\index\view\base\left.html";i:1547544555;}*/ ?>
<!doctype html>
<html lang="utf-8" style="width: 100%;height: 100%;">
<head>
	<script type="text/javascript" charset="UTF-8" src="/seeredis/public/static/js/jquery.min.js"></script>
<script type="text/javascript" charset="UTF-8" src="/seeredis/public/static/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="/seeredis/public/static/css/bootstrap.css">
<link rel="icon" href="/seeredis/public/static/img/favicon.png" type="image/x-icon" /> 
<title>SeeRedis</title>
</head>
<style>
	.dbinfo{
		float: left;
		height:calc( 100% - 80px );
		overflow: hidden;
		margin-left: 20px;
		margin-right: 20px;
		width: calc( 100% - 250px);
	}
</style>
<body style="width: 100%;height: 100%;">
	<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo url('@content/index'); ?>">
      	<p>
        <img alt="" src="/seeredis/public/static/img/favicon.png" width="30px" style="margin-top: -10px;">
        SeeRedis
        </p>
      </a>
      <ul class="nav navbar-nav navbar-right">
      	<li><a href="<?php echo url('@content/index'); ?>">首页</a></li>
      	<li><a href="<?php echo url('@command/index'); ?>">命令行</a></li>
        <li><a href="<?php echo url('@index'); ?>">注销</a></li>
      </ul>
    </div>
  </div>
</nav>
		<div style="width:200px;height: calc( 100% - 60px );margin-top: -20px;float:left;">
		<div style="width:200px;height: 100%;background-color: #D5D3CD;">
			<ul class="list-group">
				<?php if(is_array($dbNum) || $dbNum instanceof \think\Collection || $dbNum instanceof \think\Paginator): $k = 0; $__LIST__ = $dbNum;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;if($vo['num']!=0): ?>
				<a href="<?php echo url('@db/dbindex'); ?>?db=<?php echo $key; ?>">
				<?php else: endif; ?>
					<li class="list-group-item">db:<?php echo $key; ?>(<b class="dbnum"><?php echo $vo['num']; ?></b>)</li>
				<?php if($vo['num']!=0): ?>
				</a>
				<?php else: endif; endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		</div>
	</div>
	<div class="dbinfo">
		
	</div>
</body>