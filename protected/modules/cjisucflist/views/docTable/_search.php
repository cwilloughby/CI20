<?php
/* @var $this DocTableController */
/* @var $model DocTable */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'globalSearch',
	'action'=>Yii::app()->createUrl($this->route),
	'enableAjaxValidation'=>true,
	'method'=>'get',
)); ?>

	<div class="row">
			<?php echo 'Search: '; ?>
			<?php echo $form->textField($model,'globalSearch',array('size'=>40,'maxlength'=>70)); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>
	
<?php $this->endWidget(); ?>

</div><!-- search-form -->