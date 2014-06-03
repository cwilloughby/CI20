<?php
/**
 * This class is for the rss feed portlet. We have to use the SpecialPortlet component to fix a css issue.
 */
class RSSWidget extends SpecialPortlet
{
	public $pageTitle='RSS';
	public $viewPath = '/views';
	public $numPosts = 10;
	// This is the url that is used to obtain the rss feed.
	public $RSSurl = 'http://www.nashville.gov/Feeds/NewsEventFeed.aspx?type=ALL&colid=82d52d7f-f46f-4e08-9db1-04582b88e229';
	
	/**
	 * This function obtains and displays the rss feed.
	 */
	protected function renderContent()
	{
		try
		{
			// We have to change this class to prevent a css glitch caused by using the flex slider in a widget.
			$this->htmlOptions=array('class'=>'special-portlet');
			
			// Obtain the feed.
			$rss = $this->getRSS();

			// Display the feed.
			$this->render('rss',array('rss'=>$rss));
		}
		catch(Exception $ex)
		{
			echo "The rss feed is currently unavailable. Please try again later.";
		}
	}
	
	/**
	 * Get the rss feed. Stores the results in the cache for 30 minutes to limit the number of requests.
	 * @return array
	 */
	private function getRSS()
	{
		$value = Yii::app()->cache->get('rss');
		if($value === false)
		{
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $this->RSSurl);
			curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0)');
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HEADER, false);
			$value = curl_exec($curl);
			curl_close($curl);
		
			Yii::app()->cache->set('rss', $value, 1600);
		}
		return $this->convertRSS($value);
	}
	
	/**
	 * This function is used to obtain the mininum tempurature, maximum temperature, rain chance, and weathersummary
	 * from the xml and return them in an array. 
	 * @param string $xml the xml sent from the rss
	 * @return array contains the title and post date for the desired number of posts
	 */
	private function convertRSS($data)
	{
		// Convert the data from rss format to xml format.
		$xml = new SimpleXmlElement($data, LIBXML_NOCDATA);
		// Get the total number of posts.
		$cnt = count($xml->channel->item);
		// If the total number of posts exceeds the number of desired posts, shrink the total.
		if($cnt > $this->numPosts)
			$cnt = $this->numPosts;
		// Sort them into the most recent posts.
		$items = array_reverse($xml->xpath('channel/item'));

		for($i=0; $i < $cnt; $i++)
		{
			$var[$i]['title'] = (string)$items[$i]->title;
			$var[$i]['date'] = date('m/d/Y', strtotime((string)$items[$i]->pubDate));
		}

		return $var;
	}
}