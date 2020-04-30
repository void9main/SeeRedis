<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\controller\Base;
use think\Session;

class Content extends Base{

    public function index(){
		
        $ip = empty(input('post.ip'))?"127.0.0.1":input('post.ip');
		$port = empty(input('post.port'))?"6379":input('post.port');
		$auth = empty(input('post.auth'))?"":input('post.auth');

		$password = input('post.password');

		if(empty($password)){

			$this->error("密码不能为空");

			exit;
		}

		if(md5($password) != $this->pwd){

			$this->error("密码错误");

			exit;

		}else{

			Session::set("name_login",md5(time()));
		}
		
		$redis = Base::redis(0,$ip,$port,$auth);
		
        $info = $redis->info();
		
		$dbinfoNum = Base::getleft($ip,$port,$auth);
		
		$this->assign('dbNum',$dbinfoNum);
		
		$infoArr = array_chunk($info,"23",true);
		
		Session::set("redis_address",json_encode(array("ip"=>$ip,"port"=>$port,"auth"=>$auth),true));
		
		foreach($infoArr as $key=>$val){
        	$this->assign('dbInfo'.$key,$val);
		}
		
		$address = Session::get("redis_address");

		if(!empty($address)){
			
			$addArr = json_decode($address,true);
			
			$ip = $addArr['ip'];
			
			$port = $addArr['port'];
			
		}else{
			
			$ip = "未知ip";
			
			$port = "未知端口";
			
		}
	
		$this->assign("ip",$ip);
		
		$this->assign("port",$port);
		
        return $this->fetch('index/content');
    }
}
