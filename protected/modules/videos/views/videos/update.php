<?php
/* @var $this VideosController */
/* @var $video Videos */
/* @var $file Documents */

$this->breadcrumbs=array(
	'Training Resources'=>array('index'),
	$video->title=>array('view','id'=>$video->videoid),
	'Update',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Training Resources', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-film"></i> Upload Training Resources', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Training Resources', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-zoom-in"></i> View Training Resource', 'url'=>array('view', 'id'=>$video->videoid)),
);
?>

<h1>Update Training Resource <?php echo $video->videoid; ?></h1>

<?php echo $this->renderPartial('_form', array('video'=>$video, 'file'=>$file)); ?>