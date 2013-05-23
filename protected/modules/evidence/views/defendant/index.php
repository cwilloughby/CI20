<?php
/* @var $this DefendantController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::app()->name . ' - Defendants';

$this->breadcrumbs=array(
	'Defendants',
);

$this->menu2=array(
	array('label'=>'Search Defendants', 'url'=>array('admin')),
	array('label'=>'Create Defendant', 'url'=>array('create')),
);
?>

<h1>Defendants</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
)); ?>
