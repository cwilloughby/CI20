<?php

class HearingRequestController extends Controller
{
	public $layout='//layouts/column1';
	
	public function actionDARequest()
	{
		$model=new HearingRequest;
		
		// If the request form was posted.
		if(isset($_POST['HearingRequest']))
		{
			// Read in the values from the form.
			$model->attributes=$_POST['HearingRequest'];
			
			if($model->validate())
			{
				// Remove the flash message so the email will work again.
				Yii::app()->user->getFlash('success');
				
				// Redirect to the email controller's register email action in the email module.
				$this->redirect(array('/email/email/hearingrequestemail',
							'sendTo'=> HearingRequest::TAPEEMAIL,
							'defName'=> $model->defName,
							'caseNumber'=> $model->caseNumber,
							'yourName'=> $model->yourName,
							'yourEmail'=> $model->yourEmail,
							'yourNumber'=> $model->yourNumber,
							'yourExtension'=> $model->yourExtension,
							'requestType'=> "District Attorney"));
			}
		}
		
		$this->render('../daRequest/DARequest',array(
			'model'=>$model,
		));
	}

	public function actionPDRequest()
	{
		$model=new HearingRequest;
		
		// If the request form was posted.
		if(isset($_POST['HearingRequest']))
		{
			// Read in the values from the form.
			$model->attributes=$_POST['HearingRequest'];
			
			if($model->validate())
			{
				// Remove the flash message so the email will work again.
				Yii::app()->user->getFlash('success');
				
				// Redirect to the email controller's register email action in the email module.
				$this->redirect(array('/email/email/hearingrequestemail',
							'sendTo'=> HearingRequest::TAPEEMAIL,
							'defName'=> $model->defName,
							'caseNumber'=> $model->caseNumber,
							'yourName'=> $model->yourName,
							'yourEmail'=> $model->yourEmail,
							'yourNumber'=> $model->yourNumber,
							'yourExtension'=> $model->yourExtension,
							'requestType'=> "Public Defender"));
			}
		}
		
		$this->render('../pdRequest/PDRequest',array(
			'model'=>$model,
		));
	}
}
