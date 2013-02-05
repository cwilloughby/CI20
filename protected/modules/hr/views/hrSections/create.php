<?php
/* @var $this HrSectionsController */
/* @var $model HrSections */

$this->breadcrumbs=array(
	'Hr Sections'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List HrSections', 'url'=>array('index')),
	array('label'=>'Manage HrSections', 'url'=>array('admin')),
);
?>

<h1>Create HrSections</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>