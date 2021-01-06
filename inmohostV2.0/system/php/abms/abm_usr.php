<?php
extract($_POST);
extract($_FILES);
$ind_error=0;
$ind_exito=0;
$MAX_TAM_FOT=70000;
mysql_query("start transaction");
switch ($mod_tip)
{
	case "add":

			$max_id = mysql_query ("select max(emp_id) from empleados"); //obtiene el id maximo de empleados para agregar en tabla
			if(mysql_num_rows($max_id) )
			{
				$max_id = mysql_result($max_id,0,0) + 1;
			}else{
				$max_id=1;
			}
			// Me fijo que el usr_id no exista ya en la base de datos
			$errors=0;
			$cons_login="SELECT emp_id FROM empleados WHERE usr_login='$usr_login'";
			$rs_login=mysql_query($cons_login) or $errors="Error al verificar si el login ya existe<br>$cons_login";
			$usr_existe=0;
			if (mysql_num_rows($rs_login))
			{
				$errors="Ya existe un usuario con login '$usr_login' en el sistema. No se ha creado un el nuevo usuario";
			}


			if(is_array($fo_id)&&$fo_id['name']!=""){

					//conexion
				$conn_id = ftp_connect("localhost");
				$login = ftp_login($conn_id,"inmohost@inmoclick.com.ar","S0crate5-*");

				list($size_x,$size_y,$tipo,$atr)=getimagesize($fo_id['tmp_name']);
				if(filesize($fo_id['tmp_name'])<$MAX_TAM_FOT || ($size_x<600 && $size_y<600) )
				{
					//copy($fo_id,"../fotos/emp_".$max_id."-"._USR_ID.".gif");
					$res=ftp_put($conn_id,"../fotos/emp_".$max_id."-"._USR_ID.".gif", $fo_id['tmp_name'], FTP_ASCII);
				}
				else
				{
					//redim_foto("fo_id","../fotos/","emp_".$max_id."-"._USR_ID);

					redim_foto("fo_id","/tmp/","emp_".$max_id."-"._USR_ID.".gif",$conn_id);
	    		}
                                $fo_id=$max_id;
                                ftp_close($conn_id);
			}else{
				$fo_id=-1;
			}

			if (!$errors)
			{

				$max_cam=max_id("cambios_emp","cambio_id");
				$cad_cam="insert into cambios_emp
												  values( $max_id,
												  		  '$nombre',
												  		  '$apellido',
												  		  '$domicilio',
												  		  '$email',
												  		  '$telefono',
												  		  '$tel_inmo',
												  		  '$fo_id',
												  		   now(),
												  		  'alta',
												  		  $max_cam )
												  		  ";
				mysql_query($cad_cam) or $errors="Error al cargar en cambios_emp".mysql_error()."<br>".$cad_cam;


				$usr_tpo="$hh_s:$mm_s:00";
				$insertar="insert into empleados (emp_id,
													nombre,
													apellido,
													telefono,
													email,
													domicilio,
													usr_login,
													usr_pass,
													priv_id,
													usr_tpo,
													fo_id,
													tel_inmo,
													sexo,
													mostrar,
													sec_id
													)
											values (
													$max_id,
													'$nombre',
													'$apellido',
													'$telefono',
													'$email',
													'$domicilio',
													'$usr_login',
													'$usr_pass',
													$priv_id,
													'$usr_tpo',
													'$fo_id',
													'$tel_inmo',
													'$sexo',
													$mostrar,
													$sec_id
													);";

				mysql_query("$insertar") or $errors="Error al intentar cargar el usuario".mysql_error().$insertar;

                                $array_empleados = array(   'emp_id'=>$max_id,
                                                            'nombre'=>$nombre,
                                                            'apellido'=>$apellido,
                                                            'telefono'=>$telefono,
                                                            'email'=>$email,
                                                            'domicilio'=>$domicilio,
                                                            'usr_login'=>$usr_login,
                                                            'usr_pass'=>$usr_pass,
                                                            'priv_id'=>$pri_id,
                                                            'usr_tpo'=>$usr_tpo,
                                                            'fo_id'=>$fo_id,
                                                            'tel_inmo'=>$tel_inmo,
                                                            'sexo'=>$sexo,
                                                            'mostrar'=>$mostrar,
                                                            'sector'=>$sec_id);
                               if (!$errors)
                                {
                                    mysql_query("commit");
                                    actualizar_inmoclick("empleados",array("array_empleados"=>$array_empleados,"emp_id"=>$max_id,"usr_id"=>_USR_ID,"tipo"=>"alta","fo_id"=>$fo_id));
                                    $resultado="El usuario fue agregado al sistema";
                                }else{
                                    $resultado="El usuario No fue agregado al sistema".$errors;
                                }
			}






   /***********************************************************************************************************************
	******************************************   FIN ALTA USUARIO  ********************************************
	***********************************************************************************************************************/

   case "edit":

   			if($emp_id){

	   			if(is_array($fo_id)&&$fo_id['name']!=""){
	   					//conexion
					$conn_id = ftp_connect("localhost");
					$login = ftp_login($conn_id,"inmohost@inmoclick.com.ar","S0crate5-*");

		   			list($size_x,$size_y,$tipo,$atr)=getimagesize($fo_id['tmp_name']);
					if(filesize($fo_id['tmp_name'])<$MAX_TAM_FOT || ($size_x<600 && $size_y<600) )
					{
                                           
                                            $res=ftp_put($conn_id,"/fotos/emp_".$emp_id."-"._USR_ID.".gif", $_FILES['fo_id']['tmp_name'], FTP_ASCII);
						//copy($fo_id['tmp_name'],"../fotos/emp_".$emp_id."-"._USR_ID.".gif");
					}
					else
					{
                                            
						redim_foto("fo_id","/tmp/","emp_".$emp_id."-"._USR_ID.".gif",$conn_id);
                                        }
                                    $fo_id=$emp_id;
                                    $cad_fo_id="fo_id=$emp_id,";
                                    ftp_close($conn_id);
				}else{
					$fo_id=-1;
				}

				$max_cam=max_id("cambios_emp","cambio_id");
				$query_cam=mysql_query("select * from empleados where emp_id=$emp_id");

				$fila_emp=mysql_fetch_array($query_cam);



   					$cadena="
   							update
   									empleados
   							 set
   							 		nombre='$nombre',
   							 		apellido='$apellido',
   							 		domicilio='$domicilio',
   							 		telefono='$telefono',
   							 		tel_inmo='$tel_inmo',
   							 		sexo='$sexo',
   							 		mostrar='$mostrar',
   							 		sec_id='$sec_id',
   							 		email='$email',
   							 		usr_tpo='$hh_s:$mm_s:00',
   							 		usr_login='$usr_login',
   							 		priv_id='$priv_id',
   							 		$cad_fo_id
   							 		usr_pass='$usr_pass'
   							 where
   							 		emp_id=$emp_id

   				";
   				mysql_query($cadena) or $errors="Error al modificar el empleado.".mysql_error()."<br>".$cadena;



                                 $array_empleados = array(   'emp_id'=>$emp_id,
                                                            'nombre'=>$nombre,
                                                            'apellido'=>$apellido,
                                                            'telefono'=>$telefono,
                                                            'email'=>$email,
                                                            'domicilio'=>$domicilio,
                                                            'usr_login'=>$usr_login,
                                                            'usr_pass'=>$usr_pass,
                                                            'priv_id'=>$pri_id,
                                                            'usr_tpo'=>"$hh_s:$mm_s:00",
                                                            'fo_id'=>$fo_id,
                                                            'tel_inmo'=>$tel_inmo,
                                                            'sexo'=>$sexo,
                                                            'mostrar'=>$mostrar,
                                                            'sector'=>$sec_id);

                                if (!$errors)
                                {

                                        mysql_query("commit");
                                        actualizar_inmoclick("empleados",array("array_empleados"=>$array_empleados ,"emp_id"=>$emp_id,"usr_id"=>_USR_ID,"tipo"=>"modificacion","fo_id"=>$fo_id));
                                        $resultado="El usuario fue modificado";

                                }
                                else
                                {
                                        mysql_query("rollback");
                                        $resultado="El usuario no fue modificado". $errors;


                                }




   			}
   break;
}

?>