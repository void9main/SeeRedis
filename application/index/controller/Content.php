<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\controller\Base;
use think\Session;

class Content extends Base{

    public function index(){
		
        $ip = Session::get("ip");
		$port = Session::get("port");
		$auth = Session::get("auth");

		Session::flush();
		
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
