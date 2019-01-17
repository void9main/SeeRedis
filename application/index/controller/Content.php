<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\controller\Base;
use think\Session;

class Content extends Controller{


    private $redis_conn = "";

    public function index(){
        $ip = empty(input('post.ip'))?"127.0.0.1":input('post.ip');
        $port = empty(input('post.port'))?"6379":input('post.port');
		
		$redis = Base::redis($ip,$port);
		
        $info = $redis->info();
		
		$dbinfoNum = Base::getleft($ip,$port);
		
		$this->assign('dbNum',$dbinfoNum);
		
		$infoArr = array_chunk($info,"23",true);
		
		Session::set("redis_address",json_encode(array("ip"=>$ip,"port"=>$port),true));
		
		foreach($infoArr as $key=>$val){
        	$this->assign('dbInfo'.$key,$val);
		}
        return $this->fetch('index/content');
    }
}
