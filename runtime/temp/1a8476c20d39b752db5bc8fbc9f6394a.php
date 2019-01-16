<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:76:"D:\phpstudy\PHPTutorial\WWW\SeeRedis\application/index/view/index\index.html";i:1547455611;s:76:"D:\phpstudy\PHPTutorial\WWW\SeeRedis\application\index\view\base\header.html";i:1547620601;}*/ ?>
<!doctype html>
<html lang="utf-8" style="width: 100%;height: 100%;">
<head>
	<script type="text/javascript" charset="UTF-8" src="/seeredis/public/static/js/jquery.min.js"></script>
<script type="text/javascript" charset="UTF-8" src="/seeredis/public/static/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="/seeredis/public/static/css/bootstrap.css">
<link rel="icon" href="/seeredis/public/static/img/favicon.png" type="image/x-icon" /> 
<title>SeeRedis</title>
</head>
<body>
	<div class="divfo" align="center">
		<div style="margin:10px;overflow: auto;height: 100%;width:450px;margin-top:150px;text-align: left">
            <form method="POST" action="<?php echo url('@content/index'); ?>">
                <h3><img src="/seeredis/public/static/img/favicon.png" style="width:35px;margin-right:20px">SeeRedis在线管理工具</h3>
                <br />
                <div class="form-group">
                    <label for="exampleInputEmail1">ip地址</label>
                    <input type="text" class="form-control" name="ip" placeholder="127.0.0.1">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">端口号</label>
                    <input type="text" class="form-control" name="port" placeholder="6379">
                </div>
                <button type="submit" class="btn btn-primary" style="width:450px;margin-top:20px">登陆</button>
            </form>
		</div>
	</div>
</body>