<?php
/* @var $this HrPolicyController */
/* @var $model HrPolicy */

$this->breadcrumbs=array(
	'Hr Policies'=>array('index'),
	$model->sectionid=>array('view','id'=>$model->sectionid),
	'Update',
);

$this->menu=array(
	array('label'=>'Show HR Policy', 'url'=>array('index')),
	array('label'=>'Create HR Section', 'url'=>array('create')),
	array('label'=>'View HR Section', 'url'=>array('view', 'id'=>$model->sectionid)),
	array('label'=>'Manage HR Policy', 'url'=>array('admin')),
);
?>

<h1>Update HrPolicy <?php echo $model->sectionid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>