<?php
	//图片上传
namespace app\UtilityItem\controller;
use think\Controller;//模板赋值
class FileUpload extends Controller
{
	//页面
    public function index()
    {
    	return	$this->fetch();
    }
    //将前台上传的图片处理完成后 将其路径名复制到input('post.img')中 然后存储到数据库中去
    public function upload(){
//		// 获取表单上传文件 例如上传了001.jpg
//		$file = request()->file('image');
//		if($file){
//			// 移动到框架应用根目录/public/uploads/ 目录下
//			$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
//			if($info){
//			// 成功上传后 获取上传信息
//			// 输出 jpg
//			echo $info->getExtension();
//			// 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
//			echo $info->getSaveName();
//			// 输出 42a79759f284b767dfcb2a0197904287.jpg
//			echo $info->getFilename();
//			}else{
//			// 上传失败获取错误信息
//			echo $file->getError();
//			}
//		}

//		上传验证		支持对上传文件的验证，包括文件大小、文件类型和后缀：
		// 获取表单上传文件 例如上传了001.jpg
		$file = request()->file('image');
		// 移动到框架应用根目录/public/uploads/ 目录下
		$info = $file->validate(['size'=>2000000,'ext'=>'jpg,png,gif'])->move(ROOT_PATH .
		'public' . DS . 'uploads');
		if($info){
		// 成功上传后 获取上传信息
		// 输出 jpg
		echo $info->getExtension();
		// 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
		echo $info->getSaveName();
		// 输出 42a79759f284b767dfcb2a0197904287.jpg
		echo $info->getFilename();
		}else{
		// 上传失败获取错误信息
	   	$this->error($file->getError()."请上转正确的图片格式!");
		}
	}

}
?>