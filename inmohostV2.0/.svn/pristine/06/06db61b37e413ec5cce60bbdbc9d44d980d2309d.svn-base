<?php

        extract($_GET);
        extract($_POST);

        if($op!=13){
            	include("../config.php");
                include("../funciones/actualiza_inmoclick.php");

        }else{
               include("../conexion_inmoclick.php");
        }

	
	
	mysql_query("start transaction");
	switch ($op){
		//hay conexion
		case 1:
			if($internet_host){
		
				$conn_id=ftp_connect($internet_host);
				if($conn_id){
					
					echo 1;
				}else{
					echo 0;
				}
				
			}
			
		break;
		case 2:
			//cambiar estado
			if($estado==1){
				$cadena="update nov_x_emp set leida=0 where nov_id=$nov_id and emp_id=$emp_id";
			}else{
				$cadena="update nov_x_emp set leida=1 where nov_id=$nov_id and emp_id=$emp_id";
				
			}	
			

			mysql_query($cadena) or $error=1;
			
			if($error){
				echo 0;	
				mysql_query("rollback");
			}else{
				echo 1;
				mysql_query("commit");
			}
				break;
		case 3:
			//eliminar cita
			$del_cita="DELETE FROM citas WHERE cita_id=$cita_id";
			mysql_query($del_cita) or $error="0,No se Pudo eliminar la Cita";
			if (!$error)
			{
				$del_emp="DELETE FROM cita_emp WHERE cita_id=$cita_id";
				mysql_query($del_emp) or $error="0,No se Pudo eliminar el Empleado de la cita";
				if (!$error)
				{
					$del_int="DELETE FROM interesados WHERE int_id IN (SELECT int_id FROM int_x_cita WHERE cita_id=$cita_id)";
					mysql_query($del_int) or $error="0,No se Pudieron eliminar los Interesados de la cita";
					if (!$error)
					{
						print $del_int_cita="DELETE FROM int_x_cita WHERE cita_id=$cita_id";
						mysql_query($del_int_cita) or $error="0,No se Pudo eliminar de int_x_cita";
						if (!$error)
						{
							$exito="1,La cita ha sido eliminada";
						}
					}
				}
			}
			if ($exito)
			{
				echo $exito;
				mysql_query("commit");
			}
			else 
			{
				echo $error;
				mysql_query("rollback");
			}
		break;
		case 4:
			//eliminar nota
			$del_cita="DELETE FROM notas WHERE nota_id=$nota_id";
			mysql_query($del_cita) or $error="0,No se Pudo eliminar la Nota";
			if (!$error)
			{
				$exito="1,La nota ha sido eliminada";
				echo $exito;
				mysql_query("commit");
			}
			else 
			{
				echo $error;
				mysql_query("rollback");
			}
		break;
		case 5:
			//eliminar tasacion
			$del_cita="DELETE FROM tasaciones WHERE tas_id=$tas_id";
			mysql_query($del_cita) or $error="0,No se Pudo eliminar la Tasacion";
			if (!$error)
			{
				$exito="1,La Tasacion ha sido eliminada";
				echo $exito;
				mysql_query("commit");
			}
			else 
			{
				echo $error;
				mysql_query("rollback");
			}
		break;
		case 6:
			//eliminar demanda
			$del_dem="DELETE FROM demandas WHERE dem_id=$dem_id";
			mysql_query($del_dem) or $error="0,No se Pudo eliminar la Demanda";
			if (!$error)
			{
				$exito="1,La Demanda ha sido eliminada";
				echo $exito;
				mysql_query("commit");
				
			}
			else 
			{
				echo $error;
				mysql_query("rollback");
			}
		break;
		case 7:
			//eliminar medio
			$del_dem="DELETE FROM receptores WHERE rec_id=$rec_id";
			mysql_query($del_dem) or $error="0,No se Pudo eliminar el medio";
			if (!$error)
			{
				$exito="1,El medio ha sido eliminado";
				echo $exito;
				mysql_query("commit");
			}
			else 
			{
				echo $error;
				mysql_query("rollback");
			}
		break;
		
		case 8:
			
			$errores="";
                    
                        //elimino referencias
                        $q = "update propiedades set prp_referente = 0 where prp_referente=$emp_id and usr_id = "._USR_ID;
                        mysql_query($q) or $errores.=mysql_error();
//			//reviso que no sea referente de ninguna propiedad
//			$verif="select * from propiedades where prp_referente=$emp_id and usr_id="._USR_ID;
//			$res_v=mysql_query($verif);
//			
//			if(mysql_num_rows($res_v)){
//                            
//                                
//				$errores="\nEl usuario es referente de las siguientes propiedades:\n";
//				while ($fil=mysql_fetch_array($res_v)) {
//                                    
//                                       
//					$errores.=" \r ID: $fil[prp_id] \n\r";					
//				}
//			}
			                        //elimino citas y referencias
                        $q = "select * from cita_emp where emp_id = $emp_id";
                        $res_q = mysql_query($q) or $errores.=mysql_error();
                        
                        while($fila_q = mysql_fetch_array($res_q)){
                            $q1 = "select * from int_x_cita where cita_id = ".$fila_q['cita_id'];
                            $res_q1 = mysql_query($q1) or $errores.=mysql_error();
                            
                            while($fila_q1 = mysql_fetch_array($res_q1)){
                                $q2 = "delete from interesados where int_id = ".$fila_q1['int_id'];
                                mysql_query($q2) or $errores.=mysql_error();
                                
                            }
                            $q = "delete from int_x_cita where cita_id = ".$fila_q['cita_id'];
                            mysql_query($q) or $errores.=mysql_error();
                            
                            $q = "delete from citas where cita_id = ".$fila_q['cita_id'];
                            mysql_query($q) or $errores.=mysql_error();
                        }
                        
                        $q = "delete from cita_emp where emp_id = $emp_id";
                        mysql_query($q) or $errores.=mysql_error();
                        
                        
//                        $q = "delete from cita_emp where emp_id =  $emp_id";
//                        mysql_query($q);
//                        $q = "delete from citas where emp_id =  $emp_id";
//                        mysql_query($q);
//			//reviso que no sea monitor de ninguna cita
//			$verif="select * from citas,cita_emp where emp_id=$emp_id and citas.cita_id=cita_emp.cita_id";
//			$res_v=mysql_query($verif);
//			
//			if(mysql_num_rows($res_v)){
//				$errores.="El usuario es monitor de las siguientes citas:\n";
//				while ($fil=mysql_fetch_array($res_v)){
//					$errores.=" \r Fecha: $fil[cita_fecha]  - PRP_ID: $fil[prp_id] \n\r";					
//				}
//			}
			
                        //elimino novedades
                        $q = "select * from nov_x_emp where emp_id = $emp_id";
                        $res_q = mysql_query($q) or $errores = "";
                        while ($fila_q = mysql_fetch_array($res_q)) {
                            $q1 = "delete from novedades where nov_id= ".$fila_q['nov_id'];
                            mysql_query($q1) or $errores.=mysql_error();
                        }
                        $q = "delete from nov_x_emp where emp_id = $emp_id";
                        mysql_query($q) or $errores.=mysql_error();
                        
                        
			//reviso que no se encuentre en las novedades
//			$verif="select novedades.emp_desde,date_format(novedades.nov_fecha,'%d-%m-%Y') as nov_fecha,nov_x_emp.emp_id from novedades,nov_x_emp where novedades.nov_id=nov_x_emp.nov_id and (nov_x_emp.emp_id=$emp_id or novedades.emp_desde=$emp_id) and nov_x_emp.leida=0";
//			$res_v=mysql_query($verif);
//			
//			if(mysql_num_rows($res_v)){
//				$errores.="El usuario tiene las siguientes novedades:\n";
//				while ($fil=mysql_fetch_array($res_v)){
//					$e_desde="select nombre,apellido from empleados where emp_id=$fil[emp_desde]";
//					$e_desde_res=mysql_query($e_desde) or die("se murio".$e_desde);
//					$e_desde_nom=mysql_result($e_desde_res,0,0);
//					$e_desde_ape=mysql_result($e_desde_res,0,1);
//					
//					$e_hacia="select nombre,apellido from empleados where emp_id=$fil[emp_id]";
//					$e_hacia=mysql_result(mysql_query($e_desde),0,0)." ".mysql_result(mysql_query($e_desde),0,1);
//					
//					$errores.=" \r De: $e_desde_nom $e_desde_ape A: $e_hacia - Fecha: $fil[nov_fecha] \n\r";					
//				}
//			}
			
			
			if(!$errores){
				
				/*$max_cam=mysql_result(mysql_query("select max(cambio_id) from cambios_emp"),0,0)+1;
				$query_cam=mysql_query("select * from empleados where emp_id=$emp_id");
				
				$fila_emp=mysql_fetch_array($query_cam);
				
				$cad_cam="insert into cambios_emp
												  values( $fila_emp[emp_id],
												  		  '$fila_emp[nombre]',
												  		  '$fila_emp[apellido]',
												  		  '$fila_emp[domicilio]',
												  		  '$fila_emp[email]',
												  		  '$fila_emp[telefono]',
												  		  '$fila_emp[tel_inmo]',
												  		  '$fila_emp[fo_id]',
												  		  now(),
												  		  'eliminacion',
												  		  $max_cam )
												  		  ";
				mysql_query($cad_cam) or $errores="0,Error al cargar en cambios_emp";*/
				//eliminar usuario
				$del_dem="DELETE FROM empleados WHERE emp_id=$emp_id";
				mysql_query($del_dem) or $errores="0,No se Pudo eliminar el usuario";
			}else{
                                mysql_query("ROLLBACK");
				$errores="0,$errores";
			}
			
			if (!$errores)
			{
				$exito="1,El usuario ha sido eliminado";
				
				mysql_query("COMMIT");
                              actualizar_inmoclick("empleados",array("emp_id"=>$emp_id,"usr_id"=>_USR_ID,"tipo"=>"eliminacion","fo_id"=>""));
                              actualizar_inmoclick("prp_referente",array("emp_id"=>$emp_id,"usr_id"=>_USR_ID));
                              echo $exito;
			}
			else 
			{
				echo $errores;
				mysql_query("rollback");
			}
		break;
		
		case 9:
			
			$verif="select * from notas where rub_id=$rub_id";
			$res_v=mysql_query($verif);
			
			if(mysql_num_rows($res_v)){
				$i=0;
				$rubs="";
				while ($fil=mysql_fetch_array($res_v)) {
					$rubs.=" \r : ".substr($fil[nota],0,50)."... - Nombre: $fil[nombre] $fil[apellido]\n\r";					
					$i++;
				}
			}
			
			if($i==0){
				//eliminar rubro
				$del="DELETE FROM rubros WHERE rub_id=$rub_id";
				mysql_query($del) or $error="0,No se Pudo eliminar el rubro";
			}else{
				$error="0,El rubro esta siendo utilizado por los siguientes Telefonos/Notas:\n".$rubs;
			}
			if (!$error)
			{
				$exito="1,El rubro ha sido eliminado";
				echo $exito;
                		mysql_query("commit");
			
			}
			else 
			{
				echo $error;
					mysql_query("rollback");
			}
		break;
		
		case 10:
			$error="";
			$verif="select * from propiedades where bar_priv_id=$bar_id";
			$res_v=mysql_query($verif);
			
			if(mysql_num_rows($res_v)){
				$i=0;
				$bars="";
				while ($fil=mysql_fetch_array($res_v)) {
					$bars.=" \r :ID: $fil[prp_id] - Dom: ".substr($fil[prp_dom],0,50)."... \n\r";					
					$i++;
				}
			}
			
			if($i==0){
				//eliminar barrio
				$del="DELETE FROM bar_priv WHERE bar_id=$bar_id and usr_id=$usr_id";
				mysql_query($del) or $error="0,No se Pudo eliminar el barrio";
				
				$cad_select="select count(fo_id) from fotos_x_bar where bar_id=$bar_id and usr_id="._USR_ID;
				$res_select=mysql_query($cad_select);
				$num_fot=mysql_result($res_select,0,0);
				
				for ($i=1;$i<=$num_fot;$i++){
					$cad_fotos.="x$i";
				}
								
				$verif=mysql_query("select * from cambios_bar_priv");
				if(mysql_num_rows($verif)){
					$max_camb=mysql_query("select max(bar_id) from bar_priv");
					$max_camb=mysql_result($max_camb,0,0) + 1;
				}else{
					$max_camb=1;	
				}
				
				$del="DELETE FROM fotos_x_bar WHERE bar_id=$bar_id and usr_id=$usr_id";
				mysql_query($del) or $error="0,No se Pudo eliminar las fotos";
				
                                if (!$error)
                                {
                                        $exito="1,El barrio ha sido eliminado";
                                        echo $exito;
                                        mysql_query("commit");
                                        actualizar_inmoclick("bar_priv",array("bar_id"=>$bar_id,"usr_id"=>_USR_ID,"tipo"=>"eliminacion"));
                                }
                                else 
                                {
                                        echo $error;
                                        mysql_query("rollback");
                                }
                                
                                
				
				
			}else{
				$error="0,El barrio esta siendo utilizado por las siguientes Propiedades:\n".$bars;
                                echo $error;
			}
			
		break;
		case 11:
			
			$verif="select * from empleados where sec_id=$sec_id";
			$res_v=mysql_query($verif);
			
			if(mysql_num_rows($res_v)){
				$i=0;
				$secs="";
				while ($fil=mysql_fetch_array($res_v)) {
					$secs.=" \r : Nombre: $fil[nombre] $fil[apellido]\n\r";					
					$i++;
				}
			}
			
			if($i==0){
				//eliminar sector
				$del="DELETE FROM sectores WHERE sec_id=$sec_id";
				mysql_query($del) or $error="0,No se Pudo eliminar el sector";
			}else{
				$error="0,El sector esta siendo utilizado por los siguientes Empleados:\n".$secs;
			}
			if (!$error)
			{
				$exito="1,El sector ha sido eliminado";
				echo $exito;
					mysql_query("commit");
			
			}
			else 
			{
				echo $error;
					mysql_query("rollback");
			}
		break;
		case 12:
			
			$cadena="update empleados set color1='$color1' where usr_login='$usr_login'";

			mysql_query($cadena) or $error=1;
			
			$cadena="update empleados set color2='$color2' where usr_login='$usr_login'";

			mysql_query($cadena) or $error=1;
		
			if($error){
				echo 0;	
				mysql_query("rollback");
			}else{
				echo 1;
				mysql_query("commit");
			}
			
		break;
                case 13:
			//cambiar estado
			if($estado==1){
				$cadena="update consultas set consulta_leida=0 where consulta_id=$consulta_id and usr_id=$usr_id";
			}else{
				$cadena="update consultas set consulta_leida=1 where consulta_id=$consulta_id and usr_id=$usr_id";

			}


			mysql_query($cadena) or $error=1;

			if($error){
				echo 0;
				mysql_query("rollback");
			}else{
				echo 1;
				mysql_query("commit");
			}
            break;
	}

?>