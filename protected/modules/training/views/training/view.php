<?php
/* @var $this TrainingController */
/* @var $resource TrainingResources */
/* @var $types Array */

$this->pageTitle = Yii::app()->name . ' - Training Video';

$this->breadcrumbs=array(
	'Training'=>array('typeindex'),
	$type=>array('resourceindex', 'type'=>$resource->type),
	$resource->resourceid,
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-list-alt"></i> List Training Resources', 'url'=>array('typeIndex')),
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

<?php $this->widget('StrobeMediaPlayback',array(
	'srcRelative'=>'/files/training/' . $resource->document->documentname,
	'width'=>'320',
	'height'=>'240',
	'src_title'=>$resource->title,
	'allowFullScreen'=>'true',
	'playButtonOverlay'=>true,
	'scaleMode'=>'stretch',
));?>