<?php
namespace app\index\controller;
use think\Db;
use \think\View;
use \think\Controller;
use  \think\Request;
class Signing extends Controller
{

	private $opk = "123456";
	//签到活动界面
	public function Index(){
		$code  =  isset($_GET['code'])?$_GET['code']:'';
		$accesstoken = file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx0dde84b819b64c36&secret=099f7b2816ef33b57c269e06bcfc2d68&code=".$code."&grant_type=authorization_code");
			$data = json_decode($accesstoken,true);
			return $this->views($data['openid']);
	}

    public function views($openid=1)
    {  

    	$request = Request::instance();
        $data    = $request->param();
   
        $mes = $this->Get_mesing($openid);
        
        if(!empty($mes['list'])){
			foreach($mes['list'] as $key=>$val){
			        	$arr[]['signDay']=intval(date('d',$val['Month']));
			}
        }else{
        	$arr=[];
        }
        $mes['is_check'] = $this->Check_sign($openid);
       // var_dump($arr);die;
        $mes['today'] = json_encode($arr);
        $mes['openid'] = $openid;
//s var_dump($mes);die;
        return $this->fetch('indexs',['mes'=>$mes]);
    }





    //执行签到动作
    ////参数会接到一个   用户唯一openid
    /// 和 一钥匙
    public function Sign_do(){
    	   	
      $request = Request::instance();
      $data    = $request->param();

      $open_id = isset($data['open_id'])?$data['open_id']:'';
      $open_key = isset($data['open_key'])?$data['open_key']:'';

     //|| $open_key!=$this->opk
      if(!isset($open_id) || empty($open_id)){
      	$arr['status']=3;
      	$arr['error'] = '！请检查你的参数或者钥匙！！';
      }else{

		  if($this->Check_sign($open_id)){//如果已经签到了
	         $arr = $this->Get_mes($open_id);
	         $arr['status'] = 0;//已经签到
	         
		  }else{//还没签到		  
		  	
		  	$this->Mes_In($open_id);		  	
		  	$arr = $this->Get_mes($open_id);
		  	$mes = $this->Get_mesing($open_id);
           
			foreach($mes['list'] as $key=>$val)
			{
			      $day[]['signDay']=intval(date('d',$val['Month']));
			}
			$arr['day'] = $day;
			$arr['time']= date('Y-m-d H:i',time());
			$arr['status'] = 1;//签到成
		  }
	  }
	  
	  echo json_encode($arr);
        	
    }

    //检测用户是否今日已经签到
    private function Check_sign($open_id){
 		$time = strtotime(date("Y-m-d",time()));
 		$data = Db::table("Sign_details")
		    ->where('Open_id',$open_id)
		    ->where('Month',$time)
		    ->find();
    	if(empty($data)){
    		return false;
    	}else{
    		return $data;
    	}
    }

    //签到信息入库
    private function Mes_In($open_id){
    	$Yestoday = strtotime(date("Y-m-d",strtotime("-1 day")));
    	$today =  strtotime(date("Y-m-d",time()));

    	$data = Db::table('Sign_details')
			    ->where('Open_id',$open_id)
		        ->where('Month',$Yestoday)
			    ->find();

			   
	     if(empty($data)){//不连续
	     	$mes = ['Open_id' => $open_id, 'Date' => time(),'Month' => $today];
			Db::table('Sign_details')->insert($mes);
			if($this->Is_has($open_id)){
				Db::execute('update Sign_user set Sign_num=1,Integral=Integral+10,Yes_reward=5  where Openid=?',[$open_id]);
			}else{
				$mess = ['Openid' => $open_id, 'Sign_num' => 1,'Integral' => 10, 'Yes_reward' => 5];
			    Db::table('Sign_user')->insert($mess);

			}

	    }else{//连续 
	     	$mes = ['Open_id' => $open_id, 'Date' => time(),'Month' => $today];
			Db::table('Sign_details')->insert($mes);

					
			Db::execute('update Sign_user set Sign_num=Sign_num+1,Integral=Integral+10+Yes_reward,Yes_reward=Yes_reward+5  where Openid=?',[$open_id]);

	     }


    }

    //加测是否存在用户
    private function Is_has($open_id){
    	$data = Db::table('Sign_user')
			    ->where('Openid',$open_id)
			    ->find();
	    if(empty($data)){
	    	return false;
	    }else{
	    	return true;
	    }

    }

    //得到用户签到信息
    private function Get_mes($open_id){
    	$data = Db::table('Sign_user')
			    ->where('Openid',$open_id)
			    ->find();
	   return $data;
    }

    //查询出用户具体的签到详情
    private function Get_mesing($openid){
    	ini_set('date.timezone','Asia/Shanghai');
		$year = date("Y");
		$month = date("m");
		$allday = date("t");
		$strat_time = strtotime($year."-".$month."-1");//本月第一天
		$end_time = strtotime($year."-".$month."-".$allday);
		$data = Db::table('Sign_details')
	  	->where('Month',['>',$strat_time],['<',$end_time],'and')
	  	->where('Open_id',$openid)
	    ->select();
	    $arr['month_counts'] = count($data);
	    $arr['list'] = $data;
	    $arr['mes']  = $this->Get_mes($openid);
	    $arr['today']= $this->Check_sign($openid);
	  
	    return $arr;		


    }


   
}

