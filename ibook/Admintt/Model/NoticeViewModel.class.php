<?php
namespace Admintt\Model;
use Think\Model\ViewModel;

class NoticeViewModel extends ViewModel {

	public $viewFields = array(     
     'Notice'=>array('id','createdate','note','iseffective','effectivedays'),
	 
	);


}