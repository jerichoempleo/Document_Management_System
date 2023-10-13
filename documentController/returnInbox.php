<?php 
    require 'connect.php';
    error_reporting(-1);

    /*****************Returned File Dc1***************/ 
        $appid = $_POST['appid'];
        $user_id = $_POST['userid'];
    
        /* $docuCode = $_POST['docucode']; */
        
        $filename = $_POST['title'];
        $approverUser = $_POST['email'];
        $approverNotes = $_POST['Apprnotes'];

        $insert = "INSERT INTO inbox (user_id, Sender, Document_Title, description) 
                 VALUES ('$user_id', '$approverUser', '$filename', '$approverNotes')";
        $insert_run = mysqli_query($conn, $insert);

        
        if($insert_run){

            $trigger = "INSERT INTO logs (user_id, document_title, acted_by, action_made, action_date)
            VALUES('$user_id', '$filename', '$approverUser', 'Document Returned', NOW())";
            $trigger_run = mysqli_query($conn, $trigger);

            $updateStatus = "UPDATE dc_inbox SET Status='4' WHERE id = '$appid'";
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