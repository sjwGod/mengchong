<?php
namespace app\admin\model;
use think\Db;
use think\Model;

class User extends Model
{
    //表名
    protected $table = 'mc_admin_user';

    //增加
    function insertData($data)
    {
        return Db::table($this->table)->insert($data);
    }
//展示
    function show()
    {
        return Db::table($this->table)->select();
    }
//删除
    function deleteData($id)
    {
        return Db::table($this->table)->where('uid','=',$id)->delete();
    }
//查询单条
    function findData($id)
    {
        return Db::table($this->table)->where('uid','=',$id)->find();
    }
//修改
    function updateData($data,$id)
    {
        return Db::table($this->table)->where('uid','=',$id)->update($data);
    }

    //获取最后一条id
    function getlastId()
    {
        return Db::table($this->table)->getLastInsID();
    }


}