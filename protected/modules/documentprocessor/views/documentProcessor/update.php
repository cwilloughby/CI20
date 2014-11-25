<?php
/* @var $this DocumentsProcessorController */
/* @var $model Documents */

$this->breadcrumbs=array(
	'Documents'=>array('index'),
	$model->documentid=>array('view','id'=>$model->documentid),
	'Update',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Documents', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-file"></i> Create Document', 'url'=>array('create'), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-list-alt"></i> List Documents', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-zoom-in"></i> View Document', 'url'=>array('view', 'id'=>$model->documentid)),
	array('label'=>'<i class="icon icon-edit"></i> Update Document', 'url'=>array('update', 'id'=>$model->documentid), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
);
?>

<h1>Update Documents <?php echo $model->documentid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>