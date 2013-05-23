<?php
/* @var $this EvaluationQuestionsController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::app()->name . ' - List Evaluation Questions';

$this->breadcrumbs=array(
	'Evaluation Questions',
);

$this->menu2=array(
	array('label'=>'Create Evaluation Question', 'url'=>array('create')),
	array('label'=>'Manage Evaluation Questions', 'url'=>array('admin')),
);
?>

<h1>Evaluation Questions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
