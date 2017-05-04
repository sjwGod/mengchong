<?php
namespace app\index\controller;

// use think\Controller;
// use think\Request;
use think\View;
use app\index\model\Users;
use think\captcha;
use think\Validate;
use phpmailer\phpmailer; 
use think\Session;
use think\Db;
// use Ucpaas\Ucpaas; 
use app\index\model\Ucpaas;

class Login 
{
     public function index()
    {

        $view = new View();
        return $view->fetch('index');
    }

    /**
     * @Introduce
     * @Author LL
     * @Param
     *
    */
    public function login()
    {
        $view = new View();
        return $view->fetch('login');
    }

    /**
     * @Introduce  查库登录
     * @Author LL
     * @Param
     *
    */
    public function login_do()
    {
        if ($_POST) 
        {
            $data = $_POST;
            $name = $data['uname'];
            $pwd = $data['upassword'];
            $result = Db::table('mc_users')->where(" utel = '$name' || uemail = '$name'" )->find();
            $id = $result['uid'];
            $uname = $result['uname'];
            $utel = $result['utel'];
            $arr = array($id,$uname,$utel);
            if (!empty($result)) 
            {
                if ($result['utel'] == $name || $result['uemail'] == $name ) 
                {
                    Session::set('username',$arr);
                    if ($result['upassword'] == $pwd) 
                    {
                        echo 1;                       
                    }
                    else
                    {
                        echo 4;
                    }
                }
                else
                {
                    echo 2;
                }
            }
            else
            {
                echo 3;
            }
        }
        else
        {
            $view = new View();
            return $view->fetch('login');
        }

    }        

    /**
     * @Introduce  注册页面
     * @Author LL
     * @Param
     *
    */
    public function reg()
    {
        $view = new View();
        return $view->fetch('reg');
    }

