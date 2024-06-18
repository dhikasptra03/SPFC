<?php
// retrieve id from parameter
$career_id=$_GET['id'];

$sql = "DELETE FROM careers WHERE career_id='$career_id'";
if ($conn->query($sql) === TRUE) {
    header("Location:?page=career");
}
$conn->close();
?>