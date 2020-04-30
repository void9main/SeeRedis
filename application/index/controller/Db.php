<?php
namespace app\index\controller;

use think\Controller;
use app\index\controller\Base;
use think\Session;

class Db extends Base{
	
    public function dbIndex(){
		
    	$db = empty(input('get.db'))?"0":input('get.db');
		
		$page = empty(input('get.page'))?"1":input('get.page');
		
		$keysearch = empty(input('param.keys'))?"*":input('param.keys');
		
		$redis = Base::redis($db);
		
		$keys = $redis->keys("*$keysearch*");
		
		$keysArr = array_chunk($keys,"15",true);
		
		if(!empty($keysArr)){
			
			$this->assign("keysPage",self::keysPage($redis,$keysArr[$page-1]));
				
		}else{
			
			$keysArr = array(array("name"=>"无结果","type"=>"unknow","ttl"=>"unknow"));
			
			$this->assign("keysPage",$keysArr);
			
		}

		$this->assign('dbNum',$this->dbinfoNum);
		
		$this->assign("page",count($keysArr));
		
		$this->assign("nowPage",$page);
		
		$this->assign("href","dbindex?db=".$db."&keys=".$keysearch."&page=");
		
		$this->assign("db",$db);
		
		$this->assign("allNum",count($keys));
		
		$this->assign("keysearch",$keysearch);
		
		$this->assign("actionName",Session::pull("actionName"));
		
		$this->assign("actionType",Session::pull("actionType"));
		
		
		
        return $this->fetch('db/dbindex');
    }
	
	public function dbdelete(){
		
		$url = input('param.returl');
		
		$keys = input('param.keys');
		
		$key = input('param.key');
		
		$db = input('param.db');
		
		$redis = Base::redis($db);
		
		$row = $redis->del($key);
		
		Base::setActionType($row,"删除");
		
		$this->redirect($url."&keys=".$keys);
	}
	
	public function dbflush(){
		$url = input('param.returl');
		
		$keys = input('param.keys');
		
		$db = input('param.db');
		
		$redis = Base::redis($db);
		
		$row = $redis->flushdb();
		
		Base::setActionType($row,"清空db:".$db);
		
		$this->redirect($url."&keys=".$keys);
	}
	
	public function dbselect(){
		
		$url = input('param.returl');
		
		$keys = input('param.keys');
		
		$key = input('param.key');
		
		$db = input('param.db');
		
		$content = input('post.content');
		
		$field = empty(input('get.field'))?"1":input('get.field');
		
		$redis = Base::redis($db);
		
		self::typeSet($redis,$key,$content,$field);
		
		$this->redirect($url."&keys=".$keys);
	}
	
	public function dbtimeset(){
		
		$url = input('param.returl');
		
		$keys = input('param.keys');
		
		$key = input('param.key');
		
		$db = input('param.db');
		
		$ttl = input('post.ttl');
		
		$redis = Base::redis($db);
		
		$row = $redis->expire($key,(int)$ttl);
		
		Base::setActionType($row,"设置生存时间");
		
		$this->redirect($url."&keys=".$keys);
	}
	
	public function keysPage($redis,$keysPageTemp){
		
		$keysPage = array();
		
		foreach($keysPageTemp as $k=>$v){
			
			$type = $redis->type($v);
			
			$keysPage[$k]['name'] = $v;
			
			switch($type){
				case '1':
					$keysPage[$k]['content'] = $redis->get($v);
					$keysPage[$k]['typestr'] = "string";
					$keysPage[$k]['type'] = "string(字符串)";
					break;
				case '2':
					$keysPage[$k]['content'] = $redis->smembers($v);
					$keysPage[$k]['typestr'] = "set";		
					$keysPage[$k]['type'] = "set(集合)";
					break;
				case '3':
					$len = $redis->llen($v);
					$keysPage[$k]['content'] = $redis->lrange($v,0,$len);
					$keysPage[$k]['typestr'] = "list";	
					$keysPage[$k]['type'] = "list(列表)";
					break;
				case '4':
					$len = $redis->zcard($v);
					$keysPage[$k]['content'] = $redis->zrange($v,0,$len);
					$keysPage[$k]['typestr'] = "zset";	
					$keysPage[$k]['type'] = "zset(有序集合)";
					break;
				case '5':	
					$keyfield = $redis->hkeys($v);
					foreach($keyfield as $kl=>$vl){
						$contentArr[$vl] = $redis->hget($v,$vl);
					}	
					$keysPage[$k]['content'] = $contentArr;
					$keysPage[$k]['typestr'] = "hash";
					$keysPage[$k]['type'] = "hash(哈希)";
					break;
				default:
					$keysPage[$k]['type'] = "unknown(未知)";
			}
			
			$ttl = $redis->ttl($v);
			
			if($ttl == "-1"){
				$ttl = "-1(无限期)";
				
			}else{
				$ttl = $ttl."(秒/s)<b>▼</b>";
				
			}
			$keysPage[$k]['ttl'] = $ttl;
		}
		
		return $keysPage;
	}
	
	public function typeSet($redis,$key,$content="",$field=""){
		
		$type = $redis->type($key);
			
		switch($type){
			case '1':
				
				$redis->set($key,$content);
				break;
			case '2':	
				
				$redis->sadd($key,$content);
				break;
			case '3':
				
				$redis->lpush($key,$content);
				break;
			case '4':
				
				$redis->zadd($key,$field,$content);
				break;
			case '5':		
				
				$redis->hset($key,$field,$content);
				break;
			default:
				throw new \Exception("未知的数据类型！");
		}
	}
}
