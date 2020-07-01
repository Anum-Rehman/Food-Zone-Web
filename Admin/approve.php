<?php include ('../connection.php');?>
<?php 
session_start();?>
<?php
if(!isset($_SESSION['adminID'])){
	header("location:login.php");
}
?>
<?php
    if(isset($_GET['menuid'])){
        $menu_id = $_GET['menuid'];
        $approve_query = mysqli_query($con,"SELECT * FROM menu WHERE MenuID='$menu_id' AND (approved=0 OR approved=2)");
        if(mysqli_num_rows($approve_query)>0){
            mysqli_query($con,"UPDATE  `menu` SET `approved`=1 WHERE `MenuID`='$menu_id'");
            header('location:livePost.php');
        }
        else{
            header('location:livePost.php');
        }
    }
    else{
        header('location:livePost.php');
    }
?>