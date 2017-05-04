<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use app\index\model\Bbstopic;
use app\index\model\Bbssection;
use app\index\model\Bbsreply;
use think\Session;
use think\Db;
use \think\View;
class Bbs extends Common
{

    
	//展示论坛首页
    public function index()
    {
        $view = new View();
        $topic=new Bbstopic;//实例化帖子表
        $section=new Bbssection;//实例化版块表
        $data=$topic->findten();
        $sections=$section->show();
        $user=Session::get('username');
        //判断是否登录
        if(empty($user)){
            $state=1;//没有登录
        }else{
            $state=2;//登录
        }
       // print_r($state);die;
       // print_r($data);die;
        return $view->fetch('index',['data'=>$data,'sections'=>$sections,'state'=>$state,'username'=>$user[1]]);
    }
    //展示论坛列表
    public function  liebiao()
    {
        $view = new View();
        $request=Request::instance();
        $sid=$request->get('id');//论坛模块id
        $section=new Bbssection;//实例化版块表
        $sectiondata=$section->findData($sid);//查出相应模块数据
        $topic=new Bbstopic();//实例化帖子表
        //分页
        $totalnum=count($topic->findall($sid));//数据总数
        $pagenum=10;//每页显示个数
        $totalpage=ceil($totalnum/$pagenum);//总页数
        $getpage=$request->get('page');
        $page=isset($getpage)?$getpage:1;
        $up=$page-1<1?1:$page-1;
        $down=$page+1>$totalpage?$totalpage:$page+1;
        $limit=($page-1)*$pagenum;

        $topicdata=$topic->findbysection($sid,$limit,$pagenum);//根据版块id拿帖子
        $user=Session::get('username');
        //判断是否登录
        if(empty($user)){
            $state=1;//没有登录
        }else{
            $state=2;//登录
        }
        $pageshow=array(
            'page'=>$page,
            'totalpage'=>$totalpage,
            'up'=>$up,
            'down'=>$down,
            'id'=>$sid,
        );
        return $view->fetch('liebiao',['sectiondata'=>$sectiondata,'topicdata'=>$topicdata,'state'=>$state,'pageshow'=>$pageshow,'username'=>$user[1]]);
    }
    //展示论坛正文
    public function  zhengwen()
    {
        $view = new View();
        $request=Request::instance();
        $tid=$request->get('id');//帖子的id
        $topic=new Bbstopic();//实例化帖子表
        $topicdata=$topic->find($tid);//根据帖子id拿帖子内容
        $topic->updateData($tid);//根据点击修改点击量
        $reply=new Bbsreply();//实例化回复表
        $replydata=$reply->finds($tid);
        $user=Session::get('username');
        //判断是否登录
        if(empty($user)){
            $state=1;//没有登录
        }else{
            $state=2;//登录
        }

        //print_r($replydata);die;
        return $view->fetch('zhengwen',['topicdata'=>$topicdata,'replydata'=>$replydata,'state'=>$state,'username'=>$user[1]] );
    }
    //添加回复帖子的方法
    public function addreply()
    {
        $reply=new Bbsreply();
        $user=Session::get('username');//登录成功保存的内容
        $request=Request::instance();
        $getreply=$request->post();//接的评论内容

        $data=array(
            'rtid'=>$getreply['rtid'],
            'rsid'=>$getreply['rsid'],
            'rcontents'=>htmlspecialchars($getreply['rcontents']),
            'ruid'=>$user['0'],
            'rname'=>$user['1'],
            'rtime'=>date("Y-m-d h:i:s",time()),
            'rstate'=>2,
        );
        $in=$reply->insertData($data);
        $id=$getreply['rtid'];
        if($in){
           // $this->success('评论提交成功，等待审核,再去看看吧','Bbs/index');
            echo"<script>alert('评论发表成功，再去看看吧');location.href='zhengwen?id=$id';</script>";
        }else{
            echo"<script>alert('评论发表失败，再去看看吧');location.href='zhengwen?id=$id';</script>";
        }
    }
    //展示发送帖子的方法

    public function posttopic()
    {
        $request=Request::instance();
        $tsid=$request->get('tsid');//帖子版块的id
        $view = new View();
        return $view->fetch('posttopic',['tsid'=>$tsid] );
    }
    //添加帖子
    public function addtopic()
    {
        $user=Session::get('username');//登录成功保存的内容
        $request=Request::instance();
        $addtopic=$request->post();//帖子的内容
        $data=array(
            'tsid'=>$addtopic['tsid'],
            'tuid'=>$user['0'],
            'tuname'=>$user['1'],
            'topic'=>htmlspecialchars($addtopic['topic']),
            'tcontents'=>htmlspecialchars($addtopic['tcontents']),
            'time'=>date("Y-m-d h:i:s",time()),
            'tclickcount'=>0,
            'tstate'=>1,
        );
        $section=new Bbssection;//实例化版块表
        $sid=$addtopic['tsid'];//版块id
        $section->updateData($sid);//根据id修改版块发帖数量
        $topic=new Bbstopic();//实例化帖子表
        $intopic=$topic->insertData($data);
        $id=$addtopic['tsid'];//版块id
        if($intopic){
           // $this->success('帖子发表成功，等待审核,再去看看吧','Bbs/index');
          // echo"<script>alert('帖子发表成功，等待审核,再去看看吧');location.href='index.html';</script>";
           echo"<script>alert('帖子发表成功，等待审核,再去看看吧');location.href='liebiao?id=$id';</script>";
        }else{
            echo"<script>alert('帖子发表失败，再去看看吧');location.href='liebiao?id=$id';</script>";
        }
    }
}
