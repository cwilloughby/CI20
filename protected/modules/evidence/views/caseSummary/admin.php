<?php
/* @var $this CaseSummaryController */
/* @var $model CaseSummary */

$this->breadcrumbs=array(
	'Case Summaries'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CaseSummary', 'url'=>array('index')),
	array('label'=>'Create CaseSummary', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('case-summary-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Case Summaries</h1>

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
	'id'=>'case-summary-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'summaryid',
		'defid',
		'caseno',
		'location',
		'dispodate',
		'hearingdate',
		/*
		'hearingtype',
		'page',
		'sentence',
		'indate',
		'outdate',
		'destructiondate',
		'recip',
		'comment',
		'dna',
		'bio',
		'drug',
		'firearm',
		'money',
		'other',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
