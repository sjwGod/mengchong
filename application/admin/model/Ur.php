<?php
namespace app\admin\model;
use think\Db;
use think\Model;

class Ur extends Model
{
	//表名
    protected $table = 'mc_admin_user_role';

    //根据user_id获取role_id
    function roleId($userId)
    {
    	return Db::table($this->table)->where(['user_id'=>$userId])->select();
    }





	function insertAll($data)
    {
        return Db::name($this->table)->insertAll($data);
    }

}