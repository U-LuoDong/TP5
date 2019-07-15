<?php
namespace app\UtilityItem\controller;
use think\Controller;
class Language extends Controller
{
	public function index(){
        return $this->fetch();
	}
//	模板中选择语言后异步提交到这里更新页面
    public function lang() {
        switch ($_GET['lang']) {
            case 'cn':
                cookie('think_var', 'zh-cn');
            break;
            case 'en':
                cookie('think_var', 'en-us');
            break;
            //默认中文
            default : 
				cookie('think_var', 'zh-cn');
        }
    }
}
?>