<?php
/* @var $this CaseSummaryController */
/* @var $summary CaseSummary */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'case-summary-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
	<table>
		<tr>
			<td>
			<?php echo $form->labelEx($summary,'location'); ?>
			<?php echo $form->textField($summary,'location'); ?>
			<?php echo $form->error($summary,'location'); ?>
			</td>
		</tr>
		<tr>
			<td>
			<?php echo $form->labelEx($summary,'dispodate'); ?>
			<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
				array(
					'model' => $summary,
					'attribute' => 'dispodate',
					'options' => array(
						'showAnim' => 'fold',
						'dateFormat' => 'yy-mm-dd',
						'formatDate' => 'yy-mm-dd',
						'defaultDate' => $summary->dispodate,
						'changeYear' => true,
						'changeMonth' => true,
						'showButtonPanel' => true,
					),
				));
			?>
			<?php echo $form->error($summary,'dispodate'); ?>
			</td>
		</tr>

		<tr>
			<td>
			<?php echo $form->labelEx($summary,'page'); ?>
			<?php echo $form->textField($summary,'page'); ?>
			<?php echo $form->error($summary,'page'); ?>
			</td>
		</tr>
		
		<tr>
			<td>
			<?php echo $form->labelEx($summary,'sentence'); ?>
			<?php echo $form->textField($summary,'sentence'); ?>
			<?php echo $form->error($summary,'sentence'); ?>
			</td>
		</tr>
		<tr>
			<td>
			<?php echo $form->labelEx($summary,'indate'); ?>
					<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
				array(
					'model' => $summary,
					'attribute' => 'indate',
					'options' => array(
						'showAnim' => 'fold',
						'dateFormat' => 'yy-mm-dd',
						'formatDate' => 'yy-mm-dd',
						'defaultDate' => $summary->indate,
						'changeYear' => true,
						'changeMonth' => true,
						'showButtonPanel' => true,
					),
				));
			?>
			<?php echo $form->error($summary,'indate'); ?>
			</td>
			<td>
			<?php echo $form->labelEx($summary,'outdate'); ?>
			<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
				array(
					'model' => $summary,
					'attribute' => 'outdate',
					'options' => array(
						'showAnim' => 'fold',
						'dateFormat' => 'yy-mm-dd',
						'formatDate' => 'yy-mm-dd',
						'defaultDate' => $summary->outdate,
						'changeYear' => true,
						'changeMonth' => true,
						'showButtonPanel' => true,
					),
				));
			?>
			<?php echo $form->error($summary,'outdate'); ?>
			</td>
		</tr>
		
		<tr>
			<td>
			<?php echo $form->labelEx($summary,'destructiondate'); ?>
			<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
				array(
					'model' => $summary,
					'attribute' => 'destructiondate',
					'options' => array(
						'showAnim' => 'fold',
						'dateFormat' => 'yy-mm-dd',
						'formatDate' => 'yy-mm-dd',
						'defaultDate' => $summary->destructiondate,
						'changeYear' => true,
						'changeMonth' => true,
						'showButtonPanel' => true,
					),
				));
			?>
			<?php echo $form->error($summary,'destructiondate'); ?>
			</td>
		</tr>
		<tr>
			<td>
			<?php echo $form->labelEx($summary,'recip'); ?>
			<?php echo $form->textField($summary,'recip'); ?>
			<?php echo $form->error($summary,'recip'); ?>
			</td>
		</tr>

		<tr>
			<td>
			<?php echo $form->labelEx($summary,'comment'); ?>
			<?php echo $form->textArea($summary,'comment'); ?>
			<?php echo $form->error($summary,'comment'); ?>
			</td>
		</tr>
	</table>

	<table>
		<tr>
			<td>
				<?php echo $form->labelEx($summary,'dna'); ?>
				<?php echo $form->checkBox($summary,'dna'); ?>
				<?php echo $form->error($summary,'dna'); ?>
			</td>
			<td>
				<?php echo $form->labelEx($summary,'bio'); ?>
				<?php echo $form->checkBox($summary,'bio'); ?>
				<?php echo $form->error($summary,'bio'); ?>
			</td>
			<td>
				<?php echo $form->labelEx($summary,'drug'); ?>
				<?php echo $form->checkBox($summary,'drug'); ?>
				<?php echo $form->error($summary,'drug'); ?>
			</td>
			<td>
				<?php echo $form->labelEx($summary,'firearm'); ?>
				<?php echo $form->checkBox($summary,'firearm'); ?>
				<?php echo $form->error($summary,'firearm'); ?>
			</td>
			<td>
				<?php echo $form->labelEx($summary,'money'); ?>
				<?php echo $form->checkBox($summary,'money'); ?>
				<?php echo $form->error($summary,'money'); ?>
			</td>
			<td>
				<?php echo $form->labelEx($summary,'other'); ?>
				<?php echo $form->checkBox($summary,'other'); ?>
				<?php echo $form->error($summary,'other'); ?>
			</td>
		</tr>
	</table>
	<div class="row buttons">
		<?php echo CHtml::submitButton($summary->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
	
	<?php $this->endWidget(); ?>
	
</div><!-- form -->