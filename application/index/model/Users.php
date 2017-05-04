<?php
namespace app\index\model;


use think\Db;
use think\Model;


class Users extends Model
{
    protected $table = 'mc_users';//表名

    
    function select($name)
    {
        return Db::table($this->table)->where('uname','=',$name ,'||' ,'uemail','=',$name ,'||', 'utel','=',$name)->find();
    }


//增加
    function insertData($data)
    {
        return Db::table($this->table)->insertGetId($data);
    }
//展示
    function show()
    {
        return Db::table($this->table)->select();
    }
//删除
    function deleteData($id)
    {
        return Db::table($this->table)->where('u_id','=',$id)->delete();
    }
//查询单条
    function findData($id)
    {
        return Db::table($this->table)->where('u_id','=',$id)->find();
    }
//修改
    function updateData($data,$id)
    {
        return Db::table($this->table)->where('u_id','=',$id)->update($data);
    }
}