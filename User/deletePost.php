<?php include ('../connection.php'); ?>
<?php 
session_start();
if(empty($_SESSION['userID'])){
	header("../location:index.php");
}
?>
<?php include ('../connection.php');?>
<?php
    if(isset($_GET['menuid'])){
        $menu_id = $_GET['menuid'];
        $delete_query = mysqli_query($con,"SELECT * FROM menu WHERE MenuID='$menu_id' AND (approved=0 OR approved=1)");
        if(mysqli_num_rows($delete_query)>0){
            mysqli_query($con,"UPDATE  menu SET approved=2 WHERE MenuID='$menu_id'");
            header('location:deletedPost.php');
        }
        else{
            header('location:deletedPost.php');
        }
    }
    else{
        header('location:deletedPost.php');
    }
?>  