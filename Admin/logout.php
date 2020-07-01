<?php
session_start();
if(isset($_SESSION['adminID'])) {
    session_destroy();
    header('location:login.php');
}
?>