<?php
session_start();
if(isset($_SESSION['userID'])) {
    session_destroy();
    header('location:index.php?logout=1');
}
?>