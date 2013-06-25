<?php
/* @var $this VideosController */
/* @var $video Videos */
/* @var $file Documents */

$this->breadcrumbs=array(
	'Videos'=>array('index'),
	'Upload',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Videos', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-film"></i> Upload Video', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Videos', 'url'=>array('index')),
);
?>

<h1>Upload Video</h1>

<?php echo $this->renderPartial('_form', array('video'=>$video, 'file'=>$file)); ?>