<?php
/* @var $this CommentsController */
/* @var $model Comments */

$this->pageTitle = Yii::app()->name . ' - Update Comment';

$this->breadcrumbs=array(
	'Comments'=>array('index'),
	$model->commentid=>array('view','id'=>$model->commentid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Comments', 'url'=>array('index')),
	array('label'=>'View Comment', 'url'=>array('view', 'id'=>$model->commentid)),
	array('label'=>'Manage Comments', 'url'=>array('admin')),
);
?>

<h1>Update Comment <?php echo $model->commentid; ?></h1>

<?php echo $this->renderPartial('_formUpdate', array('model'=>$model)); ?>