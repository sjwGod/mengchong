<?php
namespace app\admin\controller;



use think\Controller;


// use think\Request;
use think\View;
use think\captcha;
use think\Validate;
use think\Session;
use think\Db;
use think\Request;
// use Ucpaas\Ucpaas; 
// use app\index\model\Ucpaas;




class Index extends Common
{
    public function index()
    {
        
    	$data = $this->FrontMenu();

        return $this->fetch('index',['menu'=>$data]);
    }

    /**
     * @Introduce
     * @Author 
     * @Param
     *
    */
    public function info()
    {
    	$view = new View();
    	return $view->fetch('info');
    }

    /**
     * @Introduce  密码修改
     * @Author  
     * @Param
     *
    */
    public function pass()
    {
        $view = new View();
        return $view->fetch('pass');
    }

    /**
     * @Introduce
     * @Author LL
     * @Param
     *
    */
    public function updatepwd()
    {
        if ($_POST) 
        {
            $session = Session::get('uname');
            $id = $session[0];//获取的id
            $id = $session[1];//获取的uname
            $data = $_POST;
            // print_r($data);die;
            $upwd = $data['upwd'];
            $npwd = $data['npwd'];
            $nspwd = $data['nspwd'];
            $arr['upwd'] = $npwd;
            // print_r($arr);die;
            if ($npwd != $nspwd) 
            {
                echo "<script>alert('两次密码输入不一致！');location.href='index/index';</script>";
                die;
            }
            else
            {
                $result = DB::table('mc_admin_user')->where(" uid = '$session[0]' ")->find();
                if(!empty($result))
                {
                    if($result['upwd'] == $upwd)
                    {
                        $update = Db::table('mc_admin_user')->where(" uid = '$session[0]' ")->update($arr);
                        if ($update) 
                        {
                            echo "<script>alert('修改成功！');location.href='pass';</script>";
                        }
                        else
                        {
                            echo "<script>alert('新密码不能和原密码相同!');location.href='pass';</script>";
                        }
                    }
                    else
                    {
                        echo "<script>alert('修改失败!');location.href='pass';</script>";
                    }
                }
                else
                {
                    "<script>alert('修改失败!');location.href='pass';</script>";
                }
            }
        }
        else
        {
            echo "<script>alert('请输入有效密码！');location.href='pass';</script>";
        }
    }

    /**
     * @Introduce
     * @Author 
     * @Param
     *
    */
    public function page()
    {
        $view = new View();
        return $view->fetch('page');
    }

    /**
     * @Introduce
     * @Author 
     * @Param
     *
    */
    public function adv()
    {
        $view = new View();
        return $view->fetch('adv');
    }

    /**
     * @Introduce
     * @Author 
     * @Param
     *
    */
    public function book()
    {
        $view = new View();
        return $view->fetch('book');
    }

    /**
     * @Introduce
     * @Author LL
     * @Param
     *
    */
    public function layout()
    {
        
        Session::clear();
        // return $this->redirect('login/index');
        $view = new View();
        return $view->fetch('login/login');
    }


    //左侧菜单管理
    public function Menu(){

        $request = Request::instance();
        $istype = $request->method();
        if($istype == 'GET')
        {            
            $list =  Db::name('admin_menu')->where('status',1)->select();
            $list = $this->GetMenu($list);
            // var_dump($list);die;
             $cate  = Db::name('admin_menu')->where('parent',0)->where('status',1)->select();
            
            //var_dump($cate);die;
            return $this->fetch('menu',['cate'=>$cate,'list'=>$list]);
        }
        else
        {
            $post = $request->param();
            
            $info = Db::name('admin_menu')->insert($post);
            if($info){
                  $this->success('新增成功', 'index/menu');
            }else{
                  $this->error('新增失败');
            }

        }

    }

    //删除
    public function Del(){
        $id = request()->param('id');

        $cate = Db::name('admin_menu')->where('id',$id)->find();
        if($cate['parent'] == '0'){
         
           
           
        $info = Db::name('admin_menu')
            ->where("parent = $id or id = $id")
            ->update(['status' => 0]);
          
        }else{
           
        $info = Db::name('admin_menu')
            ->where('id', $id)
            ->update(['status' => 0]);
        }


        if($info){
              $this->success('删除成功', 'index/Menu');
        }else{
              $this->error('删除失败');
        } 
    }

    //前台数据
    public function FrontMenu(){
           
             $list  = Db::name('admin_menu')->where('status',1)->select();
             return $this->GetMenu($list);

    }




    public function GetMenu($list,$pid=0){
        $arr=array();  
        foreach($list as $key=>$val){
            if($val['parent'] == $pid)
            {
                $arr[$key] = $val;
                $arr[$key]['child'] = $this->GetMenu($list,$val['id']);
            }
        }
       return $arr;
    }


}

