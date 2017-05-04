<?php
namespace app\index\model;
use think\Db;
use think\Model;

class Bbstopic extends Model
{
    //表名
    protected $table = 'mc_bbstopic';
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
    //首页只是展示最新10个
    function findten()
    {
        return Db::table($this->table)->where('tstate',2)->order('tid desc')->limit(10)->select();
    }
//删除
    function deleteData($id)
    {
        return Db::table($this->table)->where('tid',  $id)->delete();
//        Db::table('think_user')->delete(1);
//        Db::table('think_user')->delete([1,2,3]);
    }
//查询单条(根据版块id查询),有分页
    function findbysection($id,$limit,$pagenum)
    {
        //return Db::table($this->table)->where('tsid',  $id)->select();
        //下边的两个都可以
       // return Db::table($this->table)->where('tsid',  $id)->paginate(1,false,['query' => array('id' => $id),]);
       // return Db::table($this->table)->where('tsid',  $id)->paginate(2,false,['query' => request()->param(),]);
        return Db::table($this->table)->where('tsid',  $id)->where('tstate',2)->order('tid desc')->limit($limit,$pagenum)->select();
    }
   //查询所有数据来求数据总数
    function findall($id)
    {
        return Db::table($this->table)->where('tsid',  $id)->select();
    }

//查询单条
    function find($id)
    {
        return Db::table($this->table)->where('tid',  $id)->find();
    }
//根据点击修改点击量
    function updateData($id)
    {
//        $gettop=Db::table($this->table)->where('tid',  $id)->find();//查出数据
//        $newclick=$gettop['tclickcount']+1;//赋值
//        return Db::table($this->table)->where('tid',  $id)->update(['tclickcount' => $newclick]);
        //tp5自带的自增的
        return Db::table($this->table)->where('tid',  $id)->setInc('tclickcount');
    }
}