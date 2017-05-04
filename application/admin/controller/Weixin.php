<?php
namespace app\admin\controller;
use think\Db;
use think\Controller;
use think\Request;
class Weixin extends Controller
{
    public function Index()
    {
    	$request = Request::instance();
    	$istype = $request->method();
    	if($istype == 'GET')
    	{

    	$data = Db::name('admin_weixinauto')->where('status',1)->paginate(3);
       
       
    	 return $this->fetch('add',['data'=>$data]); 	
        }
        else
        {
        	$post = $request->param();
        	
        	$info = Db::name('admin_weixinauto')->insert($post);
        	if($info){
        		  $this->success('新增成功', 'Weixin/index');
        	}else{
        		  $this->error('新增失败');
        	}

        }
	}

	//删除
	public function Del(){
		$id = request()->param('id');
		$info = Db::name('admin_weixinauto')
		    ->where('id', $id)
		    ->update(['status' => 0]);

    	if($info){
    		  $this->success('删除成功', 'Weixin/index');
    	}else{
    		  $this->error('删除失败');
    	}   
	}

	//提供给微信读取数据的接口
	public function GetMes(){
		$data = Db::query('SELECT title,pic_url,content FROM mc_admin_weixinauto WHERE id >= ((SELECT MAX(id) FROM mc_admin_weixinauto)-(SELECT MIN(id) FROM mc_admin_weixinauto)) * RAND() + (SELECT MIN(id) FROM mc_admin_weixinauto) and status = 1 LIMIT 1');

		echo json_encode($data[0]);
	}
}

