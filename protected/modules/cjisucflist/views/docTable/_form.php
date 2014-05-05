<?php
/* @var $this DocTableController */
/* @var $model DocTable */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'doc-table-form',
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'fileUp'); ?>
		<?php echo $form->fileField($model, 'fileUp'); ?>
		<?php echo $form->error($model,'fileUp'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type', 
			array(
				""=>"",
				"Design"=>"Design",
				"Documentation"=>"Documentation",
				"Instructional"=>"Instructional",
				"Proposal"=>"Proposal"
			));
		?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'release_num'); ?>
		<?php echo $form->textField($model,'release_num',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'release_num'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'release_date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
			array(
				'model' => $model,
				'attribute' => 'release_date',
				'language' => 'en',
				'id'=>'rel_date',
				'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'mm/dd/yy',
					'defaultDate' => $model->release_date,
					'changeYear' => true,
					'changeMonth' => true,
					'showButtonPanel' => true,
				),
			));
		?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'agency'); ?>
		<?php echo $form->textField($model,'agency',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'agency'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cda_num'); ?>
		<?php echo $form->textField($model,'cda_num',array('size'=>8,'maxlength'=>100)); ?>
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
		<?php echo $form->label($model,'coding_start_date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
			array(
				'model' => $model,
				'attribute' => 'coding_start_date',
				'language' => 'en',
				'id'=>'coding_start',
				'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'yy-mm-dd',
					'altField' => '#coding_start',
					'altFormat' => 'mm/dd/yy',
					'defaultDate' => $model->coding_start_date,
					'changeYear' => true,
					'changeMonth' => true,
					'showButtonPanel' => true,
				),
			));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'test_start_date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
			array(
				'model' => $model,
				'attribute' => 'test_start_date',
				'language' => 'en',
				'id'=>'test_start',
				'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'yy-mm-dd',
					'altField' => '#test_start',
					'altFormat' => 'mm/dd/yy',
					'defaultDate' => $model->test_start_date,
					'changeYear' => true,
					'changeMonth' => true,
					'showButtonPanel' => true,
				),
			));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'production_date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
			array(
				'model' => $model,
				'attribute' => 'production_date',
				'language' => 'en',
				'id'=>'prod_date',
				'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'yy-mm-dd',
					'altField' => '#prod_date',
					'altFormat' => 'mm/dd/yy',
					'defaultDate' => $model->production_date,
					'changeYear' => true,
					'changeMonth' => true,
					'showButtonPanel' => true,
				),
			));
		?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'documentation_subject'); ?>
		<?php echo $form->textArea($model,'documentation_subject',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'documentation_subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'instruction_feature'); ?>
		<?php echo $form->textArea($model,'instruction_feature',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'instruction_feature'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Upload' : 'Update'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->