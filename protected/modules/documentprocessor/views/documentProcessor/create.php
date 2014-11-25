<?php
/* @var $this DocumentsProcessorController */
/* @var $document Documents */

$this->breadcrumbs=array(
	'Documents'=>array('index'),
	'Create',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Documents', 'url'=>array('admin'), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-file"></i> Create Documents', 'url'=>array('create'), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-list-alt"></i> List Documents', 'url'=>array('index')),
);
?>

<h1>Create Documents</h1>

<?php echo $this->renderPartial('uploadForm', array('document'=>$document)); ?>