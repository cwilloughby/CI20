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
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>assets/images/favicon.ico" type="image/x-icon" />
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

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
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/security/login/login'), 'visible'=>Yii::app()->user->isGuest),
				array(
					'label'=>'Admin',
					'visible'=>!Yii::app()->user->isGuest && Yii::app()->user->checkAccess('IT', Yii::app()->user->id),
					'items'=>array(
						array('label'=>'User Controls', 'url'=>array('/security/userinfo/index')),
						array('label'=>'Comment Controls', 'url'=>array('/tickets/comments/index')),
					),
				),
				array('label'=>'Trouble', 'url'=>array('/tickets/troubletickets/index')),
				array('label'=>'HR', 'url'=>array('/hr/hrpolicy/index')),
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
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php 
	//print_r(Yii::app()->user->role);
	echo $content;
	?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
