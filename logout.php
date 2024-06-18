<?php 
// activate session
session_start();
 
// delete all sessions
session_destroy();
 
// redirects the page while sending a logout message
header("Location:login.php");