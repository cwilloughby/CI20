<?php
/* @var $this HrSectionsController */
/* @var $model HrSections */

$this->breadcrumbs=array(
	'Hr Sections'=>array('index'),
	$model->sectionid=>array('view','id'=>$model->sectionid),
	'Update',
);

$this->menu=array(
	array('label'=>'List HrSections', 'url'=>array('index')),
	array('label'=>'Create HrSections', 'url'=>array('create')),
	array('label'=>'View HrSections', 'url'=>array('view', 'id'=>$model->sectionid)),
	array('label'=>'Manage HrSections', 'url'=>array('admin')),
);
?>

<h1>Update HrSections <?php echo $model->sectionid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>