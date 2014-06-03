<?php
/**
 * This class is for the weather porlet. 
 */
class WeatherReport extends CPortlet
{
	public $pageTitle='Weather';
	public $viewPath = '/views';
	
	/**
	 * This function obtains and displays the weather.
	 */
	protected function renderContent()
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
