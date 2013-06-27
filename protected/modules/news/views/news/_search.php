<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
			array(
				'model' => $model,
				'attribute' => 'date',
				'language' => 'en',
				'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'mm/dd/yy',
					'defaultDate' => $model->date,
					'changeYear' => true,
					'changeMonth' => true,
					'showButtonPanel' => true,
				),
			));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'news'); ?>
		<?php echo $form->textArea($model,'news',array('rows'=>6, 'cols'=>50)); ?>
	</div>
	<?php
	if(Yii::app()->user->checkAccess("IT", Yii::app()->user->id))
	{
		?>
		<div class="row">
			<?php echo $form->label($model,'typeid'); ?>
			<?php echo $form->textField($model,'typeid'); ?>
		</div>
		<div class="row">
			<?php echo $form->label($model,'postedby'); ?>
			<?php echo $form->textField($model,'postedby'); ?>
		</div>
		<?php
	}
	?>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->