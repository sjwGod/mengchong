<?php
/**
 * 宠物服务
 */
namespace app\index\controller;

use think\Request;
use \think\View;
use app\index\model\Sertype;
use app\index\model\Merchant;

class Service
{
    //服务首页
    public function index()
    {
        $view = new View();
        $model = new Merchant();
        $data = $model ->show();
        return $view->fetch('index',['data' => $data]);
    }

    //服务分类商户列表展示
    public function lists()
    {
        $view = new View();
        $model = new Merchant();
        $data = $model ->show();
        return $view->fetch('lists',['data' => $data]);
    }

    //商户详情
    public function show()
    {
        $request = Request::instance();
        $mid = $request->param('id');
        $view = new View();
        $model = new Merchant();
        $data = $model ->find($mid);
//        var_dump($data);die;
        return $view->fetch('show',['data'=>$data]);
    }

    public function map()
    {
        $request = Request::instance();
        $address = $request->param('address');
        $view = new View();
        return $view->fetch('map',['add'=>$address]);
    }
}