<?php
/* @var $this VideosController */
/* @var $model Videos */

$this->breadcrumbs=array(
	'Videos'=>array('index'),
	$model->title,
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Videos', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-film"></i> Upload Video', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Videos', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-zoom-in"></i> View Video', 'url'=>array('view', 'id'=>$model->videoid)),
	array('label'=>'<i class="icon icon-edit"></i> Update Video', 'url'=>array('update', 'id'=>$model->videoid)),
	array('label'=>'<i class="icon icon-trash"></i> Delete Video', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->videoid),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Video #<?php echo $model->videoid; ?></h1>

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

<?php $this->widget('application.extensions.smp.StrobeMediaPlayback',array(
	'srcRelative'=>'/videos/' . $model->document->documentname,
	'width'=>'320',
	'height'=>'240',
	'src_title'=>$model->title,
	'allowFullScreen'=>'true',
	'playButtonOverlay'=>true,
	'scaleMode'=>'stretch',
));?>
