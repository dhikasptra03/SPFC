<?php
// retrieve id from parameter
$user_id=$_GET['id'];

$sql = "DELETE FROM users WHERE user_id='$user_id'";
if ($conn->query($sql) === TRUE) {
    header("Location:?page=users");
}
$conn->close();
?>