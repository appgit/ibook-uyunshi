<?php
namespace Admintt\Model;
use Think\Model\ViewModel;

class BookViewModel extends ViewModel {

	public $viewFields = array(     
     'Book'=>array('Id','bookname','price','publish','author','bookimage','newlevel','publishdate','costprice','ishotsell','issepprice','count','hasnote'),
	  'Bookclass'=>array('note'=>'booktype','_on'=>'Book.classid=Bookclass.id'),  
	);


}