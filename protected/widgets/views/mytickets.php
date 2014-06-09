<?php
/* @var $this SiteController */
/* @var $dataProvider CActiveDataProvider */

$this->widget('CustomSmallListView', array(
	'dataProvider'=>$dataProvider,
	'ajaxUpdate'=>true,
	'itemView'=>'_viewTickets',
	'template'=>"{summary}\n{items}\n{pager}",
)); 
?>
