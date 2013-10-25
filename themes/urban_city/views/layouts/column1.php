<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div id="abound_wrapper">
	<br/>
	<br/>
	<div id="abound_body">
	<div class="row-fluid">

		<div class="span11">
			<?php if(isset($this->breadcrumbs)):?>
				<?php $this->widget('zii.widgets.CBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
					'homeLink'=>CHtml::link('Home', '/site/index'),
					'htmlOptions'=>array('class'=>'breadcrumb')
				)); ?><!-- breadcrumbs -->
			<?php endif?>

			<?php echo $content; ?>
		</div><!-- span -->
	</div><!--/row-->
	</div>
</div>
<?php $this->endContent(); ?>