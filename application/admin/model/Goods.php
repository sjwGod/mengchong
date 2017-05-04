<?php
namespace app\admin\model;

use think\Model;
use think\Db;

class Goods extends Model
{
    //添加
    public function addOne($data)
    {
    	$info = $this->insert($data);
    	return $info;
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
	public function del($goods_id)
	{
		$bloon = Db::table('mc_goods')->delete($goods_id);
		return $bloon;
	}

	//修改
	public function up($goods_desc,$goods_id)
	{
		$bloon = $this->save(['goods_desc'=>$goods_desc],['goods_id'=>$goods_id]);
		return $bloon;
	}
}