<?php
/* @var $this CrtCaseController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::app()->name . ' - Court Cases';

$this->breadcrumbs=array(
	'Court Cases',
);

$this->menu=array(
	array('label'=>'Create Court Case', 'url'=>array('create')),
	array('label'=>'Manage Court Cases', 'url'=>array('admin')),
);
?>

<h1>Court Cases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
