<?php
/* @var $this DocTableController */
/* @var $model DocTable */
?>
<?php echo $model->features;?>
<br/>
<?php echo CHtml::link('View Doc',Yii::app()->createUrl("cjisucflist/doctable/displayonline", array("path"=>"$model->path", "name"=>"$model->name")));?>