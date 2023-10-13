<?php
    include 'connect.php';
    include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="style.css">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4@4/bootstrap-4.css" rel="stylesheet">

    <title>Registration Form</title> 
</head>
<body>
   


<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>

    <section class="registration-container">
        
        <div class="reg-body">
            <div class="reg-container">
                <header> Registration </header>

                <form action="#" method="POST" id="regForm">
                    <div class="tab first">
                        <div class="details">
                            <span class="title"> Details</span>

                            <div class="fields">
                                <div class="input-field">
                                    <label><i class="fa-solid fa-user"></i> First Name</label>
                                    <input type="text" name="fname" placeholder="Enter your first name" required>
                                </div>

                                <div class="input-field">
                                    <label><i class="fa-solid fa-user"></i> Last Name</label>
                                    <input type="text" name="lname" placeholder="Enter your last name" required>
                                </div>

                                <div class="input-field">
                                    <label><i class="fa-solid fa-envelope icon"></i> Email</label>
                                    <input type="text" name="email" placeholder="Enter your email" required>
                                </div>

                                <div class="input-field">
                                    <label><i class="fa-solid fa-lock"></i> Password</label>
                                    <input type="password" name="pass" placeholder="Enter your password" required>
                                </div>

                                <div class="input-field">
                                    <label><i class="fa-solid fa-lock"></i> Confirm Password</label>
                                    <input type="password" name="cpass" placeholder="Confirm your password" required>
                                </div>

                                <div class="input-field">
                                    <label for="usertype">User Type:</label>
                                    <select id="usertype" name="user_type">
                                        <option disabled selected>Select</option>
                                        <option value="PO">Process Owner</option>
                                        <option value="DC">Document Controller</option>
                                        <option value="IQMSO">Document Controller IQMSO</option>
                                        <option value="QMR">Quality Management Representative</option>
                                    </select>
                                </div>

                                <div class="input-field">
                                    <label>Sector</label>

                                    <?php
                                    $sector = '';
                                    $query = "SELECT * FROM Sector GROUP BY Sector_Name ORDER BY Sector_Name ASC";
                                    $result = mysqli_query($conn, $query);
                                    while($row = mysqli_fetch_array($result))
                                        {
                                        $sector .= '<option value="'.$row["Sector_ID"].'">'.$row["Sector_Name"].'</option>';
                                        }
                                    ?>

                                    <select name="search-sector" id="search-sector" class="form-control action">
                                        <option value="">Select Sector</option>
                                        <?php echo $sector; ?>
                                    </select>

                                    <input type="hidden" readonly = "readonly" name = "sector-holder" id = "sector-holder">

                                   <!--  <select id = 'search-sector' name = 'search-sector' class="chosen">
                                    <option value = '' disabled selected id = "searchSec">Select Sector</option>
                                    <?php
                                        $sql = "SELECT * FROM SECTOR ORDER BY Sector_Name";
                                        $result = mysqli_query($conn, $sql);
                                        while($row = mysqli_fetch_array($result)){
                                        
                                        ?>
                                        <option value="<?= $row['Sector_ID']; ?>"><?= $row['Sector_Name']; ?></option>
                                       <?php }?>
                                    </select> -->

                                </div>

                                <div class="input-field">
                                    <label>Office</label>
                                    <select name = "office" id ="office">
                                        <option value="" disabled selected>Select Office</option>
                                    </select>
                                    <input type="hidden" readonly = "readonly" name = "office-holder" id = "office-holder">
                                </div>

                                <div class="input-field">
                                    <label>Process</label>

                                    <select name = "process" id ="process">
                                        <option value="" disabled selected>Select Process</option>
                                    </select>

                                   <!--  <?php
                                       
                                        $query = mysqli_query($conn, "SELECT * FROM PROCESS");
                                        echo "<input type = 'text' name='process' list = 'process' placeholder = 'Select your process'/>";
                                        echo "<datalist id = 'process'>";
                                            while($row = mysqli_fetch_array($query)){
                                                echo "<option>$row[Process_Name] </option>";
                                            }

                                    echo"</datalist>";
                                    ?> -->
                                </div>

                            
                    
                            </div>

                                                                             
                        </div>

                        <input type="submit" name="submit" value="Register" class = "nextBtn">
                        
                        <div class="login-here">
                            <p>Already have an account?
                                <p class="login-underline"><a class="span" href = "login.php">Login Here</a></p>
                            </p>
                        </div>
                                               
                    </div>
                                 
                </form>
            </div>
        </div>
    <?php /*
        if(isset($_POST['submit'])) { //name ng register Register button
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $User_Type = $_POST['User_Type'];
            $sector = $_POST['sector'];
            $office = $_POST['office'];
            $process = $_POST['process'];
            $status = $_POST['status'];

            $select = "SELECT * FROM reg_form WHERE email= '$email";
            $result = mysqli_query($conn, $select);

            if(mysqli_num_rows($result) > 0){
                echo '<script type = "text/javascript">';
                echo 'alert("Email Already Taken!")';
                echo 'window.location.href = "register.php"'; //May mali ata dito sa register
                echo '</script>';
            }
        }
    */ ?> 
      

    </section>

    <?php include 'footer.php';?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    
    <script>
        $("#search-sector").chosen();
    </script>

    <script>
        $("#office").chosen();
    </script>

    <script>
        $("#process").chosen();
    </script>

    <script>
        $(function(){
            $("#search-sector").change(function(){
                var displaySector = $("#search-sector option:selected").text();
                $("#sector-holder").val(displaySector);
            });
        })
    </script>

    <script>
        $(function(){
            $("#office").change(function(){
                var displayOffice = $("#office option:selected").text();
                $("#office-holder").val(displayOffice);
            });
        })
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#search-sector").change(function(){
                var Sector_ID = $(this).val();
                $.ajax({
                    url:"select.php",
                    method:"POST",
                    data:{SectorID:Sector_ID},
                    success:function(data){
                        $("#office").html(data);
                        $("#office").chosen().change().trigger('chosen:updated');
                    }
                });
            });
        });
    </script>

<script type="text/javascript">
        $(document).ready(function(){
            $("#office").change(function(){
                var Office_ID = $(this).val();
                $.ajax({
                    url:"process.php",
                    method:"POST",
                    data:{OfficeID:Office_ID},
                    success:function(data){
                        $("#process").html(data);
                        $("#process").chosen().change().trigger('chosen:updated');
                    }
                });
            });
        });
    </script>

    <script>
        $(document).on('submit', '#regForm', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("reg_Form", true);

            $.ajax({
                type: "POST",
                url: "action.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);

                    if(res.status == 200){
                      Swal.fire({
                        title: 'Registration Success',
                      //  text: 'Registration Successful',
                        text: 'Account is now pending for approval ',
                        icon: 'success',
                        }).then(function(){
                          window.location = "login.php";
                        });
                    }
                    else if(res.status == 500){
                      Swal.fire({
                        title: 'Failed',
                        text: 'An Error Occured! Please Try Again',
                        icon: 'error',
                        footer: '<a href="login.php" style = "color: darkred;">Have an account already?</a>',
                        }).then(function(){
                          window.location = "register.php";
                        });
                    }
                    else if(res.status == 1){
                        Swal.fire({
                        title: 'Failed',
                        text: 'Error! Password does not match.',
                        icon: 'error',
                        footer: '<a href="login.php" style = "color: darkred;">Have an account already?</a>',
                        }).then(function(){
                          window.location = "register.php";
                        });
                    }

                }
            });

        });
    </script>

</body>
</html>

