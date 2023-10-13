<?php 
	
	if(isset($_POST['approve'])){
		$new_message = array(			
			"id" => $_POST['id'],
            "title" => $_POST['title'],
            "code" => $_POST['code'],
            "notes" => $_POST['notes'],
            "purpose" => $_POST['purpose'],
            "status" => $_POST['status'],
            "section" => $_POST['section'],
            "author" => $_POST['author'],
            "date" => $_POST['date'],
            "revision" => $_POST['revisionNo'],
            "AffectedDocu" => $_POST['affect'],
            "oldcode" => $_POST['oldcode'],
            "NewRespon" => $_POST['newres'],
            "olddate" => $_POST['olddate'],
            "Apprnotes" => $_POST['Apprnotes']
			       
		);
		
		if(filesize("approvaldata.json") == 0){
			
			$first_record = array($new_message);
	
			$data_to_save = $first_record; 
		}else{
		
			$old_records = json_decode(file_get_contents("approvaldata.json"));

			array_push($old_records, $new_message);

			$data_to_save = $old_records;
		}

		if(!file_put_contents("approvaldata.json", json_encode($data_to_save, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX)){

			$error = "Error storing message, please try again";
		}else{

			$success =  "Message is stored successfully";
		}
	}
