<?php
require 'link.php';
$secure = $_POST[secure];
$username = $_POST[username];
$canvas = $_POST[canvas];

function getIp(){
	if(!empty($_SERVER['HTTP_CLIENT_IP']))
		return $_SERVER['HTTP_CLIENT_IP'];
	if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	return $_SERVER['REMOTE_ADDR'];
}
$ip = getIp();
$ok = 0;
$count = 0;
$sql = "SELECT * FROM Fingerprint_user WHERE username='".$username."'";
$result1 = $conn->query($sql);	
if ($result1->num_rows > 0) {
	while($row = $result1->fetch_assoc()) {
		$id = $row["id"];
		echo "<h1>Welcome back, " . $row["username"]."</h1>";
	}
	$sql = "SELECT * FROM Visit_entry_user WHERE id_user=".$id."";
	$result1 = $conn->query($sql);	
	if ($result1->num_rows > 0) {
		while($row = $result1->fetch_assoc()) {
			$count = $count+1;
			if($canvas == $row["canvas_fingerprint"]){
				$ok =1;
				
			}
		}
	}
	if($ok){
		echo "<div class='alert alert-success' role='alert'>This is a trusted device</div>";
		echo "<h3><small>This is one of ".$count." trusted devices";
	}else{
		echo "<div class='alert alert-danger' role='alert'>This is not a trusted device</div>";
	}
} else {
	$sql = "INSERT INTO Fingerprint_user (username) VALUES ('".$username."')";
	$conn->query($sql);
	echo "<div class ='row'><div class='col-md-6'> <h1>Welcome aboard!</h1></div></div>";
	echo "<div class ='row'><div class='col-md-6'><h2><small>Register has been successfull";
	if($secure=="true"){
		$sql = "INSERT INTO Visit_entry_user (id_user,ip,canvas_fingerprint)VALUES(LAST_INSERT_ID(),'".$ip."',".$canvas.")";
		$result1 = $conn->query($sql);
		echo " and this device has been saved as secure";
	}
	echo "</small></h2></div></div>";
}

?>