<?php

class Action{
	
	public function __construct($db)
	{
		ob_start();
		$this->conn = $db;
	}

    function save_inward()
    {
			print_r($_POST);
			extract($_POST);	

			if(empty($id))
			{
				// Upload file 
				$uploadedFile = ''; 
				if(!empty($_FILES["file"]["name"]))
				{
					
					$uploadDir = 'asset_invoice_uploads/';				
					// File path config 
					echo $fileName = basename($_FILES["file"]["name"]); 
					
					/* 
					$targetFilePath = $uploadDir . $fileName; 
					$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
					// Allow certain file formats 
					$allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg'); 
					if(in_array($fileType, $allowTypes)){ 
						// Upload file to the server 
						if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){ 
							$uploadedFile = $fileName; 
						}else{ 
							$uploadStatus = 0; 
							$response['message'] = 'Sorry, there was an error uploading your file.'; 
						} 
					}else{ 
						$uploadStatus = 0; 
						$response['message'] = 'Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.'; 
					} */
				}
								
				/* $data =" purchase_date='$purchase_date',warranty='$warranty',serial_no='$serial_no',hsn_code='$hsn_code',product_no='$product_no',model='$model',brand='$brand',invoice_no='$invoice_no',invoice_files='$targetFilePath',qr_code='$qr_code',status=1,created_by=1,created_on=NOW()";
		
				$insert = $this->conn->query("INSERT INTO asset_inward_master set ".$data); */
			}
			else
			{
				$save = $this->db->query("UPDATE asset_stationary_inward_master set ".$data." where id=".$id);
			}		
			/* if($save)
			return 1; */
	}
	function stationary_inward()
    {
        //print_r($_POST);
	    extract($_POST);	
		
		if(empty($id))
		{
			// Upload file 
            $uploadedFile = ''; 
            if(!empty($_FILES["file"]["name"])){
				
				$uploadDir = 'stationary_invoice_uploads/';				
				// File path config 
				$fileName = basename($_FILES["file"]["name"]); 
				$targetFilePath = $uploadDir . $fileName; 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
				// Allow certain file formats 
                $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg'); 
				if(in_array($fileType, $allowTypes)){ 
                    // Upload file to the server 
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){ 
                        $uploadedFile = $fileName; 
                    }else{ 
                        $uploadStatus = 0; 
                        $response['message'] = 'Sorry, there was an error uploading your file.'; 
                    } 
                }else{ 
                    $uploadStatus = 0; 
                    $response['message'] = 'Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.'; 
                }
            }
			
			
			
			$data ="purchase_date='$purchase_date',stationary_id='$stationary_id',no_of_count='$no_of_count',invoice_no='$invoice_no',invoice_files='$targetFilePath',qr_code='$qr_code',status=1,created_by=1,created_on=NOW()";
			
			$save = $this->conn->query("INSERT INTO asset_stationary_inward_master set ".$data);
			
		}
		else
		{
			$save = $this->db->query("UPDATE asset_stationary_inward_master set ".$data." where id=".$id);
		}		
			 if($save)
			return 1;
	}	
}
?>