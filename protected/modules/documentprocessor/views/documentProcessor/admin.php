<?php
/* @var $this DocumentsController */
/* @var $documents Documents */

$this->pageTitle = Yii::app()->name . " - Document Processor";

$this->breadcrumbs=array(
	'Documents'=>array('index'),
	'Admin Search',
);

$this->menu2=array(
	array('label'=>'Search Documents', 'url'=>array('adminsearchablefilelist')),
	array('label'=>'Upload Documents', 'url'=>array('create')),
	array('label'=>'List Document Queues', 'url'=>array('listaccessiblequeues')),
);
?>

<h1>Search Documents</h1>

<?php 
$this->widget('SFileTree',
	array(
		"div"=>"filetree",
		"root"=> '/wamp/files/',
		"multiFolder"=>"true",
		"expandSpeed"=>500,
		"collapseSpeed"=>500,
		"callback"=>"window.alert('C:' + file)",
		"script"=> "/../../../documentprocessor/documentprocessor/filetree"
	)
);
?>

<br/>

<div class="form">

<?php echo CHtml::beginForm(); ?>

	<?php echo CHtml::textField("search", "", array()); ?>

	<?php echo CHtml::submitButton('Search', array("style" => "margin-bottom: 9px", "action" => "/documentprocessor/documentprocessor/adminsearchablefilelist")); ?>

<?php echo CHtml::endForm(); ?>

</div><!-- form -->

<form action="/documentprocessor/documentprocessor/sharevalidatedfiles" method="post">

	<input type="submit" value="Share Checked Files"/>
	<br/><br/>
	<ul id="atree">
	<div id="filetree"></div>
	</ul>
	<br/>
	<input type="submit" value="Share Checked Files"/>

</form>

<?php $this->widget('DocumentUploadWidget', array('uploadType'=>'Admin')); ?>

<?php 
Yii::app()->clientScript->registerCoreScript('jquery.ui');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/scripts/jquery.mjs.nestedSortable.js');
?>

<?php
Yii::app()->clientScript->registerScript('fileSort', "
	$(function(){
		$('#atree').nestedSortable({
			listType: 'ul',
            handle: 'a',
            items: 'li',
			helper: 'clone'
		});
	});
", CClientScript::POS_END);
?>
