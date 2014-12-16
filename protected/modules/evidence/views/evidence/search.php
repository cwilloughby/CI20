<?php
/* @var $this EvidenceController */
/* @var $evidence Evidence */
/* @var $results Array */

$this->breadcrumbs=array(
	'Evidence'=>array('search'),
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Evidence', 'url'=>array('search')),
);
?>

<h1>Search Evidence</h1>

<?php echo $this->renderPartial('_form', array('model'=>$evidence)); ?>

<?php echo $this->renderPartial('_results', array('model'=>$evidence, 'results'=>$results)); ?>
