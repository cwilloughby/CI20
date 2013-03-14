<?php
/* @var $this CaseSummaryController */
/* @var $model CaseSummary */

$this->breadcrumbs=array(
	'Cases'=>array('index'),
	$model->summaryid=>array('view','id'=>$model->summaryid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Cases', 'url'=>array('index')),
	array('label'=>'Create Case', 'url'=>array('create')),
	array('label'=>'View Case', 'url'=>array('view', 'id'=>$model->summaryid)),
	array('label'=>'Manage Cases', 'url'=>array('admin')),
);
?>

<h1>Update Case <?php echo $model->summaryid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>