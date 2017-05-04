<?php
namespace app\index\controller;

use \think\View;
use app\index\model\Category;
use app\index\model\Goods;
use app\index\model\Brand;
use app\index\model\Cart;
use app\index\model\Address;
use app\index\model\Order;
use \think\Session;
use \think\Controller;
use think\Db;
use Qiniu\Auth;
use Qiniu\Storage\BucketManager;

class Index extends Controller
{
	//展示商城首页
    public function index()
    {
        $where = "1=1";
        //判断c_name
        if(input('goods_name'))
        {
            $goods_name = input('goods_name');
            $where = $where." and goods_name like '%$goods_name%' ";
        }
        //判断有无c_id
        if(input('c_id'))
        {
            $c_id = input('c_id');
            $where = $where." and c_id = $c_id";
        }
        $model = new Goods();
        //查询最新
        $data_new = $model->selNew($where);
        //查询最热
        $data_hot = $model->selHot($where);
        $arr['data_new'] = $data_new;
        $arr['data_hot'] = $data_hot;
        $session = Session::get('username');
        //判断用户是否登录
        $status = !empty($session)?1:0;
        $arr['status'] = $status;
        //查询一级商品分类
        $model_category = new category();
        $category_one = $model_category->selOne();
        $arr['model_category'] = $category_one;
    	$view = new View();
        return $view->fetch('index',$arr);
    }

    //商品分类
    public function category()
    {
    	$model = new Category();
    	$data = $model->selAll();
    	$arr = array();
    	foreach($data as $k=>$v)
    	{
    		if($v['p_id'] == 0)
    		{
    			$v['level']=0;
    			$arr[] = $v;
    			foreach($data as $kk=>$vv)
    			{
    				if($v['c_id'] == $vv['p_id'])
    				{
    					$vv['level']=1;
    					$arr[] = $vv;
    				}
    			}
    		}
    	}
    	//根据p_id 实现二级分
    	$arr['arr'] = $arr;
    	$view = new View();
    	return $view->fetch('category',$arr);
    }

    //二级商品分类
    public function two()
    {
		$c_id = input('c_id');
		//根据c_id查询所有分类
        $model = new Category();
        $data = $model->selOne($c_id);
        $arr['arr'] = $data;
    	$view = new View();
    	return $view->fetch('two',$arr);
    }

    //一级分类下页面
    public function first()
    {
        //接收一级c_id
        $c_id = input('c_id');
        //查询一级分类下的所有二级c_id
        $model_category = new category();
         //查询一级商品分类
        $category_one = $model_category->selOne($c_id);
        $arr['model_category'] = $category_one;
        foreach($category_one as $k=>$v)
        {
            $c_id_first[$k] = $v['c_id'];
        }
        $last = implode(',',$c_id_first);
        $where =  "c_id in ('$last')";
        $model = new Goods();
        //查询最新
        $data_new = $model->selNew($where);
        //查询最热
        $data_hot = $model->selHot($where);
        $arr['data_new'] = $data_new;
        $arr['data_hot'] = $data_hot;
        // Session::set('username','zhangsan');
        //判断用户是否登录
        $status = !empty(Session::get('username'))?1:0;
        $arr['status'] = $status;
       
        $view = new View();
        return $view->fetch('first',$arr);
    }


    //点击更多
    public function more()
    {
        //页数
        if(input('page'))
        {
            $page = input('page');
        }
        else
        {
            $page = 1;
        }
        //每页条数
        $page_size = 5;
        //偏移量
        $limit = ($page-1)*5;
        $model = new Brand();
        $data = $model->selAll($page_size,$limit);
        $count = $model->selCount();
        //总页数
        $total = ceil($count/$page_size);
        $arr['data'] = $data;
        //上一页
        $up = $page-1;
        if($up <=1)
        {
            $up = 1;
        }
        //下一页
        $down = $page+1;
        if($down>=$total)
        {
            $down = $total;
        }
        $arr['up'] = $up;
        $arr['page'] = $page;
        $arr['down'] = $down;
        $arr['total'] = $total;

        //判断用户是否登录
        $status = !empty(Session::get('username'))?1:0;
        $arr['status'] = $status;

        $view = new View();
        return $view->fetch('more',$arr);
    }

    //商品详情
    public function detail()
    {
        //判断用户是否登录
        $status = !empty(Session::get('username'))?1:0;
        $arr['status'] = $status;
        $goods_id = input('goods_id');
        $where = "goods_id = '$goods_id'";
        $model = new Brand();
        $data = $model->selOne($where);
        // echo '<pre>';
        // print_r($data);die;die;
        $arr['data'] = $data;
        $view = new View();
        return $view->fetch('detail',$arr);
    }

