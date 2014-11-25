<?php
/* @var $this DocumentsProcessorController */
/* @var $model Documents */

$this->pageTitle = Yii::app()->name . ' - Manage Documents';

$this->breadcrumbs=array(
	'Documents'=>array('index'),
	'Manage',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Documents', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-file"></i> Create Document', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Documents', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('documents-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Search Documents</h1>

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

<?php 
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);

$this->widget('CustomGridView', array(
	'id'=>'documents-grid',
	'dataProvider'=>$model->search(),
	'filter'=>(Yii::app()->user->checkAccess('IT', Yii::app()->user->id) ? $model : null),
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
	'columns'=>array(
		'documentname',
		'uploaddate',
		'type',
		'content',
		array(
			'class'=>'CButtonColumn',
			'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,30=>30),array(
				'onchange'=>"$.fn.yiiGridView.update('documents-grid',{ data:{pageSize: $(this).val() }})",
			)),
			'template'=>'{view}{update}',
		),
	),
)); ?>
