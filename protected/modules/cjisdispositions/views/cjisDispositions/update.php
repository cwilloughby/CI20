<?php
/* @var $this CjisDispositionsController */
/* @var $model CjisDispositions */

$this->breadcrumbs=array(
	'CJIS Dispositions'=>array('index'),
	$model->dispoid=>array('view','id'=>$model->dispoid),
	'Update',
);

$this->menu2=array(
	array('label'=>'List CJIS Dispositions', 'url'=>array('index')),
	array('label'=>'Create CJIS Disposition', 'url'=>array('create')),
	array('label'=>'View CJIS Dispositions', 'url'=>array('view', 'id'=>$model->dispoid)),
	array('label'=>'Manage CJIS Dispositions', 'url'=>array('admin')),
);
?>

<h1>Update CJIS Dispositions <?php echo $model->dispoid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>