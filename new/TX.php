

<?php
session_start();

include("db_conn.php"); 	//We include the database_connect.php which has the data for the connection to the database

/*This file should receive a link somethong like this: http://noobix.000webhostapp.com/TX.php?unit=1&b1=1
If you paste that link to your browser, it should update b1 value with this TX.php file. Read more details below.
The ESP will send a link like the one above but with more than just b1. It will have b1, b2, etc...
*/
//We loop through and grab variables from the received the URL
//- device_Id, LO_kWh,CO_LO_kWh & ACU_LO_kWh 
$action=$_GET['action'];
	//Now we detect if we recheive the id, the password, unit, or a value to update
$id = $_GET['device_Id'];

if ($action==2) {
	$LO_kWh_val=$_GET['LO_kWh'];
	$CO_LO_kWh_val=$_GET['CO'];
	$ACU_LO_kWh_val=$_GET['LO_kWh'];
	
	// Check  the connection
	if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
		mysqli_query($con,"Insert tbl_data_received SET device_id=$id,LO_kWh=$LO_kWh_val,CO_LO_kWh=$CO_LO_kWh_val,ACU_LO_kWh=$ACU_LO_kWh_val");	
		header('location: index.php');
	}
	if (isset($_GET['btnState'])) {
		$btnState=$_GET['btnState'];
		if($btnState==0){
			// Check  the connection
			if (mysqli_connect_errno()) {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
				}
					mysqli_query($con,"UPDATE tbl_device SET device_status=1");	
				}
		}
//In case that you need the time from the internet, use this line
date_default_timezone_set('UTC');
$t1 = date("gi"); 	//This will return 1:23 as 123

//Get all the values form the table on the database
$result = mysqli_query($con,"SELECT * FROM tbl_device where device_id=$id");	//table select is sptl, must be the same on yor database
//Loop through the table and filter out data for this unit id equal to the one taht we've received. 
while($row = mysqli_fetch_array($result)) {
	//We update the values for the boolean and numebers we receive from the Arduino, then we echo the boolean
	//and numbers and the text from the database back to the Arduin
	$btnState=$row['device_status'];
}// End of the while loop
//Next line will echo the data back to the Arduino
if($action==1){
	echo '[{		
		"data":{
			"device_status":'.$btnState.'
		}
	}]';	
}
?>