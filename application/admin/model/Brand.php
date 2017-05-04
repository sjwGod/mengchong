<?php
namespace app\admin\model;

use think\Model;
use think\Db;

class Brand extends Model
{

	//设置自增主键
	protected $pk = 'brand_id';

	//添加
	public function addOne($data)
	{
		$info = $this->insert($data);
		return $info;
	}


	//查询品牌
	public function selAll()
	{
		$re = $this->field('brand_id,brand_name')->select();
		return $re;
	}

	//查询全部商品
	public function selLimit($page_size,$limit)
	{
		$re = $this->limit($limit,$page_size)->select();
		return $re;
	}

	//查询总条数
	public function selCount()
	{
		$re = $this->count();
		return $re;
	}

	//删除
	public function del($brand_id)
	{
		$bloon = Db::table('mc_brand')->delete($brand_id);
		return $bloon;
	}

	//修改
	public function up($brand_desc,$brand_id)
	{
		$bloon = $this->save(['brand_desc'=>$brand_desc],['brand_id'=>$brand_id]);
		return $bloon;
	}
}

?>