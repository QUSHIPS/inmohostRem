<?php

	$rutaSystema = "../";
	$rutaInterfaz = "../../interfaz/";
	
	include ($rutaSystema."php/config.php");
	
	
	// desde donde estoy hacia donde voy
	$pag_login = $rutaSystema."../login.php";
	extract($_POST);
		
// funcion para redireccionar la web a destino
function errores($error){
	global $pag_login;
	
	switch ($error){
		
		case 1:
			echo "Acceso incorrecto!<br>esta intentando ingresar directamente";
			exit;
		break;
	
		case 2:
			echo "Acceso incorrecto!<br>no a cargado datos en el formulario";
			exit;
		break;
		
		case 3:
			echo "El usuario no existe";
			exit;
		break;

		case 4:
			echo "Clave incorrecta"; 	
			exit;
		break;

		case 5:
			echo "Su usuario aun no esta autorizado o esta suspendido";
			exit;
		break;

		case 6:
			echo "Error en BD.";
			exit;
		break;
    
                case 7:
                        Header ("Location: $pag_login?error=No tiene las cookies habilitadas. Para poder utilizar el sistema debe habilitar las cookies en su navegador&usr_id=".$_POST['usr_id']);
                        exit;
		break;
            
		
	}

}

	$url = explode("?",$_SERVER['HTTP_REFERER']);
	$pag_referida=$url[0];
	$redir=$pag_referida;

	// chequear si se llama directo al script.
	if ($_SERVER['HTTP_REFERER'] == ""){
		errores(1);
		
	}

	// si paso los datos por el formulario sigue
	if (!$usuario && !$pass){
		errores(2); 
		
	}
	
	$consulta = mysql_query("select usr_pass,empleados.priv_id,usr_login,priv_desc,usr_tpo from empleados,privilegios where usr_login='$usuario' and usr_pass='$pass' and empleados.priv_id=privilegios.priv_id") OR die("priv_desc,usr_tpo from empleados,privilegios where usr_login='$usuario' and usr_pass='$pass' and empleados.priv_id=privilegios.priv_id"); 
	
	if (mysql_num_rows($consulta) == 0){
		errores(3); 
		
	}

	// genero al array de los datos de user
	$datos_user = mysql_fetch_array($consulta);

	// creo los datos de comprobacion avanzada
	$user_del = stripslashes($usuario);
//	$pass_del = md5($_POST['pass']);
	
	// me dasago lo la coneccion y los datos
	mysql_free_result($consulta);
	
	//  vuelvo a chequear el usuario con el resultado de la base de datos
	if ($datos_user['usr_login'] != $user_del){
		errores(3); 
		
	}
	
	// comparo los pass con encriptacion
	if ($datos_user['usr_pass'] != $pass){
		errores(4);
		
	}
	
        $usr_tiempo = explode(":",$datos_user['usr_tpo']);
        //print $usr_tiempo[1];
	$sum=$usr_tiempo[0]*3600;
	$sum+=$usr_tiempo[1]*60;
	$sum+=$usr_tiempo[2];
//	
//	$segs=$sum;
       
	@session_start();
        
        if(!count($_COOKIE)){
            errores(7);
        }
        
	//$sum = 10;
        $expiracion = time()+ $sum;
        
        setcookie('usuario[usr_login]',$datos_user['usr_login'],$expiracion,"/");
        setcookie('usuario[tiempo_sesion]',$expiracion,$expiracion,"/");

    // Paranoia: decimos al navegador que no "cachee" esta p�gina.
    //session_cache_limiter('nocache,private');
    
    // Asignamos variables de sesi�n con datos del Usuario para el uso en el
    // resto de p�ginas autentificadas.
    $consulta_user = mysql_query("select usr_id,usr_raz,usr_cim from usuarios where usr_id=" . _USR_ID) OR die(mysql_error()."select usr_id,usr_raz,usr_cim from usuarios where usr_id=" . _USR_ID); 
	$datos_usuario=mysql_fetch_array($consulta_user);
    
	if (mysql_num_rows($consulta_user) == 0){
		errores(3); 
		
		
	}
        
     setcookie('usuario[usr_id]',$datos_usuario['usr_id'],$expiracion,"/");  
    //definimos usuario_nivel con el Nivel de acceso del usuario de nuestra BD de usuarios
 //   $_SESSION['usr_raz'] = $datos_usuario['usr_raz'];
    setcookie('usuario[usr_raz]',$datos_usuario['usr_raz'],$expiracion,"/");  
    
 //   $_SESSION['usr_cim'] = $datos_usuario['usr_cim'];
    setcookie('usuario[usr_cim]',$datos_usuario['usr_cim'],$expiracion,"/"); 
    
 //   $_SESSION['web'] = $datos_usuario['web'];
    setcookie('usuario[web]',$datos_user['web'],$expiracion,"/");  
 ///   $_SESSION['priv_id']=$datos_user['priv_id'];
    setcookie('usuario[priv_id]',$datos_user['priv_id'],$expiracion,"/");      
        
//    // definimos usuarios_id como IDentificador del usuario en nuestra BD de usuarios
//    $_SESSION['usr_id'] = $datos_usuario['usr_id'];
//
//    //definimos usuario_nivel con el Nivel de acceso del usuario de nuestra BD de usuarios
//    $_SESSION['usr_raz'] = $datos_usuario['usr_raz'];
//    
//    $_SESSION['usr_cim'] = $datos_usuario['usr_cim'];
//    
//    $_SESSION['usr_ccpim'] = $datos_usuario['usr_ccpim'];
//    
//	$_SESSION['web'] = $datos_usuario['web'];
    

    
    
       
    // definimos usuario_nivel con el Nivel de acceso del usuario de nuestra BD de usuarios
   /* $_SESSION['user_nivel'] = $datos_user['nivel'];*/
    
    //definimos usuario_nivel con el Nivel de acceso del usuario de nuestra BD de usuarios
  /*  $_SESSION['user_nombre'] = $datos_user['nombre'];*/

  
	// creo la fecha y hora de ingreso
//	$_SESSION["usr_tpo_ini"] = date("Y-n-j H:i:s"); 

	echo "1";
	
?>

