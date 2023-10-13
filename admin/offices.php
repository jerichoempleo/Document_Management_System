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
                        <h1 class="h3 mb-0 text-gray-800">Offices</h1>
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
            <div class="modal fade" id="addOfficesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Office</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="offices-functions.php" method="POST">


                            <div class="modal-body">

                                <input type="hidden" name="add_ID" id="add_ID">

                                <div class="form-group">
                                    <label for="#">Sector Name</label>
                                  <!--  <input type="text" class="form-control" name="S_ID" id="add_Sector_Name"
                                        placeholder="Enter Sector Name" required> -->
                                    <select name = "S_ID" class="form-control">
                                        <option selected>Select Sector</option>
                                        <?php 
                                    
                                            $sector = getAll("sector");
                                        
                                            if(mysqli_num_rows($sector) > 0)
                                            {
                                                foreach ($sector as $sectorkfk) {
                                                    ?>
                                                        <option value="<?= $sectorkfk['Sector_ID']; ?>"><?= $sectorkfk['Sector_Name']; ?> </option>
                                                    <?php
                                                }
                                            }
                                            else 
                                            {
                                                echo "No Sector Available";
                                            }  

                                            function getAll($table) //Saan galing ung $table
                                            {
                                                    global $conn;
                                                    $query = "SELECT * FROM $table";
                                                    //$query = "SELECT * FROM `categories`"; //naganda rin to pero sariling code ko yan
                                                    return $query_run = mysqli_query($conn, $query); //Nasan ung variable na $query_run sa ibang file? Di raw sya nagamit
                                            }
                                                                                        
                                        ?>
                                    </select>
                                    
                                </div>

                                <div class="form-group">
                                    <label for="#">Office Name</label>
                                    <input type="text" class="form-control" name="Office_Name" id="add_Office_Name"
                                        placeholder="Enter Office Name" required>
                                </div>

                                <div class="form-group">
                                    <label for="#">Office Description</label>
                                    <input type="text" class="form-control" name="Office_Description"
                                        id="add_Office_Description" placeholder="Enter Office Description" required>
                                </div>

                                <div class="form-group">
                                    <label for="#">Office Head</label>
                                    <input type="text" class="form-control" name="Office_Head" id="add_Offic_Head" 
                                        placeholder="Enter Office Head" required> <!--Mali spell ng id-->
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="add_offices" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-success add_btn" data-toggle="modal" data-target="#addOfficesModal" style="margin-bottom: 8px; margin-top:10px;">Add
                Office</button>
        </td>

        <?php
        //Show data in Table
        $query = "SELECT * FROM office";
        $query_run = mysqli_query($conn, $query);
        ?>
        <table id="dataTableID" class="table table-bordered table table-striped " width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Office ID</th>
                    <th>Sector ID</th>
                    <th>Office Name</th>
                    <th>Office Description</th>
                    <th>Office Head</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <!--<th colspan ="2">Action</th> Hindi pwedeng may colspan para sa dataTables--> 
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($query_run) > 0) {
                    while ($row = mysqli_fetch_assoc($query_run)) {

                        ?>
                        <tr>
                            <td>
                                <?php echo $row['Office_ID']; ?>
                            </td>
                            <td>
                                <?php echo $row['S_ID']; ?>
                            </td>
                            <td>
                                <?php echo $row['Office_Name']; ?>
                            </td>
                            <td>
                                <?php echo $row['Office_Description']; ?>
                            </td>
                            <td>
                                <?php echo $row['Office_Head']; ?>
                            </td>

                            <td>
                                <!--Edit pop up Modal -->
                                <div class="modal fade" id="editOfficeModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Office</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <form action="offices-functions.php" method="POST">
                                                <div class="modal-body">


                                                    <input type="hidden" name="edit_ID" id="edit_ID">
                                                    <input type="hidden" name="s_ID" id="s_ID">
                                                    <!---Ang shit ng code na to... Literal na ginawan ko lng ng box para dun magstore ung sector ID-->

                                                    <div class="form-group">
                                                        <label for="#">Office Name</label>
                                                        <input type="text" class="form-control" name="Office_Name"
                                                            id="edit_Office_Name"> <!--Database attribute-->
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="#">Office Description</label>
                                                        <input type="text" class="form-control" name="Office_Description"
                                                            id="edit_Office_Description">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="#">Office Head</label>
                                                        <input type="text" class="form-control" name="Office_Head"
                                                            id="edit_Office_Head">
                                                    </div>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" name="update_office"
                                                        class="btn btn-primary">Update</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-success edit_btn" data-toggle="modal"
                                    data-target="#editOfficeModal">Edit</button>
                            </td>

                            <td>
                               <!--Delete Pop Up Modal -->
                        <div class="modal fade" id="deleteOfficesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Office</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                    <form action="offices-functions.php" method = "POST"> <!--Be careful sa file name. Nakakalito ung may s or walang s-->

                                        <div class="modal-body">
                                                <input type="hidden" name= "delete_ID" id ="delete_ID">
                                            <h5>Do you want to delete this data?</h5>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" name="delete_offices" class="btn btn-primary">Confirm</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>  

                      <!--  <form action="manage-users-function.php" method = "post"> -->
                          <!--  <input type = "hidden" name = "delete_id" value="<?php echo $row['Office_ID']; ?>"> -->
                            <button type ="submit" name = "delete_btn" class = "btn btn-danger delete_btn" style="background-color: maroon; border-color: maroon;">Delete</button>
                        <!--</form>-->
                            </td>
                        </tr>
                        <?php
                    }
                } else {
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



    


