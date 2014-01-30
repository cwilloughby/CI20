<?php
/* @var $this CjisDispositionsController */
/* @var $data CjisDispositions */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('court')); ?>:</b>
	<?php echo CHtml::encode($data->court); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('caseno')); ?>:</b>
	<?php echo CHtml::encode($data->caseno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastname')); ?>:</b>
	<?php echo CHtml::encode($data->lastname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('firstname')); ?>:</b>
	<?php echo CHtml::encode($data->firstname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateofbirth')); ?>:</b>
	<?php echo CHtml::encode($data->dateofbirth); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gender')); ?>:</b>
	<?php echo CHtml::encode($data->gender); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('race')); ?>:</b>
	<?php echo CHtml::encode($data->race); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('count')); ?>:</b>
	<?php echo CHtml::encode($data->count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('offensedescription')); ?>:</b>
	<?php echo CHtml::encode($data->offensedescription); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('offensetype')); ?>:</b>
	<?php echo CHtml::encode($data->offensetype); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('disposition')); ?>:</b>
	<?php echo CHtml::encode($data->disposition); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateconcluded')); ?>:</b>
	<?php echo CHtml::encode($data->dateconcluded); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('location')); ?>:</b>
	<?php echo CHtml::encode($data->location); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('incarcerationyears')); ?>:</b>
	<?php echo CHtml::encode($data->incarcerationyears); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('incarcerationmonths')); ?>:</b>
	<?php echo CHtml::encode($data->incarcerationmonths); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('incarcerationdays')); ?>:</b>
	<?php echo CHtml::encode($data->incarcerationdays); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('incarcerationhours')); ?>:</b>
	<?php echo CHtml::encode($data->incarcerationhours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('percentage')); ?>:</b>
	<?php echo CHtml::encode($data->percentage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('suspendallbut')); ?>:</b>
	<?php echo CHtml::encode($data->suspendallbut); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('suspendpercentage')); ?>:</b>
	<?php echo CHtml::encode($data->suspendpercentage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dayfordayflag')); ?>:</b>
	<?php echo CHtml::encode($data->dayfordayflag); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hourforhourflag')); ?>:</b>
	<?php echo CHtml::encode($data->hourforhourflag); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('suspendedflag')); ?>:</b>
	<?php echo CHtml::encode($data->suspendedflag); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('noworkdetailflag')); ?>:</b>
	<?php echo CHtml::encode($data->noworkdetailflag); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('workreleaseflag')); ?>:</b>
	<?php echo CHtml::encode($data->workreleaseflag); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('workreleasepercentage')); ?>:</b>
	<?php echo CHtml::encode($data->workreleasepercentage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('earlyreleaseflag')); ?>:</b>
	<?php echo CHtml::encode($data->earlyreleaseflag); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('timeservedcredit')); ?>:</b>
	<?php echo CHtml::encode($data->timeservedcredit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('specifiedjailcreditmonths')); ?>:</b>
	<?php echo CHtml::encode($data->specifiedjailcreditmonths); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('specifiedjailcreditdays')); ?>:</b>
	<?php echo CHtml::encode($data->specifiedjailcreditdays); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('specifiedjailcredithours')); ?>:</b>
	<?php echo CHtml::encode($data->specifiedjailcredithours); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('incarcerationspecialconditions')); ?>:</b>
	<?php echo CHtml::encode($data->incarcerationspecialconditions); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('probationtype')); ?>:</b>
	<?php echo CHtml::encode($data->probationtype); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('probationyears')); ?>:</b>
	<?php echo CHtml::encode($data->probationyears); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('probationmonths')); ?>:</b>
	<?php echo CHtml::encode($data->probationmonths); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('probationdays')); ?>:</b>
	<?php echo CHtml::encode($data->probationdays); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('probationspecialconditions')); ?>:</b>
	<?php echo CHtml::encode($data->probationspecialconditions); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('restitutionamount')); ?>:</b>
	<?php echo CHtml::encode($data->restitutionamount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('courtfines')); ?>:</b>
	<?php echo CHtml::encode($data->courtfines); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('finesspecialcondition')); ?>:</b>
	<?php echo CHtml::encode($data->finesspecialcondition); ?>
	<br />

	*/ ?>

</div>