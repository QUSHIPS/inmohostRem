<?php
extract($_POST);
$ind_error=0;
$ind_exito=0;
$errors = array();

mysql_query("start transaction");

switch ($mod_tip){
    case "add":

        $max_id = mysql_query ("select max(nov_id) from novedades"); //obtiene el id maximo de novedades para agregar en tabla
        if(mysql_num_rows($max_id) )
        {
                $max_id = mysql_result($max_id,0,0) + 1;
        }else{
                $max_id=1;
        }
        //Formatea la cadena para ser insertada en la base de datos sin que los caracteres "\" � "'" la da�en.
        $nov_desc=addslashes($nov_desc);

        $insertar = "insert into novedades (nov_id,nov_desc,emp_desde,nov_fecha,nov_vig,nov_hora) values ($max_id, '$nov_desc', $emp_desde, '".date('Y-m-d')."', '0000-00-00', '".date('H:i:s')."')";

        $result = mysql_query($insertar);

        if($result === false){
            $errors[]="Error al intentar cargar la novedad".mysql_error().$insertar;
        }

        $sels = $emp_hacia;

        if($sels[0]=="0"){
            $cad="select emp_id from empleados";

            $result=mysql_query($cad);	
            
            if($result === false){
                $errors[]="Error al intentar cargar novedades para todos".mysql_error().$cad;
            }
            
            while ($fila=mysql_fetch_array($result)) {
                $cad="insert into nov_x_emp values($max_id,".$fila['emp_id'].",0)";

                mysql_query($cad);
                
                if($result === false){
                    $errors[]="Error en la carga de novedades nov_x_emp: ".$cad;
                }
            }
        }else{
            for($i=0;$i<count($sels);$i++){
                $cad="insert into nov_x_emp values($max_id,".$sels[$i].",0)";

                mysql_query($cad);
                
                if($result === false){
                    $errors[]="Error en la carga de novedades nov_x_emp: ".$cad;
                }
            }
        }

        $mensaje="La Novedad ha sido agregada con &eacute;xito";		

    break;	
   /***********************************************************************************************************************
	******************************************   FIN ALTA NOVEDAD  ********************************************
	***********************************************************************************************************************/
}

if (!$errors || (is_array($errors) && count($errors) == 0))	
{
	mysql_query("commit");
}
else 
{
	mysql_query("rollback");
}


?>
