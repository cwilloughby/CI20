<?php
/* @var $this EvaluationsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Evaluations',
);

$this->menu2=array(
	array('label'=>'Create Evaluation', 'url'=>array('create')),
	array('label'=>'Manage Evaluations', 'url'=>array('admin')),
);
?>

<h1>Evaluations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
