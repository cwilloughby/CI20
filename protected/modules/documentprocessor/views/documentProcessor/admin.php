<?php
/* @var $this DocumentsController */
/* @var $documents Documents */

$this->pageTitle = Yii::app()->name . " - Document Processor";

$this->breadcrumbs=array(
	'Documents'=>array('index'),
	'Search',
);

$this->menu2=array(
	array('label'=>'Search Documents', 'url'=>array('adminsearchablefilelist')),
	array('label'=>'Upload Documents', 'url'=>array('create')),
	array('label'=>'List Document Queues', 'url'=>array('listaccessiblequeues')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('documents-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Search Documents</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$documents,
)); ?>
</div><!-- search-form -->

<?php 
$this->widget('application.extensions.filetree.SFileTree',
	array(
		"div"=>"filetree",
		"root"=> '/wamp/files/',
		"multiFolder"=>"true",
		"expandSpeed"=>500,
		"collapseSpeed"=>500,
		"callback"=>"window.alert('C:' + file)",
	)
);
?>

<form action="/documentprocessor/documentprocessor/adminsearchablefilelist" method="post">
	
<div id="filetree"></div>

<input type="submit" value="Share Checked Files"/>

</form>

<?php $this->widget('DocumentUploadWidget', array('uploadType'=>'Admin')); ?>