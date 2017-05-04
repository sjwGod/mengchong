<?php
namespace app\index\model;

use think\Model;

class Address extends Model
{

	//根据用户id查询数据
    public function selOne($u_id)
    {
        $re = $this->where('user_id',$u_id)->find();
        return $re;
    }

    //添加
   	public function addOne($data)
   	{
   		$info = $this->insert($data);
   		return $info;
   	}
}
?>