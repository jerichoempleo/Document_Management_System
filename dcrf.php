<?php
    include 'connect.php';
    include 'insideheader.php';
    require 'authUser.php';
    include 'subnavbar.php';

    /* if(!isset($user_id)){
      header('location:login.php');
    }; */
    
    $select_user = mysqli_query($conn, "SELECT * FROM `reg_form` WHERE Reg_ID = '$user_id'") or die('query failed');
    if(mysqli_num_rows($select_user) > 0){
        $fetch_user = mysqli_fetch_assoc($select_user);
    };

    $sql = "SELECT * FROM document WHERE User_ID = '$user_id'";
    $result = mysqli_query($conn, $sql);
    $files = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>DCRF</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/dcrf.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4@4/bootstrap-4.css" rel="stylesheet">

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->

    <style>
      .chosen-container-single .chosen-single {
          height: 43.5px !important;
          border-radius: 3px;
          border: 1px solid #CCCCCC;
      }
      .chosen-container-single .chosen-single span {
          padding-top: 9px;
      }
      .chosen-container-single .chosen-single div b {
          margin-top: 9px;
      }

      .chosen-container-active .chosen-single,
      .chosen-container-active.chosen-with-drop .chosen-single {
          border-color: #fff;
          border-color: maroon !important;
          outline: 0;
          outline: thin dotted \9;
          -moz-box-shadow: 0 0 8px rgba(82, 168, 236, .6);
          box-shadow: 0 0 8px rgba(82, 168, 236, .6)
      }
    </style>
    
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="main-cont">

  
  <div class="container">
    <div class="title">Document Change Request Form</div>
    <div class="content">
      <form action="dcrf.php" method="post" enctype="multipart/form-data" id = "dcrfForm"> 

      <input type="hidden" name = "userid" value="<?php echo ($fetch_user['Reg_ID']); ?>" readonly>
    
      <div class="action-details">
          <input type="radio" name="action" id="dot-1" value="creation" onclick="EnableDisableTB(); hideShowPopUp(1)">
          <input type="radio" name="action" id="dot-2" value="revision" onclick="EnableDisableTB(); hideShowPopUp(2)">
          <input type="radio" name="action" id="dot-3" value="deletion" onclick="EnableDisableTBDe(); hideShowPopUp(3)">
          <span class="action-title">Purpose of Change</span>
          <div class="category">
            <label for="dot-1">
            <span class="dot one"></span>
            <span class="action" style="font-size: 18px; font-weight: 500;">Creation</span>
          </label>
          <label for="dot-2">
            <span class="dot two"></span>
            <span class="action" name = "Revision" style="font-size: 18px; font-weight: 500;">Revision</span>
          </label>
          <label for="dot-3">
            <span class="dot three"></span>
            <span class="action" style="font-size: 18px; font-weight: 500;">Deletion</span>
            </label>
          </div>

        </div>

        <div class="user-details">

        <div class="input-box">
          <span class="details">Section</span>
          <?php
          $section = '';
          $query = "SELECT * FROM Section GROUP BY Section_Name ORDER BY Section_Name ASC";
          $result = mysqli_query($conn, $query);
          while($row = mysqli_fetch_array($result))
          {
            $section .= '<option value="'.$row["Section_ID"].'">'.$row["Section_Name"].'</option>';
          }
          ?>
          <select name="section-holder" id="section-holder" class="form-control action">
          <option value="" disabled selected>Select Section</option>
            <?php echo $section; ?>
          </select>

          <input type="hidden" readonly = "readonly" name = "section" id = "section">
         <!--  <input list="sections" name="section" id="section" placeholder="Select Section" required autocomplete="off">
          <datalist id="sections">
            <option value="Section 1"></option>
            <option value="Section 2"></option>
            <option value="Section 3"></option>
            <option value="Section 4"></option>
            <option value="Section 5"></option>
          </datalist> -->

        </div>

          <div class="input-box">
            <span class="details">Document Code</span>
            <input type="text" placeholder="Enter document code" id="code" name = "DocCode" readonly>
          </div>

          <div class="input-box">
            <span class="details">Subject/Document Title</span>
            <input type="text" placeholder="Enter document title" required id="docuTitle" name="docuTitle">
          </div>

          <?php
            $select_user = mysqli_query($conn, "SELECT * FROM `reg_form` WHERE Reg_ID = '$user_id'") or die('query failed');
            if(mysqli_num_rows($select_user) > 0){
                $fetch_user = mysqli_fetch_assoc($select_user);
            };
          ?>

          <div class="input-box">
            <span class="details">Sector</span>
            <input type="show" required id="sector" name="sector" readonly value="<?php echo $fetch_user['sector']; ?>">
          </div>

          <div class="input-box">
            <span class="details">Document Type</span>
            <?php
            $type = '';
            $query = "SELECT * FROM Type GROUP BY Type_Name ORDER BY Type_Name ASC";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_array($result))
            {
              $type .= '<option value="'.$row["Type_ID"].'">'.$row["Type_Name"].'</option>';
            }
            ?>
            <select name="type-holder" id="type-holder" class="form-control action">
            <option value="" disabled selected>Select Document Type</option>
              <?php echo $type; ?>
            </select>

            <input type="hidden" readonly = "readonly" name = "doctype" id = "doctype">

            <!-- <select name = "doctype" id ="doctype" required>
                 <option value="" disabled selected>Select Document Type</option>
                 <option value="Type 1">Type 1</option>
                 <option value="Type 2">Type 2</option>
                 <option value="Type 3">Type 3</option>
                 <option value="Type 4">Type 4</option>
                 <option value="Type 5">Type 5</option>
            </select>   -->
          </div>

          <div class="input-box">
            <input type="hidden" readonly id="revno" name="revno">
          </div>
               
          <div class="input-box" style="width: 100%;">
            <span class="details">Notes</span>
            <textarea name="editor1" id="notes"></textarea>
          </div>
        </div>
      

        <div class = "MainDcrf revision">
        <h2 style="font-size: 25px;">Revision</h2>  

        <div class="user-details">
          <div class="input-box">
            <span class="details">Any documents affected by this change?</span>
            <select name="effect" id="effect" style="margin-bottom: 10px;">
            <option value="0" disabled selected>Select</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
            <input type="file" name="myfile[]" id = "AffectedDocu" multiple class="form-control" disabled>
            <span class="details" id = "oldcodeHolder">Document Code</span>
            <input type="text" placeholder="Enter document code" id="AffectedCode" name="OldCode" disabled>
            </div>

          <div class="input-box">
          <span class="details">New responsibilities?</span>
            <select name="new" id="new" style="margin-bottom: 10px;">
            <option value="0" disabled selected>Select</option>
            <option value="1">Yes</option>
            <option value="2">No</option>
            <input type="text" placeholder="Specify..." id="NewRes" name = "NewRes" disabled>
            
          </div>
          
          <div class="input-box">
          <span class="details">Old Revison Effectivity Date</span>
            <input type="date" placeholder="Enter document title" style="margin-top: 34px;" name="oldDate" id="oldDate" readonly> 
          </div>

          <input type="hidden" name= "email" value="<?php echo ucwords(htmlentities($fetch_user['fname'])); ?>" class="form-control" readonly="">
          <input type="hidden" name= "status" value="0">
        </div>
       
    </div>
