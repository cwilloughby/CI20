<?php
/* @var $this SiteController */
/* @var $dataProvider CActiveDataProvider */

$this->widget('CustomSmallListView', array(
	'dataProvider'=>$dataProvider,
	'ajaxUpdate'=>true,
	'itemView'=>'_view',
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
)); 
?>

