<?php
/* @var $this CrtCaseController */
/* @var $model CrtCase */

$this->breadcrumbs=array(
	'Crt Cases'=>array('index'),
	$model->caseno=>array('view','id'=>$model->caseno),
	'Update',
);

$this->menu=array(
	array('label'=>'List CrtCase', 'url'=>array('index')),
	array('label'=>'Create CrtCase', 'url'=>array('create')),
	array('label'=>'View CrtCase', 'url'=>array('view', 'id'=>$model->caseno)),
	array('label'=>'Manage CrtCase', 'url'=>array('admin')),
);
?>

<h1>Update CrtCase <?php echo $model->caseno; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>