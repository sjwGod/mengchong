<?php
namespace app\admin\controller;
use think\Db;
use \think\Request;
use think\Controller;



class Service extends Controller
{
	//定义文件上传规则
	// private $ruls=[
	// 		'size'=>1024*20,
	// 		'ext'=>'jpg,png,gif'
	// ];

  public function get(){
    $request = Request::instance();
    var_dump($request->param(''));
  }

    //商家管理      
    public function ShopShow()
    {

      $list = Db::name('merchant')->where('status',1)->paginate(6);
    
        return $this->fetch('show',[
            'list'=>$list
            ]);
    }

    //删除
    public function  Dell(){
            $id = request()->post('id');
            $id = $id;
            $id = rtrim($id,',');
            $is = Db::table('mc_merchant')
                  ->where('mid','in',$id)
                  ->update(['status' => 1]);
            if($is){
                $arr['status'] = 1;
                $arr['ids'] = $id;
             }else{
                $arr['status'] = 0;

             }
             echo json_encode($arr);
    }
   



    //服务商家添加
    public function ShopIndex()
    {
 	
    	return $this->fetch('add',[
    		
    		]);
    }

    //服务信息入库
    public function ShopAdd()
    {
	    $file = request()->file('image');// 获取表单上传文件 例如上传了001.jpg

	    $data = $this->PicUp($file);
        if($data['type']){//上传成功
        $request = request()->post();
        $request['img_path'] = $data['path'];
        $is = $this->Insert('mc_merchant',$request);
            if($is){
                 $this->success('新增成功', 'service/list');
            }else{
                 $this->error('新增失败');
            }
        }else{//上传失败
                 $this->error($data['error']);
        }
    }

    //图片上传
    public function PicUp($file)
    {  	 
	   // 移动到框架应用根目录/public/uploads/ 目录下
       $info = $file->rule('md5')->move(ROOT_PATH .'public' . DS . 'uploads');
   

	    if($info){
	        // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
	        $arr['path'] = $info->getSaveName();
            $arr['type'] = true;
	        
	    }else{
	        $arr['type'] = false;
            $arr['error']= $file->getError();
   		 }
         return $arr;
    }

    //入库的
    private function Insert($table,$data)
    {
       return  Db::name($table)->insertGetId($data);
    }
 


    
  
}





