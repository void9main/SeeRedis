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
        return $this->fetch('command/index');
    }
}
