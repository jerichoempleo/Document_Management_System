<?php 
    require 'connect.php';
    error_reporting(-1); //-1 when debugging
    
   /*  document Controller 1  */
   if(isset($_POST['view1_form'])){
        
    $appid = $_POST['appid'];
    $id = $_POST['id'];
    $userid = $_POST['userid'];
    $title = $_POST['title'];
    $action = $_POST['purpose'];
    $section = $_POST['section'];
    $code = $_POST['code'];
    $status = $_POST['status'];
    $user = $_POST['author'];
    $notes = $_POST['notes'];
    $date = $_POST['date'];
    $revno = $_POST['revisionNo'];

    $userSector = $_POST['sector'];
    $docType = $_POST['doctype'];

    $affectedDocu = $_POST['affect'];  
    $oldCode = $_POST['oldcode'];
    $Respon = $_POST['newres'];
    $oldDate = $_POST['olddate'];

    $approverUser = $_POST['email'];
    $apprnotes =  $_POST['Apprnotes'];

    $insert = "INSERT INTO dcrf_tmp2 
    (Revision_ID, User_ID, Action, Section, Document_Code, Document_Title, Sector, Document_Type, Old_Document, Old_Document_Code, New_Responsibilties, Old_Effectivity_Date, Author, Revision_no, Notes, Approver, Approver_Notes, Status) 
    VALUES ('$id', '$userid', '$action', '$section', '$code', '$title', '$userSector', '$docType', '$affectedDocu', '$oldCode', '$Respon', '$oldDate', '$user', '$revno', '$notes', '$approverUser', '$apprnotes', '$status')";
    $insert_run = mysqli_query($conn, $insert);

    $updateStatus = "UPDATE dcrf_tmp1 SET Status='1' WHERE Revision_ID = '$appid'";
    $updateStatus_run = mysqli_query($conn, $updateStatus);

    if($insert_run AND $updateStatus_run){
        $res = [
            'status' => 200,
            'message' => 'Inserted Successfully'
        ];
        echo json_encode($res);
        return;
    }else
        {
            $res = [
                'status' => 500,
                'message' => 'Failed'
            ];
            echo json_encode($res);
            return;
        }
}

    /*  document Controller 2  */

    if(isset($_POST['view2_form'])){
        
        $appid = $_POST['appid'];
        $id = $_POST['id'];
        $userid = $_POST['userid'];
        $title = $_POST['title'];
        $action = $_POST['purpose'];
        $section = $_POST['section'];
        $code = $_POST['code'];
        $status = $_POST['status'];
        $user = $_POST['author'];
        $notes = $_POST['notes'];
        $date = $_POST['date'];
        $revno = $_POST['revisionNo'];

        $userSector = $_POST['sector'];
        $docType = $_POST['doctype'];

        $affectedDocu = $_POST['affect'];  
        $oldCode = $_POST['oldcode'];
        $Respon = $_POST['newres'];
        $oldDate = $_POST['olddate'];

        $approverUser = $_POST['email'];
        $apprnotes =  $_POST['Apprnotes'];

        $insert = "INSERT INTO dcrf_table 
        (Revision_ID, User_ID, Action, Section, Document_Code, Document_Title, Sector, Document_Type, Old_Document, Old_Document_Code, New_Responsibilties, Old_Effectivity_Date, Author, Revision_no, Notes, Approver, Approver_Notes, Status) 
        VALUES ('$id', '$userid', '$action', '$section', '$code', '$title', '$userSector', '$docType', '$affectedDocu', '$oldCode', '$Respon', '$oldDate', '$user', '$revno', '$notes', '$approverUser', '$apprnotes', '$status')";
        $insert_run = mysqli_query($conn, $insert);

        $updateStatus = "UPDATE dcrf_tmp2 SET Status='1' WHERE Revision_ID = '$appid'";
        $updateStatus_run = mysqli_query($conn, $updateStatus);

        if($insert_run AND $updateStatus_run){

            $res = [
                'status' => 200,
                'message' => 'Inserted Successfully'
            ];
            echo json_encode($res);
            return;
        }else
            {
                $res = [
                    'status' => 500,
                    'message' => 'Failed'
                ];
                echo json_encode($res);
                return;
            }
    }

