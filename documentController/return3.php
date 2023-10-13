<?php 
    require 'connect.php';
    error_reporting(-1);

    /*****************Returned File Dc3***************/ 
        $appid = $_POST['appid'];
        $id = $_POST['id'];
        $docuCode = $_POST['docucode'];
        $section = $_POST['docsection'];
        $user_id = $_POST['userid'];
        $filename = $_POST['title'];
        $docType = $_POST['doctype'];
        $user = $_POST['author'];
        $approverUser = $_POST['email'];
        $approverNotes = $_POST['Apprnotes'];

        $insert = "INSERT INTO dc_inbox (DCRF_ID, Section, Document_Code, User_ID, Document_Title, Document_Type, Author, Approver, Notes, Status) 
                    VALUES ('$id', '$section', '$docuCode', '$user_id', '$filename', '$docType', '$user', '$approverUser', '$approverNotes', 2)";
        $insert_run = mysqli_query($conn, $insert);

        if($insert_run){

            $trigger = "INSERT INTO logs (user_id, document_title, acted_by, action_made, action_date)
            VALUES('$user_id', '$filename', '$approverUser', 'Document Returned to Document Controller', NOW())";
            $trigger_run = mysqli_query($conn, $trigger);

            $updateStatus = "UPDATE dcrf_table SET Status='2' WHERE Revision_ID = '$appid'";
            $updateStatus_run = mysqli_query($conn, $updateStatus);

            $res = [
                'status' => 200,
                'message' => 'Returned Successfully'
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
?>