

<?php
session_start();

include("db_conn.php"); 	//We include the database_connect.php which has the data for the connection to the database

/*This file should receive a link somethong like this: http://noobix.000webhostapp.com/TX.php?unit=1&b1=1
If you paste that link to your browser, it should update b1 value with this TX.php file. Read more details below.
The ESP will send a link like the one above but with more than just b1. It will have b1, b2, etc...
*/
//We loop through and grab variables from the received the URL

$action=$_GET['action'];
	//Now we detect if we recheive the id, the password, unit, or a value to update
$id = $_GET['id'];
if(!isset($_SESSION["lastDevice"])){
	$_SESSION["lastDevice"]=1;
}
else{
	$_SESSION["lastDevice"]=$id;
}	
if ($action==2) {
	$sptl_1_new_val=$_GET['sptl_1'];
	$sptl_2_new_val=$_GET['sptl_2'];
	$sptl_3_new_val=$_GET['sptl_3'];
	$sptl_4_new_val=$_GET['sptl_4'];
	$delayTimer_new_val=$_GET['delayTimer'];
	$textString_new_val=$_GET['textString'];
	// Check  the connection
	if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
		mysqli_query($con,"UPDATE sptl SET SPTL_1=$sptl_1_new_val,SPTL_2=$sptl_2_new_val,SPTL_3=$sptl_3_new_val,SPTL_4=$sptl_4_new_val,delayTimer=$delayTimer_new_val,textString='$textString_new_val' WHERE id =$id");	
		header('location: index.php');
	}
	if (isset($_GET['btnState'])) {
		$btnState=$_GET['btnState'];
		if($btnState==0){
			// Check  the connection
			if (mysqli_connect_errno()) {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
				}
					mysqli_query($con,"UPDATE sptl SET btnState=1");	
				}
		}
//In case that you need the time from the internet, use this line
date_default_timezone_set('UTC');
$t1 = date("gi"); 	//This will return 1:23 as 123

//Get all the values form the table on the database
$result = mysqli_query($con,"SELECT * FROM sptl where id=$id");	//table select is sptl, must be the same on yor database
//Loop through the table and filter out data for this unit id equal to the one taht we've received. 
while($row = mysqli_fetch_array($result)) {
	//We update the values for the boolean and numebers we receive from the Arduino, then we echo the boolean
	//and numbers and the text from the database back to the Arduin
	$SPTL_1=$row['SPTL_1'];
	$SPTL_2=$row['SPTL_2'];
	$SPTL_3=$row['SPTL_3'];
	$SPTL_4=$row['SPTL_4'];
	$delayTimer=$row['delayTimer'];
	$textString=$row['textString'];
	$btnState=$row['btnState'];
}// End of the while loop
//Next line will echo the data back to the Arduino
if($action==1){
	echo '{		
		"main":{
			"SPTL_1":'. $SPTL_1 .',
			"SPTL_2":'. $SPTL_2 .',
			"SPTL_3":'. $SPTL_3 .',
			"SPTL_4":'. $SPTL_4 .',
			"delayTimer":'. $delayTimer .',
			"textString":'. $textString .',
			"btnState":'.$btnState.'
		}
	}';	
}
?>