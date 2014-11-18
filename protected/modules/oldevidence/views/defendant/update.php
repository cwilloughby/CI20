<?php
/* @var $this DefendantController */
/* @var $model Defendant */

$this->pageTitle = Yii::app()->name . ' - Defendants';

$this->breadcrumbs=array(
	'Advanced Tools'=>array('/evidence/casesummary/evidencemanager'),
	'Search Defendants'=>array('admin'),
	$model->defid=>array('view','id'=>$model->defid),
	'Update',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Defendants', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-file"></i> Create Defendant', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-zoom-in"></i> View Defendant', 'url'=>array('view', 'id'=>$model->defid)),
	array('label'=>'<i class="icon icon-user"></i> Update Defendant', 'url'=>array('update', 'id'=>$model->defid)),
);
?>

<h1>Update Defendant <?php echo $model->defid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>