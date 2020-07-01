<?php include ('../connection.php');?>
<?php 
session_start();?>
<?php
if(!isset($_SESSION['adminID'])){
	header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include ('link.php'); ?>
</head>
<body>
    <?php include ('header.php');?>
    </div>              
                 <!-- /. ROW  -->
                  <hr />
               
                         <div class='panel panel-default'>
                        <div class='panel-heading text-center'>  
<strong>ADMIN DASHBOARD</strong>
                        </div> 
    <?php 
        $user_query = mysqli_query($con,'SELECT COUNT(*) AS user_count FROM foodee');
        $data_user = mysqli_fetch_assoc($user_query);
        $user_count = $data_user['user_count'];

        $cook_query = mysqli_query($con,'SELECT COUNT(*) AS cook_count FROM cook_registration WHERE verified=1');
        $data_cook = mysqli_fetch_assoc($cook_query);
        $cook_count = $data_cook['cook_count'];

        $non_cook_query = mysqli_query($con,'SELECT COUNT(*) AS cook_count FROM cook_registration WHERE verified=0');
        $data_non_cook = mysqli_fetch_assoc($non_cook_query);
        $non_cook_count = $data_non_cook['cook_count'];

        $post_query = mysqli_query($con,'SELECT COUNT(*) AS post_count FROM menu WHERE approved=1');
        $data_post = mysqli_fetch_assoc($post_query);
        $post_count = $data_post['post_count'];

        $non_post_query = mysqli_query($con,'SELECT COUNT(*) AS post_count FROM menu WHERE approved=0');
        $data_non_post = mysqli_fetch_assoc($non_post_query);
        $non_post_count = $data_non_post['post_count'];

        $del_post_query = mysqli_query($con,'SELECT COUNT(*) AS post_count FROM menu WHERE approved=2');
        $data_del_post = mysqli_fetch_assoc($del_post_query);
        $del_post_count = $data_del_post['post_count'];
    ?>
    <div class="col-sm-1"></div>
    <div class="row">
    <div class="col-sm-10" style="border:2px solid green; border-radius:5px; margin-top:10px;">
    <div class="row" style="background-color:#b6f089;">
        <div class="text-center">
            <h3><strong>REGISTERED USERS</strong></h3>
        </div>
    </div>
    <div class="row">
    <div class="col-sm-2"></div>
        <div class="col-sm-5">
            <img src="../images/cook/group.png" alt="cook" style="border-radius:80%; width:150px; height:150px;">
        </div>
        <div class="col-sm-5">
            <p>Number of Resgistered Users</p>
            <h1><b><?php echo $user_count;?></b></h1>
        </div>
    </div>
    </div>
    <div class="col-sm-2"></div>
    <div class="row">
    <div class="col-sm-4" style="border:2px solid green; border-radius:5px; margin-top:10px; margin-right:10px;">
    <div class="row" style="background-color:#b6f089;">
        <div class="text-center">
            <h3><strong>REGISTERD COOKS</strong></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <img src="../images/cook/chef.png" alt="cook" style="border-radius:100%; width:150px; height:150px;">
        </div>
        <div class="col-sm-7 text-center">
            <p>Number of Registered Cooks</p>
            <h1><b><?php echo $cook_count;?></b></h1>
        </div>
    </div>
    </div>
    <div class="col-sm-4" style="border:2px solid orange; border-radius:5px; margin-top:10px;">
    <div class="row" style="background-color:#f9b98d;">
        <div class="text-center">
            <h3><strong>UNVERIFIED COOKS</strong></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <img src="../images/cook/chef.png" alt="cook" style="border-radius:100%; width:150px; height:150px;">
        </div>
        <div class="col-sm-7 text-center">
            <p>Number of Unverified Cooks</p>
            <h1><b><?php echo $non_cook_count;?></b></h1>
        </div>
    </div>
    </div>
    </div>
    <div class="col-sm-1"></div>
    <div class="row">
    <div class="col-sm-10" style="border:2px solid green; border-radius:5px; margin-top:10px;">
    <div class="row" style="background-color:#b6f089;">
        <div class="text-center">
            <h3><strong>LIVE POSTS</strong></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-5">
            <img src="../images/cook/food.jpg" alt="cook" style="border-radius:100%; width:150px; height:150px;">
        </div>
        <div class="col-sm-5">
            <p>Number of Live Posts</p>
            <h1><b><?php echo $post_count;?></b></h1>
        </div>
    </div>
    </div>
    <div class="col-sm-2"></div>
    <div class="row">
    <div class="col-sm-4" style="border:2px solid orange; border-radius:5px; margin-top:10px; margin-right:10px;">
    <div class="row" style="background-color:orange;">
        <div class="text-center">
            <h3><strong>PENDING POSTS</strong></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <img src="../images/cook/food.jpg" alt="cook" style="border-radius:100%; width:150px; height:150px;">
        </div>
        <div class="col-sm-7 text-center">
            <p>Number of Pending Posts</p>
            <h1><b><?php echo $non_post_count;?></b></h1>
        </div>
    </div>
    </div>
    <div class="col-sm-4" style="border:2px solid red; border-radius:5px; margin-top:10px;">
    <div class="row" style="background-color:#fd6d6d;">
        <div class="text-center">
            <h3><strong>DELETED POSTS</strong></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <img src="../images/cook/food.jpg" alt="cook" style="border-radius:100%; width:150px; height:150px;">
        </div>
        <div class="col-sm-7 text-center">
            <p>Number of Deleted Posts</p>
            <h1><b><?php echo $del_post_count;?></b></h1>
        </div>
    </div>
    </div>
    </div>
    <?php include ('footer.php');?>
</body>
</html>