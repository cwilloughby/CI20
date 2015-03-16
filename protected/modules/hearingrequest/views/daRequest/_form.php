<?php
/* @var $this HearingRequestController */
/* @var $model HearingRequest */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'da-hearing-request-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<table>
	<tr>
		<td>
			<div class="row">
				<?php echo '<label style="display:inline-block; width: 200px; text-align: right;">'; ?>
				<?php echo $model->getAttributeLabel('defName') . ': <span class="required">*</span></label>'; ?>
				<?php echo $form->textField($model,'defName', array('size'=>45,'maxlength'=>100)); ?>
			</div>

			<div class="row">
				<?php echo '<label style="display:inline-block; width: 200px; text-align: right;">'; ?>
				<?php echo $model->getAttributeLabel('caseNumber') . ': <span class="required">*</span></label>'; ?>
				<?php echo $form->textField($model,'caseNumber', array('size'=>30,'maxlength'=>25)); ?>
			</div>

			<div class="row">
				<?php echo '<label style="display:inline-block; width: 200px; text-align: right;">'; ?>
				<?php echo $model->getAttributeLabel('yourName') . ': <span class="required">*</span></label>'; ?>
				<?php echo $form->textField($model,'yourName', array('size'=>30,'maxlength'=>100)); ?>
			</div>

			<div class="row">
				<?php echo '<label style="display:inline-block; width: 200px; text-align: right;">'; ?>
				<?php echo $model->getAttributeLabel('yourEmail') . ': <span class="required">*</span></label>'; ?>
				<?php echo $form->textField($model,'yourEmail', array('size'=>45,'maxlength'=>200, 'style'=>'width:245px')); ?>
			</div>

			<div class="row">
				<?php echo '<label style="display:inline-block; width: 200px; text-align: right;">'; ?>
				<?php echo $model->getAttributeLabel('yourNumber') . ': <span class="required">*</span></label>'; ?>
				<?php echo $form->textField($model,'yourNumber', array('size'=>45,'maxlength'=>45, 'style'=>'width:150px')); ?>

				<?php echo $model->getAttributeLabel('yourExtension') . ' '; ?>
				<?php echo $form->textField($model,'yourExtension', array('size'=>8,'maxlength'=>7, 'style'=>'width:50px')); ?>
			</div>

			<div class="row buttons">
				<?php echo '<label style="display:inline-block; width: 200px; text-align: right;"></label>'; ?>
				<?php echo CHtml::submitButton("Submit"); ?>

				<?php echo CHtml::resetButton("Clear"); ?>
			</div>
		</td>
		
		<td style="width:20%">
			
		</td>
		
		<td style="width:15%; valign:middle; align:right">
			<?php echo '<image style="width:189px; height:163px" src="' . HearingRequest::LOGO . '">'; ?>
		</td>
	</tr>
	</table>
<?php $this->endWidget(); ?>

</div><!-- form -->
