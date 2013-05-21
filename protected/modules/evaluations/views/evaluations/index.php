<?php
/* @var $this EvaluationsController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle = Yii::app()->name . ' - List Evaluations';

$this->breadcrumbs=array(
	'Evaluations',
);

$this->menu2=array(
	array('label'=>'Create Evaluation', 'url'=>array('create'), 'visible' => Yii::app()->user->checkAccess('Supervisor', Yii::app()->user->id)),
	array('label'=>'Manage Evaluations', 'url'=>array('admin'), 'visible' => Yii::app()->user->checkAccess('Supervisor', Yii::app()->user->id)),
);
?>

<h1>Evaluations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
