<?php
/* @var $this DeviceInventoryController */
/* @var $model DeviceInventory */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'barcodeForm',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'stateful'=>true,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary(array($model)); ?>

	<div class="row">
		<?php 
		echo "File <span class='required'>*</span> "; ;
		echo $form->fileField($model, 'file');
		echo $form->error($model, 'file'); 
		?>
	</div>
	
	<br/>
	
	<div id="button" class="row buttons">
		<?php echo CHtml::submitButton('Upload'); ?>
	</div>
	
<?php $this->endWidget(); ?>

</div><!-- form -->
