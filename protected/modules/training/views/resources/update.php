<?php
/* @var $this ResourcesController */
/* @var $resource TrainingResources */
/* @var $file Documents */

$this->breadcrumbs=array(
	'Training Resources'=>array('index'),
	$resource->title=>array('view','id'=>$resource->resourceid),
	'Update',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Training Resources', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-film"></i> Upload Training Resources', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Training Resources', 'url'=>array('training/typeindex')),
	array('label'=>'<i class="icon icon-zoom-in"></i> View Training Resource', 'url'=>array('training/view', 'id'=>$resource->resourceid, 'type'=>$resource->type)),
);
?>

<h1>Update Training Resource <?php echo $resource->resourceid; ?></h1>

<?php echo $this->renderPartial('_form', array('resource'=>$resource, 'file'=>$file)); ?>