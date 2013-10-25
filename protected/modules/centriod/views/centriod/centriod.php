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
			'Warrant'=>	array('content'=>$this->renderPartial('warrant', 
				array(
					'warrant' => $results['Warrant'],
				), $this),
				'id'=>'warrantTab'),
			// Render the demographic view in a tab.
			'Demographic'=>	array('content'=>$this->renderPartial('demographic', 
				array(
					'demographic' => $results['Demographic'],
				), $this),
				'id'=>'demographicTab'),
			// Render the alias view in a tab.
			'Alias'=> array('content'=>$this->renderPartial('alias', 
				array(
					'aliases' => $results['Alias'],
				), $this),
				'id'=>'aliasTab'),
		),
		// additional javascript options for the tabs plugin
		'options'=>array(
			'collapsible'=>false,
		),
	));
}
?>