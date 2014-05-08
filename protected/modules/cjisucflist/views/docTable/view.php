<?php
/* @var $this DocTableController */
/* @var $model DocTable */

$this->pageTitle = Yii::app()->name . ' - View CJIS File';

$this->breadcrumbs=array(
	'Search CJIS Files'=>array('searchableFileTable'),
	$model->name,
);

$this->menu2=array(
	array('label'=>'Search Documents', 'url'=>array('searchableFileTable')),
	array('label'=>'Create Document', 'url'=>array('createFileRecord'), 'visible'=>Yii::app()->user->checkAccess("IT")),
	array('label'=>'Update Document', 'url'=>array('updateFileRecord', 'id'=>$model->id), 'visible'=>Yii::app()->user->checkAccess("IT")),
	array('label'=>'Delete Document', 'url'=>'#', 'linkOptions'=>array('submit'=>array('deleteFileRecord','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'), 'visible'=>Yii::app()->user->checkAccess("IT")),
);
?>

<h1>View Document</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'label'=>'Name',
			'type'=>'raw',
            'value'=>CHtml::link(CHtml::encode($model->name),
				Yii::app()->createUrl("cjisucflist/doctable/displayonline", array("path"=>"$model->path", "name"=>"$model->name")))
		),
		'type',
		array(
			'name' => 'upload_date',
			'value' => CHtml::encode(date("m/d/Y", strtotime($model->upload_date))),
		),
		'uploader',
		array(
			'name' => 'release_num',
			'value' => (isset($model->release_num))
				?CHtml::encode($model->release_num):"N/A",
		),
		array(
			'name' => 'release_date',
			'value' => (isset($model->release_date) && ((int)$model->release_date))
				?CHtml::encode(date("m/d/Y", strtotime($model->release_date))):"N/A",
		),
		array(
			'name' => 'agency',
			'value' => (isset($model->agency))
				?CHtml::encode($model->agency):"N/A",
		),
		array(
			'name' => 'cda_num',
			'value' => (isset($model->cda_num))
				?CHtml::encode($model->cda_num):"N/A",
		),
		array(
			'name' => 'problem',
			'value' => (isset($model->problem))
				?CHtml::encode($model->problem):"N/A",
		),
		array(
			'name' => 'description',
			'value' => (isset($model->description))
				?CHtml::encode($model->description):"N/A",
		),
		array(
			'name' => 'coding_start_date',
			'value' => (isset($model->coding_start_date) && ((int)$model->coding_start_date))
				?CHtml::encode(date("m/d/Y", strtotime($model->coding_start_date))):"N/A",
		),
		array(
			'name' => 'test_start_date',
			'value' => (isset($model->test_start_date) && ((int)$model->test_start_date))
				?CHtml::encode(date("m/d/Y", strtotime($model->test_start_date))):"N/A",
		),
		array(
			'name' => 'production_date',
			'value' => (isset($model->production_date) && ((int)$model->production_date))
				?CHtml::encode(date("m/d/Y", strtotime($model->production_date))):"N/A",
		),
		array(
			'name' => 'documentation_subject',
			'value' => (isset($model->documentation_subject))
				?CHtml::encode($model->documentation_subject):"N/A",
		),
		array(
			'name' => 'instruction_feature',
			'value' => (isset($model->instruction_feature))
				?CHtml::encode($model->instruction_feature):"N/A",
		),
	),
)); 

// If the document has a release number, release date, and the user has IT access, 
// then the "Create CJIS News Post" button is visible.
if(isset($model->release_num) && isset($model->release_date) && Yii::app()->user->checkAccess("IT"))
{
	echo "<br/>" . CHtml::beginForm(Yii::app()->createUrl('cjisucflist/doctable/createCjisNews'), 'post');
	
	echo CHtml::activeHiddenField($model, 'path');
	echo CHtml::activeHiddenField($model, 'name');
	echo CHtml::activeHiddenField($model, 'release_num');
	echo CHtml::activeHiddenField($model, 'release_date');
	echo CHtml::hiddenField('firstView', 1);
	?>

	<div class="row buttons">
        <?php echo CHtml::submitButton('Post CJIS News'); ?>
    </div>

	<?php
	echo CHtml::endForm();
}
?>
