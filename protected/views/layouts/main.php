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
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/images/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
	
<?php flush(); ?>
	
<body>
<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="menu-top">
		<?php $this->widget('zii.widgets.CMenu',array(
			'activateParents'=>true,
			'lastItemCssClass'=>'last',
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index'), 'linkOptions'=>array('class'=>'toplink')),
				array(
					'label'=>'Helpdesk',
					'visible'=>!Yii::app()->user->isGuest,
					'itemOptions'=>array('class'=>'dropdown'),
					'items'=>array(
						array('label'=>'Create Ticket', 'url'=>array('/tickets/troubletickets/create'), 'itemOptions'=>array('class'=>'sub')),
						array('label'=>'View Open Tickets', 'url'=>array('/tickets/troubletickets/index'), 'itemOptions'=>array('class'=>'sub')),
						array('label'=>'View Closed Tickets', 'url'=>array('/tickets/troubletickets/closedindex'), 'itemOptions'=>array('class'=>'sub')),
					),
				),
				array(
					'label'=>'Evidence',
					'visible'=>!Yii::app()->user->isGuest && Yii::app()->user->checkAccess('Admin', Yii::app()->user->id),
					'itemOptions'=>array('class'=>'dropdown'),
					'items'=>array(
						array('label'=>'Case File Controls', 'url'=>array('/evidence/casesummary/index'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id), 'itemOptions'=>array('class'=>'sub')),
						array('label'=>'Defendant Controls', 'url'=>array('/evidence/defendant/index'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id), 'itemOptions'=>array('class'=>'sub')),
						array('label'=>'Evidence Controls', 'url'=>array('/evidence/evidence/index'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id), 'itemOptions'=>array('class'=>'sub')),
						array('label'=>'Case Controls', 'url'=>array('/evidence/crtcase/index'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id), 'itemOptions'=>array('class'=>'sub')),
						array('label'=>'Attorney Controls', 'url'=>array('/evidence/attorney/index'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id), 'itemOptions'=>array('class'=>'sub')),
					),
				),
				array(
					'label'=>'Admin',
					'visible'=>!Yii::app()->user->isGuest && (Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)
						|| Yii::app()->user->checkAccess('IT', Yii::app()->user->id)
						|| Yii::app()->user->checkAccess('ExternalGS', Yii::app()->user->id)),
					'itemOptions'=>array('class'=>'dropdown'),
					'items'=>array(
						array('label'=>'User Controls', 'url'=>array('/security/userinfo/index'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id), 'itemOptions'=>array('class'=>'sub')),
						array('label'=>'Comment Controls', 'url'=>array('/tickets/comments/index'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id), 'itemOptions'=>array('class'=>'sub')),
						array('label'=>'Log Controls', 'url'=>array('/security/log/admin'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id), 'itemOptions'=>array('class'=>'sub')),
						array('label'=>'News Controls', 'url'=>array('/news/news/index'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id), 'itemOptions'=>array('class'=>'sub')),
						array('label'=>'Time Log', 'url'=>array('/timelog/timelog/index'), 'visible'=>Yii::app()->user->checkAccess('Admin', Yii::app()->user->id), 'itemOptions'=>array('class'=>'sub')),
						array('label'=>'GS Time Log', 'url'=>array('/timelog/gstimelog/index'), 'visible'=>(Yii::app()->user->checkAccess('IT', Yii::app()->user->id)
							|| Yii::app()->user->checkAccess('ExternalGS', Yii::app()->user->id)), 'itemOptions'=>array('class'=>'sub')),
						array('label'=>'Modify User Privileges', 'url'=>array('/srbac'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id), 'itemOptions'=>array('class'=>'sub')),
					),
				),
				array(
					'label'=>Yii::app()->user->name,
					'visible'=>!Yii::app()->user->isGuest,
					'itemOptions'=>array('class'=>'dropdown'),
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
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		Powered by the Yii Framework
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
