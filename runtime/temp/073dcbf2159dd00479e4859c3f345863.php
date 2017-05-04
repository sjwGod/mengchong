<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"E:\PYS\mengchong\public/../application/index\view\login\find_password.html";i:1492824153;}*/ ?>
<!doctype html><html><head><meta charset="utf-8"><meta name="author" content="m.boqii.com"><meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0"><meta name="apple-mobile-web-app-capable" content="yes"><meta name="apple-mobile-web-app-status-bar-style" content="black"><meta name="format-detection" content="telephone=no"><title>&#x627E;&#x56DE;&#x5BC6;&#x7801;</title><style>.reg div.tel {
            border-radius: 8px;
        }
        .add_address_body{
            padding-top: 0.892em;
        }</style><link href="__ROOT__/login/css/fc10f6847e0c38498fbb.vendors.min.css"  rel="stylesheet"><link href="__ROOT__/login/css/ac788604d7bc510eaaeb.find_password.min.css"  rel="stylesheet"></head><body><div id="wrap"><div class="list_top box_shadow"><div class="top_back"><a href="javascript:history.back()"></a></div><div class="details_title">&#x627E;&#x56DE;&#x5BC6;&#x7801;</div></div>
        <div class="add_address_body">

        <img src="<?php echo captcha_src(); ?>" id="" alt="captcha" onclick="refresh(this)"/>
        <div class="yanzheng">

        <input type="text" name="t_yzm" id="captcha" class="t_yzm" placeholder="&#x56FE;&#x5F62;&#x9A8C;&#x8BC1;&#x7801;"> 

        <img src="" id="yanzheng_imgs" alt="">
        </div>
        <div class="reg">
        <div class="tel">
        <em></em>

        <input type="tel" name="UserName" id="utel" placeholder="&#x624B;&#x673A;&#x53F7;"></div></div>
        <div class="reg_yz">

        <input type="text" class="yzm" id="yzmcode" name="AuthCode" placeholder="&#x8F93;&#x5165;&#x9A8C;&#x8BC1;&#x7801;"> 

        <input type="button" class="yzm_btn" id="yzmsend" value="&#x83B7;&#x53D6;&#x9A8C;&#x8BC1;&#x7801;"></div>

        <div class="reg_btn">
        <a href="javascript:;" id="nextreg">&#x4E0B;&#x4E00;&#x6B65;</a></div></div>

        <div class="try_voice"><span><a href="javascript:;" id="btnVoice">&#x8BD5;&#x8BD5;&#x8BED;&#x97F3;&#x64AD;&#x62A5; </a></span>&#xA0;&#xA0;&#xA0;|&#xA0;&#xA0;&#xA0; <span><a href="<?php echo url('login/find_passwordemail'); ?>" >&#x901A;&#x8FC7;&#x90AE;&#x7BB1;&#x627E;&#x56DE;&#x5BC6;&#x7801;</a></span></div><div class="error"></div></div><div class="overlay"><section class="modal modal-normal"><div class="modal-bd">&#x8BF7;&#x9000;&#x51FA;&#x65E0;&#x75D5;&#x6D4F;&#x89C8;&#x6A21;&#x5F0F;</div><div class="modal-ft"><a href="javascript:;" class="left-btn">&#x786E;&#x5B9A;</a></div></section></div><script src="__ROOT__/login/js/fc194781f111c9adf2b8.vendors.min.js" ></script><script src="__ROOT__/login/js/2e8a5576121ab805497a.find_password.min.js" ></script></body><script data-fixed="" defer="defer" async="true" type="text/javascript" src="__ROOT__/login/7xq22v.com2.z0.glb.qiniucdn.com/h5shopga.js" ></script></html>

        <script>
            $('#yzmsend').click(function(){
                // alert(1);return;
                var utel = $('#utel').val();
                var rtel = /^[1][3578][0-9]{9}$/;
                if(!rtel.test(utel))
                {
                    alert('手机格式不正确');
                    return false;
                }
                $.ajax({
                    type:'post',
                    url:"<?php echo URL('login/findyzmsend'); ?>",
                    data:{'utel':utel},
                    success:function(msg){
                        if(msg == true){
                            alert('发送成功！');
                        }
                        else
                        {
                            alert('发送失败,请重新发送！');
                        }
                    }
                })
            })


            $('#nextreg').click(function(){
              var captcha = $('#captcha').val();
              // alert(captcha);
                if (captcha == '') {
                  return false;
                };
                var utel = $('#utel').val();
                // alert(tel);
                if(utel == '')
                {
                    alert('手机号不能为空！');
                    return false;
                }
                var yzmcode = $('#yzmcode').val();
                // alert(yzmcode);return;
                // var str = "";
                 $.ajax({
                    type:'post',
                    url:"<?php echo URL('login/send_tel'); ?>",
                    data:{'utel':utel,'captcha':captcha,'yzmcode':yzmcode},
                    success:function(msg){
                          if (msg == false) 
                          {
                            alert('手机号不存在');
                            return false;
                          }
                          else if(msg == 1)
                          {
                            alert('图形验证码不正确');
                            return false;
                          }
                          else if(msg == 2)
                          {
                            alert('手机验证码不正确');
                            return false;
                          }
                          else if(msg == 3)
                          {
                            alert('信息正确！');
                            location.href="<?php echo url('login/update_newpwd'); ?>";
                          }
                    }
                })
             })
                

            function refresh(obj){
              obj.src="<?php echo captcha_src(); ?>?id="+Math.random();
            } 
        </script>