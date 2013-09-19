<?php
/**
 * This class is for the weather porlet. 
 * This allows the login form to be displayed on the home page.
 */
class WeatherReport extends CPortlet
{
	public $pageTitle='Weather';
	public $viewPath = '/views';
	
	/**
	 * This function renders the login form.
	 */
	protected function renderContent()
	{
		try
		{
			$model = new Weather;

			$weather = $model->getWeather();

			// Display the weather.
			$this->render('weather',array('weather'=>$weather));
		}
		catch(Exception $ex)
		{
			echo "The weather report is currently unavailable. Please try again later.";
		}
	}
}
