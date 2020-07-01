<?php include '../connection.php' ?>
<?php 
if(empty($_SESSION['userID'])){
	header("location:index.php");
}
else{
    $user_id = $_SESSION['userID'];
    $query = mysqli_query($con,"SELECT Full_name FROM cook_registration WHERE UID='$user_id'");
    $fetch = mysqli_fetch_assoc($query);
    $name = $fetch['Full_name'];
}
?>
<?php
echo
"<div id='wrapper'>
        <nav class='navbar navbar-default navbar-cls-top' role='navigation' style='margin-bottom: 0'>
            <div class='navbar-header'>
                <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.sidebar-collapse'>
                    <span class='sr-only'>Toggle navigation</span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                </button>
                <a class='navbar-brand' href='index.html'>COOK</a> 
            </div>
  <div style='color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;'> <a href='../logout.php' class='btn btn-danger square-btn-adjust'>Logout</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class='navbar-default navbar-side' role='navigation'>
            <div class='sidebar-collapse'>
                <ul class='nav' id='main-menu'>
				<li class='text-center'>
                    <img src='../images/cook/aiqLdbbqT.png' class='user-image img-responsive'/>
                    </li>
                    <li>
                    <a href='orders.php'>Orders</a>
                    </li>					
                    <li>
                    <a href='yourMenu.php'>Your Weekly Menu</a>
                    </li>
                    <li>
                        <a href='index.php'>Live Posts</a>
                    </li>
                     <li>
                        <a  href='pendingPost.php'>Pending Posts</a>
                    </li>
                    <li>
                        <a  href='deletedPost.php'>Deleted Posts</a>
                    </li>				
					                   
                    <li>
                    <a  href='account.php'>Your Account</a>
                      </li>  
                </ul>
               
            </div>
            
        </nav>  
        <!-- / NAV SIDE  -->
        <div id='page-wrapper'>
            <div id='page-inner'>
                <div class='row'>
                    <div class='col-md-6'>
                     <h2>Cook Panel</h2>   
                        <h5>Welcome $name, Love to see you back. </h5>
                    </div>
                    <div class='col-md-6'>
                    <br>
                    <form action='<?php echo htmlspecialchars($_SERVER[PHP_SELF]) ?>' method='POST' class='form-inline'>
                      <div class='form-group mx-sm-3 mb-2'>
                        <label for='inputPassword2' class='sr-only'>Password</label>
                        <input type='search' class='form-control' name='find' required value='' placeholder='Search'>
                    </div>
                    <button type='submit' class='btn btn-primary mb-2' name='search'>Search</button>
                    </form>
                    
                    
                    
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
               
                         <div class='panel panel-default'>
                        <div class='panel-heading text-center'>
        "
?>