<?php
namespace app\index\model;

use think\Model;

class Category extends Model
{
	//设置自增主键
	protected $pk = 'c_id';

	//查询所有数据
	public function selAll()
	{
		$re = $this->select();
		return $re;
	}

	//根据p_id查询
	public function selOne($c_id = 0)
	{
		$re = $this->where('p_id',$c_id)->select();
		return $re;
	}


}

?>