<?php
namespace app\admin\model;
use think\Db;
use think\Model;

class Bbsreply extends Model
{
    //表名
    protected $table = 'mc_bbsreply';
    //删除
    function deleteData($id)
    {
        return Db::table($this->table)->where('rid',  $id)->delete();
//        Db::table('think_user')->delete(1);
//        Db::table('think_user')->delete([1,2,3]);
    }
    //批量删除
    function deleteAll($ids)
    {
        return Db::table($this->table)->delete($ids);
    }
    //批量审核
    function exams($ids)
    {
        return Db::table($this->table)->whereIn('rid',$ids)->update(['rstate'=>2]);
    }
//查询(根据版块id查询),有分页
    function findbypage($limit,$pagenum)
    {
        return Db::table($this->table)->where('rstate',2)->limit($limit,$pagenum)->select();
    }
    //查询所有待审核的数据
    function findall()
    {
        return Db::table($this->table)->where('rstate', 1)->select();
    }

}