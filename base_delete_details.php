<?php
// retrieve id from parameter
$base_id=$_GET['base_id'];
$skill_id=$_GET['skill_id'];

$sql = "DELETE FROM knowledge_base_details WHERE base_id='$base_id' AND skill_id='$skill_id'";
if ($conn->query($sql) === TRUE) {
    header("Location:?page=base");
}
$conn->close();
?>