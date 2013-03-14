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
			'activeCssClass'=>'active',
			'activateParents'=>true,
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'Human Resources', 'url'=>array('/hr/hrpolicy/index')),
				array(
					'label'=>'Helpdesk',
					'visible'=>!Yii::app()->user->isGuest,
					'url'=>array('/tickets/troubletickets/create'),
					'items'=>array(
						array('label'=>'Create Ticket', 'url'=>array('/tickets/troubletickets/create')),
						array('label'=>'View Open Tickets', 'url'=>array('/tickets/troubletickets/index')),
						array('label'=>'View Closed Tickets', 'url'=>array('/tickets/troubletickets/closedindex')),
					),
				),
				array(
					'label'=>'Evidence',
					'visible'=>!Yii::app()->user->isGuest && Yii::app()->user->checkAccess('Admin', Yii::app()->user->id),
					'items'=>array(
						array('label'=>'Case Controls', 'url'=>array('/evidence/casesummary/index'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
						array('label'=>'Evidence Controls', 'url'=>array('/evidence/evidence/index'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
						array('label'=>'Defendant Controls', 'url'=>array('/evidence/defendant/index'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
						array('label'=>'Attorney Controls', 'url'=>array('/evidence/attorney/index'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
						array('label'=>'Lone Case Controls', 'url'=>array('/evidence/crtcase/index'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
					),
				),
				array(
					'label'=>'Admin',
					'visible'=>!Yii::app()->user->isGuest && Yii::app()->user->checkAccess('Admin', Yii::app()->user->id),
					'items'=>array(
						array('label'=>'User Controls', 'url'=>array('/security/userinfo/index'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
						array('label'=>'Comment Controls', 'url'=>array('/tickets/comments/index'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
						array('label'=>'Log Controls', 'url'=>array('/security/log/admin'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
						array('label'=>'News Controls', 'url'=>array('/news/news/index')),
						array('label'=>'Modify User Privileges', 'url'=>array('/srbac'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
					),
				),
				array('label'=>'Emergency Response Plan', 'url'=>Yii::app()->baseUrl . '/assets/files/cep.pdf'),
				array(
					'label'=>Yii::app()->user->name,
					'visible'=>!Yii::app()->user->isGuest,
					'items'=>array(
						array('label'=>'Logout', 'url'=>array('/security/login/logout')),
						array('label'=>'Change Password', 'url'=>array('/security/password/change')),
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
