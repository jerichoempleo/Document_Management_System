<?php 
include('includes/header.php');
include('includes/navbar.php');
include('database-connect/connect.php');
?>
        
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                
                 <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4" style="margin-top: 27px; margin-left: 10px;">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                  <!-- Topbar Search 
                  <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn primarybtn-new" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>-->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) 
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            Dropdown - Messages 
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>-->

                        

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
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                      <!-- Pop up filter -->
                      <div class="modal fade" id="exampleModalPop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        Filter Table:                            
                                        <select name="section" id="section">
                                            <option value="" disabled selected></option>
                                            <option value="Operations">Operations</option>
                                            <option value="Leadership and Planning">Leadership and Planning</option>
                                            <option value="Support">Support</option>
                                            <option value="Performance Evaluation">Performance Evaluation</option>
                                        </select>

                                        <select name="Type" id="Type">
                                            <option value="" disabled selected></option>
                                            <option value="Quality Manual">Quality Manual</option>
                                            <option value="Process Manual">Process Manual</option>
                                            <option value="Work Instruction Manual">Work Instruction Manual</option>
                                            <option value="Forms Manual">Forms Manual</option>
                                            <option value="Reference Manual">Reference Manual</option>
                                            <option value="Risk Register Manual">Risk Register Manual</option>
                                            <option value="Job Description Manual">Job Description Manual</option>
                                            
                                            

                                        </select>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: none; background-color: inherit;">
                                    <i class="fa-solid fa-xmark" style="font-size: 20px;"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php 
                                     $sql = "SELECT dc.Document_ID, dc.Document_Code, dc.Document_Type, dc.Document_Title, dt.Section
                                     FROM document dc, dcrf_table dt where dc.DCRF_ID = dt.Revision_ID";
                                     $result = mysqli_query($conn, $sql);
                                     $files = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                    ?>
                                    <table id="Doc_Table" class="table table-striped" style="width:100%"  data-page-length='15'>
                                        <thead>
                                            <th>ID</th>
                                            <th>Section</th>
                                            <th>Code</th>
                                            <th>Filename</th>
                                            <th>Document Type</th>
                                        </thead>

                                        <tbody>
                                        <?php foreach ($files as $file): ?>
                                            <tr>
                                            <td><?php echo $file['Document_ID']; ?></td>
                                            <td><?php echo $file['Section']; ?></td>
                                            <td><?php echo $file['Document_Code']; ?></td>
                                            <td><?php echo $file['Document_Title']; ?></td>
                                            <td><?php echo $file['Document_Type']; ?></td>                                        
                                            </tr>
                                        <?php endforeach;?>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: maroon;">Close</button>
                                </div>
                                </div>
                            </div>
                        </div>
                         <!--End Pop up filter -->

                        <!-- Total Documents Card-->
                        <div class="col-xl-3 col-md-6 mb-4" data-toggle="modal" data-target="#exampleModalPop">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Documents</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                                $total_documents_query = "SELECT COUNT(*) AS total_documents FROM document";
                                                $total_documents_result = mysqli_query($conn, $total_documents_query);

                                                if(mysqli_num_rows($total_documents_result) > 0){
                                                    while($row = mysqli_fetch_assoc($total_documents_result)){
                                                        echo '<div class="h5 mb-0 font-weight-bold text-gray-800">'.$row['total_documents'].'</div>';
                                                    }
                                                }
                                            ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-file fa-2x text-gray-300" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Process Owners Card -->
                        <div class="col-xl-3 col-md-6 mb-4"> 
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Users</div>

                                                <?php
                                                    $total_users_query = "SELECT COUNT(reg_id) AS total_users FROM reg_form WHERE status = 'approved'";
                                                    $total_users_result = mysqli_query($conn, $total_users_query);

                                                    if(mysqli_num_rows($total_users_result) > 0){
                                                        while($row = mysqli_fetch_assoc($total_users_result)){
                                                            echo '<div class="h5 mb-0 font-weight-bold text-gray-800">'.$row['total_users'].'</div>';
                                                        }
                                                    }
                                                ?>

                                            
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Pending Documents Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pending Documents

                                            <?php
                                                $total_pending_documents_query = "SELECT COUNT(*) AS total_pending_documents FROM dcrf_table WHERE status = '0'";
                                                $total_pending_documents_result = mysqli_query($conn, $total_pending_documents_query);
                
                                                if(mysqli_num_rows($total_pending_documents_result) > 0){
                                                    while($row = mysqli_fetch_assoc($total_pending_documents_result)){
                                                        echo '<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">'.$row['total_pending_documents'].'</div>';
                                                    }
                                                }
                                            ?>
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Approved Documents Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Approved Documents

                                                <?php
                                                $total_approved_documents_query = "SELECT COUNT(*) AS total_approved_documents FROM dcrf_table WHERE status = '1'";
                                                $total_approved_documents_result = mysqli_query($conn, $total_approved_documents_query);
                
                                                if(mysqli_num_rows($total_approved_documents_result) > 0){
                                                    while($row = mysqli_fetch_assoc($total_approved_documents_result)){
                                                        echo '<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">'.$row['total_approved_documents'].'</div>';
                                                    }
                                                }
                                            ?>
                                            
                                            </div>
                                            
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-check fa-2x text-gray-300" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Returned Card-->
                        <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-sector shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Returned Documents</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                    $total_returned_query = "SELECT COUNT(*) AS total_returned FROM dcrf_table WHERE Status = 2";
                                                    $total_returned_result = mysqli_query($conn, $total_returned_query);

                                                    if(mysqli_num_rows($total_returned_result) > 0){
                                                        while($row = mysqli_fetch_assoc($total_returned_result)){
                                                            echo '<div class="h5 mb-0 font-weight-bold text-gray-800">'.$row['total_returned'].'</div>';
                                                        }
                                                    }
                                                ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                            <i class="fa fa-arrow-left text-gray-300" aria-hidden="true" style="font-size:30px;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <!-- Total Sectors Card-->
                        <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-sector shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Sectors</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                    $total_sectors_query = "SELECT COUNT(*) AS total_sectors FROM sector";
                                                    $total_sectors_result = mysqli_query($conn, $total_sectors_query);

                                                    if(mysqli_num_rows($total_sectors_result) > 0){
                                                        while($row = mysqli_fetch_assoc($total_sectors_result)){
                                                            echo '<div class="h5 mb-0 font-weight-bold text-gray-800">'.$row['total_sectors'].'</div>';
                                                        }
                                                    }
                                                ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                            <i class="fa fa-sitemap text-gray-300" aria-hidden="true" style="font-size:30px;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Total Offices Card -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-office shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Offices</div>

                                                    <?php
                                                        $total_offices_query = "SELECT COUNT(*) AS total_offices FROM office";
                                                        $total_offices_result = mysqli_query($conn, $total_offices_query);

                                                        if(mysqli_num_rows($total_offices_result) > 0){
                                                            while($row = mysqli_fetch_assoc($total_offices_result)){
                                                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800">'.$row['total_offices'].'</div>';
                                                            }
                                                        }
                                                    ?>                                            
                                            </div>
                                            <div class="col-auto">
                                            <i class="fa fa-building text-gray-300" aria-hidden="true" style="font-size:30px;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Processes Card -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-process shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Processes</div>

                                                    <?php
                                                        $total_processes_query = "SELECT COUNT(*) AS total_processes FROM process";
                                                        $total_processes_result = mysqli_query($conn, $total_processes_query);

                                                        if(mysqli_num_rows($total_processes_result) > 0){
                                                            while($row = mysqli_fetch_assoc($total_processes_result)){
                                                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800">'.$row['total_processes'].'</div>';
                                                            }
                                                        }
                                                    ?>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fa fa-cog text-gray-300" aria-hidden="true" style="font-size:30px;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>                       

                    <!-- Content Row -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
            <script>
                $(document).ready(function(){
                    $("#section").on('change', function(){
                        var value = $(this).val();
                        $.ajax({
                            url:"filter.php",
                            type:"POST",
                            data:'request=' + value,
                            beforeSend:function(){
                                $(".modal-body").html("<span>Loading...</span>");
                            },
                            success:function(data){
                                $(".modal-body").html(data);
                            }
                        });
                    });
                });

                $(document).ready(function(){
                    $("#Type").on('change', function(){
                        var value = $(this).val();
                        $.ajax({
                            url:"filter.php",
                            type:"POST",
                            data:'requestType=' + value,
                            beforeSend:function(){
                                $(".modal-body").html("<span>Loading...</span>");
                            },
                            success:function(data){
                                $(".modal-body").html(data);
                            }
                        });
                    });
                });
            </script>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>



    