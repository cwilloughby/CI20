<?php
/* @var $this ResourcesController */
/* @var $resource TrainingResources */
/* @var $document Documents */

$this->breadcrumbs=array(
	'Training Resources'=>array('index'),
	'Upload',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Training Resources', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-film"></i> Upload Training Resource', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list"></i> List Training Resources', 'url'=>array('training/typeIndex')),
);
?>

<h1>Upload Training Resource</h1>

<?php echo $this->renderPartial('_form', array('resource'=>$resource, 'document'=>$document)); ?>