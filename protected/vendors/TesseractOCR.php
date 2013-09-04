<?php
class TesseractOCR {

  function recognize($originalImage) {
    $jpgImage       = TesseractOCR::convertImageToJpg($originalImage);
    $configFile     = TesseractOCR::generateConfigFile(func_get_args());
    $outputFile     = TesseractOCR::executeTesseract($jpgImage, $configFile);
    $recognizedText = TesseractOCR::readOutputFile($outputFile);
    TesseractOCR::removeTempFiles($jpgImage, $outputFile, $configFile);
    return $recognizedText;
  }

	function convertImageToJpg($originalImage) {
		$jpgImage = 'C:/wamp/tmp/tesseract-ocr-tif-' . rand() . '.jpg';
		exec("convert -density 400 \"$originalImage\" -depth 8 \"$jpgImage\"");
		return $jpgImage;
	}

  function generateConfigFile($arguments) {
    $configFile = 'C:/wamp/tmp/tesseract-ocr-config-'.rand().'.conf';
    $whitelist = TesseractOCR::generateWhitelist($arguments);
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

  function generateWhitelist($arguments) {
    array_shift($arguments); //first element is the image path
    $whitelist = '';
    foreach($arguments as $chars) $whitelist.= join('', (array)$chars);
    return $whitelist;
  }

  function executeTesseract($jpgImage, $configFile) {

    $outputFile = 'C:/wamp/tmp/tesseract-ocr-output-'.rand();
    exec("tesseract \"$jpgImage\" \"$outputFile\" nobatch \"$configFile\"");
    return $outputFile.'.txt'; //tesseract appends txt extension to output file
  }

  function readOutputFile($outputFile) {
    return trim(file_get_contents($outputFile));
  }

  function removeTempFiles() { array_map("unlink", func_get_args()); }
}
?>
