<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\controller\Base;
use think\Session;

class User extends Controller{

    public function login(){

        $ip = empty(input('post.ip'))?"127.0.0.1":input('post.ip');
		$port = empty(input('post.port'))?"6379":input('post.port');
		$auth = empty(input('post.auth'))?"":input('post.auth');

        $password = input('post.password');

        if(empty($password)){

            $this->error("密码不能为空",url(''));

            exit;
        }

        if(md5($password) != config("password")){

            $this->error("密码错误",url(''));

            exit;

        }else{

            Session::set("name_login",md5(time()));

            //重定向到
            $this->redirect('@content/index',[],200,['ip'=>$ip,"port"=>$port,"auth"=>$auth]);
        }
    }
}