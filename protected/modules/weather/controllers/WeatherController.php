<?php

class WeatherController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2home';

	/**
	 * Displays the weather report page
	 */
	public function actionReport()
	{
		try
		{
			// Obtain the weather.
			$weather = Weather::getWeather();

			// Display the weather.
			$this->render('weather',array('weather'=>$weather));
		}
		catch(Exception $ex)
		{
			echo "The weather report is currently unavailable. Please try again later.";
		}
	}
}
