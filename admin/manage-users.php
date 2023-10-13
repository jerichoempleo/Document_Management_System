<?php
include('includes/header.php');
include('includes/navbar.php');
include('../admin/database-connect/connect.php');
?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow newtopbar" style="margin-bottom:0;">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                
                 <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4" style="margin-top: 27px; margin-left: 10px;">
                        <h1 class="h3 mb-0 text-gray-800">Manage Users</h1>
                    </div>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Welcome, Admin</span>
                                <img class="img-profile rounded-circle" src="img/icons8-male-user-50.png">
                            </a>
                            
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="card-body">

                    <div class="table-responsive">

                    <td>
                    <!--Add Pop Up Modal -->
                    <div class="modal fade" id="addManageUsersModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <form action="manage-users-function.php" method = "POST"> 


                                                <div class="modal-body">
                                                
                                                        <input type="hidden" name= "add_ID" id ="add_ID">

                                                        <div class="form-group">
                                                            <label for="#">First Name</label>
                                                            <input type="text" class="form-control" name="fname" id="add_First_Name" placeholder="Enter First Name" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="#">Last Name</label>
                                                            <input type="text" class="form-control" name="lname" id="add_Last_Name" placeholder="Enter Last Name" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="#">Email</label>
                                                            <input type="text" class="form-control" name="email" id="add_Email" placeholder="Enter email" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="#">Sector</label>
                                                            <input type="text" class="form-control" name="sector" id="add_Sector" placeholder="Enter sector" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="#">Office</label>
                                                            <input type="text" class="form-control" name="office" id="add_Office" placeholder="Enter office" required>
                                                        </div>
                                                        <!--
                                                        <div class="form-group">
                                                            <label for="#">department</label>
                                                            <input type="text" class="form-control" name="department" id="add_Department" placeholder="Enter department" required>
                                                        </div> -->

                                                        <div class="form-group">
                                                            <label for="#">Process</label>
                                                            <input type="text" class="form-control" name="process" id="add_process" placeholder="Enter process" required>
                                                        </div>
                                                
                                                </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="add_manage_users" class="btn btn-primary">Submit</button>
                                                    </div>
                                            </form>
                                    </div>
                                </div>
                </div>  
                            <button type="button" class="btn btn-success add_btn" data-toggle="modal" data-target="#addManageUsersModal" style="margin-bottom: 20px;">Add Users</button>
            </td>


            <?php
            //Displaying data into tables
            $query ="SELECT * FROM reg_form WHERE status = 'approved'";
            $query_run=mysqli_query($conn, $query);
            ?>
            <table id = "dataTableID" class="table table-bordered table table-striped" width = "100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Register ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>User Type</th>
                        <th>Sector</th>
                        <th>Office</th>
                        <th>Process</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <!--<th colspan ="2">Action</th> Hindi pwedeng may colspan para sa dataTables--> 
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(mysqli_num_rows($query_run) > 0) {
                            while($row=mysqli_fetch_assoc($query_run))
                            {
                        
                                ?>
                    <tr>
                        <td><?php echo $row['Reg_ID']; ?></td>
                        <td><?php echo $row['fname']; ?></td>
                        <td><?php echo $row['lname']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['User_Type']; ?></td>
                        <td><?php echo $row['sector']; ?></td>
                        <td><?php echo $row['office']; ?></td>
                        <td><?php echo $row['process']; ?></td>
                        

                        <td>
                            <!--Edit Pop Up Modal -->
                            <div class="modal fade" id="editManageUsersModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                <form action="manage-users-function.php" method = "POST"> 


                                        <div class="modal-body">
                                        
                                                <input type="hidden" name= "edit_ID" id ="edit_ID">

                                                <div class="form-group">
                                                    <label for="#">First Name</label>
                                                    <input type="text" class="form-control" name="fname" id="edit_First_Name">
                                                </div>

                                                <div class="form-group">
                                                    <label for="#">Last Name</label>
                                                    <input type="text" class="form-control" name="lname" id="edit_Last_Name">
                                                </div>

                                                <div class="form-group">
                                                    <label for="#">Email</label>
                                                    <input type="text" class="form-control" name="email" id="edit_Email">
                                                </div>

                                                <div class="form-group">
                                                    <label for="#">User Type</label>
                                                    <input type="text" class="form-control" name="User_Type" id="edit_User_Type">
                                                </div>

                                                <div class="form-group">
                                                    <label for="#">Sector</label>
                                                    <input type="text" class="form-control" name="sector" id="edit_Sector">
                                                </div>

                                                <div class="form-group">
                                                    <label for="#">Office</label>
                                                    <input type="text" class="form-control" name="office" id="edit_Office">
                                                </div>
                                                <!--
                                                <div class="form-group">
                                                    <label for="#">department</label>
                                                    <input type="text" class="form-control" name="department" id="edit_Department">
                                                </div> -->

                                                <div class="form-group">
                                                    <label for="#">Process</label>
                                                    <input type="text" class="form-control" name="process" id="edit_Process">
                                                </div>

                
                                        
                                        </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" name="update_manage_users" class="btn btn-primary">Update</button>
                                            </div>
                                    </form>
                                    </div>
                                </div>
                            </div>  

                            <button type="button" class="btn btn-success edit_btn" data-toggle="modal" data-target="#editManageUsersModal">Edit</button>
                        </td>

                        <td>

                        <!--Delete Pop Up Modal -->
                        <div class="modal fade" id="deleteManageUsersModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                <form action="manage-users-function.php" method = "POST"> 


                                        <div class="modal-body">
                                        
                                                <input type="hidden" name= "delete_ID" id ="delete_ID">

                                            <h5>Do you want to delete this data?</h5>

                
                                        
                                        </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" name="delete_manage_users" class="btn btn-primary">Confirm</button>
                                            </div>
                                    </form>
                                    </div>
                                </div>
                            </div>  

                        <!--  <form action="manage-users-function.php" method = "post"> -->
                            <!--  <input type = "hidden" name = "delete_id" value="<?php echo $row['Reg_ID']; ?>"> -->
                                <button type ="submit" name = "delete_btn" class = "btn btn-danger delete_btn" style="background-color: maroon; border-color: maroon;">Delete</button>
                        <!-- </form> -->
                        </td>
                    </tr>
                    <?php
                            }
                        }
                        else 
                        {
                            echo "No Record Found";
                        }
                        ?>
                </tbody>
            </table>
    </div>
</div>



<?php
include('includes/scripts.php');
include('includes/footer.php');
?>



    


