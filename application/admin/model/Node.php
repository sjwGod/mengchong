<?php
namespace app\admin\model;
use think\Db;
use think\Model;

class Node extends Model
{
    //表名
    protected $table = 'mc_admin_node';

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
        return Db::table($this->table)->where('nid','=',$id)->delete();
    }
//查询单条
    function findData($id)
    {
        return Db::table($this->table)->where('nid','=',$id)->find();
    }
//修改
    function updateData($data,$id)
    {
        return Db::table($this->table)->where('nid','=',$id)->update($data);
    }
}