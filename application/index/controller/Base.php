<?php
namespace app\index\controller;

use think\Session;

class Base {


    private $redis_conn = "";
	
	public static function getleft($ip="127.0.0.1",$port=6379){
		$redis = self::redis("0",$ip, $port);
		
        for($i=0;$i<17;$i++){
            $redis->select($i);
            $dbinfo = $redis->keys("*");
            $dbinfoNum[]['num'] = count($dbinfo);
            unset($dbinfo);
        }
		return $dbinfoNum;
	}
	
	public static function redis($db = "0",$ip="127.0.0.1",$port=6379){
		$redisInfo = Session::get("redis_address");
		//
		if(!empty($redisInfo)){
			$redisArr = json_decode($redisInfo,true);
			$ip = $redisArr['ip'];
			$port = $redisArr['port'];
		}
		try{
            $redis = new \Redis();
        }catch(\Exception $e){
            throw new \Exception("php.ini缺少php_redis.dll文件配置");
        }
		try{
            $redis->connect($ip,$port);

        }catch(\Exception $e){
            throw new \Exception("连接redis服务器失败,请检查redis服务器是否开启");
        }
		
		$redis->select($db);
		
		return $redis;
	}
	
	public static function redis_conn($redis){
		
	}
}
