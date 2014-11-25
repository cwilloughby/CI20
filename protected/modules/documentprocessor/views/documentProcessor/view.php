<?php
/* @var $this DocumentsProcessorController */
/* @var $model Documents */

$this->breadcrumbs=array(
	'Documents'=>array('index'),
	$model->documentid,
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Documents', 'url'=>array('admin'), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-file"></i> Create Document', 'url'=>array('create'), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-list-alt"></i> List Documents', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-zoom-in"></i> View Document', 'url'=>array('view', 'id'=>$model->documentid)),
	array('label'=>'<i class="icon icon-edit"></i> Update Document', 'url'=>array('update', 'id'=>$model->documentid), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-trash"></i> Delete Document', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->documentid),'confirm'=>'Are you sure you want to delete this item?'), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
);
?>

<h1>View Documents #<?php echo $model->documentid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'documentid',
		'uploader',
		'documentname',
		'path',
		'uploaddate',
		'type',
		'ext',
		'prefix',
		'description',
		'content',
		'modifiedby',
		'modifieddate',
		'signed',
		'disabled',
		'shareable',
	),
)); ?>
