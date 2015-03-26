<?php
require 'link.php';
$target_id = $_POST['target_id'];
$new_tag = $_POST['new_tag'];
$target_id_canvas = $_POST['target_id_canvas'];

$new_tag = $conn->real_escape_string($new_tag);
$conn->query("UPDATE Fingerprint_registry_default_MD5 SET tag='".$new_tag."' WHERE id=".$target_id);
$conn->query("UPDATE Fingerprint_registry_canvas_MD5 SET tag='".$new_tag."' WHERE id=".$target_id_canvas);
echo("<h3><small>Done!</small></h3>");

?>