<?php
/* @var $this UserInfoController */
/* @var $model UserInfo */

$this->pageTitle = Yii::app()->name . ' - Manage Users';

$this->breadcrumbs=array(
	'User Management'=>array('index'),
	'Search',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Users', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-user"></i> Create User', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Users', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-info-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Search Users</h1>

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

$this->widget('CustomGridView', array(
	'id'=>'user-info-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
	'afterAjaxUpdate'=>"function(){jQuery('#hire_date_search').datepicker({'dateFormat': 'yy-mm-dd'})}",
	'columns'=>array(
		'firstname',
		'lastname',
		'middlename',
		'username',
		'email',
		'phoneext',
		array( 
			'name'=>'department_search', 
			'value'=>'$data->department->departmentname' 
		),
		array(        
			'name'=>'active',
			'value'=>'($data->active == 1)?"Yes":"No"',
		),
		array(
			'class'=>'CButtonColumn',
			'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,30=>30),array(
				'onchange'=>"$.fn.yiiGridView.update('user-info-grid',{ data:{pageSize: $(this).val() }})",
			)),
			'template'=>'{view} {update}',
		),
	),
)); 
?>
