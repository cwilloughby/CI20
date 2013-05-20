<?php
/* @var $this EvaluationQuestionsController */
/* @var $model EvaluationQuestions */

$this->breadcrumbs=array(
	'Evaluation Question'=>array('index'),
	'Create',
);

$this->menu2=array(
	array('label'=>'List Evaluation Questions', 'url'=>array('index')),
	array('label'=>'Manage Evaluation Questions', 'url'=>array('admin')),
);
?>

<h1>Create Evaluation Question</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>