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
    <div class='col-md-6'>
                    <br>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" class='form-inline'>
                      <div class='form-group mx-sm-3 mb-2'>
                        <label for='inputPassword2' class='sr-only'>Password</label>
                        <input type='search' class='form-control' name='find' required value='' placeholder='Search'>
                    </div>
                    <input type='submit' class='btn btn-primary' value='Search' name='search'>
                    </form>
                    
                    
                    
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
               
                         <div class='panel panel-default'>
                        <div class='panel-heading text-center'>
    Registered Users
    </div>
    <div class="panel-body">
        <div id="morris-donut-chart"></div>
                            <table class="table">
                            <thead class="thead-dark">
                              <tr>
                                <th scope="col" class="text-center">USER ID</th>
                                <th scope="col" class="text-center">NAME</th>
                                <th scope="col" class="text-center">EMAIL</th>
                                <th scope="col" class="text-center">Location</th>
                              </tr>
                            </thead>
                            <?php
                             if(isset($_POST['search'])){
                              $value = $_POST['find'];
                              $user_query = mysqli_query($con,"SELECT * FROM foodee WHERE ID LIKE '%$value%' OR Name LIKE '%$value%'
                              OR District LIKE '%$value%'");
                            }
                            else{
                            $user_query=mysqli_query($con,"SELECT * FROM `foodee`");
                            }
                            $i=1;
                            while($data = mysqli_fetch_assoc($user_query))
							{
                            $user_id = $data['ID'];
                            $name = $data['Name'];
                            $email = $data['Email'];
                            $loc = $data['District'];
                            ?>
                            <tbody>
                              <tr>
                                <th scope="row" class="thead-light text-center"><?php echo $user_id ?></th>
                                <td class="text-center"><?php echo $name ?></td>
                                <td class="text-center"><?php echo $email ?></td>
                                <td class="text-center"><?php echo $loc ?></td>
                              </tr>
                            <?php
                            $i++;
                            }
                            ?>
                            </table>
    <?php include ('footer.php');?>
</body>
</html>