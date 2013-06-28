
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta charset="utf-8">
	<title>CI2.0</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Free yii themes, free web application theme">
	<meta name="author" content="Webapplicationthemes.com">

	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<?php
	$baseUrl = Yii::app()->theme->baseUrl; 
	$cs = Yii::app()->getClientScript();
	Yii::app()->clientScript->registerCoreScript('jquery');
	?>
	<!-- Fav and Touch and touch icons -->
	<link rel="shortcut icon" href="<?php echo $baseUrl;?>/img/icons/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $baseUrl;?>/img/icons/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $baseUrl;?>/img/icons/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="<?php echo $baseUrl;?>/img/icons/apple-touch-icon-57-precomposed.png">
	<?php  
	$cs->registerCssFile($baseUrl.'/css/bootstrap.min.css');
	$cs->registerCssFile($baseUrl.'/css/bootstrap-responsive.min.css');
	$cs->registerCssFile($baseUrl.'/css/abound.css');
	//$cs->registerCssFile($baseUrl.'/css/style-blue.css');
	?>
	<!-- styles for style switcher -->
	<?php  
	// Checks for, and assigns cookie to local variable:  
	if(!empty($_COOKIE['style'])) 
		$style = $_COOKIE['style'];
	// If no cookie is present, then set the style to the default of blue.
	else 
		$style = '/css/style-blue.css';
	?>  
	
	<link rel="stylesheet" type="text/css" id = "mystyle" href="<?php echo $baseUrl . $style;?>" />

	<?php
	$cs->registerScriptFile($baseUrl.'/js/bootstrap.min.js');
	$cs->registerScriptFile($baseUrl.'/js/plugins/jquery.sparkline.js');
	$cs->registerScriptFile($baseUrl.'/js/plugins/jquery.flot.min.js');
	$cs->registerScriptFile($baseUrl.'/js/plugins/jquery.flot.pie.min.js');
	$cs->registerScriptFile($baseUrl.'/js/charts.js');
	$cs->registerScriptFile($baseUrl.'/js/plugins/jquery.knob.js');
	$cs->registerScriptFile($baseUrl.'/js/plugins/jquery.masonry.min.js');
	?>
</head>

<body>

<section id="navigation-main">   
<!-- Require the navigation -->
<?php require_once('tpl_navigation.php')?>
</section><!-- /#navigation-main -->
    
<section class="main-body">
    <div class="container-fluid">
            <!-- Include content pages -->
            <?php echo $content; ?>
    </div>
</section>

<!-- Require the footer -->
<?php require_once('tpl_footer.php')?>

  </body>
</html>