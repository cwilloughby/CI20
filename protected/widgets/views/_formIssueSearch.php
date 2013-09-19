<?php
/* @var $this IssueTrackerController */
/* @var $model IssueTracker */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'issue-tracker-search-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'onsubmit'=>"return false;",/* Disable normal form submit */
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'search'); ?>
		<?php echo $form->textField($model,'search'); ?>
		<?php echo CHtml::Button('Search',array('id'=>'issuesearch')); ?> 
		<?php echo $form->error($model,'search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php
Yii::app()->clientScript->registerScript('issuescript', '
$("#issuesearch").click(function() {
	var data=$("#issue-tracker-search-form").serialize();
	var myurl = "issuetracker/issuetracker/portlet";
	
	$.ajax({
		type: "GET",
		url: myurl,
		data:data,
		success:function(data){
			$("div #issues").html(data);
		},
		error:function(data){ // if error occured
			alert("Error occured.please try again");
			alert(data);
		},
		dataType:"html"
	});
});',
CClientScript::POS_READY);
?>