<?php

class WeatherController extends Controller
{
	public $layout='//layouts/column2home';

	/**
	 * Displays the weather report page
	 */
	public function actionReport()
	{
		$model = new Weather;
		$weather = $model->getWeather();
		
		// Display the weather.
		$this->render('weather',array('weather'=>$weather));
	}
}
