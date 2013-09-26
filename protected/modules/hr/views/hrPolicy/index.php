<?php
/* @var $this HrSectionsController */
/* @var $panels Array */
/* @var $section HrSection */
/* @var $policy HrPolicy */
?>

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

<?php if(Yii::app()->user->hasFlash('deleted')):?>
    <div class="info">
        <?php echo Yii::app()->user->getFlash('deleted'); ?>
    </div>
<?php endif; ?>

<div class="accordion">
	<?php
	foreach($panels as $policyKey => $policyValue)
	{		
		?>
		<h3 class="portlet-decoration" id="hrmain"><span class="icon-hand-up"></span> <?php echo $policyKey; ?></h3>
		<div class="accordion portlet-content portlet_border">
			<?php
			if(is_array($policyValue))
			{
				foreach($policyValue as $sectionKey => $sectionValue)
				{
					?>
					<h4 id="hrsub" class="portlet-decoration"><span class="icon-hand-up"></span> <?php echo $sectionKey; ?></h4>
					<div><?php 
					if($sectionKey != 'Create New Section')
						echo nl2br($sectionValue);
					else {
						echo $sectionValue;
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
					<?php echo $this->renderPartial('_formSection', array('model'=>$section, 'id'=>$policyValue)); ?>
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
Yii::app()->clientScript->registerCoreScript('jquery', CClientScript::POS_END);
Yii::app()->clientScript->registerCoreScript('jquery.ui', CClientScript::POS_END);

Yii::app()->clientScript->registerScript('accordionscript',
	'$(function() {
		$("div.accordion").accordion({
			collapsible: true,
			heightStyle: "content",
			clearStyle: "true",
			icons: true
		});
	});',
CClientScript::POS_READY);

Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$(".info").animate({opacity: 1.0}, 3000).fadeOut("slow");',
   CClientScript::POS_READY
);
?>