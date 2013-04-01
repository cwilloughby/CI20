<?php
/* @var $this CaseSummaryController */
/* @var $model CaseSummary */

$this->pageTitle = Yii::app()->name . ' - Case Files';

$this->breadcrumbs=array(
	'Case File'=>array('index'),
	$model->summaryid=>array('view','id'=>$model->summaryid),
	'Update',
);

$this->menu2=array(
	array('label'=>'List Case Files', 'url'=>array('index')),
	array('label'=>'Create Case File', 'url'=>array('create')),
	array('label'=>'View Case File', 'url'=>array('view', 'id'=>$model->summaryid)),
	array('label'=>'Manage Case Files', 'url'=>array('admin')),
);
?>

<h1>Update Case File <?php echo $model->summaryid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>