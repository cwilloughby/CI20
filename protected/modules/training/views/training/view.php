<?php
/* @var $this TrainingController */
/* @var $video Videos */

$this->pageTitle = Yii::app()->name . ' - Training Video';

$this->breadcrumbs=array(
	'Training'=>array('typeindex'),
	$type=>array('resourceindex', 'type'=>$video->type),
	$video->videoid,
);

$this->menu2=array(
	array('label'=>'List Training Resources', 'url'=>array('typeIndex')),
);
?>

<?php $this->widget('application.extensions.smp.StrobeMediaPlayback',array(
	'srcRelative'=>'/videos/' . $video->document->documentname,
	'width'=>'320',
	'height'=>'240',
	'src_title'=>$video->title,
	'allowFullScreen'=>'true',
	'playButtonOverlay'=>true,
	'scaleMode'=>'stretch',
));?>