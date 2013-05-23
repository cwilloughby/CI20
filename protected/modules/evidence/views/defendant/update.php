<?php
/* @var $this DefendantController */
/* @var $model Defendant */

$this->pageTitle = Yii::app()->name . ' - Defendants';

$this->breadcrumbs=array(
	'Defendant'=>array('index'),
	$model->defid=>array('view','id'=>$model->defid),
	'Update',
);

$this->menu2=array(
	array('label'=>'Search Defendants', 'url'=>array('admin')),
	array('label'=>'Create Defendant', 'url'=>array('create')),
	array('label'=>'View Defendant', 'url'=>array('view', 'id'=>$model->defid)),
);
?>

<h1>Update Defendant <?php echo $model->defid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>