<?php
/* @var $this DocTableController */
/* @var $model DocTable */

$this->pageTitle = Yii::app()->name . ' - Search CJIS Files';

$this->breadcrumbs=array(
	'Search CJIS Files',
);

$this->menu2=array(
	array('label'=>'Search CJIS Files', 'url'=>array('searchableFileTable')),
	array('label'=>'Upload CJIS File', 'url'=>array('createFileRecord')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('doc-table-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Search CJIS Files</h1>

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

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'doc-table-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
	'columns'=>array(
		array(
			'class' => 'CLinkColumn',
			'header' => 'Name',
			'labelExpression' => '$data->name',
			'urlExpression' => 'Yii::app()->createUrl("cjisucflist/doctable/download", array("path"=>"$data->path", "name"=>"$data->name", "ext"=>"$data->extension"))'
		),
		array(
			'name' => 'upload_date',
			'value' => 'DATE("m/d/Y g:i a", STRTOTIME("$data->upload_date"))',
		),
		'type',
		/*
		'uploader',
		'release_num',
		'release_date',
		array(
			'name' => 'release_date',
			'value' => 'DATE("m/d/Y g:i a", STRTOTIME("$data->release_date"))',
		),
		'agency',
		'cda_num',
		'problem',
		'description',
		array(
			'name' => 'coding_start_date',
			'value' => 'DATE("m/d/Y g:i a", STRTOTIME("$data->coding_start_date"))',
		),
		array(
			'name' => 'test_start_date',
			'value' => 'DATE("m/d/Y g:i a", STRTOTIME("$data->test_start_date"))',
		),
		array(
			'name' => 'production_date',
			'value' => 'DATE("m/d/Y g:i a", STRTOTIME("$data->production_date"))',
		),
		'documentation_subject',
		'instruction_feature',
		*/
		array(
			'class'=>'CButtonColumn',
			'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,30=>30),array(
				'onchange'=>"$.fn.yiiGridView.update('doc-table-grid',{ data:{pageSize: $(this).val() }})",
			)),
			'buttons' => array(  
				'view' => array( 
					'url' => 'Yii::app()->createUrl("cjisucflist/doctable/viewFileRecord", array("id"=>$data->id))',        
				),
				'update' => array(
					'url' => 'Yii::app()->createUrl("cjisucflist/doctable/updateFileRecord", array("id"=>$data->id))',
				),
				'delete' => array(
					'url' => 'Yii::app()->createUrl("cjisucflist/doctable/deleteFileRecord", array("id"=>$data->id))',   
				),                         
			),
		),
	),
)); ?>
