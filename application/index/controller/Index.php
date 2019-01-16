<?php
namespace app\index\controller;

use think\Controller;
use think\Session;

class Index extends Controller{
    public function index(){
    	Session::delete("redis_address");
        return $this->fetch('index/index');
    }
}
