<?php
/* @var $this HearingRequestController */
/* @var $model HearingRequest */

$this->pageTitle = Yii::app()->name . ' - Submit Hearing Request';

$this->breadcrumbs=array(
	'PD Hearing Request',
);
?>

<h1>Submit A Preliminary Hearing Request</h1>

<p>
	To receive a digital copy of a Preliminary Hearing, please complete the form below. You will receive an email confirmation when your request is processed. You may retrieve your file on your <b>"G:\GS Preliminary Hearing Requests"</b> directory.

	Please contact Sonny Dothard at 615-862-5612 for technical assistance. 
</p>

<?php echo $this->renderPartial('../pdRequest/_form', array('model'=>$model)); ?>