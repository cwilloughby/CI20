<?php
/* @var $this CaseSummaryController */
/* @var $model CaseSummary */

$this->pageTitle = Yii::app()->name . ' - Case Files';

$this->breadcrumbs=array(
	'Case Files'=>array('index'),
	'Manage',
);

$this->menu2=array(
	array('label'=>'List Case Files', 'url'=>array('index')),
	array('label'=>'Create Case File', 'url'=>array('create')),
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

<h1>Manage Case Files</h1>

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
		array( 
			'name'=>'div_search', 
			'value'=>'$data->caseno0->crtdiv' 
		),
		array( 
			'name'=>'complaint_search', 
			'value'=>'$data->caseno0->cptno' 
		),
		'sentence',
		'comment',
		array(        
			'name'=>'dna',
			'value'=>'$data->getYesNo($data->dna)',
			'filter'=>CHtml::listData($model->getYesNo(), 'id', 'title'),
			'htmlOptions' => array('width'=>50),
		),
		array(        
			'name'=>'bio',
			'value'=>'$data->getYesNo($data->bio)',
			'filter'=>CHtml::listData($model->getYesNo(), 'id', 'title'),
			'htmlOptions' => array('width'=>50),
		),
		array(        
			'name'=>'drug',
			'value'=>'$data->getYesNo($data->drug)',
			'filter'=>CHtml::listData($model->getYesNo(), 'id', 'title'),
			'htmlOptions' => array('width'=>50),
		),
		array(        
			'name'=>'firearm',
			'value'=>'$data->getYesNo($data->firearm)',
			'filter'=>CHtml::listData($model->getYesNo(), 'id', 'title'),
			'htmlOptions' => array('width'=>50),
		),
		array(        
			'name'=>'money',
			'value'=>'$data->getYesNo($data->money)',
			'filter'=>CHtml::listData($model->getYesNo(), 'id', 'title'),
			'htmlOptions' => array('width'=>50),
		),
		array(        
			'name'=>'other',
			'value'=>'$data->getYesNo($data->other)',
			'filter'=>CHtml::listData($model->getYesNo(), 'id', 'title'),
			'htmlOptions' => array('width'=>50),
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
			'htmlOptions' => array('style'=>'width:15px'),
			'headerHtmlOptions'=>array('style'=>'width:15px;'),
		),
	),
)); ?>
