<?php
/* @var $this EvaluationQuestionsController */
/* @var $model EvaluationQuestions */

$this->pageTitle = Yii::app()->name . ' - Manage Evaluation Questions';

$this->breadcrumbs=array(
	'Evaluation Questions'=>array('index'),
	'Manage',
);

$this->menu2=array(
	array('label'=>'List Evaluation Questions', 'url'=>array('index')),
	array('label'=>'Create Evaluation Question', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('evaluation-questions-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Evaluation Questions</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'evaluation-questions-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array( 
			'name'=>'department_search', 
			'value'=>'$data->department->departmentname' 
		),
		'question',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
