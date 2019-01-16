<?php if (!defined('THINK_PATH')) exit(); /*a:8:{s:75:"D:\phpstudy\PHPTutorial\WWW\SeeRedis\application/index/view/db\dbindex.html";i:1547625397;s:76:"D:\phpstudy\PHPTutorial\WWW\SeeRedis\application\index\view\base\header.html";i:1547620601;s:73:"D:\phpstudy\PHPTutorial\WWW\SeeRedis\application\index\view\base\nav.html";i:1547649958;s:74:"D:\phpstudy\PHPTutorial\WWW\SeeRedis\application\index\view\base\left.html";i:1547544555;s:78:"D:\phpstudy\PHPTutorial\WWW\SeeRedis\application\index\view\action\delete.html";i:1547625900;s:78:"D:\phpstudy\PHPTutorial\WWW\SeeRedis\application\index\view\action\select.html";i:1547649189;s:79:"D:\phpstudy\PHPTutorial\WWW\SeeRedis\application\index\view\action\timeset.html";i:1547649708;s:74:"D:\phpstudy\PHPTutorial\WWW\SeeRedis\application\index\view\base\page.html";i:1547608227;}*/ ?>
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
	.dbtable{
		width:100%;
		float: left;
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
		<form method="post" action="<?php echo $href; ?>1">
		<div class="input-group" style="width: 300px;">
			    <input type="text" class="form-control" placeholder="key" name="keys">
			    <span class="input-group-btn">
			       <button class="btn btn-default" type="submit">Search</button>
			    </span>
		</div><!-- /input-group -->
		<p><b>共<?php echo $allNum; ?>条记录</b></p>
		</form>
		<br />
		<table class="table table-striped table-bordered table-hover dbtable">
			<tr>
			<th style="width: 30%;">key</th>
			<th style="width: 20%;">type</th>
			<th style="width: 20%;">tll</th>
			<th style="width: 30%;">操作</th>
			</tr>
			<?php if(is_array($keysPage) || $keysPage instanceof \think\Collection || $keysPage instanceof \think\Paginator): $k = 0; $__LIST__ = $keysPage;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
			<tr>
			<td><?php echo $vo['name']; ?></td>
			<td><?php echo $vo['type']; ?></td>
			<td><?php echo $vo['ttl']; ?></td>
			<td>
				<?php if($vo['ttl']!="unknow"){ ?>
				<div class="modal fade" id="deleteModel<?php echo $k; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">删除</h4>
      </div>
      <form action="<?php echo url('@db/dbdelete'); ?>?key=<?php echo $vo['name']; ?>&db=<?php echo $db; ?>" method="post">
	      <div class="modal-body">
	      	<input type="text" value=<?php 
	      		echo 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
	      		 ?>
	      		style="width:500px;display: none;"
	      		name="returl"
	      		/>
	      	<input type="text" value="<?php echo $keysearch; ?>" name="keys"
	      		style="display: none;"
	      		/>
	        	<p>确定删除:<b><?php echo $vo['name']; ?></b>?</p>
	      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="submit" class="btn btn-danger">确定删除</button>
      </div>
      </form>
    </div>
  </div>
</div>
				<button type="button" class="btn btn-danger btn-xs" 
				data-toggle="modal" data-target="#deleteModel<?php echo $k; ?>">
				  删除
				</button>
				<div class="modal fade" id="selectModel<?php echo $k; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">查询</h4>
      </div>
      <form method="post" action="<?php echo url('@db/dbselect'); ?>?key=<?php echo $vo['name']; ?>&db=<?php echo $db; ?>">
      <div class="modal-body">
      	<p>key:<b><?php echo $vo['name']; ?></b></p>
      	<input type="text" value=<?php 
	      		echo 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
	      		 ?>
	      		style="width:500px;display: none;"
	      		name="returl"
	      		/>
	      	<input type="text" value="<?php echo $keysearch; ?>" name="keys"
	      		style="display: none;"
	      		/>
	      <?php switch($vo['typestr']): case "string": ?>
				    <p>类型:<b>string</b></p>
				    	<textarea class="form-control" rows="8" name="content"><?php echo $vo['content']; ?></textarea>
				    <?php break; case "set": ?>
				    <p>类型:<b>set</b></p>
					    <div class="input-group">
					    <span class="input-group-addon">添加新数据</span>
							<input type="text" class="form-control" name="content">
							</div>
							<br />
				    	<?php if(is_array($vo['content']) || $vo['content'] instanceof \think\Collection || $vo['content'] instanceof \think\Paginator): if( count($vo['content'])==0 ) : echo "" ;else: foreach($vo['content'] as $kv=>$val): ?>
				    	<div class="input-group">
				    	<span class="input-group-addon"><?php echo $kv; ?></span>
							<input type="text" class="form-control" value="<?php echo $val; ?>" disabled="disabled">
							</div>
							<?php endforeach; endif; else: echo "" ;endif; break; case "list": ?>
				    <p>类型:<b>list</b></p>
					    <div class="input-group">
					    <span class="input-group-addon">添加新数据</span>
							<input type="text" class="form-control" name="content">
							</div>
							<br />
				    	<?php if(is_array($vo['content']) || $vo['content'] instanceof \think\Collection || $vo['content'] instanceof \think\Paginator): if( count($vo['content'])==0 ) : echo "" ;else: foreach($vo['content'] as $kv=>$val): ?>
				    	<div class="input-group">
				    	<span class="input-group-addon"><?php echo $kv; ?></span>
							<input type="text" class="form-control" value="<?php echo $val; ?>" disabled="disabled">
							</div>
							<?php endforeach; endif; else: echo "" ;endif; break; case "zset": ?>
				    <p>类型:<b>zset</b></p>
					    <div class="input-group">
					    <span class="input-group-addon">添加新数据</span>
							<input type="text" class="form-control" name="content">
							<span class="input-group-addon">添加新分数</span>
							<input type="text" class="form-control" name="field" placeholder="默认为1">
							</div>
							<br />
				    	<?php if(is_array($vo['content']) || $vo['content'] instanceof \think\Collection || $vo['content'] instanceof \think\Paginator): if( count($vo['content'])==0 ) : echo "" ;else: foreach($vo['content'] as $kv=>$val): ?>
				    	<div class="input-group">
				    	<span class="input-group-addon"><?php echo $kv; ?></span>
							<input type="text" class="form-control" value="<?php echo $val; ?>" disabled="disabled">
							</div>
							<?php endforeach; endif; else: echo "" ;endif; break; case "hash": ?>
				    <p>类型:<b>hash</b></p>
					    <div class="input-group">
					    <span class="input-group-addon">添加新field</span>
							<input type="text" class="form-control" name="field" placeholder="默认为1">
					    <span class="input-group-addon">添加新数据</span>
							<input type="text" class="form-control" name="content">
							</div>
							<br />
				    	<?php if(is_array($vo['content']) || $vo['content'] instanceof \think\Collection || $vo['content'] instanceof \think\Paginator): if( count($vo['content'])==0 ) : echo "" ;else: foreach($vo['content'] as $kv=>$val): ?>
				    	<div class="input-group">
				    	<span class="input-group-addon"><?php echo $kv; ?></span>
							<input type="text" class="form-control" value="<?php echo $val; ?>" disabled="disabled">
							</div>
							<?php endforeach; endif; else: echo "" ;endif; break; default: ?>
				    <p><b>未知数据类型</b></p>
				<?php endswitch; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="submit" class="btn btn-primary">保存</button>
      </div>
      </form>
    </div>
  </div>
</div>
				<button type="button" class="btn btn-primary btn-xs"
				data-toggle="modal" data-target="#selectModel<?php echo $k; ?>"
				>查看</button>
				<div class="modal fade" id="timesetModel<?php echo $k; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">设置时间</h4>
      </div>
      <form method="post" action="<?php echo url('@db/dbtimeset'); ?>?key=<?php echo $vo['name']; ?>&db=<?php echo $db; ?>">
      <div class="modal-body">
        <p>key:<b><?php echo $vo['name']; ?></b></p>
        <input type="text" value=<?php 
	      		echo 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
	      		 ?>
	      		style="width:500px;display: none;"
	      		name="returl"
	      		/>
	      	<input type="text" value="<?php echo $keysearch; ?>" name="keys"
	      		style="display: none;"
	      		/>
        <div class="input-group">
					<span class="input-group-addon">当前时间:<?php echo $vo['ttl']; ?></span>
					<input type="text" class="form-control" name="ttl" placeholder="设置新的时间">
				</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="submit" class="btn btn-success">设置</button>
      </div>
      </form>
    </div>
  </div>
</div>
				<button type="button" class="btn btn-default btn-xs"
				data-toggle="modal" data-target="#timesetModel<?php echo $k; ?>"	
				>设置生存时间</button>
				<?php } ?>
			</td>
			</tr>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</table>
					<nav aria-label="Page navigation">
			  <ul class="pagination">
			  	<?php if($nowPage == 1){ ?>
			  	<li class="disabled">
			  		<a href="#" aria-label="Previous">
			  	<?php }else{ ?>
			  	<li>
			  		<a href="<?php echo $href; ?><?php echo $nowPage-1; ?>" aria-label="Previous">
			  	<?php } ?>
			        <span aria-hidden="true">&laquo;</span>
			      </a>
			    </li>
			    <?php $pageLes = floor($nowPage/10); if(($page-$nowPage)>=10){ for($i=$pageLes*10+1;$i<=($pageLes+1)*10;$i++){ if($i==$nowPage){ ?>
			  				<li class="active">
			  			<?php }else{ ?>
			  				<li>
			  			<?php } ?>
			  			<a href="<?php echo $href; ?><?php echo $i; ?>"><?php echo $i; ?></a></li>
			  		<?php } }else{ for($i=$pageLes*10+1;$i<=$page;$i++){ if($i==$nowPage){ ?>
			  				<li class="active">
			  			<?php }else{ ?>
			  				<li>
			  			<?php } ?>
			  			 <a href="<?php echo $href; ?><?php echo $i; ?>"><?php echo $i; ?></a></li>
			  		<?php } } if($nowPage == $page){ ?>
			    <li class="disabled">
			    	<a href="#" aria-label="Previous">
			    <?php }else{ ?>
			    <li>
			    	<a href="<?php echo $href; ?><?php echo $nowPage+1; ?>" aria-label="Next">
			    <?php } ?>
			        <span aria-hidden="true">&raquo;</span>
			      </a>
			    </li>
			  </ul>
			</nav>
	</div>
</body>