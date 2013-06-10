<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<style>
    /*.toggler { width: 500px; height: 200px; position: relative; }*/
    /*#button { padding: .5em 1em; text-decoration: none; }*/
    #effect { width: 100%; height: 375px; padding: 0; position: relative; background: #fff; }
    #effect h3 { margin: 0; padding: 0.4em; text-align: center; vertical-align: bottom}
    
  </style>
<div class="grid grid-pad">
 

<!--<div class="grid">-->
   <div class="col-1-4">
     <div class="module1 mod1_image">  
     <div class="menu-vertical"> 
        <ul>
            <li><a href="https://apps.tn.gov/tndlr/">Renew/Duplicate Driver License</a></li>
            <li><a href="http://www.tn.gov/safety/publicsafety.shtml">Driving and Public Safety</a></li>
            <li><a href="http://www.tn.gov/dlpractice/">Take a Practice Test</a></li>
            <li><a href="http://www.tn.gov/revenue/vehicle">Vehicle Title &amp; Registration</a></li>
            <li><a href="http://www.tn.gov/topics/Driving/">More &raquo;</a></li>
          </ul>
     </div>
         <!--<img src="/ci20/assets/images/main/education.jpg" />-->
     </div>
    
   </div>
   <div class="col-1-4">
     <div class="module2" >  
        
    <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">Submit</a></li>
        <li><a href="#">Terms</a></li>
    </ul>

</div>
   </div>
   <div class="col-1-4">
<!--     <div class="module">
     		<h3>2/3 (Opt-in Outside Padding)</h3>
				<p>3Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>	
     </div>-->
     <div class="half_mod_top">
     		<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array('links'=>$this->breadcrumbs,)); ?><!-- breadcrumbs -->
	<?php endif?>  </div>
       <div class="half_mod_bottom">
     		      
     <div class="menu-vertical"> 
        <?php
		if(!isset(Yii::app()->user->id))
			$this->widget('UserLogin');
		else
		{
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
		}
	?>
     </div>
         <!--<img src="/ci20/assets/images/main/education.jpg" />-->
       </div>
   </div>
   <div class="col-1-4">
       <div class="module3">
     		<div class="toggler">
  <div id="effect" class="ui-widget-content ui-corner-all">
    <h3 class="ui-widget-header ui-corner-all">Animate</h3>
    <p>
      Etiam libero neque, luctus a, eleifend nec, semper at, lorem. Sed pede. Nulla lorem metus, adipiscing ut, luctus sed, hendrerit vitae, mi.
    </p>
  </div>
</div>
 
<!--<a href="#" id="button" class="ui-state-default ui-corner-all">Toggle Effect</a>-->
 </div>

   </div>
<!--   <div class="col-1-8">
     <div class="module">
     		<h3>1/3</h3>
				<p>4Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam.</p>	
     </div>
   </div>-->
   <div class="col-1-4">
     <div class="module4">
