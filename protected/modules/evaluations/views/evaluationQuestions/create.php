<?php
/* @var $this EvaluationQuestionsController */
/* @var $model EvaluationQuestions */

$this->pageTitle = Yii::app()->name . ' - Create Evaluation Question';

$this->breadcrumbs=array(
	'Evaluation Question'=>array('index'),
	'Create',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Evaluation Questions', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-file"></i> Create Evaluation Question', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Evaluation Questions', 'url'=>array('index')),
);
?>

<h1>Create Evaluation Question</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>