<!------------------------------------- creation ----------------------------->
    

<div class = "MainDcrf creation">
        <h2 style="font-size: 25px;">Creation</h2>
       
          <!-- <textarea name="editor1"></textarea>
          <div class="button">
          <input type="submit" value="Save" name="saveCr">
          </div>   -->
  </div>

    <div class = "MainDcrf deletion">
        <h2 style="font-size: 25px;">Deletion</h2>
    </div>

    <div class="user-details">
      <div class="input-box">
        <span class="details" style="margin-top: 50px;">Attach File</span>
        <input type="file" name="Newfile[]" id = "NewFile" multiple class="form-control" required>
      </div>
    </div>

    <div class="button">
          <input type="submit" value="Submit" name="save">
        </div>
      </form>
    </div>
  </div>
  </div>

  <div class="overlay" id="divOne" style="display: none;">
  <div class="wrapper">
  <h2>Choose document</h2><a class="close" href="dcrf.php">&times;</a>
    <table id="Doc_Table" border="1">
        <thead id = "table">
            <th>ID</th>
            <th>Filename</th>
            <th>Code</th>
            <th>Author</th>
            <th>Effectivity Date</th>
            <th>Revision No</th>
        </thead>

        <tbody class="tbody">
        <?php foreach ($files as $file): ?>
            <tr class = "tr">
            <td><?php echo $file['Document_ID']; ?></td>
            <td><?php echo $file['Document_Title']; ?></td>
            <td><?php echo $file['Document_Code']; ?></td>
            <td><?php echo $file['Uploader']; ?></td>
            <td><?php echo $file['Effectivity_Date']; ?></td>
            <td><?php echo $file['Revision_no']; ?></td>
            </tr>
        <?php endforeach;?>
        
        </tbody>
    </table>
</div>
	</div>

  <?php 
    include 'footer.php';
  ?>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" rel="stylesheet">

<script>
  $("#type-holder").chosen();
  $("#section-holder").chosen();

</script>

