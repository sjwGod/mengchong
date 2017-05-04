<?php
namespace app\index\controller;
use think\Session;
use think\Controller;
class Common extends Controller
{
    public function __construct()
    {
        $url = $_SERVER['PATH_INFO'];
        Session::set('url',$url);
    }
}