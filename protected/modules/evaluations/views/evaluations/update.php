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
	array('label'=>'Create Evaluation', 'url'=>array('create'), 'visible' => Yii::app()->user->checkAccess('Supervisor', Yii::app()->user->id)),
	array('label'=>'View Evaluation', 'url'=>array('view', 'id'=>$model->evaluationid)),
	array('label'=>'Manage Evaluations', 'url'=>array('admin'), 'visible' => Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
);
?>

<h1>Change Employee on Evaluation <?php echo $model->evaluationid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'allUsers' => $allUsers)); ?>