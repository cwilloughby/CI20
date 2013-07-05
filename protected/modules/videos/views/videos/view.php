<?php
/* @var $this VideosController */
/* @var $model Videos */

$this->breadcrumbs=array(
	'Training Resources'=>array('index'),
	$model->title,
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Training Resources', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-film"></i> Upload Training Resource', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Training Resources', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-zoom-in"></i> View Training Resource', 'url'=>array('view', 'id'=>$model->videoid)),
	array('label'=>'<i class="icon icon-edit"></i> Update Training Resource', 'url'=>array('update', 'id'=>$model->videoid)),
	array('label'=>'<i class="icon icon-trash"></i> Delete Training Resource', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->videoid),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Training Resource #<?php echo $model->videoid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'videoid',
		array(        
			'name'=>'documentid',
			'value'=>isset($model->document)?CHtml::encode($model->document->path):"Unknown"
		),
		'title',
		'type',
	),
)); ?>

<br/>

<?php 

if($model->category == 'Video')
{
	$this->widget('application.extensions.smp.StrobeMediaPlayback',array(
		'srcRelative'=>'/videos/' . $model->document->documentname,
		'width'=>'320',
		'height'=>'240',
		'src_title'=>$model->title,
		'allowFullScreen'=>'true',
		'playButtonOverlay'=>true,
		'scaleMode'=>'stretch',
	));
}
?>
