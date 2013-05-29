<?php
/* @var $this VideosController */
/* @var $video Videos */
/* @var $file Documents */

$this->breadcrumbs=array(
	'Videos'=>array('index'),
	$video->title=>array('view','id'=>$video->videoid),
	'Update',
);

$this->menu2=array(
	array('label'=>'Search Videos', 'url'=>array('admin')),
	array('label'=>'Upload Video', 'url'=>array('create')),
	array('label'=>'List Videos', 'url'=>array('index')),
	array('label'=>'View Video', 'url'=>array('view', 'id'=>$video->videoid)),
);
?>

<h1>Update Video <?php echo $video->videoid; ?></h1>

<?php echo $this->renderPartial('_form', array('video'=>$video, 'file'=>$file)); ?>