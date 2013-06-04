<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'News'=>array('index'),
	'Create',
);

$this->menu2=array(
	array('label'=>'Search News Posts', 'url'=>array('admin')),
	array('label'=>'Create News Post', 'url'=>array('create')),
	array('label'=>'List News Posts', 'url'=>array('index')),
);
?>

<h1>Create News</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>