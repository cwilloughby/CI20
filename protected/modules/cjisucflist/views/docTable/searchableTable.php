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

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>

<?php 
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'doc-table-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
	'columns'=>array(
		array(
			'name' => 'name',
			'type' => 'raw',
			'value' => 'CHtml::link($data->name,Yii::app()->createUrl("cjisucflist/doctable/displayonline", array("path"=>"$data->path", "name"=>"$data->name")))',
			'htmlOptions' => array('style' => 'max-width:150px; overflow-x: auto; word-wrap:break-word')
		),
		'type',
		array(
			'name' => 'agency',
			'value' => '(isset($data->agency))
				?CHtml::encode($data->agency):"N/A"',
		),
		array(
			'name' => 'cda_num',
			'value' => '(isset($data->cda_num))
				?CHtml::encode($data->cda_num):"N/A"',
		),
		array(
			'name' => 'release_num',
			'value' => '(isset($data->release_num))
				?CHtml::encode($data->release_num):"N/A"',
		),
		array(
			'name' => 'release_date',
			'value' => '(isset($data->release_date) && ((int)$data->release_date))
				?CHtml::encode(date("m/d/Y", strtotime($data->release_date))):"N/A"',
		),
		array(
			'name' => 'problem',
			'value' => '(isset($data->problem))
				?CHtml::encode($data->problem):"N/A"',
		),
		array(
			'name' => 'description',
			'value' => '(isset($data->description))
				?CHtml::encode($data->description):"N/A"',
		),
		array(
			'name' => 'documentation_subject',
			'value' => '(isset($data->documentation_subject))
				?CHtml::encode($data->documentation_subject):"N/A"',
		),
		array(
			'name' => 'instruction_feature',
			'value' => '(isset($data->instruction_feature))
				?CHtml::encode($data->instruction_feature):"N/A"',
		),
		/*
		array(
			'name' => 'upload_date',
			'value' => 'DATE("m/d/Y", STRTOTIME("$data->upload_date"))',
		),
		'uploader',
		array(
			'name' => 'release_date',
			'value' => 'DATE("m/d/Y g:i a", STRTOTIME("$data->release_date"))',
		),
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
