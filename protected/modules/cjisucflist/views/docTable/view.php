<?php
/* @var $this DocTableController */
/* @var $model DocTable */

$this->pageTitle = Yii::app()->name . ' - View CJIS File';

$this->breadcrumbs=array(
	'Search CJIS Files'=>array('searchableFileTable'),
	$model->name,
);

$this->menu2=array(
	array('label'=>'Search CJIS Files', 'url'=>array('searchableFileTable')),
	array('label'=>'Upload CJIS File', 'url'=>array('createFileRecord')),
	array('label'=>'Update CJIS File Record ', 'url'=>array('updateFileRecord', 'id'=>$model->id)),
	array('label'=>'Delete CJIS File', 'url'=>'#', 'linkOptions'=>array('submit'=>array('deleteFileRecord','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View CJIS File Details</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'type',
		'path',
		'extension',
		'upload_date',
		'uploader',
		'release_num',
		'release_date',
		'agency',
		'cda_num',
		'problem',
		'description',
		'coding_start_date',
		'test_start_date',
		'production_date',
		'documentation_subject',
		'instruction_feature',
	),
)); ?>
