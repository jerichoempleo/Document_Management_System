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
                        <h1 class="h3 mb-0 text-gray-800">Manage Documents</h1>
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

<?php
//Displaying data into tables
$query ="SELECT * FROM document";
$query_run=mysqli_query($conn, $query);
?>
        <table id = "dataTableID" class="table table-bordered table table-striped " width = "100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Document ID</th>
                  
                    <th>Register ID</th>
                    <th>Section</th>
                    <th>Document Code</th>
                    <th>Document Title</th>
                    <th>Document Type</th>
                    <th>Uploader</th>
                   
                    <th>Approver</th>
                  
                    <th>Revision Number</th>
                    <th>Effectivity Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(mysqli_num_rows($query_run) > 0) {
                        while($row=mysqli_fetch_assoc($query_run))
                        {
                
                            ?>
                <tr>
                    <td><?php echo $row['Document_ID']; ?></td>
                   
                    <td><?php echo $row['User_ID']; ?></td>
                    <td><?php echo $row['Section']; ?></td>
                    <td><?php echo $row['Document_Code']; ?></td>
                    <td><?php echo $row['Document_Title']; ?></td>
                    <td><?php echo $row['Document_Type']; ?></td>
                    <td><?php echo $row['Uploader']; ?></td>
                 
                    <td><?php echo $row['Approver']; ?></td>
                   
                    <td><?php echo $row['Revision_no']; ?></td>
                    <td><?php echo $row['Effectivity_Date']; ?></td>
                    <td>
                        <!--Edit Pop Up Modal -->
                        <div class="modal fade" id="editManageDocumentsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Document</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                               <form action="manage-documents-function.php" method = "POST"> 


                                    <div class="modal-body">
                                    
                                            <input type="hidden" name= "edit_ID" id ="edit_ID">

                                            <div class="form-group">
                                                <label for="#">Document Title</label>
                                                <input type="text" class="form-control" name="Document_Title" id="edit_Document">
                                            </div>
                    
                                    </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="update_manage_documents" class="btn btn-primary">Update</button>
                                        </div>
                                </form>
                                </div>
                            </div>
                        </div>  

                        <button type="button" class="btn btn-success edit_btn" data-toggle="modal" data-target="#editManageDocumentsModal">Edit</button>
                    </td>

                    <!--Delete Pop Up Modal -->
                    <div class="modal fade" id="deleteDocumentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete Document</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                               <form action="manage-documents-function.php" method = "POST"> 


                                    <div class="modal-body">
                                    
                                            <input type="hidden" name= "delete_ID" id ="delete_ID">

                                           <h5>Do you want to delete this data?</h5>

            
                                    
                                    </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" name="delete_document" class="btn btn-primary">Confirm</button>
                                        </div>
                                </form>
                                </div>
                            </div>
                        </div> 

                    <td>
                            <!--<form action="manage-documents-function.php" method = "post"> 
                                <input type = "hidden" name = "delete_ID" value="<?php echo $row['Document_ID']; ?>">-->
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



    


