<?php
namespace app\admin\controller;

use think\Controller;
use \think\View;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use app\admin\model\Brand;
use app\admin\model\Category;
use app\admin\model\Goods;

class Show extends Controller
{

	//品牌添加
	public function brand()
	{

		$view = new view();
		return $view->fetch('brand');
	}

	//品牌验证
	public function brandPro()
	{
		$a = input('brand_name');
		// echo $a;die;
		$file = $_FILES['myfile'];
		
		// 需要填写你的 Access Key 和 Secret Key
		$accessKey = '7MsCGz-UP9cDldZG0D8Hxurnz1XTeMf6JYKBZSL4';
		$secretKey = 'sqabqMp3bsYjkQ02AVJ2x4JTOblZ0zg2o3ERRb9G';

		// 构建鉴权对象
		$auth = new Auth($accessKey, $secretKey);

		// 要上传的空间
		$bucket = 'images';

		// 生成上传 Token
		$token = $auth->uploadToken($bucket);

		// 要上传文件的本地路径
		$filePath = $file['tmp_name'];

		// 要上传的文件名
		$name = $file['name'];
		//定义文件名
		$filename = time().'.'.pathinfo($name)['extension'];
		
		// 初始化 UploadManager 对象并进行文件的上传
		$uploadMgr = new UploadManager();

		// 调用 UploadManager 的 putFile 方法进行文件的上传
		list($ret, $err) = $uploadMgr->putFile($token, $filename , $filePath);

		if ($err !== null) 
		{
			echo 'no';
			var_dump($err);
		} 
		else 
		{
			$data = array();
			$data['brand_name'] = input('brand_name');
			$data['brand_logo'] = $filename;
			$data['brand_desc'] = input('brand_desc');
			$model = new Brand();
			$info = $model->addOne($data);
			if($info)
			{
				$this->redirect('index/index');
			}
			else
			{
				$this->redirect('show/brand');
			}

		}

	}

	//商品添加
	public function goods()
	{
		//查询分类
		$model_category = new Category();
		$data_category = $model_category->selAll();
		$data_c = array();
		foreach($data_category as $k=>$v)
		{
			if($v['p_id'] == 0)
			{
				$v['level'] = 0;
				$data_c[] = $v;
				foreach($data_category as $kk=>$vv)
				{
					if($vv['p_id'] == $v['c_id'])
					{
						$vv['level'] = 1;
						$data_c[] = $vv;
					}
				}
			}
		}

		//查询品牌
		$model_brand = new Brand();
		$data_brand = $model_brand->selAll();

		$arr['brand'] = $data_brand;
		$arr['category'] = $data_c;

		$view = new view();
		return $view->fetch('goods',$arr);
	}

	//商品验证
	public function goodsPro()
	{
		$file = $_FILES['myfile'];
		
		// 需要填写你的 Access Key 和 Secret Key
		$accessKey = '7MsCGz-UP9cDldZG0D8Hxurnz1XTeMf6JYKBZSL4';
		$secretKey = 'sqabqMp3bsYjkQ02AVJ2x4JTOblZ0zg2o3ERRb9G';

		// 构建鉴权对象
		$auth = new Auth($accessKey, $secretKey);

		// 要上传的空间
		$bucket = 'images';

		// 生成上传 Token
		$token = $auth->uploadToken($bucket);

		// 要上传文件的本地路径
		$filePath = $file['tmp_name'];

		// 要上传的文件名
		$name = $file['name'];
		//定义文件名
		$filename = time().'.'.pathinfo($name)['extension'];
		
		// 初始化 UploadManager 对象并进行文件的上传
		$uploadMgr = new UploadManager();

		// 调用 UploadManager 的 putFile 方法进行文件的上传
		list($ret, $err) = $uploadMgr->putFile($token, $filename , $filePath);

		if ($err !== null) 
		{
			echo 'no';
			var_dump($err);
		} 
		else 
		{
			$data = array();
			$data['c_id'] = input('c_id');
			$data['goods_name'] = input('goods_name');
			$data['brand_id'] = input('brand_id');
			$data['goods_img'] = $filename;
			$data['price'] = input('price');
			$data['goods_desc'] = input('goods_desc');
			$data['add_time'] = date('Y-m-d H:i:s');
			$model = new Goods();
			$info = $model->addOne($data);
			if($info)
			{
				$this->redirect('index/index');
			}
			else
			{
				$this->redirect('show/goods');
			}
		}
	}

	//品牌展示
	public function brandlist()
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
        $data = $model->selLimit($page_size,$limit);
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

		$view = new view();
		return $view->fetch('brandlist',$arr);
	}

	//删除
	public function del()
	{
		//获取brand_id
		$brand_id = input('brand_id');
		$model = new Brand();
		$bloon = $model->del($brand_id);
		if($bloon)
		{
			$this->redirect('show/brandlist');
		}
		else
		{
			$this->redirect('show/brandlist');
		}
	}

	//商品展示
	public function goodslist()
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
        $model = new Goods();
        $data = $model->selLimit($page_size,$limit);
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

		$view = new view();
		return $view->fetch('goodslist',$arr);
	}

	//商品删除
	public function delgoods()
	{
		//获取brand_id
		$goods_id = input('goods_id');
		$model = new Goods();
		$bloon = $model->del($goods_id);
		if($bloon)
		{
			$this->redirect('show/goodslist');
		}
		else
		{
			$this->redirect('show/goodslist');
		}
	}

	//商品即点即改
	public function up()
	{
		$goods_desc = input('goods_desc');
		$goods_id = input('goods_id');
		$model = new Goods();
		$bloon = $model->up($goods_desc,$goods_id);
		if($bloon)
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}

	//品牌即点即改
	public function upbrand()
	{
		$goods_desc = input('brand_desc');
		$goods_id = input('brand_id');
		$model = new Brand();
		$bloon = $model->up($goods_desc,$goods_id);
		if($bloon)
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}

}

?>