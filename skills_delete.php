<?php
// retrieve id from parameter
$skill_id=$_GET['id'];

$sql = "DELETE FROM skills WHERE skill_id='$skill_id'";
if ($conn->query($sql) === TRUE) {
    header("Location:?page=skills");
}
$conn->close();
?>