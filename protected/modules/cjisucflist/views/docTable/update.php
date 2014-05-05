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
	array('label'=>'Search CJIS Files', 'url'=>array('searchableFileTable')),
	array('label'=>'Upload CJIS File', 'url'=>array('createFileRecord'), 'visible'=>Yii::app()->user->checkAccess("IT")),
	array('label'=>'View File Record', 'url'=>array('viewFileRecord', 'id'=>$model->id), 'visible'=>Yii::app()->user->checkAccess("IT")),
);
?>

<h1>Update CJIS File Record <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>