<?php

/**
 * This is the script that is used to map the files and folders on JIS09051\crimclerk_shared$.
 * This is run in a Cron job.
 */
class MapCommonFilesCommand extends CConsoleCommand
{
	// Make a variable set to the location that needs to be mapped.
	
	/**
	 * Run the command and map the files and folders.
	 * I know this name does not follow best practice but it is required this way by yii.
	 */
    public function run($args)
	{
        // Create Document model object.
		
		// Loop through folders and subfolders, grabbing each file
		{
			// Try to catch errors related to the current file.
			{
				// Pass the current file to the model.
				
				// Call function to read in file contents and metadata.
				
				// Validate the file. Throw exception if validation fails.
				
				// If the file's existance is already known to the database
				{
					// Update the existing model.
				}
				// else
				{
					// Save the new model.
				}
			}
			// Catch errors here.
			{
				// If the mapping of a file failed, then the indexing of that file will be skipped and the loop
				// will move on to the next file. That way, a single bad file will not stop the entire process.
				// The failure will also be recorded here.
			}
			
		} // End loop
    }
}
