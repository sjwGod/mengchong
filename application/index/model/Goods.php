<?php
namespace app\index\model;

use think\Model;

class Goods extends Model
{
	//设置自增主键
	protected $pk = 'goods_id';

	//查询最新品
	public function selNew($where)
	{
		$re = $this->where($where)->limit(8)->order('add_time', 'desc')->select();
		return $re;
	}

	//查询最热品
	public function selHot($where)
	{
		$re = $this->where($where)->limit(8)->order('is_hot', 'desc')->select();
		return $re;
	}

	
}


?>