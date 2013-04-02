<?php /* @var $this Controller */ ?>

<?php $this->beginContent('//layouts/main'); ?>
<div class="span-5 last">
	<div id="sidebar">
	<?php
		$this->menu1=array(
			// The link to the trouble ticket form.
			array('label'=>'Create Ticket', 'url'=>array('/tickets/troubletickets/create')),
			// The link to the hr policy page.
			array('label'=>'Human Resources', 'url'=>array('/hr/hrpolicy/index')),
			// The link to the emergency response plan.
			array('label'=>'Emergency Response Plan', 'url'=>Yii::app()->baseUrl . '/assets/files/cep.pdf'),
		);
		
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Quick Links',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu1,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Page Menu',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu2,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
	?>
	</div><!-- sidebar -->
</div>
<div class="span-19">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<?php $this->endContent(); ?>