    //加入购物车
    public function cart()
    {
        $data = input();
        //获取用户id
        $user_data = Session::get('username');
        $user_id = $user_data['0'];
        // $user_id = '8';
        $data['user_id'] = $user_id;
        //将购物车入库
        $model = new Cart();
        $info = $model->addOne($data);
        if($info)
        {
            $this->redirect('index/cartlist');
        }
        else
        {
            $this->redirect('index/detail',['goods_id' => $data['goods_id']]);
        }
    }

    //显示购物车列表
    public function cartlist()
    {
        $user_data = Session::get('username');
        $user_id = $user_data['0'];
        // $user_id = '8';
        //根据user_id查询商品情况
        $model = new Cart();
        $data = $model->selAll($user_id);
        $arr['data'] = $data;
        $view = new View();
        return $view->fetch('cartlist',$arr);
    }

    //支付订单
    public function order()
    {


        //判断用户是否完善信息
        //通过session获取用户id
        $user_data = Session::get('username');
        $user_id = $user_data['0'];
        $model = new Address();
        $data = $model->selOne($user_id);
        if(!$data)
        {
            //完善信息
            $view = new View();
            return $view->fetch('pertect');
        }

        $arr['data'] = $data;


        $cart_id = input('cart_id');
        $where = " cart_id in ('$cart_id') ";
        //在购物车中删除所选
        $model_cart = new Cart();
        $bloon = $model_cart->del($cart_id);
        if($bloon)
        {
                  
            $cart = input('cart');
            $all = explode(',', $cart);
            $priceall = '';
            foreach($all as $k=>$v)
            {
                $priceall += $v;
                $count = $k+1;
            }
            $arr['count'] = $count;
            $arr['priceall'] = $priceall;
            

            //生成订单，基本信息默认
            $model_order = new Order();
            $order_sn = time().$user_id.'1502phpf';
            $data_order['user_id'] = $user_id;
            $data_order['price_all'] = $priceall;
            $data_order['order_sn'] = $order_sn;
            $data_order['address'] = $data['address'];
            $data_order['tel'] = $data['address_tel'];
            $data_order['address_name'] = $data['address_name'];
            $info = $model_order->addOne($data_order);
            if($info)
            {
                $view = new View();
                return $view->fetch('order',$arr);
            }
            else
            {
                echo "网络异常，生成订单失败";
            }

            
        }
        else
        {
            echo "网络异常，请重新支付";
        }    
        
    }

    public function addPerfect()
    {
        $data = input();
        $data['user_name'] = Session::get('username')['1'];
        $data['user_id'] = Session::get('username')['0'];
        //添加收获地址
        $model = new Address();
        $info = $model->addOne($data);
        if($info)
        {
            $this->redirect('index/cartlist');
        }
        else
        {
            echo '网络异常';
        }
    }


    /**
     * @Introduce  个人中心
     * @Author LL
     * @Param
     *
    */
    public function personal()
    {
        $session = Session::get('username');
        $view = new View();
        return $view->fetch('personal',['session'=>$session]);
    }


    /**
     * @Introduce  我的用户
     * @Author LL
     * @Param
     *
    */
    public function myaccount()
    {
        $session = Session::get('username');
        $view = new View();
        return $view->fetch('myaccount',['session'=>$session]);
    }

    //用户为登陆 跳转到登录页面
    public function login()
    {
        $view = new View();
        return $view->fetch('login/login');
    }


    /**
     * @Introduce
     * @Author LL
     * @Param
     *
    */
    public function clogintel()
    {
        $view = new View();
        return $view->fetch('clogintel');
    }

    /**
     * @Introduce  通过原密码修改密码
     * @Author LL
     * @Param
     *
    */
    public function updatapwd()
    {
        if ($_POST) 
        {
            $session = Session::get('username');
            $utel = $session[2];
            $data = $_POST;
            $oldpwd = $data['oldpwd'];
            $findpwd = Db::table('mc_users')->where(" utel = '$utel' " )->find();
            if ($oldpwd != $findpwd['upassword']) 
            {
                echo 1;
                die;
            }
            else
            {
                $array = array('upassword'=>$data['upassword']);
                $update = Db::table('mc_users')->where(" utel = '$utel' ")->update($array);

                if($update)
                {
                    echo 2;
                }
                else
                {
                    echo 3;
                    die;
                }
            }
        }
        else
        {
            $view = new View();
            return $view->fetch('clogintel');
        }


    }


    /**
     * @Introduce 支付密码
     * @Author LL
     * @Param
     *
    */
    public function paypwd()
    {
        $view = new View();
        return $view->fetch('paypwd');
    }


    /**
     * @Introduce  第三方绑定页面
     * @Author LL
     * @Param
     *
    */
    public function thirdbind()
    {
        $view = new View();
        return $view->fetch('thirdbind');
    }


    /**
     * @Introduce
     * @Author LL
     * @Param
     *
    */
    public function personage()
    {
        $view = new View();
        return $view->fetch('personage');
    }

    /**
     * @Introduce 退出
     * @Author LL
     * @Param
     *
    */
    public function layout()
    {
        Session::clear();
        return $this->redirect('index/index');

    }
    
}


