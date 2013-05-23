<?php
/* @var $this CrtCaseController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::app()->name . ' - Court Cases';

$this->breadcrumbs=array(
	'Court Cases',
);

$this->menu2=array(
	array('label'=>'Search Court Cases', 'url'=>array('admin')),
	array('label'=>'Create Court Case', 'url'=>array('create')),
);
?>

<h1>Court Cases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
)); ?>
