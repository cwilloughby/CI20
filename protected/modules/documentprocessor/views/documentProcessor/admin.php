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
$this->widget('application.extensions.filetree.SFileTree',
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
	<div id="filetree"></div>
	<br/>
	<input type="submit" value="Share Checked Files"/>

</form>

<?php $this->widget('DocumentUploadWidget', array('uploadType'=>'Admin')); ?>