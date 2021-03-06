<?php
/* @var $this ResourcesController */
/* @var $model TrainingResources */

$this->breadcrumbs=array(
	'Training Resources'=>array('index'),
	'Search',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Training Resources', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-film"></i> Upload Training Resource', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Training Resources', 'url'=>array('training/typeIndex')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('videos-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Search Training Resources</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php if(Yii::app()->user->hasFlash('deleted')):?>
    <div class="info">
        <?php echo Yii::app()->user->getFlash('deleted'); ?>
    </div>
<?php endif; ?>

<?php 
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);

$this->widget('CustomGridView', array(
	'id'=>'videos-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'title',
		'type',
		array(
			'class'=>'CButtonColumn',
			'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,30=>30),array(
				'onchange'=>"$.fn.yiiGridView.update('news-grid',{ data:{pageSize: $(this).val() }})",
			)),
			'template'=>'{view}{delete}',
			'buttons'=>array
			(
				'view' => array
				(
					'url'=>'$this->grid->controller->createUrl("training/view", array("id"=>$data->primaryKey, "type"=>$data->type))',
				),
			),
		),
	),
));

Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$(".info").animate({opacity: 1.0}, 3000).fadeOut("slow");',
   CClientScript::POS_READY
);
