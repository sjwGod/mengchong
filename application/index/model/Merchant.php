<?php
namespace app\index\model;
use think\Db;
use think\Model;

class Merchant extends Model
{
    //表名
    protected $table = 'mc_merchant';
    //展示
    function show()
    {
        return Db::table($this->table)->select();
    }

//查询单条
    function find($id)
    {
        return Db::table($this->table)->where('mid',  $id)->find();
    }

}