<?php
/* @var $this EvaluationQuestionsController */
/* @var $model EvaluationQuestions */

$this->pageTitle = Yii::app()->name . ' - Update Evaluation Question';

$this->breadcrumbs=array(
	'Evaluation Question'=>array('index'),
	$model->questionid=>array('view','id'=>$model->questionid),
	'Update',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Evaluation Questions', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-file"></i> Create Evaluation Question', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Evaluation Questions', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-zoom-in"></i> View Evaluation Question', 'url'=>array('view', 'id'=>$model->questionid)),
);
?>

<h1>Update Evaluation Question <?php echo $model->questionid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>