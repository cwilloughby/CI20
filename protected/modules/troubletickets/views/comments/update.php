<?php
/* @var $this CommentsController */
/* @var $model Comments */

$this->breadcrumbs=array(
	'Comments'=>array('index'),
	$model->commentid=>array('view','id'=>$model->commentid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Comments', 'url'=>array('index')),
	array('label'=>'Create Comments', 'url'=>array('create')),
	array('label'=>'View Comments', 'url'=>array('view', 'id'=>$model->commentid)),
	array('label'=>'Manage Comments', 'url'=>array('admin')),
);
?>

<h1>Update Comments <?php echo $model->commentid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>