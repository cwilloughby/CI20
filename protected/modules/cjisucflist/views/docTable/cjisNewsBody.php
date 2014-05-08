<?php
/* @var $this EmailController */
?>
Build #: <?php echo $model->release_num;?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo CHtml::link('View Doc',Yii::app()->createUrl("cjisucflist/doctable/displayonline", array("path"=>"$model->path", "name"=>"$model->name")));?>
<br/>Release Date: <?php echo $model->release_date;?>
<br/><br/>Features: <?php echo $model->features;?>		
