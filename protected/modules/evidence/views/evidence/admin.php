<?php
/* @var $this EvidenceController */
/* @var $model Evidence */

$this->pageTitle = Yii::app()->name . ' - Evidence';

$this->breadcrumbs=array(
	'Evidence'=>array('index'),
	'Search',
);

$this->menu2=array(
	array('label'=>'Search Evidence', 'url'=>array('admin')),
	array('label'=>'Create Evidence', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('evidence-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Search Evidence</h1>

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

<?php 
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'evidence-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
	'afterAjaxUpdate'=>"function(){jQuery('#date_search').datepicker({'dateFormat': 'yy-mm-dd'})}",
	'columns'=>array(
		'exhibitlist',
		'caseno',
		'hearingtype',
		array(
			'name' => 'hearingdate',
			'value' => '(isset($data->hearingdate) && ((int)$data->hearingdate))
				?CHtml::encode(date("m/d/Y", strtotime($data->hearingdate))):"N/A"',
			'type' => 'raw', 
			'filter'=>$this->widget('zii.widgets.jui.CJuiDatepicker', array(
				'model'=>$model, 
				'attribute'=>'hearingdate', 
				'htmlOptions' => array('id' => 'date_search'), 
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'yy-mm-dd',
					'defaultDate' => $model->hearingdate,
					'changeYear' => true,
					'changeMonth' => true,
					'showButtonPanel' => true,
				)
			), true)
		),
		'exhibitno',
		'evidencename',
		'comment',
		array(
			'class'=>'CButtonColumn',
			'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,30=>30),array(
				'onchange'=>"$.fn.yiiGridView.update('evidence-grid',{ data:{pageSize: $(this).val() }})",
			)),
			'template'=>'{view}{update}',
		),
	),
)); ?>
