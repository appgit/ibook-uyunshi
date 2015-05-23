<?php
namespace Admintt\Model;
use Think\Model\ViewModel;

class ShangpinViewModel extends ViewModel {

		public $viewFields = array(     
     'Shangpin'=>array('id','image','name','price','chatcount','publishdate','ishandled','status','description'), 
	 'Userinfo'=>array('truename','username','tel','addr','email','vip','number', '_on'=>'Shangpin.userid=Userinfo.id'), 
     'Stype'=>array('note'=>'stype','_on'=>'Shangpin.stypeid=Stype.id'),
	  'Btype'=>array('note'=>'btype','_on'=>'Stype.btypeid=Btype.id'),  
	);


}