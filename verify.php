<?php include 'connection.php' ?>
<?php
    function redirect(){
        header('location: Admin/registeredCook.php');
        exit();
    }
    if(!isset($_GET['Email']) || !isset($_GET['vkey'])){
        redirect();
    }
    else{
        $email = $_GET['Email'];
        $token = $_GET['vkey'];
        $fetch = mysqli_query($con,"SELECT * FROM `cook_registration` WHERE `Email` = '$email' 
        AND `vkey` = '$token' AND `verified`=0");
        if(mysqli_num_rows($fetch)>0){
            mysqli_query($con,"UPDATE `cook_registration` SET `verified` = 1, `vkey`='' WHERE `Email`='$email'");
            $to = $email;
			$subject = "Registration Approved";
			$message = "<p>Your Request to join Food Zone has been approved.";
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