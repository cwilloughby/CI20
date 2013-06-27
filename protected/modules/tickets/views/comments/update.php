<?php
/* @var $this CommentsController */
/* @var $model Comments */

$this->pageTitle = Yii::app()->name . ' - Update Comment';

$this->breadcrumbs=array(
	'Comments'=>array('index'),
	$model->commentid=>array('view','id'=>$model->commentid),
	'Update',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Comments', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Comments', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-zoom-in"></i> View Comment', 'url'=>array('view', 'id'=>$model->commentid)),
	array('label'=>'<i class="icon icon-edit"></i> Update Comment', 'url'=>array('update', 'id'=>$model->commentid)),
);
?>

<h1>Update Comment <?php echo $model->commentid; ?></h1>

<?php echo $this->renderPartial('_formUpdate', array('model'=>$model)); ?>