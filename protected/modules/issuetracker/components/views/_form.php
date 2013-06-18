<?php
/* @var $this IssueTrackerController */
/* @var $model IssueTracker */
/* @var $form CActiveForm */
?>
<script type="text/javascript">
function send()
{
	var data=$("#issue-tracker-search-form").serialize();
	
	$.ajax({
		type: 'GET',
		url: '<?php echo Yii::app()->createAbsoluteUrl("issuetracker/issuetracker/portlet"); ?>',
		data:data,
		success:function(data){
			$("div #issues").html(data);
		},
		error:function(data){ // if error occured
			alert("Error occured.please try again");
			alert(data);
		},
		dataType:'html'
	});
}
</script>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'issue-tracker-search-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'onsubmit'=>"return false;",/* Disable normal form submit */
		'onkeypress'=>" if(event.keyCode == 13){ send(); } " /* Do ajax call when user presses enter key */
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'search'); ?>
		<?php echo $form->textField($model,'search'); ?>
		<?php echo CHtml::Button('Search',array('onclick'=>'send();')); ?> 
		<?php echo $form->error($model,'search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->