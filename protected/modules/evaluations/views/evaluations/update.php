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
	array('label'=>'<i class="icon icon-search"></i> Search Evaluations', 'url'=>array('admin'), 'visible' => Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-file"></i> Create Evaluation', 'url'=>array('create'), 'visible' => Yii::app()->user->checkAccess('Supervisor', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-list-alt"></i> List Evaluations', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-zoom-in"></i> View Evaluation', 'url'=>array('view', 'id'=>$model->evaluationid)),
	array('label'=>'<i class="icon icon-edit"></i> Fill Out Evaluation', 'url'=>array('edit', 'id'=>$model->evaluationid, 'EvaluationAnswers_page'=>1), 'visible' => Yii::app()->user->checkAccess('Supervisor', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-user"></i> Change Employee', 'url'=>array('update', 'id'=>$model->evaluationid), 'visible' => Yii::app()->user->checkAccess('Supervisor', Yii::app()->user->id)),
);
?>

<h1>Change Employee on Evaluation <?php echo $model->evaluationid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'allUsers' => $allUsers)); ?>