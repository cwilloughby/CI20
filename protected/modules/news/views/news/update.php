<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'News'=>array('index'),
	$model->newsid=>array('view','id'=>$model->newsid),
	'Update',
);

$this->menu2=array(
	array('label'=>'List News Posts', 'url'=>array('index')),
	array('label'=>'Create News Post', 'url'=>array('create')),
	array('label'=>'View News Post', 'url'=>array('view', 'id'=>$model->newsid)),
	array('label'=>'Manage News Posts', 'url'=>array('admin')),
);
?>

<h1>Update News <?php echo $model->newsid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>