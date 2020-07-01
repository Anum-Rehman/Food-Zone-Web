<?php include '../connection.php' ?>
<?php 
session_start();?>
<?php
if(!isset($_SESSION['adminID'])){
	header("location:login.php");
}
?>
<?php
    function redirect(){
        header('location: unverifiedCook.php');
        exit();
    }
    if(!isset($_GET['userid'])){
        redirect();
    }
    else{
        $user_id = $_GET['userid'];
        $fetch = mysqli_query($con,"SELECT * FROM `cook_registration` WHERE `UID` = '$user_id'");
        if(mysqli_num_rows($fetch)>0){
            $data = mysqli_fetch_assoc($fetch);
            $email = $data['Email'];
            mysqli_query($con,"DELETE FROM cook_registration WHERE UID='$user_id'");
            $to = $email;
			$subject = "Registration Status";
			$message = "<p>Your Request to join Food Zone has been Rejected.";
			$headers =  "From: anumr32@gmail.com";
			$headers .= "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			mail($to,$subject,$message,$headers);
            redirect();
        }
        else{
            redirect();
        }
    }
?>