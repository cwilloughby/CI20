<?php
/* @var $this CaseSummaryController */
/* @var $model CaseSummary */

$this->pageTitle = Yii::app()->name . ' - Case Files';

$this->breadcrumbs=array(
	'Case File'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Case Files', 'url'=>array('index')),
	array('label'=>'Manage Case Files', 'url'=>array('admin')),
);
?>

<h1>Create Case File</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>