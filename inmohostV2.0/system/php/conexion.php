<?php

extract($_GET);
extract($_POST);

$conectar=1;


if(isset($usr_id)){
	if(strpos($usr_id,"-")!==false){

		$cadena_usr = explode("-",$usr_id);
		$usr_id_prp = $cadena_usr[0];
		$usr_id = $cadena_usr[1];

	}
}
if(isset($usr_id)&&$usr_id!=""){
	if(isset($_GET['usr_inmohost'])){
		$u_id=$_GET['usr_inmohost'];	
	}else{
		$u_id=$usr_id;
	}
	
	
	$HOST="localhost";     
	$USUARIO="inmo";//"inmohost_".$u_id;
	$PASSWORD="inmo";//$u_id;
	$BASE_DATOS="inmodb";//"inmohost_".$u_id;
}else{

	
	if(session_status() === PHP_SESSION_NONE){ session_start('inmohost'); 
	//if($_COOKIE['usuario']['usr_id']){
		$u_id=$_COOKIE['usuario']['usr_id'];	
		$HOST="localhost";     
		$USUARIO="inmo";//"inmohost_".$u_id;
		$PASSWORD="inmo";//$u_id;
		$BASE_DATOS="inmodb";//"inmohost_".$u_id;
	}else{
		$conectar=0;
	}
}	
	
	 
	//---------------------
	
	//---------------------
	//****************************************************************************************
	
	if($conectar){
		$db=mysql_connect($HOST,$USUARIO,$PASSWORD);
		mysql_select_db($BASE_DATOS,$db);
		mysql_query("SET CHARACTER SET latin1");
		mysql_query("SET NAMES latin1");
	}
	
	//echo $HOST." -".$USUARIO." - ".$PASSWORD." - ".$BASE_DATOS;


?>