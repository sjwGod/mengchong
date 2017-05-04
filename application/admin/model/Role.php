<?php
namespace app\admin\model;
use think\Db;
use think\Model;

class Role extends Model
{
    //表名
    protected $table = 'mc_admin_role';

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
        return Db::table($this->table)->where('rid','=',$id)->delete();
    }
//查询单条
    function findData($id)
    {
        return Db::table($this->table)->where('rid','=',$id)->find();
    }
//修改
    function updateData($data,$id)
    {
        return Db::table($this->table)->where('rid','=',$id)->update($data);
    }
}