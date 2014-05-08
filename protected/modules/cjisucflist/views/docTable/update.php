<?php
/* @var $this DocTableController */
/* @var $model DocTable */

$this->pageTitle = Yii::app()->name . ' - Update CJIS File Record';

$this->breadcrumbs=array(
	'Search CJIS Files'=>array('searchableFileTable'),
	$model->name=>array('viewFileRecord','id'=>$model->id),
	'Update',
);

$this->menu2=array(
	array('label'=>'Search Documents', 'url'=>array('searchableFileTable')),
	array('label'=>'Create Document', 'url'=>array('createFileRecord'), 'visible'=>Yii::app()->user->checkAccess("IT")),
	array('label'=>'View Document', 'url'=>array('viewFileRecord', 'id'=>$model->id), 'visible'=>Yii::app()->user->checkAccess("IT")),
);
?>

<h1>Update Document <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>