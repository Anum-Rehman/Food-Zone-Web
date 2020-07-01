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
<?php include ('header.php');?>
    ORDERS
    </div>
    <div class="panel-body">
        <div id="morris-donut-chart"></div>
        
        <?php include ('footer.php');?>
</body>
</html>