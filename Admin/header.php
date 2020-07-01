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
                <a class='navbar-brand' href='index.html'>Admin</a> 
            </div>
  <div style='color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;'><a href='logout.php' class='btn btn-danger square-btn-adjust'>Logout</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class='navbar-default navbar-side' role='navigation'>
            <div class='sidebar-collapse'>
                <ul class='nav' id='main-menu'>
				<li class='text-center'>
                    <img src='assets/img/find_user.png' class='user-image img-responsive'/>
                    </li>
                    <li>
                        <a href='index.php'><b>Dashboard</b></a>
                    </li>					
                    <li>
                    <a href='weeklyMenu.php'><b>Weekly Menu</b></a>
                    </li>
                    <li>
                        <a href='registeredCook.php'><b>Registered Cooks</b></a>
                    </li>
                     <li>
                        <a  href='unverifiedCook.php'><b>Unverified Cooks</b></a>
                    </li>
                    <li>
                        <a  href='registeredUser.php'><b>Registered Users</b></a>
                    </li>				
					                   
                    <li>
                        <a href='#'><b>Posts</b><span class='fa arrow'></span></a>
                        <ul class='nav nav-second-level'>
                            <li>
                                <a href='livePost.php'><b>Live Posts</b></a>
                            </li>
                            <li>
                                <a href='pendingPost.php'><b>Pending Posts</b></a>
                            </li>
                            <li>
                                <a href='deletedPost.php'><b>Deleted Posts</b></a>
                            </li>
                                </ul>
                               
                            </li>
                        </ul>
                      </li>  
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id='page-wrapper' >
            <div id='page-inner'>
                <div class='row'>
                    <div class='col-md-6'>
                     <h2>Admin Panel</h2>   
                        <h5>Welcome Anum Rehman, Love to see you back. </h5>
                    </div>
        "
?>