<?php
/* @var $this CjisDispositionsController */
/* @var $model CjisDispositions */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'court'); ?>
		<?php echo $form->textField($model,'court',array('size'=>8,'maxlength'=>8)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'case'); ?>
		<?php echo $form->textField($model,'case',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lastname'); ?>
		<?php echo $form->textField($model,'lastname',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'firstname'); ?>
		<?php echo $form->textField($model,'firstname',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dateofbirth'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
			array(
				'model' => $model,
				'attribute' => 'dateofbirth',
				'language' => 'en',
				'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'mm/dd/yy',
					'defaultDate' => $model->dateofbirth,
					'changeYear' => true,
					'changeMonth' => true,
					'showButtonPanel' => true,
				),
			));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gender'); ?>
		<?php echo $form->textField($model,'gender',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'race'); ?>
		<?php echo $form->textField($model,'race',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'count'); ?>
		<?php echo $form->textField($model,'count'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'offensedescription'); ?>
		<?php echo $form->textArea($model,'offensedescription',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'offensetype'); ?>
		<?php echo $form->textField($model,'offensetype',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'disposition'); ?>
		<?php echo $form->textField($model,'disposition',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dateconcluded'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
			array(
				'model' => $model,
				'attribute' => 'dateconcluded',
				'language' => 'en',
				'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'mm/dd/yy',
					'defaultDate' => $model->dateconcluded,
					'changeYear' => true,
					'changeMonth' => true,
					'showButtonPanel' => true,
				),
			));
		?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'location'); ?>
		<?php echo $form->textField($model,'location',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'incarcerationyears'); ?>
		<?php echo $form->textField($model,'incarcerationyears'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'incarcerationmonths'); ?>
		<?php echo $form->textField($model,'incarcerationmonths'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'incarcerationdays'); ?>
		<?php echo $form->textField($model,'incarcerationdays'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'incarcerationhours'); ?>
		<?php echo $form->textField($model,'incarcerationhours'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'percentage'); ?>
		<?php echo $form->textField($model,'percentage',array('size'=>25,'maxlength'=>25)); ?> %
	</div>

	<div class="row">
		<?php echo $form->label($model,'suspendallbut'); ?>
		<?php echo $form->textField($model,'suspendallbut',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'suspendpercentage'); ?>
		<?php echo $form->textField($model,'suspendpercentage',array('size'=>25,'maxlength'=>25)); ?> %
	</div>

	<div class="row">
		<?php echo $form->label($model,'dayfordayflag'); ?>
		<?php echo $form->dropDownList($model,'dayfordayflag', Array('', 'N' => 'No', 'Y' => 'Yes'), array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hourforhourflag'); ?>
		<?php echo $form->dropDownList($model,'hourforhourflag', Array('', 'N' => 'No', 'Y' => 'Yes'), array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'suspendedflag'); ?>
		<?php echo $form->dropDownList($model,'suspendedflag', Array('', 'N' => 'No', 'Y' => 'Yes'), array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'noworkdetailflag'); ?>
		<?php echo $form->dropDownList($model,'noworkdetailflag', Array('', 'N' => 'No', 'Y' => 'Yes'), array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'workreleaseflag'); ?>
		<?php echo $form->dropDownList($model,'workreleaseflag', Array('', 'N' => 'No', 'Y' => 'Yes'), array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'workreleasepercentage'); ?>
		<?php echo $form->textField($model,'workreleasepercentage',array('size'=>25,'maxlength'=>25)); ?> %
	</div>

	<div class="row">
		<?php echo $form->label($model,'earlyreleaseflag'); ?>
		<?php echo $form->dropDownList($model,'earlyreleaseflag', Array('', 'N' => 'No', 'Y' => 'Yes'), array('size'=>1,'maxlength'=>1)); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'timeservedcredit'); ?>
		<?php echo $form->textField($model,'timeservedcredit',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'specifiedjailcreditmonths'); ?>
		<?php echo $form->textField($model,'specifiedjailcreditmonths',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'specifiedjailcreditdays'); ?>
		<?php echo $form->textField($model,'specifiedjailcreditdays',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'specifiedjailcredithours'); ?>
		<?php echo $form->textField($model,'specifiedjailcredithours',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'incarcerationspecialconditions'); ?>
		<?php echo $form->textArea($model,'incarcerationspecialconditions',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'probationtype'); ?>
		<?php echo $form->textField($model,'probationtype',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'probationyears'); ?>
		<?php echo $form->textField($model,'probationyears'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'probationmonths'); ?>
		<?php echo $form->textField($model,'probationmonths'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'probationdays'); ?>
		<?php echo $form->textField($model,'probationdays'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'probationspecialconditions'); ?>
		<?php echo $form->textArea($model,'probationspecialconditions',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'restitutionamount'); ?>
		<?php echo $form->textField($model,'restitutionamount',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'courtfines'); ?>
		<?php echo $form->textField($model,'courtfines',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'finesspecialcondition'); ?>
		<?php echo $form->textArea($model,'finesspecialcondition',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->