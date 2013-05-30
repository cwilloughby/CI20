<?php
/* @var $this TrainingController */
/* @var $video Videos */

$this->pageTitle = Yii::app()->name . ' - Training Video';

$this->breadcrumbs=array(
	'Training'=>array('index'),
	$video->videoid,
);

$this->menu2=array(
	array('label'=>'List Training Videos', 'url'=>array('index')),
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