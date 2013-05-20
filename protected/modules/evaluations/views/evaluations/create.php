<?php
/* @var $this EvaluationsController */
/* @var $model Evaluations */
/* @var $allUsers array */

$this->breadcrumbs=array(
	'Evaluation'=>array('index'),
	'Create',
);

$this->menu2=array(
	array('label'=>'List Evaluations', 'url'=>array('index')),
	array('label'=>'Manage Evaluations', 'url'=>array('admin')),
);
?>

<h1>Create Evaluation</h1>

<?php 
echo $this->renderPartial('_form', array('model'=>$model, 'allUsers' => $allUsers)); ?>