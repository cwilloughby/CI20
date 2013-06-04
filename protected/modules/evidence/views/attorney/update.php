<?php
/* @var $this AttorneyController */
/* @var $model Attorney */

$this->pageTitle = Yii::app()->name . ' - Attorneys';

$this->breadcrumbs=array(
	'Attorney'=>array('index'),
	$model->attyid=>array('view','id'=>$model->attyid),
	'Update',
);

$this->menu2=array(
	array('label'=>'Search Attorneys', 'url'=>array('admin')),
	array('label'=>'Create Attorney', 'url'=>array('create')),
	array('label'=>'View Attorney', 'url'=>array('view', 'id'=>$model->attyid)),
	array('label'=>'Update Attorney', 'url'=>array('update', 'id'=>$model->attyid)),
);
?>

<h1>Update Attorney <?php echo $model->attyid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>