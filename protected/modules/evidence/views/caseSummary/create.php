<?php
/* @var $this CaseSummaryController */
/* @var $model CaseSummary */

$this->breadcrumbs=array(
	'Cases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Cases', 'url'=>array('index')),
	array('label'=>'Manage Cases', 'url'=>array('admin')),
);
?>

<h1>Create Case</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>