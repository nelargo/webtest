<?php
require 'link.php';
$canvas_MD5 = $_POST[canvas_MD5];
$cookie = $_POST[cookievalue];

function getIp(){
	if(!empty($_SERVER['HTTP_CLIENT_IP']))
		return $_SERVER['HTTP_CLIENT_IP'];
	if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	return $_SERVER['REMOTE_ADDR'];
}
$ip = getIp();


if($canvas_MD5 !=null){
	echo "<h2>Canvas fingerprint + Unique EverCookie</h2>";
	$sql = "SELECT * FROM Fingerprint_registry_super_key WHERE fingerprint_key=".$canvas_MD5." AND cookie_key='".$cookie."'";
	$result1 = $conn->query($sql);
	if ($result1->num_rows > 0) {
		while($row = $result1->fetch_assoc()) {
			$id = $row["id"];
			echo "<h3>id: " . $row["id"]. " - Print: " . $row["fingerprint_key"]." + Cookie: ".$row["cookie_key"]."</h3>";
		}
	} else {
		echo "<h3>Your print is new to us, congratulations! <span class='glyphicon glyphicon-thumbs-up'></span> <small>Registry has been made and will show next time you visit us</small><span class='glyphicon glyphicon-refresh'></span></h3>";

		echo $canvas_MD5." ".$cookie;
		$sql = "INSERT INTO Fingerprint_registry_super_key (fingerprint_key,cookie_key) VALUES (".$canvas_MD5.",'".$cookie."')";
		$result1 = $conn->query($sql);
	}
}


?>