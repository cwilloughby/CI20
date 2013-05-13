<?php
/* @var $this HrSectionsController */
/* @var $section HrSection */
/* @var $policy HrPolicy */
?>

<script>
$(function() {
	$("div.accordion").accordion({
		collapsible: true,
		heightStyle: "content",
		clearStyle: "true",
		icons: false
	});
});
</script>

<?php
$this->pageTitle = Yii::app()->name . ' - HR Policy';

$this->breadcrumbs=array(
	'HR Policy',
);

$this->menu2=array(
	array('label'=>'Create HR Policy', 'url'=>array('createpolicy')),
	array('label'=>'Manage HR Policies', 'url'=>array('admin')),
);
?>

<h1>HR Policies</h1>

<div class="accordion">
	<?php
	foreach($panels as $key1 => $value1)
	{
		?>
		<h3><?php echo $key1; ?></h3>
		<div class="accordion">
			<?php
			if(is_array($value1))
			{
				foreach($value1 as $key2 => $value2)
				{
					?>
					<h3><?php echo $key2; ?></h3>
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
				<h3><?php echo "Create New Section"; ?></h3>
				<div>
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
		<h3><?php echo "Create New Policy"; ?></h3>
		<div>
			<?php echo $this->renderPartial('_form', array('model'=>$policy)); ?>
		</div>
		<?php
	}
	?>
</div>
