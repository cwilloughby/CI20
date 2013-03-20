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
	
	<div class="row">
		<?php echo $form->label($model, 'def_search1'); ?>
		<?php echo $form->textField($model, 'def_search1'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model, 'def_search2'); ?>
		<?php echo $form->textField($model, 'def_search2'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'caseno'); ?>
		<?php echo $form->textField($model,'caseno'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'div_search'); ?>
		<?php echo $form->textField($model,'div_search'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'complaint_search'); ?>
		<?php echo $form->textField($model,'complaint_search'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'location'); ?>
		<?php echo $form->textField($model,'location'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hearingdate'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
			array(
				'model' => $model,
				'attribute' => 'hearingdate',
				'language' => 'en',
				'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'yy-mm-dd',
					'defaultDate' => $model->hearingdate,
					'changeYear' => true,
					'changeMonth' => true,
					'showButtonPanel' => true,
				),
			));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hearingtype'); ?>
		<?php echo $form->textField($model,'hearingtype'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'page'); ?>
		<?php echo $form->textField($model,'page'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'dispodate'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
			array(
				'model' => $model,
				'attribute' => 'dispodate',
				'language' => 'en',
				'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'yy-mm-dd', 
					'defaultDate' => $model->dispodate,
					'changeYear' => true,
					'changeMonth' => true,
					'showButtonPanel' => true,
				),
			));
		?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'sentence'); ?>
		<?php echo $form->textField($model,'sentence'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'indate'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
			array(
				'model' => $model,
				'attribute' => 'indate',
				'language' => 'en',
				'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'yy-mm-dd', 
					'defaultDate' => $model->indate,
					'changeYear' => true,
					'changeMonth' => true,
					'showButtonPanel' => true,
				),
			));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'outdate'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
			array(
				'model' => $model,
				'attribute' => 'outdate',
				'language' => 'en',
				'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'yy-mm-dd', 
					'defaultDate' => $model->outdate,
					'changeYear' => true,
					'changeMonth' => true,
					'showButtonPanel' => true,
				),
			));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'destructiondate'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
			array(
				'model' => $model,
				'attribute' => 'destructiondate',
				'language' => 'en',
				'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'yy-mm-dd', 
					'defaultDate' => $model->destructiondate,
					'changeYear' => true,
					'changeMonth' => true,
					'showButtonPanel' => true,
				),
			));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'recip'); ?>
		<?php echo $form->textField($model,'recip'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment'); ?>
	</div>
	<table style="width:62%">
		<tr>
			<?php echo '<td>' . $form->label($model,'dna') . "</td>"; ?>
			<?php echo $form->radioButtonList($model, 'dna', array(1=>'Yes', 0=>'No', 2=>'N/A'), 
				array('separator' => '', 'template' => '<td>{label}{input}</td>')); ?>
		</tr>
		<tr>
			<?php echo '<td>' . $form->label($model,'bio') . "</td>"; ?>
			<?php echo $form->radioButtonList($model, 'bio', array(1=>'Yes', 0=>'No', 2=>'N/A'), 
				array('separator' => '', 'template' => '<td>{label}{input}</td>')); ?>
		</tr>
		<tr>
			<?php echo '<td>' . $form->label($model, 'drug') . "</td>"; ?>
			<?php echo $form->radioButtonList($model, 'drug', array(1=>'Yes', 0=>'No', 2=>'N/A'), 
				array('separator' => '', 'template' => '<td>{label}{input}</td>')); ?>
		</tr>
		<tr>
			<?php echo '<td>' . $form->label($model, 'firearm') . "</td>"; ?>
			<?php echo $form->radioButtonList($model, 'firearm', array(1=>'Yes', 0=>'No', 2=>'N/A'), 
				array('separator' => '', 'template' => '<td>{label}{input}</td>')); ?>
		</tr>
		<tr>
			<?php echo '<td>' . $form->label($model, 'money') . "</td>"; ?>
			<?php echo $form->radioButtonList($model, 'money', array(1=>'Yes', 0=>'No', 2=>'N/A'), 
				array('separator' => '', 'template' => '<td>{label}{input}</td>')); ?>
		</tr>
		<tr>
			<?php echo '<td>' . $form->label($model, 'other') . "</td>"; ?>
			<?php echo $form->radioButtonList($model, 'other', array(1=>'Yes', 0=>'No', 2=>'N/A'), 
				array('separator' => '', 'template' => '<td>{label}{input}</td>')); ?>
		</tr>
	</table>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->