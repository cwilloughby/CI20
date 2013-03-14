<?php
/* @var $this CaseSummaryController */
/* @var $model CaseSummary */

$this->breadcrumbs=array(
	'Cases'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Cases', 'url'=>array('index')),
	array('label'=>'Create Case', 'url'=>array('create')),
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

<h1>Manage Cases</h1>

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
		array( 
			'name'=>'def_search1', 
			'value'=>'$data->def->fname' 
		),
		array( 
			'name'=>'def_search2', 
			'value'=>'$data->def->lname' 
		),
		'caseno',
		'location',
		'hearingdate',
		'hearingtype',
		'sentence',
		'comment',
		array(        
			'name'=>'dna',
			'value'=>'($data->dna == 0)?"No":(($data->dna == 1)?"Yes":"N/A")',
		),
		array(        
			'name'=>'bio',
			'value'=>'($data->bio == 0)?"No":(($data->bio == 1)?"Yes":"N/A")',
		),
		array(        
			'name'=>'drug',
			'value'=>'($data->drug == 0)?"No":(($data->drug == 1)?"Yes":"N/A")',
		),
		array(        
			'name'=>'firearm',
			'value'=>'($data->firearm == 0)?"No":(($data->firearm == 1)?"Yes":"N/A")',
		),
		array(        
			'name'=>'money',
			'value'=>'($data->money == 0)?"No":(($data->money == 1)?"Yes":"N/A")',
		),
		array(        
			'name'=>'other',
			'value'=>'($data->other == 0)?"No":(($data->other == 1)?"Yes":"N/A")',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
		),
	),
)); ?>
