<?php
/* @var $this CaseSummaryController */
/* @var $model CaseSummary */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'case-summary-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'defid'); ?>
		<?php echo $form->textField($model,'defid'); ?>
		<?php echo $form->error($model,'defid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'caseno'); ?>
		<?php echo $form->textField($model,'caseno'); ?>
		<?php echo $form->error($model,'caseno'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'location'); ?>
		<?php echo $form->textField($model,'location'); ?>
		<?php echo $form->error($model,'location'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dispodate'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
			array(
				'model' => $model,
				'attribute' => 'dispodate',
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'yy-mm-dd',
					'formatDate' => 'yy-mm-dd',
					'defaultDate' => $model->dispodate,
					'changeYear' => true,
					'changeMonth' => true,
					'showButtonPanel' => true,
				),
			));
		?>
		<?php echo $form->error($model,'dispodate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hearingdate'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
			array(
				'model' => $model,
				'attribute' => 'hearingdate',
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'yy-mm-dd',
					'formatDate' => 'yy-mm-dd',
					'defaultDate' => $model->hearingdate,
					'changeYear' => true,
					'changeMonth' => true,
					'showButtonPanel' => true,
				),
			));
		?>
		<?php echo $form->error($model,'hearingdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hearingtype'); ?>
		<?php echo $form->textField($model,'hearingtype'); ?>
		<?php echo $form->error($model,'hearingtype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'page'); ?>
		<?php echo $form->textField($model,'page'); ?>
		<?php echo $form->error($model,'page'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sentence'); ?>
		<?php echo $form->textField($model,'sentence'); ?>
		<?php echo $form->error($model,'sentence'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'indate'); ?>
				<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
			array(
				'model' => $model,
				'attribute' => 'indate',
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'yy-mm-dd',
					'formatDate' => 'yy-mm-dd',
					'defaultDate' => $model->indate,
					'changeYear' => true,
					'changeMonth' => true,
					'showButtonPanel' => true,
				),
			));
		?>
		<?php echo $form->error($model,'indate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'outdate'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
			array(
				'model' => $model,
				'attribute' => 'outdate',
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'yy-mm-dd',
					'formatDate' => 'yy-mm-dd',
					'defaultDate' => $model->outdate,
					'changeYear' => true,
					'changeMonth' => true,
					'showButtonPanel' => true,
				),
			));
		?>
		<?php echo $form->error($model,'outdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'destructiondate'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
			array(
				'model' => $model,
				'attribute' => 'destructiondate',
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'yy-mm-dd',
					'formatDate' => 'yy-mm-dd',
					'defaultDate' => $model->destructiondate,
					'changeYear' => true,
					'changeMonth' => true,
					'showButtonPanel' => true,
				),
			));
		?>
		<?php echo $form->error($model,'destructiondate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recip'); ?>
		<?php echo $form->textField($model,'recip'); ?>
		<?php echo $form->error($model,'recip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment'); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

	<table>
		<tr>
			<td>
				<?php echo $form->labelEx($model,'dna'); ?>
				<?php echo $form->checkBox($model,'dna'); ?>
				<?php echo $form->error($model,'dna'); ?>
			</td>
			<td>
				<?php echo $form->labelEx($model,'bio'); ?>
				<?php echo $form->checkBox($model,'bio'); ?>
				<?php echo $form->error($model,'bio'); ?>
			</td>
			<td>
				<?php echo $form->labelEx($model,'drug'); ?>
				<?php echo $form->checkBox($model,'drug'); ?>
				<?php echo $form->error($model,'drug'); ?>
			</td>
			<td>
				<?php echo $form->labelEx($model,'firearm'); ?>
				<?php echo $form->checkBox($model,'firearm'); ?>
				<?php echo $form->error($model,'firearm'); ?>
			</td>
			<td>
				<?php echo $form->labelEx($model,'money'); ?>
				<?php echo $form->checkBox($model,'money'); ?>
				<?php echo $form->error($model,'money'); ?>
			</td>
			<td>
				<?php echo $form->labelEx($model,'other'); ?>
				<?php echo $form->checkBox($model,'other'); ?>
				<?php echo $form->error($model,'other'); ?>
			</td>
		</tr>
	</table>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->