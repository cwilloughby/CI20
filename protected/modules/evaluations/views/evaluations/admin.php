<?php
/* @var $this EvaluationsController */
/* @var $model Evaluations */

$this->pageTitle = Yii::app()->name . ' - Manage Evaluations';

$this->breadcrumbs=array(
	'Evaluations'=>array('index'),
	'Manage',
);

$this->menu2=array(
	array('label'=>'List Evaluations', 'url'=>array('index')),
	array('label'=>'Create Evaluation', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('evaluations-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Evaluations</h1>

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
	'id'=>'evaluations-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array( 
			'name'=>'employee_search', 
			'value'=>'$data->employee0->username' 
		),
		array( 
			'name'=>'evaluator_search', 
			'value'=>'$data->evaluator0->username' 
		),
		array(
			'name' => 'evaluationdate',
			'value' => 'DATE("m/d/Y g:i a", STRTOTIME("$data->evaluationdate"))',
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
