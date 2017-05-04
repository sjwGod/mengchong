<?php
namespace app\index\model;

use think\Db;
use think\Model;

class Sign extends Model
{
	 // 设置当前模型对应的完整数据表名称
      protected $table = 'Sign_details';
 

	
	public function FindOne($open_id=''){
		 $time = strtotime(date("Y-m-d",time()));

		 $data = Db::table($this->$table)
		    ->where('Open_id',$open_id)
		    ->where('Month',$time)
		    ->find();
		    return $data;
		



	}


}