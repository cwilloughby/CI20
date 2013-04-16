<?php
/* @var $this DefendantController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::app()->name . ' - Defendants';

$this->breadcrumbs=array(
	'Defendants',
);

$this->menu2=array(
	array('label'=>'Create Defendant', 'url'=>array('create')),
	array('label'=>'Manage Defendants', 'url'=>array('admin')),
);
?>

<h1>Defendants</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
