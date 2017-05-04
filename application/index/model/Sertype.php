<?php
namespace app\index\model;
use think\Db;
use think\Model;

class Sertype extends Model
{
    //表名
    protected $table = 'mc_serType';
    //展示
    function show()
    {
        return Db::table($this->table)->select();
    }
//删除
    function deleteData($id)
    {
        return Db::table($this->table)->where('tid',  $id)->delete();
    }

//查询单条
    function find($id)
    {
        return Db::table($this->table)->where('tid',  $id)->find();
    }
//修改
    function updateData($data, $id)
    {
        return Db::table($this->table)->where('tid',  $id)->update($data);
    }
}