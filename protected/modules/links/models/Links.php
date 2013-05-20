<?php
/**
 * This class is used to store all the different links in one place for easy changes.
 */
class Links
{
	private $copiers = array(
		array('Name'=>'CrimClerk_Admin_Copier', 'Address' => 'http://10.96.23.100'),
		array('Name'=>'CrimClerk_Archive_Copier', 'Address' => 'http://10.96.18.116'),
		array('Name'=>'CrimClerk_Bond_Copier', 'Address' => 'http://10.96.23.96'),
		array('Name'=>'CrimClerk_cc_copier', 'Address' => 'http://10.96.23.97'),
		array('Name'=>'CrimClerk_File_Area_Copier', 'Address' => 'http://10.96.23.99'),
		array('Name'=>'CrimClerk_gs_copier', 'Address' => 'http://10.96.23.95'),
		array('Name'=>'CrimClerk_Minutes_copier', 'Address' => 'http://10.96.23.98'),
		array('Name'=>'CrimClerk_MSE_copier', 'Address' => 'http://10.52.102.37'),
	);
	
	private $printers = array(
		array('Name'=>'CrimClerk_Bond_Office_1', 'Address' => 'http://10.96.23.37'),
		array('Name'=>'CrimClerk_Bond_Office_2', 'Address' => 'http://10.96.23.50'),
		array('Name'=>'CrimClerk_Cashier', 'Address' => 'http://10.96.22.141'),
		array('Name'=>'CrimClerk_Court_Admin', 'Address' => 'http://NPIBF74AF'),
		array('Name'=>'CrimClerk_Court_Chief', 'Address' => 'http://NPIDF1191'),
		array('Name'=>'CrimClerk_Finance_Chief', 'Address' => 'http://DELL3F0D37'),
		array('Name'=>'CrimClerk_IT_Chief', 'Address' => 'http://NPI47D7CF'),
		array('Name'=>'CrimClerk_Left_Counter', 'Address' => 'http://10.96.22.159'),
		array('Name'=>'CrimClerk_Middle_Counter', 'Address' => 'http://10.96.22.220'),
		array('Name'=>'CrimClerk_Public_Counter', 'Address' => 'http://10.96.23.94'),
		array('Name'=>'CrimClerk_Right_Counter', 'Address' => 'http://rnp507336'),
	);
	
	public function getPrinters()
	{
		return $this->printers;
	}
	
	public function getCopiers()
	{
		return $this->copiers;
	}
}
