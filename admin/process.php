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
                        <h1 class="h3 mb-0 text-gray-800">Processes</h1>
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
            <div class="modal fade" id="addProcessModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Process</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="process-function.php" method="POST"> <!--Note: Check lagi kung may s ba or wala ung mga file kasi magulo namin convention ko-->


                            <div class="modal-body">

                                <input type="hidden" name="add_ID" id="add_ID">

                                <div class="form-group">
                                    <label for="#">Office Name</label>
                                  <!--  <input type="text" class="form-control" name="S_ID" id="add_Sector_Name"
                                        placeholder="Enter Sector Name" required> -->
                                    <select name = "O_ID" class="form-control">
                                        <option selected>Select Office</option>
                                        <?php 
                                    
                                            $office = getAll("office");
                                        
                                            if(mysqli_num_rows($office) > 0)
                                            {
                                                foreach ($office as $officefk) {
                                                    ?>
                                                        <option value="<?= $officefk['Office_ID']; ?>"><?= $officefk['Office_Name']; ?> </option>
                                                    <?php
                                                }
                                            }
                                            else 
                                            {
                                                echo "No Process Available";
                                            }  

                                            function getAll($processTable) //Saan galing ung $table
                                            {
                                                    global $conn;
                                                    $query = "SELECT * FROM $processTable ORDER BY Office_Name ASC";
                                                    return $query_run = mysqli_query($conn, $query); //Nasan ung variable na $query_run sa ibang file? Di raw sya nagamit
                                            }
                                                                                        
                                        ?>
                                    </select>
                                    
                                </div>

                                <div class="form-group">
                                    <label for="#">Process Name</label>
                                    <input type="text" class="form-control" name="Process_Name" id="add_Process_Name"
                                        placeholder="Enter Process Name" required>
                                </div>

                                <div class="form-group">
                                    <label for="#">Process Description</label>
                                    <input type="text" class="form-control" name="Process_Description"
                                        id="add_Process_Description" placeholder="Enter Process Description" required>
                                </div>

                                <div class="form-group">
                                    <label for="#">Process Type</label>
                                    <input type="text" class="form-control" name="Process_Type" id="add_Process_Type"
                                        placeholder="Enter Process Head" required>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="add_process" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-success add_btn" data-toggle="modal" data-target="#addProcessModal" style="margin-bottom: 8px; margin-top:10px;">Add Process</button>
        </td>

<?php
//Show data in tables
$query ="SELECT * FROM process";
$query_run=mysqli_query($conn, $query);
?>
       <table id="dataTableID" class="table table-bordered table table-striped " width = "100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Process ID</th>
                    <th>Office ID</th>
                    <th>Process Name</th>
                    <th>Process Description</th>
                    <th>Process Type</th>
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
                    <td><?php echo $row['Process_ID']; ?></td>
                    <td><?php echo $row['O_ID']; ?></td>
                    <td><?php echo $row['Process_Name']; ?></td>
                    <td><?php echo $row['Process_Desciption']; ?></td>
                    <td><?php echo $row['Process_Type']; ?></td>
                    
                    <td>
                        <!--Edit Pop Up Modal -->
                        <div class="modal fade" id="editProcessModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Process</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                               <form action="process-function.php" method = "POST"> 


                                    <div class="modal-body">
                                    
                                            
                                            <input type="hidden" name= "edit_ID" id ="edit_ID">
                                            <input type="hidden" name= "o_ID" id ="o_ID"> <!---Ang shit ng code na to... Literal na ginawan ko lng ng box para dun magstore ung office ID-->

                                            <div class="form-group">
                                                <label for="#">Process Name</label>
                                                <input type="text" class="form-control" name="Process_Name" id="edit_Process_Name">
                                            </div>

                                            <div class="form-group">
                                                <label for="#">Process Description</label>
                                                <input type="text" class="form-control" name="Process_Description" id="edit_Process_Description">
                                            </div>

                                            <div class="form-group">
                                                <label for="#">Process Type</label>
                                                <input type="text" class="form-control" name="Process_Type" id="edit_Process_Type">
                                            </div>
            
                                    
                                    </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="update_process" class="btn btn-primary">Update</button>
                                        </div>
                                </form>
                                </div>
                            </div>
                        </div>  

                        <button type="button" class="btn btn-success edit_btn" data-toggle="modal" data-target="#editProcessModal">Edit</button>
                    </td>

                    <td>
                     <!--Delete Pop Up Modal -->
                     <div class="modal fade" id="deleteProcessModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete Process</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                               <form action="process-function.php" method = "POST"> <!--Becareful sa file name. Nakakalito ung may s or walang s-->


                                    <div class="modal-body">
                                            <input type="hidden" name= "delete_ID" id ="delete_ID">

                                           <h5>Do you want to delete this data?</h5>
                                    </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" name="delete_process" class="btn btn-primary">Confirm</button>
                                        </div>
                                </form>
                                </div>
                            </div>
                        </div>  

                      <!--  <form action="manage-users-function.php" method = "post"> -->
                          <!--  <input type = "hidden" name = "delete_id" value="<?php echo $row['Process_ID']; ?>"> -->
                            <button type ="submit" name = "delete_btn" class = "btn btn-danger delete_btn" style="background-color: maroon; border-color: maroon;">Delete</button>
                            <!--</form>-->
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



    


