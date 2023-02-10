

<?php
session_start();

include("db_conn.php"); 	//We include the database_connect.php which has the data for the connection to the database

/*This file should receive a link somethong like this: http://noobix.000webhostapp.com/TX.php?unit=1&b1=1
If you paste that link to your browser, it should update b1 value with this TX.php file. Read more details below.
The ESP will send a link like the one above but with more than just b1. It will have b1, b2, etc...
*/
//We loop through and grab variables from the received the URL
//- device_Id, LO_kWh,CO_LO_kWh & ACU_LO_kWh 

// action 1 if send 
//http://<ip_address>/cloudcontrol/TX.php?action=1&device_Id=1&LO_kWh=<value1>&CO_LO_kWh=<value2>&ACU_LO_kWh=<value3>
	//note values are from the device

// action 2 if get
// http://<ip_address>/cloudcontrol/TX.php?action=2&device_id=1
$action=$_GET['action'];
	//Now we detect if we recheive the id, the password, unit, or a value to update
$id = $_GET['device_Id'];

if ($action==1) {
	$LO_kWh_val=$_GET['LO_kWh'];
	$CO_LO_kWh_val=$_GET['CO_LO_kWh'];
	$ACU_LO_kWh_val=$_GET['ACU_LO_kWh'];
	
	// Check  the connection
	if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
		mysqli_query($conn,"Insert tbl_data_received SET device_id=$id,LO_kWh=$LO_kWh_val,CO_LO_kWh=$CO_LO_kWh_val,ACU_LO_kWh=$ACU_LO_kWh_val");	
		
} else if($action==2) {
	$id = $_GET['device_id'];
	//In case that you need the time from the internet, use this line
	date_default_timezone_set('UTC');
	$t1 = date("gi"); 	//This will return 1:23 as 123

	//Get all the values form the table on the database
	$result = mysqli_query($conn,"SELECT * FROM tbl_device where device_id=$id");	
	//Loop through the table and filter out data for this unit id equal to the one taht we've received. 
	while($row = mysqli_fetch_array($result)) {
		$btnState=$row['device_status'];
			// echo '[{		
			// 	"data":{
			// 		"device_status":'.$btnState.'
			// 	}
			// }]';	
			echo $row['device_status'];
		
	}// End of the while loop
	//Next line will echo the data back to the esp32
	
}
	// if (isset($_GET['btnState'])) {
	// 	$btnState=$_GET['btnState'];
	// 	if($btnState==0){
	// 		// Check  the connection
	// 		if (mysqli_connect_errno()) {
	// 			echo "Failed to connect to MySQL: " . mysqli_connect_error();
	// 			}
	// 				mysqli_query($con,"UPDATE tbl_device SET device_status=1");	
	// 			}
	// 	}

?>