<?php
require 'link.php';

$default_MD5 = $_POST[default_MD5];
$default_raw = $_POST[default_raw];
$resolution_MD5 = $_POST[resolution_MD5];
$resolution_raw = $_POST[resolution_raw];
$canvas_MD5 = $_POST[canvas_MD5];
$canvas_raw = $_POST[canvas_raw];

function getIp(){
	if(!empty($_SERVER['HTTP_CLIENT_IP']))
		return $_SERVER['HTTP_CLIENT_IP'];
	if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	return $_SERVER['REMOTE_ADDR'];
}
$ip = getIp();

if($default_MD5 !=null){
	echo "<h2>Default fingerprint <small>Uses only browser&system metadata</small></h2>";
	$sql = "SELECT * FROM Fingerprint_registry_default_MD5 WHERE fingerprint_key=".$default_MD5;
	$result1 = $conn->query($sql);
	if ($result1->num_rows > 0) {
		//Here, the user is recognized-----------------
		echo "<div class='row'><div class='col-md-6'>";
		while($row = $result1->fetch_assoc()) {
			$id = $row["id"];
			$tag = $row["tag"];
			echo "<h3>id: " . $row["id"]. " - Print: " . $row["fingerprint_key"]." - Tag: ".$row["tag"]."</h3>";
		}
		echo "</div></div>";
		if($tag == "Anonymous"){
			echo "<div id='nameUpdate'><div class='row'><div class='col-md-6'><h3>Give us a Name tag for this PC, so it doesn't remain as Anonymous</h3></div></div>";
			echo "<div class='row'><div class='col-md-6'><form><input type='text' name='tag' id='tag'><input type='hidden' id='targetid' name='targetid' value='".$id."'><input type='button' value='Submit' class='btn btn-primary' onclick='saveName();'></form></div></div></div>";
		}
		$sql2 = "INSERT INTO Visit_entry_default_MD5 (visitor_id,ip)VALUES(".$id.",'".$ip."')";
		$result1 = $conn->query($sql2);
		$sql3 = "SELECT date,ip FROM Visit_entry_default_MD5 WHERE visitor_id = ".$id;
		$result1 = $conn->query($sql3);
		if ($result1->num_rows > 0) {
			echo "<div class='row'><div class='col-md-6 mygrid-wrapper-div'><table class='table table-condensed table-hover'><thead><tr><th>TimeStamp <span class='glyphicon glyphicon-time'></span></th><th>Ip <span class='glyphicon glyphicon-map-marker'></span></th></tr></thead><tbody>";
			while($row = $result1->fetch_assoc()) {
				echo "<tr><td>".$row["date"]. "</td><td>" . $row["ip"]."</td></tr>";
			}
			echo "</tbody></table></div></div>";
		}
	} else {
		//User unrecognized.----------------------------
		echo "<h3>Your print is new to us, congratulations! <span class='glyphicon glyphicon-thumbs-up'></span> <small>Registry has been made and will show next time you visit us</small><span class='glyphicon glyphicon-refresh'></span></h3>";
		$sql = "INSERT INTO Fingerprint_registry_default_MD5 (fingerprint_key) VALUES (".$default_MD5.")";
		$result1 = $conn->query($sql);
		$sql2 = "INSERT INTO Visit_entry_default_MD5 (visitor_id,ip)VALUES(LAST_INSERT_ID(),'".$ip."')";
		$result1 = $conn->query($sql2);
	}
}
if($canvas_MD5 !=null){
	echo "<h2>Canvas fingerprint <small>The real deal, gpu rendering info on top of the default print for extra detail on profiling</small></h2>";
	$sql = "SELECT * FROM Fingerprint_registry_canvas_MD5 WHERE fingerprint_key=".$canvas_MD5;
	$result1 = $conn->query($sql);
	if ($result1->num_rows > 0) {
		while($row = $result1->fetch_assoc()) {
			$id = $row["id"];
			echo "<h3>id: " . $row["id"]. " - Print: " . $row["fingerprint_key"]." - Tag: ".$row["tag"]."</h3>";
		}
		echo "<form><input type='hidden' id='targetid_canvas' value='".$id."'></form>";
		$sql2 = "INSERT INTO Visit_entry_canvas_MD5 (visitor_id,ip)VALUES(".$id.",'".$ip."')";
		$result1 = $conn->query($sql2);
		$sql3 = "SELECT date,ip FROM Visit_entry_canvas_MD5 WHERE visitor_id = ".$id;
		$result1 = $conn->query($sql3);
		if ($result1->num_rows > 0) {
			echo "<div class='row'><div class='col-md-6 mygrid-wrapper-div'><table class='table table-condensed table-hover'><thead><tr><th>TimeStamp <span class='glyphicon glyphicon-time'></span></th><th>Ip <span class='glyphicon glyphicon-map-marker'></span></th></tr></thead><tbody>";
			while($row = $result1->fetch_assoc()) {
				echo "<tr><td>".$row["date"]. "</td><td>" . $row["ip"]."</td></tr>";
			}
			echo "</tbody></table></div></div>";
		}
	} else {
		echo "<h3>Your print is new to us, congratulations! <span class='glyphicon glyphicon-thumbs-up'></span> <small>Registry has been made and will show next time you visit us</small><span class='glyphicon glyphicon-refresh'></span></h3>";
		$sql = "INSERT INTO Fingerprint_registry_canvas_MD5 (fingerprint_key) VALUES (".$canvas_MD5.")";
		$result1 = $conn->query($sql);
		$sql2 = "INSERT INTO Visit_entry_canvas_MD5 (visitor_id,ip)VALUES(LAST_INSERT_ID(),'".$ip."')";
		$result1 = $conn->query($sql2);
	}
}
if($resolution_MD5 !=null){
	echo "<h2>Resolution fingerprint <small>Adds curent resolution to the mix.Will change for each monitor on multiscreen systems</small></h2>";
	$sql = "SELECT * FROM Fingerprint_registry_resolution_MD5 WHERE fingerprint_key=".$resolution_MD5;
	$result1 = $conn->query($sql);
	if ($result1->num_rows > 0) {
		while($row = $result1->fetch_assoc()) {
			$id = $row["id"];
			echo "<h3>id: " . $row["id"]. " - Print: " . $row["fingerprint_key"]. "</h3>";
		}
		$sql2 = "INSERT INTO Visit_entry_resolution_MD5 (visitor_id,ip)VALUES(".$id.",'".$ip."')";
		$result1 = $conn->query($sql2);
		$sql3 = "SELECT date,ip FROM Visit_entry_resolution_MD5 WHERE visitor_id = ".$id;
		$result1 = $conn->query($sql3);
		if ($result1->num_rows > 0) {
			echo "<div class='row'><div class='col-md-6 mygrid-wrapper-div'><table class='table table-condensed table-hover'><thead><tr><th>TimeStamp <span class='glyphicon glyphicon-time'></span></th><th>Ip <span class='glyphicon glyphicon-map-marker'></span></th></tr></thead><tbody>";
			while($row = $result1->fetch_assoc()) {
				echo "<tr><td>".$row["date"]. "</td><td>" . $row["ip"]."</td></tr>";
			}
			echo "</tbody></table></div></div>";
		}
	} else {
		echo "<h3>Your print is new to us, congratulations! <span class='glyphicon glyphicon-thumbs-up'></span> <small>Registry has been made and will show next time you visit us</small><span class='glyphicon glyphicon-refresh'></span></h3>";
		$sql = "INSERT INTO Fingerprint_registry_resolution_MD5 (fingerprint_key) VALUES (".$resolution_MD5.")";
		$result1 = $conn->query($sql);
		$sql2 = "INSERT INTO Visit_entry_resolution_MD5 (visitor_id,ip)VALUES(LAST_INSERT_ID(),'".$ip."')";
		$result1 = $conn->query($sql2);
	}
}
if($default_raw !=null){
	echo "<div class='row'><div class='col-md-6 mygrid-wrapper-div'> asdasd".$default_raw."</div></div>";
}
if($resolution_raw !=null){
	echo "<div class='row'><div class='col-md-6 mygrid-wrapper-div'>ffsf".$resolution_raw."</div></div>";
}
if($canvas_raw !=null){
	echo "<div class='row'><div class='col-md-6 mygrid-wrapper-div'>aass".$canvas_raw."</div></div>";
}

?>