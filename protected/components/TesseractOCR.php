<?php
/**
* A wrapper to work with TesseractOCR inside PHP
*
* PHP version 5
*
* @category OCR
* @package TesseractOCR
* @author Thiago Alessio Pereira <thiagoalessio@me.com>
* @license http://opensource.org/licenses/MIT MIT
* @link https://github.com/thiagoalessio/tesseract-ocr-for-php
*/
/**
* A wrapper to work with TesseractOCR inside PHP
*
* @category OCR
* @package TesseractOCR
* @author Thiago Alessio Pereira <thiagoalessio@me.com>
* @license http://opensource.org/licenses/MIT MIT
* @link https://github.com/thiagoalessio/tesseract-ocr-for-php
*/
class TesseractOCR
{
	private $jpgImagesArray;
	private $outputFilesArray;
	private $configFile;
	private $image;
	
	/**
	* Class constructor, loads the image to be recognized
	*
	* @param string $image Path to the image to be recognized
	*/
	public function __construct($image)
	{
		$this->image = $image;
	}
	
	public function convertToText()
	{
		$jpgImageBaseName = $this->convertImageToJpg($this->image);
		$this->putConvertedImagesInArray($jpgImageBaseName);
		$this->generateConfigFile(func_get_args());
		$recognizedText = $this->executeTesseract();
		$this->removeTempFiles();
		return $recognizedText;
	}
	
	/**
	 * This function takes a pdf and converts it into jpgs. Each page in the pdf 
	 * becomes its own jpg.
	 */
	private function convertImageToJpg($originalImage)
	{
		$jpgImageBaseName = 'C:/wamp/tmp/tesseract-ocr-jpg-' . rand();
		exec("convert -density 350 -define jpeg:size=1366x768 \"$originalImage\" -depth 8 -colorspace Gray \"$jpgImageBaseName.jpg\"");
		return $jpgImageBaseName;
	}
	
	private function putConvertedImagesInArray($jpgImageBaseName)
	{
		$this->jpgImagesArray = glob($jpgImageBaseName . '-*');

		if(empty($this->jpgImagesArray))
			$this->jpgImagesArray[0] = $jpgImageBaseName . '.jpg';
	}
	
	/**
	 * This function is for when the user specifies range criteria for the OCR process.
	 * It creates a temporary config file with that criteria stored in it.
	 * @param array $arguments
	 */
	private function generateConfigFile($arguments)
	{
		$this->configFile = 'C:/wamp/tmp/tesseract-ocr-config-'.rand().'.conf';
		$whitelist = $this->generateWhitelist($arguments);
		if(!empty($whitelist)) {
			$fp = fopen($this->configFile, 'w');
			fwrite($fp, "tessedit_char_whitelist $whitelist");
			fclose($fp);
		}
		else {
			$fp = fopen($this->configFile, 'w');
			fwrite($fp, "");
			fclose($fp);
		}
	}
	
	private function generateWhitelist($arguments)
	{
		array_shift($arguments); //first element is the image path
		$whitelist = '';
		foreach($arguments as $chars) $whitelist.= join('', (array)$chars);
		return $whitelist;
	}
	
	/**
	 * This is where tesseract is called to perform the OCR.
	 * @param string $configFile
	 * @return string
	 */
	private function executeTesseract()
	{
		$output = "";
		// Perform OCR on each jpg.
		foreach($this->jpgImagesArray as $key => $value)
		{
			$this->outputFilesArray[$key] = 'C:/wamp/tmp/tesseract-ocr-output-' . $key;
			$this->currentJpg = $this->jpgImagesArray[$key];
			$this->currentOut = $this->outputFilesArray[$key];
			exec("tesseract \"$this->currentJpg\" \"$this->currentOut\" nobatch \"$this->configFile\"");
			// tesseract appends txt extension to output file, so we need to call this afterwards.
			$this->outputFilesArray[$key] .= '.txt';
			$output .= $this->readOutputFile($this->outputFilesArray[$key]);
		}
		return $output;
	}
	
	/**
	 * This function takes a text file, reads the content, and returns it in a string.
	 * @param string $file
	 * @return string
	 */
	private function readOutputFile($file)
	{
		return trim(file_get_contents($file));
	}
	
	/**
	* Clean up the temporary files created during the process of recognition
	*
	* @return void
	*/
	protected function removeTempFiles()
	{
		unlink($this->configFile);
		foreach($this->jpgImagesArray as $file)
		{
			unlink($file);
		}
		foreach($this->outputFilesArray as $file)
		{
			unlink($file);
		}
	}
}
