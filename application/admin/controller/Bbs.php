<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use app\admin\model\Bbstopic;
use app\admin\model\Bbsreply;
use think\Session;
use \think\View;
class Bbs extends Controller
{
	//展示待审核的帖子
    public function index()
    {
        $view = new View();
        $request=Request::instance();
        $topic=new Bbstopic;//实例化帖子表
        //分页
        $totalnum=count($topic->findall());//数据总数
        $pagenum=4;//每页显示个数
        $totalpage=ceil($totalnum/$pagenum);//总页数
        $getpage=$request->get('page');
        $page=isset($getpage)?$getpage:1;
        $up=$page-1<1?1:$page-1;
        $down=$page+1>$totalpage?$totalpage:$page+1;
        $limit=($page-1)*$pagenum;
        $topicdata=$topic->findbypage($limit,$pagenum);//这一页的数据需要赋值
        //总共显示10个，仿照百度分页
        $pageshow=array();//建一个数组来放页数
        //将页数赋值到一个数组，传到渲染页面
        if($page>=1&&$page<=6){
            for($i=1;$i<=($totalpage<10?$totalpage:10);$i++){
                $pageshow[]=$i;
            }
        }else{
            for($i=$page-5;$i<=($page+4>$totalpage?$totalpage:$page+4);$i++){
                $pageshow[]=$i;
            }
        }
       // print_r($pageshow);die;
//        for ($i=0;$i<count($pageshow);$i++){
//            echo $pageshow["$i"];
//        }
//        die;
        return $view->fetch('examtopic',['pageshow'=>$pageshow,'up'=>$up,'down'=>$down,'topicdata'=>$topicdata]);
    }
    //单个删除帖子
    public function del()
    {
        $request=Request::instance();
        $id=$request->post('id');
        $topic=new Bbstopic;//实例化帖子表
        if($topic->deleteData($id)){
            echo 1;
        }else{
            echo 0;
        }

    }
    //删除多个帖子
    public function dels()
    {
        $request=Request::instance();
        $ids=$request->post('ids');
//        print_r($ids);die;
        $topic=new Bbstopic;//实例化帖子表
        $topic->deleteAll($ids);
        $idss=explode(',',$ids);
        echo json_encode($idss);
    }
    //审核多个帖子
    public function exam()
    {
        $request=Request::instance();
        $ids=$request->post('ids');
       // echo 1;
       // echo $ids;
        $topic=new Bbstopic;//实例化帖子表
        $topic->exams($ids);
        $idss=explode(',',$ids);
        echo json_encode($idss);
    }
    //展示待审核的评论
    public function reply()
    {
        $view = new View();
        $request=Request::instance();
        $reply=new Bbsreply;//实例化评论表
        //分页
        $totalnum=count($reply->findall());//数据总数
        $pagenum=4;//每页显示个数
        $totalpage=ceil($totalnum/$pagenum);//总页数
        $getpage=$request->get('page');
        $page=isset($getpage)?$getpage:1;
        $up=$page-1<1?1:$page-1;
        $down=$page+1>$totalpage?$totalpage:$page+1;
        $limit=($page-1)*$pagenum;
        $replydata=$reply->findbypage($limit,$pagenum);//这一页的数据需要赋值
        //总共显示10个，仿照百度分页
        $pageshow=array();//建一个数组来放页数
        //将页数赋值到一个数组，传到渲染页面
        if($page>=1&&$page<=6){
            for($i=1;$i<=($totalpage<10?$totalpage:10);$i++){
                $pageshow[]=$i;
            }
        }else{
            for($i=$page-5;$i<=($page+4>$totalpage?$totalpage:$page+4);$i++){
                $pageshow[]=$i;
            }
        }
        // print_r($pageshow);die;
//        for ($i=0;$i<count($pageshow);$i++){
//            echo $pageshow["$i"];
//        }
//        die;
        return $view->fetch('examreply',['pageshow'=>$pageshow,'up'=>$up,'down'=>$down,'replydata'=>$replydata]);
    }
    //单个删除评论
    public function delreply()
    {
        $request=Request::instance();
        $id=$request->post('id');
        $reply=new Bbsreply;//实例化评论表
        if($reply->deleteData($id)){
            echo 1;
        }else{
            echo 0;
        }

    }
    //删除多个评论
    public function delsreply()
    {
        $request=Request::instance();
        $ids=$request->post('ids');
        $reply=new Bbsreply;//实例化评论表
        $reply->deleteAll($ids);
        $idss=explode(',',$ids);
        echo json_encode($idss);
    }
    //审核多个评论
    public function examreply()
    {
        $request=Request::instance();
        $ids=$request->post('ids');
        // echo 1;
        // echo $ids;
        $reply=new Bbsreply;//实例化评论表
        $reply->exams($ids);
        $idss=explode(',',$ids);
        echo json_encode($idss);
    }
}
