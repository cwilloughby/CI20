<?php
/* @var $this EvaluationsController */
/* @var $model Evaluations */

$this->pageTitle = Yii::app()->name . ' - Update Evaluation';

$this->breadcrumbs=array(
	'Evaluation'=>array('index'),
	$model->evaluationid=>array('view','id'=>$model->evaluationid),
	'Update',
);

$this->menu2=array(
	array('label'=>'List Evaluations', 'url'=>array('index')),
	array('label'=>'Create Evaluation', 'url'=>array('create')),
	array('label'=>'View Evaluation', 'url'=>array('view', 'id'=>$model->evaluationid)),
	array('label'=>'Manage Evaluations', 'url'=>array('admin')),
);
?>

<h1>Change Employee on Evaluation <?php echo $model->evaluationid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'allUsers' => $allUsers)); ?>