<?php
/* @var $this TimeLogController */
/* @var $model TimeLog */

$this->pageTitle = Yii::app()->name . " - Time Log";

$this->breadcrumbs=array(
	'Time Logs'=>array('index'),
	'Search',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Time Logs', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Time Logs', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('time-log-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('export', "
$('#export-button').on('click',function() {
    $.fn.yiiGridView.export();
});
$.fn.yiiGridView.export = function() {
    $.fn.yiiGridView.update('time-log-grid',{
        success: function() {
            $('#time-log-grid').removeClass('grid-view-loading');
            window.location = '". $this->createUrl('exportFile')  . "';
        },
        data: $('.search-form form').serialize() + '&export=true'
    });
}
");
?>

<h1>Search Time Logs</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&gt;</b>, 
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->renderPartial('_grid',array(
	'model'=>$model,
));
