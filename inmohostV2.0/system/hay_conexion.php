<?php

	if($internet_host){
		
		$conn_id=ftp_connect($internet_host);
		if($conn_id){
			
			echo 1;
		}else{
			echo 0;
		}
		
	}
	

?>