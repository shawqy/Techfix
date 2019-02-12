<?php 
 session_start();
 unset($_SESSION['clientEmail']);
 unset($_SESSION['clientPassword']);
 unset($_SESSION['clientId']);
 unset($_SESSION['techEmail']);
 unset($_SESSION['techPassword']);
 unset($_SESSION['techId']);
 session_destroy();
 header("Location: ../pro/home/index.php");

?>