<script>
    function EnableDisableTB() {
        var revision = document.getElementById("dot-2");
        var code = document.getElementById("code");
        code.disabled = revision.checked ? false : true;
		code.value="";
        if (!code.disabled) {
            code.focus();
        }
    }

    function EnableDisableTBDe() {
        var deletion = document.getElementById("dot-3");
        var code = document.getElementById("code");
        code.disabled = deletion.checked ? false : true;
		code.value="";
        if (!code.disabled) {
            code.focus();
        }
    }
</script>

<script>
  $('form').submit(function(e) {
    $(':disabled').each(function(e) {
        $(this).removeAttr('disabled');
    })
});
</script>

<script>
    $(document).ready(function(){
        $('input[type="radio"]').click(function(){
            var input = $(this).attr("value");
            var target = $("." + input);
            $(".MainDcrf").not(target).hide();
            $(target).show();
        });
    });
</script> 

<!-- <script>
  function yesNoEffect(){
    var status = document.getElementById("effect");
    if(status.value == "2" || status.value == "0"){
      document.getElementById("AffectedDocu").style.visibility = "hidden";
      document.getElementById("AffectedCode").style.visibility = "hidden";
      document.getElementById("oldcodeHolder").style.visibility = "hidden";
    }
    else{
      document.getElementById("AffectedDocu").style.visibility = "visible";
      document.getElementById("AffectedCode").style.visibility = "visible";
      document.getElementById("oldcodeHolder").style.visibility = "visible";
    }
  }
</script>

<script>
  function yesNoRes(){
    var status = document.getElementById("new");
    if(status.value == "2" || status.value == "0"){
      document.getElementById("NewRes").style.visibility = "hidden";
    }
    else{
      document.getElementById("NewRes").style.visibility = "visible";
    }
  }
</script> -->

<script>
    $(function () {
        $("#effect").change(function () {
            if ($(this).val() == 1) {
                $("#AffectedDocu").removeAttr("disabled");
                $("#AffectedDocu").focus();
                $("#AffectedCode").removeAttr("disabled");
                $("#AffectedCode").focus();
            } else {
                $("#AffectedDocu").attr("disabled", "disabled");
                $("#AffectedCode").attr("disabled", "disabled");
            }
        });
    });
</script>

<script>
    $(function () {
        $("#new").change(function () {
            if ($(this).val() == 1) {
                $("#NewRes").removeAttr("disabled");
                $("#NewRes").focus();
            } else {
                $("#NewRes").attr("disabled", "disabled");
            }
        });
    });
</script>

<script>
    function hideShowPopUp(val){
      if(val == 1){
        document.getElementById('divOne').style.display = 'none';
      }
      if(val == 2 || val == 3){
        document.getElementById('divOne').style.display = 'block';
      }
    }
</script>

<script>
  $('#Doc_Table').click(function(){       
    $('#divOne').hide();
});
</script>


<script>
    var docuTable = document.getElementById('Doc_Table'), rIndex;

    for(var i = 1; i < docuTable.rows.length; i++){
        docuTable.rows[i].onclick = function(){
            rIndex = this.rowIndex;
            document.getElementById("docuTitle").value = this.cells[1].innerHTML;
            document.getElementById("code").value = this.cells[2].innerHTML; 
            document.getElementById("oldDate").value = this.cells[4].innerHTML; 
            document.getElementById("revno").value = this.cells[5].innerHTML;
        }
    }
</script>

</script>

<!-----------------------------------editor ---------------------------------->
   
<script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
<script>
   CKEDITOR.replace( 'editor1' );
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>



<!-----------------------------------Revision ---------------------------------->
<script>
    $(document).on('submit', '#dcrfForm', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("dcrf_Form", true);

            bootbox.confirm({
            title: 'Submit Document',
            message: 'Submit your Document Change Request Form for approval?',
            buttons: {
                cancel: {
                    label: '<i class="fa fa-times"></i> Cancel'
                },
                confirm: {
                    label: '<i class="fa fa-check"></i> Confirm'
                }
            },
            callback:function (result) {
              if (result){
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
                            title: "Success",
                            text: "Submitted, Please wait for Approval.",
                            icon: "success",
                            }).then(function(){
                              window.location = "dcrf.php";
                              $('#dcrfForm')[0].reset();
                            });
                        }
                        else if(res.status == 500){
                          Swal.fire({
                            title: "Failed",
                            text: "Error Occur! Please Try Again",
                            icon: "error",
                            }).then(function(){
                              
                              $('#dcrfForm')[0].reset();
                            });
                        }
                    }
                });
              }
            }
        });
    });
      
</script>

<script>
        $(function(){
            $("#section-holder").change(function(){
                var displaySection = $("#section-holder option:selected").text();
                $("#section").val(displaySection);
            });
        });

        $(function(){
            $("#type-holder").change(function(){
                var displaySection = $("#type-holder option:selected").text();
                $("#doctype").val(displaySection);
            });
        });
</script>

</body>
</html>
