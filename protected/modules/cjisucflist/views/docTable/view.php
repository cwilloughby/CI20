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
		array(
			'label'=>'Name',
			'type'=>'raw',
            'value'=>CHtml::link(CHtml::encode($model->name),
				Yii::app()->createUrl("cjisucflist/doctable/displayonline", array("path"=>"$model->path", "name"=>"$model->name")))
		),
		'type',
		array(
			'name' => 'upload_date',
			'value' => CHtml::encode(date("m/d/Y", strtotime($model->upload_date))),
		),
		'uploader',
		array(
			'name' => 'release_num',
			'value' => (isset($model->release_num))
				?CHtml::encode($model->release_num):"N/A",
		),
		array(
			'name' => 'release_date',
			'value' => (isset($model->release_date) && ((int)$model->release_date))
				?CHtml::encode(date("m/d/Y", strtotime($model->release_date))):"N/A",
		),
		array(
			'name' => 'agency',
			'value' => (isset($model->agency))
				?CHtml::encode($model->agency):"N/A",
		),
		array(
			'name' => 'cda_num',
			'value' => (isset($model->cda_num))
				?CHtml::encode($model->cda_num):"N/A",
		),
		array(
			'name' => 'problem',
			'value' => (isset($model->problem))
				?CHtml::encode($model->problem):"N/A",
		),
		array(
			'name' => 'description',
			'value' => (isset($model->description))
				?CHtml::encode($model->description):"N/A",
		),
		array(
			'name' => 'coding_start_date',
			'value' => (isset($model->coding_start_date) && ((int)$model->coding_start_date))
				?CHtml::encode(date("m/d/Y", strtotime($model->coding_start_date))):"N/A",
		),
		array(
			'name' => 'test_start_date',
			'value' => (isset($model->test_start_date) && ((int)$model->test_start_date))
				?CHtml::encode(date("m/d/Y", strtotime($model->test_start_date))):"N/A",
		),
		array(
			'name' => 'production_date',
			'value' => (isset($model->production_date) && ((int)$model->production_date))
				?CHtml::encode(date("m/d/Y", strtotime($model->production_date))):"N/A",
		),
		array(
			'name' => 'documentation_subject',
			'value' => (isset($model->documentation_subject))
				?CHtml::encode($model->documentation_subject):"N/A",
		),
		array(
			'name' => 'instruction_feature',
			'value' => (isset($model->instruction_feature))
				?CHtml::encode($model->instruction_feature):"N/A",
		),
	),
)); ?>
