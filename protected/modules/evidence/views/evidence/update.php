<?php
/* @var $this EvidenceController */
/* @var $model Evidence */

$this->breadcrumbs=array(
	'Evidence'=>array('index'),
	$model->evidenceid=>array('view','id'=>$model->evidenceid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Evidence', 'url'=>array('index')),
	array('label'=>'Create Evidence', 'url'=>array('create')),
	array('label'=>'View Evidence', 'url'=>array('view', 'id'=>$model->evidenceid)),
	array('label'=>'Manage Evidence', 'url'=>array('admin')),
);
?>

<h1>Update Evidence <?php echo $model->evidenceid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>