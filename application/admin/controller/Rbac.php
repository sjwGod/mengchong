<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\User;
use app\admin\model\Role;
use app\admin\model\Node;
use app\admin\model\Ur;
use app\admin\model\Rn;
use think\Request;
use \think\View;
use think\Db;
class Rbac extends Common
{
    public function index()
    {
        //用户列表
        $view = new View();
        //查询所有用户
        $model = new User();
        $data = $model->show();
        //查询所有角色
        $model1 = new Role();
        $role = $model1->show();

        //循环出所有用户根据用户id查询出关联表中角色id
        foreach ($data as $key => $value)
         {
            // 查询关联表根据用户id获取对应角色id
            $roleId = Db::table('mc_admin_user_role')->where('user_id',$value['uid'])->column('role_id');
            // var_dump($roleId);
            // 根据角色id获取角色名称
            $roleName = array();
            foreach ($role as $k => $v) {
                if(in_array($v['rid'], $roleId)){
                    array_push($roleName, $v['rname']);
                }
            }
            // var_dump($roleName);
            //给管理员表添加角色字段
            $data[$key]['roleName'] = implode(' , ', $roleName);
        }
        return $view->fetch('user',['data'=>$data]);
    }

    //添加用户
    public function user()
    {
        $view = new View();
        $role = new Role();
        $data = $role->show();
        return $view->fetch('user_add',['role'=>$data]);
    }

    //用户添加入库
    public function add()
    {
        $request=Request::instance()->post();
        // var_dump($request);die;
        $uname = $request['uname'];
        $upwd = $request['upwd'];
        $utel = $request['utel'];
        $uemail = $request['uemail'];
        $login_time = date('Y-m-d H:i:s',time());
        $login_ip = $request['login_ip'];
        $status = $request['status'];
        //定义一个新数组把user表中的字段存进去，然后入库
        $arr = array('uname'=>$uname,'upwd'=>$upwd,'utel'=>$utel,'uemail'=>$uemail,'login_time'=>$login_time,'login_ip'=>$login_ip,'status'=>$status);
        // var_dump($arr);die;
        $model = new User();
        $res = $model->insertData($arr);
        // print_r($res);die;
        //获取用户id
        $uid = $model->getlastId();
        // echo $uid;die;
        //角色id
        $rid = $request['role'];
        $data = array();
        foreach ($rid as $key => $value) {
            $data[$key]['user_id'] = $uid;
            $data[$key]['role_id'] = $value;
        }
        // var_dump($data);die;
        // 实例化model，将用户id和角色id加入关联表
        $ur = new Ur();
        $info = $ur->saveAll($data);
        if($info)
        {
            echo "<script>alert('添加成功！');location.href='index'</script>";
        }else{
            echo "<script>alert('添加失败！');history.back();</script>";
        }

    }

    
    //角色列表展示
    public function role()
    {
        $view = new View();
        $model = new Role();
        $data = $model->show();
        return $view->fetch('role',['data'=>$data]);
    }

    //添加角色
    public function role_add()
    {
        $data = Request::instance()->post();
        if(empty($data))
        {
            $view = new View();
            return $view->fetch('role_add');
        }else{
            $model = new Role();
            $res = $model->insertData($data);
            if($res)
            {
                echo "<script>alert('添加成功！');location.href='role'</script>";
            }else{
                echo "<script>alert('添加失败！');history.back();</script>";
            }
        }
    }

    /**
     * 角色分配权限
     */
    public function roleNode()
    {
        //获取角色id，查询出角色信息
        $rid = Request::instance()->param('rid');
        $role = new Role();
        $roleData = $role->findData($rid);
        //查询所有权限
        $node = new Node();
        $nodeData = $node->show();
        //查询role-node关联表数据
        $roleNode = Db::table('mc_admin_role_node')->where('role_id',$rid)->select();
        $data = array();
        foreach ($roleNode as $k => $v) {
            $data[] = $v['node_id'];
        }
        // var_dump($data);die;
        $view = new View();
        return $view->fetch('roleNode',['roleData'=>$roleData,'nodeData'=>$nodeData,'data'=>$data]);
    }
    //添加权限
    public function ins_rn()
    {
        $data = Request::instance()->post();
        //先删除原本角色绑定的权限
        $res = Db::table('mc_admin_role_node')->where('role_id',$data['role_id'])->delete();
        //循环输出选中权限
        foreach ($data['node_id'] as $key => $value) {
            $arr[$key]['role_id'] = $data['role_id'];
            $arr[$key]['node_id'] = $value;
        }
        // var_dump($arr);die;
        //重新添加权限
        $rn = new Rn();
        $info = $rn->saveAll($arr);
        // var_dump($info);die;
        if($info)
        {
            echo "<script>alert('赋权成功！');location.href='role'</script>";
        }else{
            echo "<script>alert('赋权失败！');history.back();</script>";
        }
    }


    //权限列表
    public function node()
    {
        $view = new View();
        $model = new Node();
        $data = $model->show();
        return $view->fetch('node',['data'=>$data]);
    }

    //添加权限
    public function node_add()
    {
        $data = Request::instance()->post();
        if(empty($data))
        {
            $view = new View();
            return $view->fetch('node_add');
        }else{
            $model = new Node();
            $res = $model->insertData($data);
            if($res)
            {
                echo "<script>alert('添加成功！');location.href='node'</script>";
            }else{
                echo "<script>alert('添加失败！');history.back();</script>";
            }
        }
    }





}