<?php
	//图像处理
namespace app\UtilityItem\controller;
use think\Controller;//模板赋值
class ImageProcessing extends Controller
{
	//		获取图像信息  可以获取打开图片的信息，包括图像大小、类型等，例如：
	public function getInfo(){
		$image = \think\Image::open('./img/iu.jpg');
		// 返回图片的宽度
		$width = $image->width();
		// 返回图片的高度
		$height = $image->height();
		// 返回图片的类型
		$type = $image->type();
		// 返回图片的mime类型
		$mime = $image->mime();
		echo $mime."<br/>";//image/jpeg
		// 返回图片的尺寸数组 0 图片宽度 1 图片高度
		$size = $image->size();
		dump($size);//array(2) { [0] => int(960)[1] => int(540) }
	}

	//缩略图
	public function thumb(){
		$image = \think\Image::open('./img/iu.jpg');
		// 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.png
		//实际生成的缩略图并不是150*150，因为默认采用原图等比例缩放的方式生成缩略图，最大宽度是150。
		$image->thumb(150, 150)->save('./img/iu_1.jpg');
	}
	
	//文字水印
	public function textWatermark(){
		$fontfile = "C:\Windows\Fonts\simsun.ttc";
		$image = \think\Image::open('./img/iu.jpg');
		// 给原图右下角添加水印并保存
		$image->text('十年磨一剑 - 为API开发设计的高性能框架',$fontfile,20,'#ffffff')->save('./img/iu_1.jpg');
	}
	//图片水印
	public function imgWatermark(){
		$image = \think\Image::open('./img/iu.jpg');
		// 给原图左上角添加水印并保存
//		$image->water('./img/nsu.jpg',1)->save('./img/water_image.png');
		//给图片水印增加透明度
		$image->water('./img/nsu.jpg',1,50)->save('img/water_image.png');
	}
}

?>