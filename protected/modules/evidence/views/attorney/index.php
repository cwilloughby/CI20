<?php
/* @var $this AttorneyController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::app()->name . ' - Attorneys';

$this->breadcrumbs=array(
	'Attorneys',
);

$this->menu2=array(
	array('label'=>'Search Attorneys', 'url'=>array('admin')),
	array('label'=>'Create Attorney', 'url'=>array('create')),
);
?>

<h1>Attorneys</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
)); ?>
