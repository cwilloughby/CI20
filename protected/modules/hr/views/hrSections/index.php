<?php
/* @var $this HrSectionsController */
/* @var $dataProvider CActiveDataProvider */
?>
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>

<script>
$(function() {
	$("div.accordion").accordion({
		collapsible: true,
		heightStyle: "content",
		clearStyle: "true"
	});
});
</script>
<?php
$this->breadcrumbs=array(
	'Hr Sections',
);

$this->menu=array(
	array('label'=>'Create HrSections', 'url'=>array('create')),
	array('label'=>'Manage HrSections', 'url'=>array('admin')),
);
?>

<h1>Hr Sections</h1>

<div class="accordion">
	<?php
	foreach($panels as $key1 => $value1)
	{
		?>
		<h3><?php echo $key1; ?></h3>
		<div class="accordion">
			<?php
			foreach($value1 as $key2 => $value2)
			{
				?>
				<h3><?php echo $key2; ?></h3>
				<div><?php echo $value2; ?></div>
				<?php
			}
			?>
		</div>
		<?php
	}
	?>
</div>
