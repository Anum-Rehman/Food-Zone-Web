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
<?php include ('header.php'); ?>
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
UNVERIFIED COOKS
                        </div>
                        <div class="panel-body">
                            <div id="morris-donut-chart"></div>
                            <table class="table">
                            <thead class="thead-dark">
                              <tr>
                                <th scope="col" class="text-center">USER ID</th>
                                <th scope="col" class="text-center">NAME</th>
                                <th scope="col" class="text-center">EMAIL</th>
                                <th scope="col" class="text-center">USERNAME</th>
                                <th scope="col" class="text-center">NIC</th>
                                <th scope="col" class="text-center">CONTACT</th>
                                <th scope="col" class="text-center">GENDER</th>
                                <th scope="col" class="text-center">DATE OF BIRTH</th>
                                <th scope="col" class="text-center">FOOD TYPE</th>
                                <th scope="col" class="text-center">TASTE</th>
                                <th scope="col" class="text-center">SPECIALITY IN</th>
                                <th scope="col" class="text-center">TIME PREFER</th>
                                <th scope="col" class="text-center">EXPERIENCE</th>
                                <th scope="col" class="text-center">HOURS</th>
                                <th scope="col" class="text-center">NO. OF DISHES</th>
                                <th scope="col" class="text-center">PEOPLE QUANTITY</th>
                                <th scope="col" class="text-center">DATE</th>
                                <th scope="col" class="text-center">STATUS</th>
                                <th scope="col" class="text-center">DELETE COOK</th>
                              </tr>
                            </thead>
                            <?php
                            if(isset($_POST['search'])){
                              $value = $_POST['find'];
                              $cook_query = mysqli_query($con,"SELECT * FROM cook_registration WHERE UID LIKE '%$value%' OR Full_name LIKE '%$value%'
                              OR Email LIKE '%$value%' OR Username LIKE '%$value%' OR CNIC LIKE '%$value%' OR Contact LIKE '%$value%'");
                            }
                            else{
                            $cook_query=mysqli_query($con,"SELECT * FROM `cook_registration`");
                            }
                            $i=1;
                            while($data = mysqli_fetch_assoc($cook_query))
							{
                            $user_id = $data['UID'];
                            $name = $data['Full_name'];
                            $email = $data['Email'];
                            $user = $data['Username'];
                            $nic = $data['CNIC'];
                            $contact = $data['Contact'];
                            $pass = $data['Password'];
                            $gender = $data['Gender'];
                            $DOB = $data['DOB'];
                            $food_Type = $data['Traditional_Food'];
                            $taste = $data['Taste'];
                            $speciality = $data['Specialty'];
                            $time_prefer = $data['Time_Prefer'];
                            $experience = $data['Experience'];
                            $hour = $data['Time'];
                            $Quantity = $data['Dishes_Quantity'];
                            $people_quantity = $data['People_Quantity'];
                            $verify = $data['verified'];
                            $date = $data['Cur_Time'];
                            $vkey = $data['vkey'];
                            if($verify==0){ 
                            ?>
                            <tbody>
                              <tr>
                                <th scope="row" class="thead-light"><?php echo $user_id ?></th>
                                <td><?php echo $name ?></td>
                                <td><?php echo $email ?></td>
                                <td><?php echo $user ?></td>
                                <td><?php echo $nic ?></td>
                                <td><?php echo $contact ?></td>
                                <td><?php echo $gender ?></td>
                                <td><?php echo $DOB ?></td>
                                <td><?php echo $food_Type ?></td>
                                <td><?php echo $taste ?></td>
                                <td><?php echo $speciality ?></td>
                                <td><?php echo $time_prefer ?></td>
                                <td><?php echo $experience ?></td>
                                <td><?php echo $hour ?></td>
                                <td><?php echo $Quantity ?></td>
                                <td><?php echo $people_quantity ?></td>
                                <td><?php echo $date ?></td>
                                <td><?php echo "<a href='../verify.php?Email=$email&vkey=$vkey' class='btn btn-primary'>APPROVE</a>" ?></td>
                                <td><?php echo "<a class='btn btn-danger' href='deleteCook.php?userid=$user_id'>DELETE</a>"?></td>
                               <?php } ?>
                              </tr>
                            <?php
                            $i++;
                            }
                            ?>
                            </table>
   <?php include ('footer.php');?>   
</body>
</html>