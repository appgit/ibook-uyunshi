<?php 
	namespace Home\Model;
	use Think\Model\ViewModel;
	class TypeViewModel extends ViewModel{
	   
	    public $viewFields = array(
	        'stype'=>array('id'=>'stypeid','note'=>'stypename','btypeid'),     
	    	'btype'=>array('note'=>'btypename','sptypeid','_on'=>'stype.btypeid=btype.id'),
	    	'sptype'=>array('icon','image','note'=>'sptypename','isnew','_on'=>'btype.sptypeid=sptype.id'),
	    	);
	}
 ?>

