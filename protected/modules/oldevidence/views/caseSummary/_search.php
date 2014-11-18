<?php
/* @var $this CaseSummaryController */
/* @var $model CaseSummary */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	
	<table>
		<tr>
			<td>
			<?php echo $form->label($model, 'def_search1'); ?>
			<?php echo $form->textField($model, 'def_search1'); ?>
			</td>
			<td>
			<?php echo $form->label($model, 'def_search2'); ?>
			<?php echo $form->textField($model, 'def_search2'); ?>
			</td>
		</tr>

		<tr>
			<td>
			<?php echo $form->label($model,'caseno'); ?>
			<?php echo $form->textField($model,'caseno'); ?>
			</td>
			<td>
			<?php echo $form->label($model,'complaint_search'); ?>
			<?php echo $form->textField($model,'complaint_search'); ?>
			</td>
		</tr>
		<?php
		if(Yii::app()->user->checkAccess("EvidenceAdmin", Yii::app()->user->id))
		{
			?>
			<tr>
				<td>
				<?php echo $form->label($model,'div_search'); ?>
				<?php echo $form->textField($model,'div_search'); ?>
				</td>
				<td>
				<?php echo $form->label($model,'location'); ?>
				<?php echo $form->textField($model,'location'); ?>
				</td>
				<td>
				<?php echo $form->label($model,'page'); ?>
				<?php echo $form->textField($model,'page'); ?>
				</td>
			</tr>

			<tr>
				<td>
				<?php echo $form->label($model,'dispodate'); ?>
				<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
					array(
						'model' => $model,
						'attribute' => 'dispodate',
						'language' => 'en',
						'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
						'options' => array(
							'showAnim' => 'fold',
							'dateFormat' => 'mm/dd/yy',
							'defaultDate' => $model->dispodate,
							'changeYear' => true,
							'changeMonth' => true,
							'showButtonPanel' => true,
						),
					));
				?>
				</td>

				<td>
				<?php echo $form->label($model,'sentence'); ?>
				<?php echo $form->textField($model,'sentence'); ?>
				</td>
			</tr>

			<tr>
				<td>
				<?php echo $form->label($model,'indate'); ?>
				<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
					array(
						'model' => $model,
						'attribute' => 'indate',
						'language' => 'en',
						'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
						'options' => array(
							'showAnim' => 'fold',
							'dateFormat' => 'mm/dd/yy',
							'defaultDate' => $model->indate,
							'changeYear' => true,
							'changeMonth' => true,
							'showButtonPanel' => true,
						),
					));
				?>
				</td>

				<td>
				<?php echo $form->label($model,'outdate'); ?>
				<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
					array(
						'model' => $model,
						'attribute' => 'outdate',
						'language' => 'en',
						'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
						'options' => array(
							'showAnim' => 'fold',
							'dateFormat' => 'mm/dd/yy',
							'defaultDate' => $model->outdate,
							'changeYear' => true,
							'changeMonth' => true,
							'showButtonPanel' => true,
						),
					));
				?>
				</td>
			</tr>

			<tr>
				<td>
				<?php echo $form->label($model,'destructiondate'); ?>
				<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
					array(
						'model' => $model,
						'attribute' => 'destructiondate',
						'language' => 'en',
						'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
						'options' => array(
							'showAnim' => 'fold',
							'dateFormat' => 'mm/dd/yy',
							'defaultDate' => $model->destructiondate,
							'changeYear' => true,
							'changeMonth' => true,
							'showButtonPanel' => true,
						),
					));?>
				</td>
			</tr>
			<?php
		}
		?>
		<tr>
			<td>
			<?php echo CHtml::submitButton('Search'); ?>
			</td>
		</tr>
	</table>
<?php $this->endWidget(); ?>

</div><!-- search-form -->