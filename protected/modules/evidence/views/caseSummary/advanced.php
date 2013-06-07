<?php
/* @var $this CaseSummaryController */

$this->pageTitle = Yii::app()->name . ' - Case Files';

$this->breadcrumbs=array(
	'Advanced Tools',
);

$this->menu2=array(
	array('label'=>'Defendant Tools', 'url'=>array('/evidence/defendant/admin')),
	array('label'=>'Attorney Tools', 'url'=>array('/evidence/attorney/admin')),
	array('label'=>'Case Tools', 'url'=>array('/evidence/crtcase/admin')),
	array('label'=>'Evidence Tools', 'url'=>array('/evidence/evidence/admin')),
);
?>

<h1>Advanced Tools</h1>

<?php echo CHtml::link('Defendant Tools', array('/evidence/defendant/admin')); ?>
<br/>
<?php echo CHtml::link('Attorney Tools', array('/evidence/attorney/admin')); ?>
<br/>
<?php echo CHtml::link('Case Tools', array('/evidence/crtcase/admin')); ?>
<br/>
<?php echo CHtml::link('Evidence Tools', array('/evidence/evidence/admin')); ?>
