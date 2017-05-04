<?php
namespace app\index\model;
use think\Db;
use think\Model;

class Bbssection extends Model
{
    //表名
    protected $table = 'mc_bbssection';
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
        return Db::table($this->table)->where('sid',  $id)->delete();
//        Db::table('think_user')->delete(1);
//        Db::table('think_user')->delete([1,2,3]);
    }

//查询单条
    function findData($id)
    {
        return Db::table($this->table)->where('sid',  $id)->find();
    }

//修改
    function updateData( $id)
    {
        $getsection=Db::table($this->table)->where('sid',  $id)->find();
        $newtopicnum=$getsection['stopiccount']+1;
        return Db::table($this->table)->where('sid',  $id)->update(['stopiccount'=>$newtopicnum]);
    }
}