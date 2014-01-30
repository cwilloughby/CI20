<?php
/* @var $this CjisDispositionsController */
/* @var $model CjisDispositions */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cjis-dispositions-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'court'); ?>
		<?php echo $form->textField($model,'court',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'court'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'case'); ?>
		<?php echo $form->textField($model,'case',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'case'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastname'); ?>
		<?php echo $form->textField($model,'lastname',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'lastname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'firstname'); ?>
		<?php echo $form->textField($model,'firstname',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'firstname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dateofbirth'); ?>
		<?php echo $form->textField($model,'dateofbirth'); ?>
		<?php echo $form->error($model,'dateofbirth'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gender'); ?>
		<?php echo $form->textField($model,'gender',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'race'); ?>
		<?php echo $form->textField($model,'race',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'race'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'count'); ?>
		<?php echo $form->textField($model,'count'); ?>
		<?php echo $form->error($model,'count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'offensedescription'); ?>
		<?php echo $form->textArea($model,'offensedescription',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'offensedescription'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'offensetype'); ?>
		<?php echo $form->textField($model,'offensetype',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'offensetype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'disposition'); ?>
		<?php echo $form->textField($model,'disposition',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'disposition'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dateconcluded'); ?>
		<?php echo $form->textField($model,'dateconcluded'); ?>
		<?php echo $form->error($model,'dateconcluded'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'location'); ?>
		<?php echo $form->textField($model,'location',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'location'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'incarcerationyears'); ?>
		<?php echo $form->textField($model,'incarcerationyears'); ?>
		<?php echo $form->error($model,'incarcerationyears'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'incarcerationmonths'); ?>
		<?php echo $form->textField($model,'incarcerationmonths'); ?>
		<?php echo $form->error($model,'incarcerationmonths'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'incarcerationdays'); ?>
		<?php echo $form->textField($model,'incarcerationdays'); ?>
		<?php echo $form->error($model,'incarcerationdays'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'incarcerationhours'); ?>
		<?php echo $form->textField($model,'incarcerationhours'); ?>
		<?php echo $form->error($model,'incarcerationhours'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'percentage'); ?>
		<?php echo $form->textField($model,'percentage',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'percentage'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'suspendallbut'); ?>
		<?php echo $form->textField($model,'suspendallbut',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'suspendallbut'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'suspendpercentage'); ?>
		<?php echo $form->textField($model,'suspendpercentage',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'suspendpercentage'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dayfordayflag'); ?>
		<?php echo $form->textField($model,'dayfordayflag',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'dayfordayflag'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hourforhourflag'); ?>
		<?php echo $form->textField($model,'hourforhourflag',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'hourforhourflag'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'suspendedflag'); ?>
		<?php echo $form->textField($model,'suspendedflag',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'suspendedflag'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'noworkdetailflag'); ?>
		<?php echo $form->textField($model,'noworkdetailflag',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'noworkdetailflag'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'workreleaseflag'); ?>
		<?php echo $form->textField($model,'workreleaseflag',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'workreleaseflag'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'workreleasepercentage'); ?>
		<?php echo $form->textField($model,'workreleasepercentage',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'workreleasepercentage'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'earlyreleaseflag'); ?>
		<?php echo $form->textField($model,'earlyreleaseflag',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'earlyreleaseflag'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'timeservedcredit'); ?>
		<?php echo $form->textField($model,'timeservedcredit',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'timeservedcredit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'specifiedjailcreditmonths'); ?>
		<?php echo $form->textField($model,'specifiedjailcreditmonths',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'specifiedjailcreditmonths'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'specifiedjailcreditdays'); ?>
		<?php echo $form->textField($model,'specifiedjailcreditdays',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'specifiedjailcreditdays'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'specifiedjailcredithours'); ?>
		<?php echo $form->textField($model,'specifiedjailcredithours',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'specifiedjailcredithours'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'incarcerationspecialconditions'); ?>
		<?php echo $form->textArea($model,'incarcerationspecialconditions',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'incarcerationspecialconditions'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'probationtype'); ?>
		<?php echo $form->textField($model,'probationtype',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'probationtype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'probationyears'); ?>
		<?php echo $form->textField($model,'probationyears'); ?>
		<?php echo $form->error($model,'probationyears'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'probationmonths'); ?>
		<?php echo $form->textField($model,'probationmonths'); ?>
		<?php echo $form->error($model,'probationmonths'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'probationdays'); ?>
		<?php echo $form->textField($model,'probationdays'); ?>
		<?php echo $form->error($model,'probationdays'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'probationspecialconditions'); ?>
		<?php echo $form->textArea($model,'probationspecialconditions',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'probationspecialconditions'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'restitutionamount'); ?>
		<?php echo $form->textField($model,'restitutionamount',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'restitutionamount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'courtfines'); ?>
		<?php echo $form->textField($model,'courtfines',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'courtfines'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'finesspecialcondition'); ?>
		<?php echo $form->textArea($model,'finesspecialcondition',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'finesspecialcondition'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->