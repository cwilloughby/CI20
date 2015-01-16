<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta charset="utf-8">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<?php
	$baseUrl = Yii::app()->theme->baseUrl; 
	$cs = Yii::app()->getClientScript();
	Yii::app()->clientScript->registerCoreScript('jquery');

	$cs->registerCssFile($baseUrl.'/css/spans.css');
	$cs->registerCssFile($baseUrl.'/css/responsive_widths.css');
	$cs->registerCssFile($baseUrl.'/css/abound.css');
	$cs->registerCssFile($baseUrl.'/css/templatemo_style.css');
	//$cs->registerCssFile($baseUrl.'/css/ddsmoothmenu.css');
	$cs->registerCssFile($baseUrl.'/css/bootstrap.min.css');
	$cs->registerCssFile($baseUrl.'/css/bootstrap-responsive.min.css');
	$cs->registerCssFile(Yii::app()->baseUrl . '/css/sprites.css');
	$cs->registerCssFile('/../vendors/flexSlider/flexslider.css');
	$cs->registerCssFile('/../vendors/bxslider/jquery.bxslider.css');
	?>
		
	<link rel="shortcut icon" href="<?php echo $baseUrl;?>/images/favicon.ico">
		
	<script language="javascript" type="text/javascript">
	function clearText(field)
	{
		if (field.defaultValue == field.value) field.value = '';
		else if (field.value == '') field.value = field.defaultValue;
	}
	</script>

	<?php
	//$cs->registerScriptFile('/../vendors/flexSlider/jquery.flexslider.js');
	$cs->registerScriptFile('/../vendors/bxslider/jquery.bxslider.min.js');
	$cs->registerScriptFile($baseUrl.'/js/bootstrap.min.js');
	$cs->registerScriptFile($baseUrl.'/js/ddsmoothmenu.js');
	?>

	<?php
	/*
	<script type="text/javascript">
		$(window).load(function() {
			$('.flexslider').flexslider({
				animation: "slide",
				animationLoop: true,
				slideshow: true,
				slideshowSpeed: 7000,
				animationSpeed: 600,
				directionNav: false, 
			});
		});
	</script>
	*/
	?>
</head>

<body>
	<section id="navigation-main">  
		<?php require_once('tpl_navigation.php')?>
	</section>
	
	<section class="main-body">
		<div class="container-fluid">
			<!-- Include content pages -->
			<?php echo $content; ?>
			<!-- Make sure the page footer will still be at the bottom of the page on smaller pages -->
			<div class="push"></div>
		</div>
	</section>

	<?php require_once('tpl_footer.php')?>
</body>

</html>
