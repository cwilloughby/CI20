<?php
/* @var $this EvidenceController */
/* @var $model Evidence */

$this->pageTitle = Yii::app()->name . ' - Evidence';

$this->breadcrumbs=array(
	'Advanced Tools'=>array('/evidence/casesummary/evidencemanager'),
	'Search Evidence'=>array('admin'),
	$model->evidenceid=>array('view','id'=>$model->evidenceid),
	'Update',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Evidence', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-file"></i> Create Evidence', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-zoom-in"></i> View Evidence', 'url'=>array('view', 'id'=>$model->evidenceid)),
	array('label'=>'<i class="icon icon-edit"></i> Update Evidence', 'url'=>array('update', 'id'=>$model->evidenceid)),
);
?>

<h1>Update Evidence <?php echo $model->evidenceid; ?></h1>

<?php echo $this->renderPartial('_updateForm', array('model'=>$model)); ?>