<?php
namespace app\UtilityItem\controller;
class Debug
{
	public function index(){
		debug('begin');
		for($i=0;$i<1000;$i++);
		debug('end');
		// 进行统计区间
		echo debug('begin','end').'s<br/>';
		echo debug('begin','end',6).'s<br/>';
		echo debug('begin','end','m');

	}
}
?>