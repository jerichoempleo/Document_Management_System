<?php 
    require 'connect.php';
    error_reporting(E_ALL);

   /***********************dcrf insert********************/

    if(isset($_POST['dcrf_Form'])){
    
    $user_id =  $_POST['userid'];
    $action = $_POST['action'];
    $section = $_POST['section'];
    $code = $_POST['DocCode'];
    $notes = $_POST['editor1'];
    $revno = $_POST['revno'];
    $user = $_POST['email'];

    $userSector = $_POST['sector'];
    $docuType = $_POST['doctype'];

    if (empty($revno)){
        $revno = 0;
    } 

    /* if (empty($code)){
        $code = "None";
    }  */

    /********************Revision******************/
    $all_files = $_FILES['myfile'];
    $new_files = $_FILES['Newfile'];
    $oldCode = $_POST['OldCode'];
    $Respon = $_POST['NewRes'];
    $oldDate = date('Y-m-d', strtotime($_POST['oldDate']));

    $image_name = $_FILES['myfile']['name'];
    $image_tmp = $_FILES['myfile']['tmp_name'];

    $image_name2 = $_FILES['Newfile']['name'];
    $image_tmp2 = $_FILES['Newfile']['tmp_name'];


    if (empty($Respon)){
        $Respon = "None";
    } 

    if (empty($oldCode)){
        $oldCode = "None";
    } 


    $location = "admin/files/";
   /*  $extension = pathinfo($all_files, PATHINFO_EXTENSION); */
    /* $size = $_FILES['myfile']['size']; */

    $image = implode(",",$image_name);
    $image2 = implode(",",$image_name2);


    if (!empty($image_name))
    {
        foreach ($image_name as $key => $val)
        {
            $targetPath = $location.$val;
            move_uploaded_file($_FILES['myfile']['tmp_name'][$key],"$targetPath");

        }
    }

    if (!empty($image_name2))
    {
        foreach ($image_name2 as $key2 => $val2)
        {
            $targetPath2 = $location.$val2;
            move_uploaded_file($_FILES['Newfile']['tmp_name'][$key2],"$targetPath2");

        }
    }

    /* if (!in_array($extension, ['zip', 'pdf', 'docx','png','jpg'])) {
        echo "You file extension must be .zip, .pdf or .docx";
    } */ /* if ($_FILES['myfile']['size'] > 1000000000) { 
        echo "File too large!";
    } */ 


    /*********************insertionGlobal***************/
    if($insert = mysqli_query($conn,"INSERT INTO dcrf_tmp1 
    (User_ID, Action, Section, Document_Code, Document_Title, Sector, Document_Type, Old_Document, Old_Document_Code, New_Responsibilties, Old_Effectivity_Date, Author, Revision_no, Notes, Status) 
    VALUES ('$user_id', '$action', '$section', '$code', '$image2', '$userSector', '$docuType', '$image', '$oldCode', '$Respon', '$oldDate', '$user', '$revno', '$notes', 'Pending')"))
        {
            $res = [
                'status' => 200,
                'message' => 'Inserted Successfully'
            ];
            echo json_encode($res);
            return;
        }
        
        else
            {
                $res = [
                    'status' => 500,
                    'message' => 'Failed'
                ];
                echo json_encode($res);
                return;
            }   
    }

?>



<?php 

/***************inbox deletion*************************/

    if(isset($_POST['delete_inbox'])){

        $inbox_id = mysqli_real_escape_string($conn, $_POST['id']);
       
        $query = "DELETE FROM inbox WHERE id='$inbox_id'";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {
            $res = [
                'status' => 200,
                'message' => 'Inbox Deleted Successfully'
            ];
            echo json_encode($res);
            return;
        }
        else
        {
            $res = [
                'status' => 500,
                'message' => 'Inbox Not Deleted'
            ];
            echo json_encode($res);
            return;
        }
    }

/******************************Registration***********************************/
    if(isset($_POST['reg_Form'])){

        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = mysqli_real_escape_string($conn, md5($_POST['pass']));
        $cpass = mysqli_real_escape_string($conn, md5($_POST['cpass']));
        $usertype = mysqli_real_escape_string($conn, ($_POST['user_type']));
        $sector = mysqli_real_escape_string($conn, ($_POST['sector-holder']));
        $office = mysqli_real_escape_string($conn, ($_POST['office-holder']));
        $process = mysqli_real_escape_string($conn, ($_POST['process']));
    
        $select = mysqli_query($conn, "SELECT * FROM `reg_form` WHERE email = '$email' AND pass = '$pass'") or die('query failed');
    
        if(mysqli_num_rows($select) > 0){
            $res = [
                'status' => 500,
                'message' => 'Failed, An Error Occured.'
            ];
            echo json_encode($res);
            return;
        }
        else if($pass != $cpass){
            $res = [
                'status' => 1,
                'message' => 'Failed, Password and confirm password does not match.'
            ];
            echo json_encode($res);
            return;

        }
        else{
            mysqli_query($conn, "INSERT INTO `reg_form`(fname, lname, email, pass, User_Type, sector, office, process, status) VALUES('$fname', '$lname', '$email', '$pass', '$usertype', '$sector', '$office', '$process', 'pending')") or die('query failed');
            $res = [
                'status' => 200,
                'message' => 'Registration Successful!'
            ];
            echo json_encode($res);
            return;
        }
    
    }

    


?>

