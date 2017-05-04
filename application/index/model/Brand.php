<?php
namespace app\index\model;

use think\Model;

class Brand extends Model
{
	//设置自增主键
	protected $pk = 'brand_id';

	//查询全部商品
	public function selAll($page_size,$limit)
	{
		$re = $this->alias('b')->join('Goods g','b.brand_id = g.brand_id')->limit($limit,$page_size)->select();
		return $re;
	}

	//商品详情
	public function selOne($where)
	{
		$re = $this->alias('b')->join('Goods g','b.brand_id = g.brand_id')->where($where)->find();
		return $re;
	}

	//查询总条数
	public function selCount()
	{
		$re = $this->alias('b')->join('Goods g','b.brand_id = g.brand_id')->count();
		return $re;
	}
}
?>