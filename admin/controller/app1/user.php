<?php
/**
*  系统控制层入口
* @author:
*/
class c_app1_user{

	function insert(){
		$app1_user = new app1_user();
		$arr = $app1_user->checkData($_POST,$err);
		if ($err!=null){
		    msg::json(-1,$err);
		}
		$db = pool::db();
		$res = $db->table('app1_user')->insert($arr);
		if ($res === false) {
			msg::json(-1,$db->msg);
		} else {
			msg::json(1);
		}
	}

	function delete(){
		$id=cstring::getIds($_POST['id']);
		if(empty($id)){
			msg::json(-1,'参数错误');
		}
		$where  = "id in($id)";
		$db = pool::db();
		$res = $db->table('app1_user')->where($where)->delete();
		if ($res === false) {
			msg::json(-1,$db->msg);
		} else {
			msg::json(1);
		}
	}

	function update(){
		$id=(int)$_GET['id'];
		$where  = array('id'=>$id);
		$app1_user = new app1_user();
		$db = pool::db();
		$arr = $app1_user->checkData($_POST,$err);
		if ($err!=null){
		    msg::json(-1,$err);
		}
		$res = $db->table('app1_user')->where($where)->update($arr);
		if ($res === false) {
			msg::json(-1,$db->msg);
		} else {
			msg::json(1);
		}

	}
	function add(){
		$db = pool::db();
		include APP_PATH.("view/app1/user/add.php");
	}

	function edit(){
		$id=(int)$_GET['id'];
		$where  = array('id'=>$id);
		$db = pool::db()->table('app1_user');
		$row = $db->where($where)->find();
		include APP_PATH.("view/app1/user/edit.php");
	}
	//列表模板
	function index(){		
		include APP_PATH.("view/app1/user/index.php");
	}
	//分页
	function page(){
		$db = pool::db()->table('app1_user');
		//搜索条件
		$keys = json_decode($_GET['key'],true);
		if (!empty($keys)) {
			$keys = cstring::safe($keys);
			foreach($keys as $k=>$v){
				$where = "`{$k}` like '%{$v}%'";
				$db->where($where);
			}
		}
		$rows = [];
		if ($cnt = $db->count() ) {
			$o = array('size'=>max(1,(int)$_GET['limit']));
			$sql = sprintf("select * from %s %s order by id desc", $db->table, $db->condition());
			$rows = $db->rows($sql,($_GET['page']-1)*$o['size'],$o['size']);
		}
		$res=['code'=>0,'msg'=>'','count'=>$cnt,'data'=>$rows];
		msg::json($res);		
	}

}
