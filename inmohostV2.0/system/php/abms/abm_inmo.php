<?php

extract($_POST);

mysql_query("start transaction");

switch ($mod_tip)
{
	
   case "edit": 
   			
      			$cadena="update 
	   							usuarios  set
							     	 	  usr_raz='$usr_raz',
							     	 	  usr_dom='$usr_dom',
							     	 	  pro_id=$pro_id,
							     	 	  loc_id=$loc_id,
							     	 	  usr_tel='$telefono_usuario_prefijo_1-$telefono_usuario_deatlle_1',
							     	 	  usr_mail='$usr_mail',
							     	 	  web='$web',
                                                                          usr_matricula = '$usr_matricula'
			      					 where 
			      					 	  usr_id="._USR_ID;
      			
      			mysql_query($cadena) or $errors="Error al modificar usuarios".mysql_error();
                            
                            if($telefono_usuario_prefijo_1!=''){
                                $telefonos[] = array("prefijo"=>trim($telefono_usuario_prefijo_1),"telefono"=>trim($telefono_usuario_detalle_1));
                                $usr_tel=trim($telefono_usuario_prefijo_1).'-'.trim($telefono_usuario_detalle_1);
                            }
                            
                            if(trim($telefono_usuario_prefijo_2)!=''){
                                
                                $telefonos[] = array("prefijo"=>trim($telefono_usuario_prefijo_2),"telefono"=>trim($telefono_usuario_detalle_2));
                                $usr_tel.=','.trim($telefono_usuario_prefijo_2).'-'.trim($telefono_usuario_detalle_2);
                            }
                            if(trim($telefono_usuario_detalle_3)!=''){
                                $telefonos[] = array("prefijo"=>trim($telefono_usuario_prefijo_3),"telefono"=>trim($telefono_usuario_detalle_3));
                                $usr_tel.=','.trim($telefono_usuario_prefijo_3).'-'.trim($telefono_usuario_detalle_3);
                            }
                        
                            
                            
                        $array_usuario = array(
                                                            'usr_raz' => $usr_raz,
                                                            'titular' => $titular,
                                                             'usr_dom' => $usr_dom,
                                                             'pro_id' => $pro_id,
                                                             'loc_id'=>$loc_id,
                                                             'usr_tel'=>$usr_tel,
                                                             'usr_mail'=>$usr_mail,
                                                             'web' =>$web,
                                                             'usr_matricula' => $usr_matricula,
                                                             'telefonos' =>$telefonos
                                    );

                    if (!$errors)
                    {
                            mysql_query("commit");
                            actualizar_inmoclick("usuarios",array("usr_id"=>_USR_ID,"array_usuario"=>$array_usuario));
                            $resultado="Los datos de la inmobiliaria han sido modificados";
                    }
                    else
                    {
                            $resultado="Error".mysql_error();
                            mysql_query("rollback");

                    }


      			
     break;
}
if (!$errors)	
{
	mysql_query("commit");
}
else
{
	mysql_query("rollback");
}


?>