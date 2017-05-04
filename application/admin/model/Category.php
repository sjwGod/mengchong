<?php
namespace app\admin\model;

use \think\Model;

class Category extends Model
{
	//设置自增主键
	protected $pk = 'c_id';

	//查询
	public function selAll()
	{
		$re = $this->select();
		return $re;
	}
}

?>