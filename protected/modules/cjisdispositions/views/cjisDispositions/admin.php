<?php
/* @var $this CjisDispositionsController */
/* @var $model CjisDispositions */

$this->breadcrumbs=array(
	'CJIS Dispositions'=>array('index'),
	'Manage',
);

$this->menu2=array(
	array('label'=>'List CJIS Dispositions', 'url'=>array('index')),
	array('label'=>'Create CJIS Disposition', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('cjis-dispositions-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage CJIS Dispositions</h1>

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
	'id'=>'cjis-dispositions-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
	'columns'=>array(
		'case',
		'lastname',
		'firstname',
		array(
			'name' => 'dateofbirth',
			'value' => 'DATE("m/d/Y", STRTOTIME("$data->dateofbirth"))',
		),
		array( 
			'name'=>'count', 
			'value'=>'(!$data->count == 0) 
						? $data->count
						: ""',
		),
		'offensedescription',
		'disposition',
		array(
			'class'=>'CButtonColumn',
			'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,30=>30),array(
				'onchange'=>"$.fn.yiiGridView.update('cjis-dispositions-grid',{ data:{pageSize: $(this).val() }})",
			)),
			'template'=>'{view}',
		),
	),
)); ?>
