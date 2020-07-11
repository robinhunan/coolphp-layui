<?php
/**
*  系统控制层入口
* @author:
*/
class c_manager{

	function insert(){
		$manager = new manager();
		$arr = $manager->checkData($_POST,$err);
		if ($err!=null){
		    msg::json(-1,$err);
		}
		$db = pool::db();
		$res = $db->table('manager')->insert($arr);
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
		$res = $db->table('manager')->where($where)->delete();
		if ($res === false) {
			msg::json(-1,$db->msg);
		} else {
			msg::json(1);
		}
	}

	function update(){
		$id=(int)$_GET['id'];
		$where  = array('id'=>$id);
		$manager = new manager();
		$db = pool::db();
		$arr = $manager->checkData($_POST,$err);
		if ($err!=null){
		    msg::json(-1,$err);
		}
		$res = $db->table('manager')->where($where)->update($arr);
		if ($res === false) {
			msg::json(-1,$db->msg);
		} else {
			msg::json(1);
		}

	}
	function add(){
		$db = pool::db();
		include APP_PATH.("view/manager/add.php");
	}

	function edit(){
		$id=(int)$_GET['id'];
		$where  = array('id'=>$id);
		$db = pool::db()->table('manager');
		$row = $db->where($where)->find();
		include APP_PATH.("view/manager/edit.php");
	}
	//列表模板
	function index(){		
		include APP_PATH.("view/manager/index.php");
	}
	//分页
	function page(){
		$db = pool::db()->table('manager');
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
	
	function logout(){
		setcookie('_mkey',null,0,'/');
		echo '<script>location.href="../www/?c=manager"</script>';
	}
}
