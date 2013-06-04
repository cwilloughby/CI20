<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
	
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ciMainMenu.css" />
	<!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/maincustom.css" />-->
      
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/images/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui.css" />
	
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
	<script>
	if (!window.jQuery) {
		document.write('<script src="/../../../../../assets/jquery/jquery.js"><\/script>');
		document.write('<script src="/../../../../../assets/jquery/jqueryui.js"><\/script>');
	}
	</script>
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
	
<?php flush(); ?>
	
<body>
<div class="container" id="page">

	<div id="header">
		<div id="logo"><a id ="logo1" href="/site/index"><?php echo CHtml::encode(Yii::app()->name); ?></a></div>
	</div><!-- header -->

	<div class="menu-horizontal">
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
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array('links'=>$this->breadcrumbs,)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php 
	echo $content;
	?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by Office of the Criminal Court Clerk of Davidson County.<br/>
		All Rights Reserved.<br/>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
