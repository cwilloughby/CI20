<?php
/* @var $this TrainingController */
/* @var $video Videos */
/* @var $types Array */

$this->pageTitle = Yii::app()->name . ' - Training Video';

$this->breadcrumbs=array(
	'Training'=>array('typeindex'),
	$type=>array('resourceindex', 'type'=>$video->type),
	$video->videoid,
);

$this->menu2=array(
	array('label'=>'List Training Resources', 'url'=>array('typeIndex')),
);

$count = 1;
// This loop allows the side menu to be dynamic.
foreach($types as $key =>$value)
{
	$this->menu2 = array_merge($this->menu2, 
			array($count =>array('label'=>$value, 'url'=>array('resourceIndex', 'type'=>$value))));
	$count++;
}
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