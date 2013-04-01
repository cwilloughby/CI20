<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'News'=>array('index'),
	'Create',
);

$this->menu2=array(
	array('label'=>'List News Posts', 'url'=>array('index')),
	array('label'=>'Manage News Posts', 'url'=>array('admin')),
);
?>

<h1>Create News</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>