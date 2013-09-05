<?php
class TesseractOCR
{
	private $jpgImagesArray;
	private $outputFilesArray;
	
	public function recognize($originalImage)
	{
		$jpgImageBaseName = $this->convertImageToJpg($originalImage);
		$this->putConvertedImagesInArray($jpgImageBaseName);
		$configFile = $this->generateConfigFile(func_get_args());
		$recognizedText = $this->executeTesseract($configFile);
		$this->removeTempFiles($configFile);
		return $recognizedText;
	}

	/**
	  * This function takes a pdf and converts it into jpgs. Each page in the pdf 
	  * becomes its own jpg.
	  */
	private function convertImageToJpg($originalImage)
	{
		$jpgImageBaseName = 'C:/wamp/tmp/tesseract-ocr-jpg-' . rand();
		exec("convert -density 400 \"$originalImage\" -depth 8 \"$jpgImageBaseName.jpg\"");
		return $jpgImageBaseName;
	}

	private function putConvertedImagesInArray($jpgImageBaseName)
	{
		$this->jpgImagesArray = glob($jpgImageBaseName . '-*');

		if(empty($this->jpgImagesArray))
			$this->jpgImagesArray[0] = $jpgImageBaseName . '.jpg';
	}
	
	private function generateConfigFile($arguments)
	{
		$configFile = 'C:/wamp/tmp/tesseract-ocr-config-'.rand().'.conf';
		$whitelist = $this->generateWhitelist($arguments);
		if(!empty($whitelist)) {
			$fp = fopen($configFile, 'w');
			fwrite($fp, "tessedit_char_whitelist $whitelist");
			fclose($fp);
		}
		else {
			$fp = fopen($configFile, 'w');
			fwrite($fp, "");
			fclose($fp);
		}
		return $configFile;
	}

	private function generateWhitelist($arguments)
	{
		array_shift($arguments); //first element is the image path
		$whitelist = '';
		foreach($arguments as $chars) $whitelist.= join('', (array)$chars);
		return $whitelist;
	}

	private function executeTesseract($configFile)
	{
		$output = "";
		// Perform OCR on each jpg.
		foreach($this->jpgImagesArray as $key => $value)
		{
			$this->outputFilesArray[$key] = 'C:/wamp/tmp/tesseract-ocr-output-' . $key;
			$this->currentJpg = $this->jpgImagesArray[$key];
			$this->currentOut = $this->outputFilesArray[$key];
			exec("tesseract \"$this->currentJpg\" \"$this->currentOut\" nobatch \"$configFile\"");
			// tesseract appends txt extension to output file, so we need to call this afterwards.
			$this->outputFilesArray[$key] .= '.txt';
			$output .= $this->readOutputFile($this->outputFilesArray[$key]);
		}
		return $output;
	}

	private function readOutputFile($file)
	{
		return trim(file_get_contents($file));
	}

	private function removeTempFiles($configFile)
	{
		unlink($configFile);
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
