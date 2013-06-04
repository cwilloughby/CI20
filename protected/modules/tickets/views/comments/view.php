<?php
/* @var $this CommentsController */
/* @var $model Comments */

$this->pageTitle = Yii::app()->name . ' - View Comment';

$this->breadcrumbs=array(
	'Comments'=>array('index'),
	$model->commentid,
);

$this->menu2=array(
	array('label'=>'Search Comments', 'url'=>array('admin')),
	array('label'=>'List Comments', 'url'=>array('index')),
	array('label'=>'View Comment', 'url'=>array('view', 'id'=>$model->commentid)),
	array('label'=>'Update Comment', 'url'=>array('update', 'id'=>$model->commentid)),
	array('label'=>'Delete Comment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->commentid),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Comment #<?php echo $model->commentid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'commentid',
		'content',
		array(        
			'name'=>'createdby',
			'value'=>isset($model->createdby0)?CHtml::encode($model->createdby0->username):"Unknown"
		),
		'datecreated',
	),
)); ?>
