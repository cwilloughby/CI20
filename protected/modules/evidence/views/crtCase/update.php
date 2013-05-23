<?php
/* @var $this CrtCaseController */
/* @var $model CrtCase */

$this->pageTitle = Yii::app()->name . ' - Court Cases';

$this->breadcrumbs=array(
	'Court Case'=>array('index'),
	$model->caseno=>array('view','id'=>$model->caseno),
	'Update',
);

$this->menu2=array(
	array('label'=>'Search Court Cases', 'url'=>array('admin')),
	array('label'=>'Create Court Case', 'url'=>array('create')),
	array('label'=>'View Court Case', 'url'=>array('view', 'id'=>$model->caseno)),
);
?>

<h1>Update Court Case <?php echo $model->caseno; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>