<?php $this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Quick Links',
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu1,
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();  ?>  </div>
   </div>
   <div class="col-1-4">
     <div class="module5">
     		<?php $this->widget('WeatherReport');?> </div>
   </div>
  <div class="col-1-4">
     <div class="module6">
            <?php $this->widget('NewsReport');?>
     </div>
   </div>
  <div class="col-1-4">
     <div class="module7">
			<?php $this->widget('NewsReport', array('type'=>'IT News'));?>
     </div>
   </div>
  <div class="col-2-3">
     <div class="module8">
     		<?php $this->widget('zii.widgets.CMenu',array(
			'activateParents'=>true,
			'lastItemCssClass'=>'last',
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index'), 'itemOptions'=>array('class'=>'menu-icon-home')),
				array(
					'label'=>'Helpdesk', //'linkOptions'=>array('class'=>'menu-icon-helpdesk'),
					'visible'=>!Yii::app()->user->isGuest,
					'itemOptions'=>array('class'=>'menu-icon-helpdesk'),
					'items'=>array(
						array('label'=>'Create Ticket', 'url'=>array('/tickets/troubletickets/create'), 'itemOptions'=>array('class'=>'sub')),
						array('label'=>'View Open Tickets', 'url'=>array('/tickets/troubletickets/index'), 'itemOptions'=>array('class'=>'sub')),
						array('label'=>'View Closed Tickets', 'url'=>array('/tickets/troubletickets/closedindex'), 'itemOptions'=>array('class'=>'sub')),
						array('label'=>'Training Resources', 'url'=>array('/training/training/index'), 'itemOptions'=>array('class'=>'separator')),
					),
				),
				array(
					'label'=>'Evidence',
					'visible'=>!Yii::app()->user->isGuest && (Yii::app()->user->checkAccess('EvidenceView', Yii::app()->user->id)),
					'itemOptions'=>array('class'=>'menu-icon-evidence'),
					'items'=>array(
						array('label'=>'Search Case Files', 'url'=>array('/evidence/casesummary/admin'), 'visible'=>Yii::app()->user->checkAccess('EvidenceView', Yii::app()->user->id), 'itemOptions'=>array('class'=>'sub')),
						array('label'=>'Create Case File', 'url'=>array('/evidence/casesummary/create'),'visible'=>Yii::app()->user->checkAccess('EvidenceView', Yii::app()->user->id), 'itemOptions'=>array('class'=>'sub')),
						array('label'=>'Defendant Controls', 'url'=>array('/evidence/defendant/admin'), 'visible'=>Yii::app()->user->checkAccess('EvidenceView', Yii::app()->user->id), 'itemOptions'=>array('class'=>'separator')),
						array('label'=>'Evidence Controls', 'url'=>array('/evidence/evidence/admin'), 'visible'=>Yii::app()->user->checkAccess('EvidenceView', Yii::app()->user->id), 'itemOptions'=>array('class'=>'sub')),
						array('label'=>'Case Controls', 'url'=>array('/evidence/crtcase/admin'), 'visible'=>Yii::app()->user->checkAccess('EvidenceView', Yii::app()->user->id), 'itemOptions'=>array('class'=>'sub')),
						array('label'=>'Attorney Controls', 'url'=>array('/evidence/attorney/admin'), 'visible'=>Yii::app()->user->checkAccess('EvidenceView', Yii::app()->user->id), 'itemOptions'=>array('class'=>'sub')),
					),
				),
				array(
					'label'=>'Admin Tools',
					'visible'=>!Yii::app()->user->isGuest && (Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)
						|| Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
					'itemOptions'=>array('class'=>'menu-icon-admin'),
					'items'=>array(
						array('label'=>'News Controls', 'url'=>array('/news/news/index'), 'visible'=>Yii::app()->user->checkAccess('Admin', Yii::app()->user->id), 'itemOptions'=>array('class'=>'sub')),
						array('label'=>'CJIS Issue Tracker', 'url'=>array('/issuetracker/issuetracker/admin'), 'visible'=>Yii::app()->user->checkAccess('Admin', Yii::app()->user->id), 'itemOptions'=>array('class'=>'sub')),
					),
				),
				array(
					'label'=>'IT Tools',
					'visible'=>!Yii::app()->user->isGuest,
					'itemOptions'=>array('class'=>'menu-icon-it'),
					'items'=>array(
						array('label'=>'Manage Users', 'url'=>array('/security/userinfo/index'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id), 'itemOptions'=>array('class'=>'sub')),
						array('label'=>'Comment Controls', 'url'=>array('/tickets/comments/index'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id), 'itemOptions'=>array('class'=>'sub')),
						array('label'=>'Log Controls', 'url'=>array('/security/log/admin'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id), 'itemOptions'=>array('class'=>'sub')),
						array('label'=>'Modify User Privileges', 'url'=>array('/srbac'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id), 'itemOptions'=>array('class'=>'sub')),
						array('label'=>'Centriod', 'url'=>array('/centriod/centriod/examinefiles'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id), 'itemOptions'=>array('class'=>'sub')),
						array('label'=>'Upload Videos', 'url'=>array('/videos/videos/admin'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id), 'itemOptions'=>array('class'=>'sub')),
					),
				),
				array(
					'label'=>'Time Log',
					'visible'=>!Yii::app()->user->isGuest && (Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)
						|| Yii::app()->user->checkAccess('IT', Yii::app()->user->id)
						|| Yii::app()->user->checkAccess('ExternalGS', Yii::app()->user->id)),
					'itemOptions'=>array('class'=>'menu-icon-timelog'),
					'items'=>array(
						array('label'=>'Time Log', 'url'=>array('/timelog/timelog/admin'), 'visible'=>Yii::app()->user->checkAccess('Admin', Yii::app()->user->id), 'itemOptions'=>array('class'=>'sub')),
						array('label'=>'GS Time Log', 'url'=>array('/timelog/gstimelog/admin'), 'visible'=>(Yii::app()->user->checkAccess('IT', Yii::app()->user->id)
							|| Yii::app()->user->checkAccess('ExternalGS', Yii::app()->user->id)), 'itemOptions'=>array('class'=>'sub')),
					),
				),
				array(
					'label'=>'Evaluations',
					'visible'=>!Yii::app()->user->isGuest,
					'itemOptions'=>array('class'=>'menu-icon-evaluation'),
					'items'=>array(
						array('label'=>'Evaluations', 'url'=>array('/evaluations/evaluations/index'), 'visible'=>!Yii::app()->user->isGuest, 'itemOptions'=>array('class'=>'sub')),
						array('label'=>'Evaluation Questions', 'url'=>array('/evaluations/evaluationquestions/index'), 'visible'=>Yii::app()->user->checkAccess('Supervisor', Yii::app()->user->id), 'itemOptions'=>array('class'=>'sub')),
					),
				),
				array(
					'label'=>'Links',
					'visible'=>!Yii::app()->user->isGuest,
					'itemOptions'=>array('class'=>'menu-icon-link'),
					'items'=>array(
						array('label'=>'Printers & Copiers', 'url'=>array('/links/links/printersCopiers'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id), 'itemOptions'=>array('class'=>'sub')),
					),
				),
				array(
					'label'=>Yii::app()->user->name,
					'visible'=>!Yii::app()->user->isGuest,
					'itemOptions'=>array('class'=>'menu-icon-user'),
					'items'=>array(
						array('label'=>'Logout', 'url'=>array('/security/login/logout'), 'itemOptions'=>array('class'=>'sub')),
						array('label'=>'Change Password', 'url'=>array('/security/password/change'), 'itemOptions'=>array('class'=>'sub')),
					),
				),
			),
		)); ?> </div>
   </div>
<!--  <div class="col-1-4">
     <div class="module9">
     		<h3>1/8</h3>
                <p>10Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
     </div>
   </div>
  <div class="col-1-4">
     <div class="module10">
     		<h3>1/8</h3>
                <p>11Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
     </div>
   </div>-->
  <div class="col-1-3">
     <div class="module11">
     		<h3>1/8</h3>
                <p>12Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
     </div>
   </div>
</div>
<!--</div>-->

<!--<div class="grid grid-pad">
   <div class="col-1-4">
     <div class="module">
     		<h3>1/4</h3>
     </div>
   </div>
   <div class="col-1-4">
     <div class="module">
     		<h3>1/2</h3>
     </div>
   </div>
  <div class="col-1-4">
     <div class="module">
     		<h3>1/4</h3>
     </div>
   </div>
</div>
</div>-->


<?php $this->endContent(); ?>