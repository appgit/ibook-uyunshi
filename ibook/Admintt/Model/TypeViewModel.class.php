<?php
namespace Admintt\Model;
use Think\Model\ViewModel;

class TypeViewModel extends ViewModel {

	public $viewFields = array(     
     'Stype'=>array('id','note'=>'stype'),
	  'Btype'=>array('note'=>'btype','_on'=>'Stype.btypeid=Btype.id'),
       'Sptype'=>array('isnew','note'=>'sptype','_on'=>'Btype.sptypeid=Sptype.id'),	  
	);


}