/*****************document Controller 3 ***************/
    function randomCode($l = 10){
        $char = '0123456789QWERTYUIOPASDFGHJKLZXCVBNM';
        $charlngth = strlen($char);
        $rand = '';
        for($i = 0; $i < $l; $i++){
            $rand .= $char[rand(0, $charlngth -1)];
        }
        return $rand;
    }

    if(isset($_POST['view3_form'])){
            
        $id = $_POST['id'];
        $appid = $_POST['appid'];
        $user_id = $_POST['userid'];
    
        $docuCode = $_POST['docucode'];
        if (empty($docuCode)){
            $docuCode = randomCode();
        } 

        $section = $_POST['docsection'];
    
        $filename = $_POST['title'];
        $user = $_POST['author'];

        $revno = $_POST['revisionNo'] + 1;
        if (empty($revno)){
            $revno = 0;
        } 

        $docType = $_POST['doctype'];
    
        $approverUser = $_POST['email'];
        $approverNotes = $_POST['Apprnotes'];
    
            if(mysqli_query($conn, "INSERT INTO dc_inbox (DCRF_ID, Section, Document_Code, User_ID, Document_Title, Document_Type, Author, Approver, Notes, Revision_no, Status) 
            VALUES ('$id', '$section', '$docuCode', '$user_id', '$filename', '$docType', '$user', '$approverUser', '$approverNotes', '$revno', 1)")){
                                
                $sql = "UPDATE dcrf_table SET Status='1' WHERE Revision_ID = '$appid'";
                $run = mysqli_query($conn, $sql);

                $trigger = "INSERT INTO logs (user_id, document_title, acted_by, action_made, action_date)
                VALUES('$user_id', '$filename', '$approverUser', 'Document Approved. Wait for file to be uploaded', NOW())";
                $trigger_run = mysqli_query($conn, $trigger);

                    $res = [
                        'status' => 200,
                        'message' => 'Application Approved'
                    ];
                    echo json_encode($res);
                    return;
            }

            else {
                    $res = [
                        'status' => 500,
                        'message' => 'Failed'
                    ];
                    echo json_encode($res);
                    return;
            }
    
        }


/*****************University document Controller Deletion***************/

    if(isset($_POST['delete_docu'])){

            date_default_timezone_set('Asia/Manila');
            $date = date('Y/m/d h:i:s a', time());

            $docu_id = mysqli_real_escape_string($conn, $_POST['docu_id']);
            $queryArchive = mysqli_query($conn, "SELECT * FROM document WHERE Document_ID='$docu_id'");
            while($fetch = mysqli_fetch_array($queryArchive)){
                mysqli_query($conn, "INSERT INTO `archive` 
                VALUES('', '$fetch[User_ID]', '$fetch[Document_ID]', '$fetch[Document_Code]', '$fetch[Document_Title]', '$fetch[Revision_no]', '$fetch[Uploader]', '$fetch[Approver]', '$date')") or die(mysqli_error($conn));
            }

            $query = "DELETE FROM document WHERE Document_ID='$docu_id'";
            $query_run = mysqli_query($conn, $query);

            if($query_run and $queryArchive)
            {
                $res = [
                    'status' => 200,
                    'message' => 'Student Deleted Successfully'
                ];
                echo json_encode($res);
                return;
            }
            else
            {
                $res = [
                    'status' => 500,
                    'message' => 'Student Not Deleted'
                ];
                echo json_encode($res);
                return;
            }
        }

/*****************University document Controller Upload File to Process Owner***************/

if(isset($_POST['view_inboxform'])){
            
    $appid = $_POST['appid'];
    $id = $_POST['id'];
    $user_id = $_POST['userid'];

    $docuCode = $_POST['code'];
    $section = $_POST['docSection'];

    $filename = $_FILES['myfile']['name'];
    $user = $_POST['author'];

    $revno = $_POST['revisionNo'];

    $docType = $_POST['doctype'];

    $approverUser = $_POST['email'];
    $approverNotes = $_POST['Apprnotes'];

    $destination = '../admin/files/' . $filename;

    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];

    if (!in_array($extension, ['zip', 'pdf', 'docx','png','jpg', 'JPG'])) {
        echo "You file extension must be .zip, .pdf or .docx";
    } elseif ($_FILES['myfile']['size'] > 1000000000) { 
        echo "File too large!";
    } else {
        if (move_uploaded_file($file, $destination)) {

                    if(mysqli_query($conn, "INSERT INTO document (DCRF_ID, User_ID, Section, Document_Code, Document_Title, Document_Type, Uploader, Size, Downloads, Approver, Notes, Revision_no) 
                    VALUES ('$id', '$user_id', '$section', '$docuCode', '$filename', '$docType', '$user', $size, 0, '$approverUser', '$approverNotes', '$revno')")){
                
                        mysqli_query($conn, "INSERT INTO inbox (user_id, Sender, Document_Title, description) 
                        VALUES ('$user_id', '$approverUser', '$filename', '$approverNotes')");
      
                        $updateStatus = "UPDATE dc_inbox SET Status='3' WHERE id = '$appid'";
                        $updateStatus_run = mysqli_query($conn, $updateStatus);
            
                            $res = [
                                'status' => 200,
                                'message' => 'Application Approved'
                            ];
                            echo json_encode($res);
                            return;
                    }
            

        } else {
                $res = [
                    'status' => 500,
                    'message' => 'Failed'
                ];
                echo json_encode($res);
                return;
        }

    }
}

        
?>








   
        
 

 