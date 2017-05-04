<?php
namespace app\index\controller;

use think\Controller;


class Weixin extends Controller
{
	private $appid="wx0dde84b819b64c36";                    //微信配置
    private $appsecret = "099f7b2816ef33b57c269e06bcfc2d68";//微信配置


	public function Index()
	{
		
		
		if(isset($_GET["echostr"]))
		{
		    $this->valid();//微信验证

		}else
		{
		    $this->responseMsg();
		}

	}

   //响应消息
    public function responseMsg()
    {
    	  $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        if (!empty($postStr)){
            $this->logger("R ".$postStr);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);

            switch ($RX_TYPE)
            {
                case "event":
                    $result = $this->receiveEvent($postObj);
                    break;
                case "text":
                    $result = $this->receiveText($postObj);
                    break;
                case "image":
                    $result = $this->receiveImage($postObj);
                    break;
                case "location":
                    $result = $this->receiveLocation($postObj);
                    break;
                case "voice":
                    $result = $this->receiveVoice($postObj);
                    break;
                case "video":
                    $result = $this->receiveVideo($postObj);
                    break;
                case "link":
                    $result = $this->receiveLink($postObj);
                    break;
                default:
                    $result = "unknown msg type: ".$RX_TYPE;
                    break;
            }
          
            echo $result;
        }else {
            echo "";
            exit;
        }
    }


      //接收事件消息
    private function receiveEvent($object)
    {
        $content = "";
        switch ($object->Event)
        {
            case "subscribe":
                 $title = "我是您身边的萌宠管家";
                 $con= (!empty($object->EventKey))?("\n来自二维码场景 ".str_replace("qrscene_","",$object->EventKey)):"其实我不仅仅是你的宠物管家，我还是您的生活小助手，有什么问题可以问我的，语音也可以的亲！！！";
                  $content = array();
                  $content[] = array("Title"=>$title,  "Description"=>$con, "PicUrl"=>"http://www.phpwangheng.top/t01aa4020750dc4c48b-1382163897301.jpg", "Url" =>"http://http://www.phpwangheng.top/t01aa4020750dc4c48b-1382163897301.jpg");
                 echo  $this->transmitNews($object,$content);
                break;
            case "unsubscribe":
                $content = "取消关注";
                break;
            case "SCAN":
                $content = "扫描场景 ".$object->EventKey;
                break;
            case "CLICK"://点击click时间
                switch ($object->EventKey)
                {
                    case "V1001_GOOD":
                        $this->Sign($object);
                        break;
                    default:
                        $content = "".$object->EventKey;
                        break;
                }
                break;
            case "LOCATION":
                $content = "上传位置：纬度".$object->Latitude.";经度 ".$object->Longitude;
                break;
            case "VIEW":
                $object->EventKey;
                break;
            default:
                $content = "receive a new event: ".$object->Event;
                break;
        }
        // $result = $this->transmitText($object, $content);
        // return $result;
    }

    //接收文本消息
    private function receiveText($object)
    {
        $keyword =  $object->Content;//回复内容
        $this->Robot($object,$keyword);

    }

    //接收语音消息
    private function receiveVoice($object)
    {
        if (isset($object->Recognition) && !empty($object->Recognition)){
            $content = $object->Recognition;
            $this->Robot($object, $content);
        }else{
            $content = array("MediaId"=>$object->MediaId);
            $result = $this->transmitVoice($object, $content);
             return $result;
        }
       
    }


    //只能聊天机器人接口
    private function Robot($object,$keyword)
    {     
        $url="http://api.qingyunke.com/api.php?key=free&appid=0&msg=".urlencode($keyword);
        $con = json_decode(file_get_contents($url),true);
        if($con['result']==0){
            $return_con = $con['content'];
        }else{
             $return_con = "臣妾不知啊！！！！";
        }
        echo $this->transmitText($object,$return_con);
    }

     //点击事件处理(签到)
    private function Sign($object){
          $open_id = $this->Get_opend_id($object);     

          $url = 'http://www.phpwangheng.top/mengchong/public/index.php/index/signing/sign_do?open_id='.$open_id;//去执行签到接口
          $data = json_decode(file_get_contents($url),true);
          // $data['Sign_num']=3;
          // $data['Integral']=10;
          // $data['Yes_reward']=1;
         
        $con = '连续签到天数'.$data['Sign_num'].'天';
        // $con.= '积分'.$data['Integral'];
        $con.='今日奖励：'.$data['Yes_reward'];
         
        echo  $this->transmitText($object,$con);
 

    }



    //获取用户  I唯一 open_id
    private function Get_opend_id($object){
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$this->Get_Token()."&openid=".$object->FromUserName ."&lang=zh_CN";
         $data = $this->Url($url);
         return $data['openid'];
    }

    //获取TOKEN 如果有就用，没有取
    private function Get_Token(){
        $last_time = 3600*2-1000;
        session_set_cookie_params($last_time);//设置session 的过期时间token的有效期
        session_start();
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appid."&secret=".$this->appsecret;
      
        if(!isset($_SESSION['token']) && empty($_SESSION['token'])){
            $data = $this->Url($url);
            $token = $data['access_token'];
            $_SESSION['token']= $token;
        }else{
            $token = $_SESSION['token'];
        }
       return $token;

    }

    /*
     调用接口
     @ url 
     @ 是否转为数组形式
     @ 是否转为数组对象
     */
    private function Url($url,$type=true,$Otype=false)
    {
        $con = file_get_contents($url);
        if($type){
           $con = json_decode($con,true);
        }
        if($Otype){
            $con = json_decode($con);
        }
        return $con;
    }



   
 


    //回复文本消息
    private function transmitText($object, $content)
    {
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    </xml>";
        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content);
        return $result;
    }

 

    //回复图文消息
    private function transmitNews($object, $newsArray)
    {
        if(!is_array($newsArray)){
            return;
        }
        $itemTpl = "  <item>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
        <PicUrl><![CDATA[%s]]></PicUrl>
        <Url><![CDATA[%s]]></Url>
         </item>";

        $item_str = "";
        foreach ($newsArray as $item){
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
        }
        $newsTpl = "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[news]]></MsgType>
                <Content><![CDATA[]]></Content>
                <ArticleCount>%s</ArticleCount>
                <Articles>$item_str</Articles>
                </xml>";

        $result = sprintf($newsTpl, $object->FromUserName, $object->ToUserName, time(), count($newsArray));
        return $result;
    }

    //回复音乐消息
    private function transmitMusic($object, $musicArray)
    {
        $itemTpl = "<Music>
    <Title><![CDATA[%s]]></Title>
    <Description><![CDATA[%s]]></Description>
    <MusicUrl><![CDATA[%s]]></MusicUrl>
    <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
</Music>";

        $item_str = sprintf($itemTpl, $musicArray['Title'], $musicArray['Description'], $musicArray['MusicUrl'], $musicArray['HQMusicUrl']);

        $textTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[music]]></MsgType>
$item_str
</xml>";

        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    //日志记录
    private function logger($log_content)
    {
        if(isset($_SERVER['HTTP_APPNAME'])){   //SAE
            sae_set_display_errors(false);
            sae_debug($log_content);
            sae_set_display_errors(true);
        }else if($_SERVER['REMOTE_ADDR'] != "127.0.0.1"){ //LOCAL
            $max_size = 10000;
            $log_filename = "log.xml";
            if(file_exists($log_filename) and (abs(filesize($log_filename)) > $max_size)){unlink($log_filename);}
            file_put_contents($log_filename, date('H:i:s')." ".$log_content."\r\n", FILE_APPEND);
        }
    }
































	//检测
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }

    private function checkSignature()
    {
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
                
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        
        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
}