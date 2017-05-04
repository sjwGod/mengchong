<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\View;
use think\captcha;
use think\Session;
use think\Db;

class Common extends Controller
{
	public function __construct(){
		parent::__construct();
		$data = Session::get('uname');
		$id = $data[0];
		if(empty($id))
		{
			$this->success('请先登录...','Login/index');
		}else{
			$request = \think\Request::instance();
        	$controller = $request->controller();
        	$action = $request->action();

        	$sql="select * from mc_admin_user 
        	LEFT JOIN mc_admin_user_role ON mc_admin_user.uid = mc_admin_user_role.user_id 
        	LEFT JOIN mc_admin_role ON mc_admin_user_role.role_id = mc_admin_role.rid 
        	LEFT JOIN mc_admin_role_node ON mc_admin_role.rid = mc_admin_role_node.role_id 
        	LEFT JOIN mc_admin_node ON mc_admin_role_node.node_id = mc_admin_node.nid
        	where mc_admin_user.uid = $id and mc_admin_node.ncontroller = '$controller' and mc_admin_node.naction = '$action'";
	 	    // echo $sql;die;
	 	    
	 	    $res = Db::query($sql);
	 	    // var_dump($res);die;
	 	    
	 	    if($controller == 'Index')
	 	    {
	 	    	return true;
	 	    }
	 	    if($id=='1')
	 	    {
	 	    	return true;
	 	    }
	 	    if(!$res)
	 	    {
	 	    	$this->error("权限不够，请联系管理员");
	 	    }
		}
	}
}