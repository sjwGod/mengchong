<?php
namespace app\index\model;

use think\Model;

class Order extends Model
{
	//设置自增主键
	protected $pk = 'order_id';

	//添加订单
	public function addOne($data)
	{
		$info = $this->insert($data);
		return $info;
	}
}

?>