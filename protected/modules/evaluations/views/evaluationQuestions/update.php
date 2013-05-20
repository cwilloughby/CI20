<?php
/* @var $this EvaluationQuestionsController */
/* @var $model EvaluationQuestions */

$this->breadcrumbs=array(
	'Evaluation Question'=>array('index'),
	$model->questionid=>array('view','id'=>$model->questionid),
	'Update',
);

$this->menu2=array(
	array('label'=>'List Evaluation Questions', 'url'=>array('index')),
	array('label'=>'Create Evaluation Question', 'url'=>array('create')),
	array('label'=>'View Evaluation Question', 'url'=>array('view', 'id'=>$model->questionid)),
	array('label'=>'Manage Evaluation Questions', 'url'=>array('admin')),
);
?>

<h1>Update Evaluation Question <?php echo $model->questionid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>