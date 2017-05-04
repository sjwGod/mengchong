<?php
namespace app\admin\controller;


use think\Controller;



// class Login extends Controller
// {

//     //登录
//      public function Index()
//     {      
//         return $this->fetch('login');
//     }
  
// }
// use think\Controller;
// use think\Request;
use think\View;
use think\captcha;
use think\Validate;
use think\Session;
use think\Db;


class Login 
{
    public function index()
    {
    	$view = new View();
    	return $view->fetch('login');
    }

    /**
     * @Introduce
     * @Author LL
     * @Param
     *
    */
    public function logindo()
    {
        if ($_POST) 
        {
            $data = $_POST;
            $uname = $data['uname'];
            $upwd = $data['upwd'];
            $result = Db::table('mc_admin_user')->where(" uname = '$uname'" )->find();
            $id = $result['uid'];
            $arr = array($id,$uname);
            if (!empty($result)) 
            {
                if ($upwd == $result['upwd']) 
                {
                    Session::set('uname',$arr);
                    return true;
                }
                else
                {
                    echo 3;
                    die;
                }
            }
            else
            {
                echo 5;
                die;
            }
        }
        else
        {

            // $view = new View();
            // return $view->fetch('login');
        }
       
    }





}
// 4af885cc780fca0488193533c081094ed8173edd
