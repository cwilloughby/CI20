<?php
/* @var $this AttorneyController */
/* @var $model Attorney */

$this->pageTitle = Yii::app()->name . ' - Attorneys';

$this->breadcrumbs=array(
	'Advanced Tools'=>array('/evidence/casesummary/evidencemanager'),
	'Search Attorneys'=>array('admin'),
	$model->attyid=>array('view','id'=>$model->attyid),
	'Update',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Attorneys', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-user"></i> Create Attorney', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-zoom-in"></i> View Attorney', 'url'=>array('view', 'id'=>$model->attyid)),
	array('label'=>'<i class="icon icon-edit"></i> Update Attorney', 'url'=>array('update', 'id'=>$model->attyid)),
);
?>

<h1>Update Attorney <?php echo $model->attyid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>