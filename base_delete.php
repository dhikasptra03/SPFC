<?php
// retrieve id from parameter
$base_id = $_GET['id'];

// delete knowledge base details first to avoid foreign key constraint error
$sql = "DELETE FROM knowledge_base_details WHERE base_id='$base_id'";
$conn->query($sql);

// delete knowledge base
$sql = "DELETE FROM knowledge_bases WHERE base_id='$base_id'";
$conn->query($sql);

$conn->close();

header("Location:?page=base");
?>