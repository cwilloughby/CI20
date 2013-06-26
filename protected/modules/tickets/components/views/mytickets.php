<?php
/* @var $this SiteController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php echo CHtml::Button('Switch Widgets!',array('onclick'=>'ticketswitcher();')); ?> 

<?php 
$this->widget('CustomSmallListView', array(
	'dataProvider'=>$dataProvider,
	'ajaxUpdate'=>true,
	'itemView'=>'_view',
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
)); 
?>

