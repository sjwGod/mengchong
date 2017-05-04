<?php
namespace app\index\model;
use think\Db;
use think\Model;

class Bbsreply extends Model
{
    //表名
    protected $table = 'mc_bbsreply';
    //增加
    function insertData($data)
    {
        return Db::table($this->table)->insertGetId($data);
        // return $this->insertGetId($data);
    }

 //展示
    function show()
    {
        return Db::table($this->table)->select();
    }

//删除
    function deleteData($id)
    {
        return Db::table($this->table)->where('rid',  $id)->delete();
//        Db::table('think_user')->delete(1);
//        Db::table('think_user')->delete([1,2,3]);
    }

//查询单条
    function findData($id)
    {
        return Db::table($this->table)->where('rid',  $id)->find();
    }
//查询多条
    function finds($id)
    {
        return Db::table($this->table)->where('rtid', $id)->where('rstate',2)->order('rid desc')->select();
    }
//修改
    function updateData($data, $id)
    {
        return Db::table($this->table)->where('rid',  $id)->update($data);
    }
}