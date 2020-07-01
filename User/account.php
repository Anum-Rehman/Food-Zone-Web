<?php include ('../connection.php'); ?>
<?php 
session_start();
if(empty($_SESSION['userID'])){
	header("../location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include ('links.php'); ?>
</head>
<body>
    <?php include ('header.php'); ?>
        <?php 
            
        ?>
    <?php include ('footer.php'); ?>
</body>
</html>