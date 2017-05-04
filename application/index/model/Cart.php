<?php
namespace app\index\model;

use think\Model;

class Cart extends Model
{
	//设置自增主键
	protected $pk = 'cart_id';

	//添加
	public function addOne($data)
	{
		$info = $this->insertGetId($data);
		return $info;
	}

	//根据user_id查询
	public function selAll($user_id)
	{
		$re = $this->alias('c')->join('Goods g','c.goods_id = g.goods_id')->where('user_id',$user_id)->select();
		return $re;
	}

	//删除
	public function del($where)
	{
		// $bloon = $this->where($where)->delete();
		$bloon = $this->destroy($where);
		return $bloon;
	}

	

}

?>