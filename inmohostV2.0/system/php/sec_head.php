<?php

	//Inicio la sesion 
	if(session_status() === PHP_SESSION_NONE) session_start(); 
        
        if(!isset($isAjax)) $isAjax = 0;
        
        $usuario = $_COOKIE['usuario'];

	$error="";
	//COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO 
	if (!isset($usuario['usr_login']) ) { 
		
		//si no existe, envio a la p�gina de autentificacion 
	//	header("Location: $rutaAbsoluta"."login.php?error=".$usuario['usr_login']); 
	    //ademas salgo de este script 
	 //   exit(); 
	  $error=1;
	$_INMO_COLOR1="FFFFFF";
	$_INMO_COLOR2="FFFFFF";	  
	}else{
	//Personalizo el escritorio del empleado que inicia la sesion
	include_once 'conexion.php';
	$_INMO_COLOR1=mysql_result(mysql_query("select color1 from empleados where usr_login='".$usuario['usr_login']."'"),0,0);
	$_INMO_COLOR2=mysql_result(mysql_query("select color2 from empleados where usr_login='".$usuario['usr_login']."'"),0,0);

	}

	
	
	// chequeo actividad de session // tiempo que lleva dentro del sistema
    $usr_id = $usuario["usr_id"];
    $priv_id = $usuario["priv_id"];
    $hora_expiracion = $usuario["tiempo_sesion"];
    $hora_actual = time(); 
    
    	//echo "$tiempo_activo > ".$segs."<BR>";
	
    	if ($hora_actual > $hora_expiracion){

		@session_destroy();
		$error=1;
        }
 
	
		if($error==1){
			
			if(isset($isAjax)){
				echo 0;
			}else{
				?>
				<script language="javascript">
						parent.destruirSesion();
					</script>
                
				<?php
			}
		}else{
			if(isset($isAjax)){
				echo 1;			
			}
		}
?>
