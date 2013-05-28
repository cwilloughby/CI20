<?php
/* @var $this VideosController */
/* @var $video Videos */
/* @var $file Documents */

$this->breadcrumbs=array(
	'Videos'=>array('index'),
	'Upload',
);

$this->menu2=array(
	array('label'=>'Search Videos', 'url'=>array('admin')),
	array('label'=>'Upload Video', 'url'=>array('create')),
	array('label'=>'List Videos', 'url'=>array('index')),
);
?>

<h1>Upload Video</h1>

<?php echo $this->renderPartial('_form', array('video'=>$video, 'file'=>$file)); ?>