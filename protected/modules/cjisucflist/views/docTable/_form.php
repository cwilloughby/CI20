<?php
/* @var $this DocTableController */
/* @var $model DocTable */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'doc-table-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>125)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'path'); ?>
		<?php echo $form->textField($model,'path',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'path'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'extension'); ?>
		<?php echo $form->textField($model,'extension',array('size'=>7,'maxlength'=>7)); ?>
		<?php echo $form->error($model,'extension'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uploader'); ?>
		<?php echo $form->textField($model,'uploader',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'uploader'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'release_num'); ?>
		<?php echo $form->textField($model,'release_num',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'release_num'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'release_date'); ?>
		<?php echo $form->textField($model,'release_date'); ?>
		<?php echo $form->error($model,'release_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'agency'); ?>
		<?php echo $form->textField($model,'agency',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'agency'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cda_num'); ?>
		<?php echo $form->textField($model,'cda_num',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'cda_num'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'problem'); ?>
		<?php echo $form->textArea($model,'problem',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'problem'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'coding_start_date'); ?>
		<?php echo $form->textField($model,'coding_start_date'); ?>
		<?php echo $form->error($model,'coding_start_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'test_start_date'); ?>
		<?php echo $form->textField($model,'test_start_date'); ?>
		<?php echo $form->error($model,'test_start_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'production_date'); ?>
		<?php echo $form->textField($model,'production_date'); ?>
		<?php echo $form->error($model,'production_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'documentation_subject'); ?>
		<?php echo $form->textField($model,'documentation_subject',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'documentation_subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'instruction_feature'); ?>
		<?php echo $form->textField($model,'instruction_feature',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'instruction_feature'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->