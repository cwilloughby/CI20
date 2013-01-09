<?php
/* @var $this CommentsController */
/* @var $model Comments */

$this->breadcrumbs=array(
	'Comments'=>array('index'),
	$model->commentid,
);

$this->menu=array(
	array('label'=>'List Comments', 'url'=>array('index')),
	array('label'=>'Create Comments', 'url'=>array('create')),
	array('label'=>'Update Comments', 'url'=>array('update', 'id'=>$model->commentid)),
	array('label'=>'Delete Comments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->commentid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Comments', 'url'=>array('admin')),
);
?>

<h1>View Comments #<?php echo $model->commentid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'commentid',
		'content',
		'createdby',
		'datecreated',
	),
)); ?>
