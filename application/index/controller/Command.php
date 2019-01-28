<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\controller\Base;
use think\Session;

class Command extends Controller{
	
	public function __construct(){
		parent::__construct();
		
		$dbinfoNum = Base::getleft();

		$this->assign('dbNum',$dbinfoNum);
	}

    public function index(){
    	
		$address = Session::get("redis_address");

		if(!empty($address)){
			
			$addArr = json_decode($address,true);
			
			$ip = $addArr['ip'];
			
			$port = $addArr['port'];
			
		}else{
			
			$ip = "unknow";
			
			$port = "unknow";
			
		}
	
		$this->assign("ip",$ip);
		
		$this->assign("port",$port);
		
		
        return $this->fetch('command/index');
    }
}
