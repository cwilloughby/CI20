<?php
/**
 * This class is for the weather porlet. 
 * This allows the login form to be displayed on the home page.
 */
class WeatherReport extends CPortlet
{
	public $pageTitle='Weather';
	
	/**
	 * This function renders the login form.
	 */
	protected function renderContent()
	{
		$model = new Weather;

		$weather = $model->getWeather();
		
		// Display the weather.
		$this->render('weather',array('weather'=>$weather));
	}
}
