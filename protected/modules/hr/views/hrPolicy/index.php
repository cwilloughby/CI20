<?php
/* @var $this HrSectionsController */
/* @var $section HrSection */
/* @var $policy HrPolicy */
?>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/jquery/jquery.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/assets/jquery/jqueryui.js"></script>

<?php
$this->pageTitle = Yii::app()->name . ' - HR Policy';

$this->breadcrumbs=array(
	'HR Policy',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search HR Policies', 'url'=>array('admin'), 'visible' => Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-file"></i> Create HR Policy', 'url'=>array('createpolicy'), 'visible' => Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-list-alt"></i> List HR Policies', 'url'=>array('index')),
);
?>

<h1>HR Policies</h1>

<div class="accordion">
	<?php
	foreach($panels as $key1 => $value1)
	{		
		?>
		<h3 class="portlet-decoration" id="hrmain"><span class="icon-hand-up"></span> <?php echo $key1; ?></h3>
		<div class="accordion portlet-content portlet_border">
			<?php
			if(is_array($value1))
			{
				foreach($value1 as $key2 => $value2)
				{
					?>
					<h4 id="hrsub" class="portlet-decoration"><span class="icon-hand-up"></span> <?php echo $key2; ?></h4>
					<div><?php 
					if($key2 != 'Create New Section')
						echo nl2br($value2);
					else {
						echo $value2;
					}
					?>
					</div>
					<?php
				}
			}
			else
			{
				?>
				<h4 id="hrsub"><span class="icon-hand-up"></span> <?php echo "Create New Section"; ?></h4>
				<div class="portlet-content portlet_border">
					<?php echo $this->renderPartial('_formSection', array('model'=>$section, 'id'=>$value1)); ?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	}
	if(Yii::app()->user->checkAccess('hr@HrEdit', Yii::app()->user->id))
	{
		?>
		<h3 class="portlet-decoration" id="hrmain"><span class="icon-hand-up"></span> <?php echo "Create New Policy"; ?></h3>
		<div class="portlet-content portlet_border">
			<?php echo $this->renderPartial('_form', array('model'=>$policy)); ?>
		</div>
		<?php
	}
	?>
</div>

<?php
Yii::app()->clientScript->registerScript('accordionscript',
	'jQuery.noConflict();
	jQuery(function() {
		jQuery("div.accordion").accordion({
			collapsible: true,
			heightStyle: "content",
			clearStyle: "true",
			icons: true
		});
	});',
CClientScript::POS_READY);
?>