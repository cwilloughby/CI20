<?php
/* @var $this AttorneyController */
/* @var $model Attorney */

$this->pageTitle = Yii::app()->name . ' - Attorneys';

$this->breadcrumbs=array(
	'Advanced Tools'=>array('/evidence/casesummary/evidencemanager'),
	'Search Attorneys',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Attorneys', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-user"></i> Create Attorney', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('attorney-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Search Attorneys</h1>

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
	'id'=>'attorney-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
	'columns'=>array(
		'lname',
		'fname',
		'type',
		'barid',
		array(
			'class'=>'CButtonColumn',
			'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,30=>30),array(
				'onchange'=>"$.fn.yiiGridView.update('attorney-grid',{ data:{pageSize: $(this).val() }})",
			)),
			'template'=>'{view}{update}',
		),
	),
)); ?>