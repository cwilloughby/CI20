<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

  <div class="row-fluid">
	<div class="span3">
		<div class="sidebar-nav">
        
		  <?php $this->widget('zii.widgets.CMenu', array(
			/*'type'=>'list',*/
			'encodeLabel'=>false,
			'items'=>array(
				array('label'=>'<i class="icon icon-home"></i> Home', 'url'=>array('/site/index'),'itemOptions'=>array('class'=>'')),
				// The link to the trouble ticket form.
				array('label'=>'<i class="icon icon-tag"></i> Create Ticket', 'url'=>array('/tickets/troubletickets/create')),
				// The link to the hr policy page.
				array('label'=>'<i class="icon icon-book"></i> Human Resources', 'url'=>array('/hr/hrpolicy/index')),
				// The link to the emergency response plan.
				array('label'=>'<i class="icon icon-fire"></i> Emergency Response Plan', 'url'=>Yii::app()->baseUrl . '/assets/files/cep.pdf'),
				
				// Include the operations menu
				array('label'=>'OPERATIONS','items'=>$this->menu1),
			),
			));?>
			<br/>
			<?php $this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Page Menu',
			));
			$this->widget('zii.widgets.CMenu', array(
				'encodeLabel'=>false,
				'items'=>$this->menu2,
				'htmlOptions'=>array('class'=>'OPERATIONS'),
			));
			$this->endWidget();
		  ?>
		</div>
        <br>
		
    </div><!--/span-->
    <div class="span9">
    
    <?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
			'homeLink'=>CHtml::link('Home', '/'),
			'htmlOptions'=>array('class'=>'breadcrumb')
        )); ?><!-- breadcrumbs -->
    <?php endif?>
    
    <!-- Include content pages -->
    <?php echo $content; ?>

	</div><!--/span-->
  </div><!--/row-->


<?php $this->endContent(); ?>