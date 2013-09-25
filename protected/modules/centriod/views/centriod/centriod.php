<?php
/* @var $this CentriodController */
/* @var $centriod Centriod */
/* @var $results Array */

$this->pageTitle = Yii::app()->name . ' - Centriod';

$this->breadcrumbs=array(
	'Centriod',
);
?>

<h1>Centriod</h1>

<?php echo $this->renderPartial('_form', array('centriod'=>$centriod)); ?>

<?php
if($results)
{
	$this->widget('zii.widgets.jui.CJuiTabs',array(
		'tabs'=>array(
			// Render the warrant view in a tab.
			'Warrant'=>	$this->renderPartial('warrant', 
				array(
					'warrant' => $results['Warrant'],
				), $this),
			// Render the demographic view in a tab.
			'Demographic'=>	$this->renderPartial('demographic', 
				array(
					'demographic' => $results['Demographic'],
				), $this),
			// Render the alias view in a tab.
			'Alias'=>	$this->renderPartial('alias', 
				array(
					'aliases' => $results['Alias'],
				), $this),
		),
		// additional javascript options for the tabs plugin
		'options'=>array(
			'collapsible'=>false,
		),
	));
}
?>