    /**
     * @Introduce
     * @Author LL
     * @Param
     *
    */
    public function regyzmsend()
    {
        if ($_POST) 
        {
            $rand = rand(1111,9999);
            Session::set('yzmcode',$rand);
            $tel = $_POST['utel'];
            //初始化必填
            $options['accountsid']='2fb723ac1e323f2dd61f14a70d4a9818';
            $options['token']='1018ebdf5433a5e02ac72587bec16e0e';
            //初始化 $options必填
            $ucpass = new Ucpaas($options);
            //短信验证码（模板短信）,默认以65个汉字（同65个英文）为一条（可容纳字数受您应用名称占用字符影响），超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。
            $appId = "7036ccf71c024914b197c469d797e034";
            $to = $tel;
            $templateId = "42116";
            $param=$rand;
            echo $ucpass->templateSMS($appId,$to,$templateId,$param);
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * @Introduce  注册入库
     * @Author LL
     * @Param
     *
    */
    public function reg_do()
    {
        if ($_POST) 
        {
            //获取session验证码
            $session = session::get('yzmcode');
            // $session = session::pull('yzmcode');
            $code = $session;
            $data = $_POST;
            //获取传值验证码
            $yzmcode = $data['yzmcode'];
            if ($yzmcode == $code ) {
                $uname = $data['uname'];
                $pwd = $data['upassword'];
                //验证码验证成功 验证手机号
                $utel = $data['utel'];
                //查询是否有此手机号
                $select = Db::table('mc_users')->where(" utel = '$utel' " )->find();
                if (empty($select)) 
                {
                    $insert = Db::execute("insert into mc_users (uname,utel,upassword) values ('$uname','$utel','$pwd')");
                    if ($insert) 
                    {
                        echo 1;
                    }
                    else
                    {
                        echo 2;
                    }
                }
                else
                {
                    echo 3;
                }
            }
            else
            {
                $view = new View();
                return $view->fetch('reg');
            }
        }
        else
        {
            echo false;
        }    
    }

    /**
     * @Introduce  查看波奇网服务协议
     * @Author LL
     * @Param
     *
    */
    public function agreement()
    {
        $view = new View();
        return $view->fetch('agreement.html');
    }

    /**
     * @Introduce  手机号找回密码
     * @Author LL
     * @Param
     *
    */
    public function find_password()
    {
        $view = new View();
        return $view->fetch('find_password');
    }

    //手机发送验证码找回密码
    public function findyzmsend()
    {
        if ($_POST) 
        {
            $rand = rand(1111,9999);
            Session::set('findyzmcode',$rand);
            $tel = $_POST['utel'];
            //初始化必填
            $options['accountsid']='2fb723ac1e323f2dd61f14a70d4a9818';
            $options['token']='1018ebdf5433a5e02ac72587bec16e0e';
            //初始化 $options必填
            $ucpass = new Ucpaas($options);
            //短信验证码（模板短信）,默认以65个汉字（同65个英文）为一条（可容纳字数受您应用名称占用字符影响），超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。
            $appId = "7036ccf71c024914b197c469d797e034";
            $to = $tel;
            $templateId = "42116";
            $param=$rand;
            echo $ucpass->templateSMS($appId,$to,$templateId,$param);
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * @Introduce
     * @Author LL
     * @Param
     *
    */
    public function send_tel()
    {
        if ($_POST) 
        {
            $data = $_POST;
            $captcha = $_POST['captcha'];
            if(!captcha_check($captcha))
            {
                echo 1;
                die;
            }
            else
            {
                $session = session::get('findyzmcode');
                // $session = session::pull('findyzmcode');
                $code = $session;
                //获取传值验证码
                $yzmcode = $data['yzmcode'];
                if ($yzmcode == $code ) 
                {
                    //验证码验证成功 验证手机号
                    $utel = $data['utel'];
                    //查询是否有此手机号
                    $select = Db::table('mc_users')->where(" utel = '$utel' " )->find();
                    if (empty($select)) 
                    {
                        echo false;
                        die;
                    }
                    else
                    {
                        echo 3;
                    }
                }
                else
                {
                    echo 2;
                }
            } 
        }
        else
        {
            $view = new View();
            return $view->fetch('find_passwordByEmail');
        }
    }

    /**
     * @Introduce   邮箱找回密码
     * @Author LL
     * @Param
     *
    */
    public function find_passwordemail()
    {
        $view = new View();
        return $view->fetch('find_passwordByEmail');
    }

    /**
     * @Introduce  发送邮件获取验证码
     * @Author LL
     * @Param
     *
    */
    public function send_email()
    {
        if ($_POST) 
        {
            $data = $_POST;
            $captcha = $_POST['captcha'];
            if(!captcha_check($captcha))
            {
                echo 1;
                die;
            }
            else
            {
                $email = $data['emailTxt'];
                // $login = new Users;
                // $select = $login->select($email);
                $select = Db::table('mc_users')->where(" uemail = '$email'" )->find();
                if (empty($select)) 
                {
                    echo false;
                    die;
                }
                else
                {
                    $rand = rand(1111,9999);
                    $arr = array($email,$rand);
                    Session::set('rand',$arr);
                    $sendmail = '377970807@qq.com'; //发件人邮箱
                    $sendmailpswd = "yoebhkixhjnlbgcf"; //客户端授权密码,而不是邮箱的登录密码！
                    $send_name = 'liuliu';// 设置发件人信息，如邮件格式说明中的发件人，
                    $toemail = $email;//定义收件人的邮箱
                    $to_name = 'libo';//设置收件人信息，如邮件格式说明中的收件人
                    $mail = new PHPMailer();  
                    $mail->isSMTP();// 使用SMTP服务  
                    $mail->CharSet = "utf8";// 编码格式为utf8，不设置编码的话，中文会出现乱码  
                    $mail->Host = "smtp.qq.com";// 发送方的SMTP服务器地址  
                    $mail->SMTPAuth = true;// 是否使用身份验证  
                    $mail->Username = $sendmail;//// 发送方的
                    $mail->Password = $sendmailpswd;//客户端授权密码,而不是邮箱的登录密码！
                    $mail->SMTPSecure = "ssl";// 使用ssl协议方式 
                    $mail->Port = 465;//  qq端口465或587）
                    $mail->setFrom($sendmail,$send_name);// 设置发件人信息，如邮件格式说明中的发件人，
                    $mail->addAddress($toemail,$to_name);// 设置收件人信息，如邮件格式说明中的收件人，  
                    $mail->addReplyTo($sendmail,$send_name);// 设置回复人信息，指的是收件人收到邮件后，如果要回复，回复邮件将发送到的邮箱地址  
                    //$mail->addCC("xxx@qq.com");// 设置邮件抄送人，可以只写地址，上述的设置也可以只写地址(这个人也能收到邮件)  
                    //$mail->addBCC("xxx@qq.com");// 设置秘密抄送人(这个人也能收到邮件)  
                    //$mail->addAttachment("bug0.jpg");// 添加附件  
                    $mail->Subject = "验证码邮件";// 邮件标题  
                    $mail->Body = "您的验证码是:<br>".$rand;// 邮件正文  
                    //$mail->AltBody = "This is the plain text纯文本";// 这个是设置纯文本方式显示的正文内容，如果不支持Html方式，就会用到这个，基本无用  
                    if(!$mail->send()){// 发送邮件  
                        echo "Message could not be sent.";  
                        echo "Mailer Error: ".$mail->ErrorInfo;// 输出错误信息  
                    }else{  
                        echo '发送成功';  
                    }  
                }
            }
        }
        else
        {
            $view = new View();
            return $view->fetch('find_passwordByEmail');
        }
    }

    /**
     * @Introduce  验证码页面展示
     * @Author LL
     * @Param
     *
    */
    public function find_passwordrand()
    {
        $view = new View();
        return $view->fetch('find_passwordemailrand');
    }

    /**
     * @Introduce  邮箱验证码验证
     * @Author LL
     * @Param
     *
    */
    public function captcha()
    {
        if ($_GET) 
        {
            $data = $_GET;
            //session 获取验证码
            $session = Session::get('rand');
            // $session = Session::flash('rand');
            $email = $session[0]; //查询的邮箱
            $rand = $session[1];  //查询生成的验证码
            if ($data['RandTxt'] == $rand) 
            {
                echo true;
            }
            else
            {
                echo false;
            }

        }
        else
        {
            $view = new View();
            return $view->fetch('find_passwordByEmail');
        }
    }

    /**
     * @Introduce  （忘记密码）展示验证成功修改密码页面
     * @Author LL
     * @Param
     *
    */
    public function update_newpwd()
    {
        $view = new View();
        return $view->fetch('update_newpwd');
    }

    /**
     * @Introduce 修改密码过程
     * @Author LL
     * @Param
     *
    */
    public function update_pwd()
    {
        if ($_POST) 
        {
            $session = Session::get('rand');
            // $session = Session::pull('rand');
            $email = $session[0]; //查询的邮箱
            $rand = $session[1];  //查询生成的验证码
            $data = $_POST;
            $password = $data['upassword'];
            $update = Db::table('mc_users')->where(" uemail = '$email'")->update($data);
            if($update)
            {
                echo true;
            }
            else
            {
                echo false;
            }
            // Session::delete('rand');
        }
        else
        {
            $view = new View();
            return $view->fetch('find_passwordByEmail');
        }
    }

    /**
     * @Introduce  短信找回密码
     * @Author LL
     * @Param
     *
    */
    public function login_sms()
    {
        $view = new View();
        return $view->fetch('login_sms');
    }


    /**
     * @Introduce
     * @Author LL
     * @Param
     *
    */
    public function personal()
    {
        $view = new View();
        return $view->fetch('personal');
    }


    
}