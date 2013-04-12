<?php
/* @var $this CaseSummaryController */
/* @var $summary CaseSummary */
/* @var $defendant Defendant */
/* @var $case CrtCase */
/* @var $attorney Attorney */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'case-summary-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<p class="note">If the defendant is a company and not a person,
		just put the company's name in for the last name and leave the first name and oca blank.</p>
	
	<?php echo $form->errorSummary(array($summary, $defendant, $case, $attorney)); ?>

	<table>
		<tr>
			<td>
			<table>
				<tr>
					<td>
					<?php echo $form->labelEx($defendant,'fname'); ?>
					<?php echo $form->textField($defendant,'fname'); ?>
					<?php echo $form->error($defendant,'fname'); ?>
					</td>
				</tr>

				<tr>
					<td>
					<?php echo $form->labelEx($defendant,'lname', array('required' => true)); ?>
					<?php echo $form->textField($defendant,'lname'); ?>
					<?php echo $form->error($defendant,'lname'); ?>
					</td>
				</tr>

				<tr>
					<td>
					<?php echo $form->labelEx($defendant,'oca'); ?>
					<?php echo $form->textField($defendant,'oca'); ?>
					<?php echo $form->error($defendant,'oca'); ?>
					</td>
				</tr>
			</table>
			</td>
			<td>
			<table>
				<tr>
					<td>
					<?php echo $form->labelEx($case,'caseno', array('required' => true)); ?>
					<?php echo $form->textField($case,'caseno'); ?>
					<?php echo $form->error($case,'caseno'); ?>
					</td>
				</tr>

				<tr>
					<td>
					<?php echo $form->labelEx($case,'crtdiv'); ?>
					<?php echo $form->textField($case,'crtdiv'); ?>
					<?php echo $form->error($case,'crtdiv'); ?>
					</td>
				</tr>

				<tr>
					<td>
					<?php echo $form->labelEx($case,'cptno'); ?>
					<?php echo $form->textField($case,'cptno'); ?>
					<?php echo $form->error($case,'cptno'); ?>
					</td>
				</tr>
			</table>
			</td>
		</tr>
	</table>
	
	<hr>
	
	<?php $this->widget('ext.jqrelcopy.JQRelcopy',array(
		'id' => 'copylink',
		'removeText' => 'Remove',
		'removeHtmlOptions' => array('style'=>'color:red'),
		'options' => array(
			'copyClass'=>'newcopy',
			'limit'=>20,
			'clearInputs'=>true,
			'excludeSelector'=>'.skipcopy',
			'append'=>CHtml::tag('span',array('class'=>'hint'),'You can remove this line'),
		)
	))?>
 
	<table>
		<tr>
			<th><?php echo $form->labelEx($attorney,'fname');?></th>
			<th><?php echo $form->labelEx($attorney,'lname');?></th>
			<th><?php echo $form->labelEx($attorney,'barid');?></th>
		</tr>

		<tr class="row copy">
			<td>
			<?php echo $form->textField($attorney,'fname[]', array('required' => true)); ?>
			<?php echo $form->error($attorney,'fname[]'); ?>
			</td>
			<td>
			<?php echo $form->textField($attorney,'lname[]', array('required' => true)); ?>
			<?php echo $form->error($attorney,'lname[]'); ?>
			</td>
			<td>
			<?php echo $form->textField($attorney,'barid[]'); ?>
			<?php echo $form->error($attorney,'barid[]'); ?>
			</td>
		</tr>
		<tr>
			<td>
			<a id="copylink" href="#" rel=".copy">Add More Attorneys To The Case</a>
			</td>
		</tr>
	</table>
	
	<hr>
	
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