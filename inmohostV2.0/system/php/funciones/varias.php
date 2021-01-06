<?php

include (_FILE_PHP_CLASS_UPLOAD);
include (_FILE_PHP_MAILER);
include ("actualiza_inmoclick.php");

//TOMAR EL ULTIMO ID
 function max_id($tabla,$campo){
 //	print "select max($campo) from $tabla";
 	   $num=mysql_query("select max($campo) from $tabla") or die(mysql_error());
 	   $max=mysql_result($num,0,0) + 1;
   return $max;
 }
 
function buscar_coincidencia($dem_id,$prp_id){
	session_start();
	if($dem_id){
		$cad="select * from demandas where dem_id=$dem_id";
		$res=mysql_query($cad);
		$fila=mysql_fetch_array($res);
		
		//RECUPERO LOCALIDADES
		$filt_loc="";
		$locs=split("x",$fila[loc_id]); //separo las localidades
		for ($i=0;$i<count($locs);$i++){ //recorro el array
		//	echo $locs[$i]."*$i*";
			if($locs[$i]!=""){ //por cada localidad armo el filtro
				$filt_loc.=" propiedades.loc_id=$locs[$i]";
				if($i<count($locs)-2){
					$filt_loc.=" or ";
				}
			}
		}
		
		
		//RECUPERO TIPOS DE CONSTRUCCION
		$filt_tip="";
		//echo $fila[loc_id];
		$tips=split("x",$fila[tip_id]);
		for ($i=0;$i<count($tips);$i++){
		//	echo $locs[$i]."*$i*";
			if($tips[$i]!=""){
				$filt_tip.=" propiedades.tip_id=$tips[$i]";
				if($i<count($tips)-2){
					$filt_tip.=" or ";
				}
			}
		}
		
		
		//RECUPERO CONDICIONES
		$filt_con="";
		//echo $fila[loc_id];
		$conds=split("x",$fila[con_id]);
		for ($i=0;$i<count($conds);$i++){
		//	echo $locs[$i]."*$i*";
			if($conds[$i]!=""){
				$filt_con.=" propiedades.con_id=$conds[$i]";
				if($i<count($conds)-2){
					$filt_con.=" or ";
				}
			}
		}
		
		
		//Ya tengo los filtros multiples. solo resta hacer la consulta en propiedades
		$regs=" prp_id,
				prp_dom,
				loc_desc,
				pro_desc,
				tip_desc,
				con_desc,
				prp_pre,
				prp_pre_dol ";
		
		$tablas="propiedades,
				 localidades,
				 provincias,
				 tipo_const,
				 condiciones";
		
		$filtro="propiedades.pro_id=provincias.pro_id and
				 propiedades.loc_id=localidades.loc_id and
				 propiedades.tip_id=tipo_const.tip_id and
				 propiedades.con_id=condiciones.con_id and 
				 propiedades.prp_mostrar=1 ";
		
		
		if($fila[dem_dom]){
			$filtro.=" and (propiedades.prp_dom like '%$fila[dem_dom]%' or propiedades.prp_bar like '%$fila[dem_dom]%')";		
		}
		/*
		if($fila[dem_barr]){
			$filtro.=" and (propiedades.prp_bar like '%$fila[dem_barr]%' or propiedades.prp_dom like '%$fila[dem_barr]%')";		
		}*/
		
		
		
		
		if($fila[dem_pre_min_dol]){
			$filtro.=" and (propiedades.prp_pre_dol >= $fila[dem_pre_min_dol])";
		}
		
		if($fila[dem_pre_max_dol]){
			$filtro.=" and (propiedades.prp_pre_dol <= $fila[dem_pre_max_dol])";
		}
		
		
		if($fila[pro_id]){
			$filtro.=" and propiedades.pro_id=$fila[pro_id] ";
		}
		
		if($filt_con){
			$filtro.="and ($filt_con)";		
		}
		
		if($filt_loc){
			$filtro.="and ($filt_loc)";		
		}
		
		if($filt_tip){
			$filtro.="and ($filt_tip)";		
		}

                if($fila['dem_habitaciones_min']!=0){
                    $filtro.=" and exists (select * from ser_x_prp_ihost where ser_id=3 and valor >= ".$fila['dem_habitaciones_min']." and propiedades.prp_id=ser_x_prp_ihost.prp_id and propiedades.usr_id=ser_x_prp_ihost.usr_id) ";
                }

                if($fila['dem_habitaciones_max']!=0){
                    $filtro.=" and exists (select * from ser_x_prp_ihost where ser_id=3 and valor <= ".$fila['dem_habitaciones_max']." and propiedades.prp_id=ser_x_prp_ihost.prp_id and propiedades.usr_id=ser_x_prp_ihost.usr_id) ";
                }


                if($fila['dem_banos_min']!=0){
                    $filtro.=" and exists (select * from ser_x_prp_ihost where ser_id=8 and valor >= ".$fila['dem_banos_min']." and propiedades.prp_id=ser_x_prp_ihost.prp_id and propiedades.usr_id=ser_x_prp_ihost.usr_id) ";
                }

                if($fila['dem_banos_max']!=0){
                    $filtro.=" and exists (select * from ser_x_prp_ihost where ser_id=8 and valor <= ".$fila['dem_banos_max']." and propiedades.prp_id=ser_x_prp_ihost.prp_id and propiedades.usr_id=ser_x_prp_ihost.usr_id) ";
                }

                if($fila['dem_sup_total_min']!=0){
                    $filtro.=" and exists (select * from ser_x_prp_ihost where ser_id=2 and valor >= ".$fila['dem_sup_total_min']." and propiedades.prp_id=ser_x_prp_ihost.prp_id and propiedades.usr_id=ser_x_prp_ihost.usr_id) ";
                }

                if($fila['dem_sup_total_max']!=0){
                    $filtro.=" and exists (select * from ser_x_prp_ihost where ser_id=2 and valor <= ".$fila['dem_sup_total_max']." and propiedades.prp_id=ser_x_prp_ihost.prp_id and propiedades.usr_id=ser_x_prp_ihost.usr_id) ";
                }


                if($fila['dem_sup_cubierta_min']!=0){
                    $filtro.=" and exists (select * from ser_x_prp_ihost where ser_id=7 and valor >= ".$fila['dem_sup_cubierta_min']." and propiedades.prp_id=ser_x_prp_ihost.prp_id and propiedades.usr_id=ser_x_prp_ihost.usr_id) ";
                }

                if($fila['dem_sup_cubierta_max']!=0){
                    $filtro.=" and exists (select * from ser_x_prp_ihost where ser_id=7 and valor <= ".$fila['dem_sup_cubierta_max']." and propiedades.prp_id=ser_x_prp_ihost.prp_id and propiedades.usr_id=ser_x_prp_ihost.usr_id) ";
                }

                if($fila['dem_cochera']){
                    if($fila['dem_cochera']==1){
                        $filtro.=" and exists (select * from ser_x_prp_ihost where ser_id=4 and ( (valor like '%garage%' or valor like '%cochera%') and valor not like '%sin cochera%') and propiedades.prp_id=ser_x_prp_ihost.prp_id and propiedades.usr_id=ser_x_prp_ihost.usr_id)";
                    }else{
                        $filtro.=" and exists (select * from ser_x_prp_ihost where ser_id=4 and ( valor like '%sin cochera%') and propiedades.prp_id=ser_x_prp_ihost.prp_id and propiedades.usr_id=ser_x_prp_ihost.usr_id)";
                    }
                }

                $volver=0;



               if($fila['dem_inmobiliaria'] || $fila['dem_red_inmoclick']){

                   if($fila['dem_inmobiliaria']){

                        if($fila['dem_pre_min']){
                            if($fila['dem_pre_max']){
                                $filtro.= " and (propiedades.prp_pre between ".$fila['dem_pre_min']." and ".$fila['dem_pre_max']." or propiedades.pre_inmo between ".$fila['dem_pre_min']." and ".$fila['dem_pre_max']."  ) ";
                            }else{
                                $filtro.=" and (propiedades.prp_pre >= ".$fila['dem_pre_min']." or propiedades.pre_inmo >= ".$fila['dem_pre_max'].")";
                            }
                            
                        }elseif($fila['dem_pre_max']){
                            $filtro.=" and (propiedades.prp_pre <= ".$fila['dem_pre_max']." or propiedades.pre_inmo <= ".$fila['dem_pre_max'].")";
                        }

                        //print"select $regs from $tablas where $filtro";
                        $result=mysql_query("select $regs from $tablas where $filtro"." and propiedades.usr_id="._USR_ID);

                     //   echo "select $regs from $tablas where $filtro"." and propiedades.usr_id="._USR_ID."<br>";
                        if(mysql_num_rows($result)){

                                $string="<table><tr><td colspan=8> COINCIDENCIAS DENTRO DE SUS PROPIEDADES <td></tr><tr><td colspan=5 style='font-weight:bold;border:2px solid #CCCCCC'>Coincidencias</td><td colspan=2 colspan=5 style='font-weight:bold;border:2px solid #CCCCCC'>Demandante</td></tr><tr><td style='font-weight:bold'> PRP_ID </td><td style='font-weight:bold'> Domicilio </td> <td style='font-weight:bold'> Inmueble </td><td style='font-weight:bold'> Condicion </td> <td style='font-weight:bold'> Precio  </td><td style='font-weight:bold'> Contacto </td><td style='font-weight:bold'> Enviar Mail</td></tr>";

                                while ($fil_res=mysql_fetch_array($result)) {
                                    $precio="";

                                    if($fil_res['prp_pre']){
                                        $precio.="\$".$fil_res['prp_pre'];
                                    }

                                    if($fil_res['prp_pre_dol']){
                                        $precio.=" USD".$fil_res['prp_pre_dol'];
                                    }


                                     $string.="<tr><td style='border:1px solid #CCCCCC;'><a href=\\\"javascript:ventana('prp_ficha', '&mod_edit=1&prp_id=$fil_res[prp_id]&usr_id="._USR_ID."', 'system/prp_ficha.php', 'Ficha de Propiedad');\\\">$fil_res[prp_id]</a></td><td style='border:1px solid #CCCCCC;'> $fil_res[prp_dom] - [$fil_res[loc_desc] - $fil_res[pro_desc]] </td> <td style='border:1px solid #CCCCCC;'> $fil_res[tip_desc] </td><td style='border:1px solid #CCCCCC;'> $fil_res[con_desc] </td> <td style='border:1px solid #CCCCCC;'> ".$precio."  </td><td style='border:1px solid #CCCCCC;'> $fila[dem_raz] - Tel: $fila[dem_tel] </td><td style='border:1px solid #CCCCCC;'><a href=\\\"javascript:ventana('env_mail', 'prp_id=$fil_res[prp_id]&usr_id="._USR_ID."&to=$fila[dem_mail]&subject=Solicitud de inmueble&dem_raz=$fila[dem_raz]', 'system/send_mail.php', 'Enviar Mail - Notificar Demanda');\\\"> $fila[dem_mail] </a></td></tr>";

                                }

                                      $string.="</table>";
                                         $volver=1;
                        }

                           
                    }

                    if($fila['dem_red_inmoclick']){

                            include(dirname(__FILE__)."/../conexion_inmoclick.php");

                            if($fila['dem_pre_min']){

                                if($fila['dem_pre_max']){
                                  $filtro.= " and propiedades.prp_pre between ".$fila['dem_pre_min']." and ".$fila['dem_pre_max']." ";
                                }else{
                                    $filtro.=" and propiedades.prp_pre >= ".$fila['dem_pre_min'];
                                }
                            }elseif($fila['dem_pre_max']){
                                $filtro.=" and propiedades.prp_pre <= ".$fila['dem_pre_max'];
                            }

                                $regs.=",usuarios.usr_raz,propiedades.usr_id";

                                $tablas="propiedades join usuarios on (propiedades.usr_id=usuarios.usr_id) ,
                                             localidades,
                                             provincias,
                                             tipo_const,
                                             condiciones";
                              $filtro.="and usuarios.web != '' and usuarios.visible=1 and usuarios.usr_tipo=2 and propiedades.usr_id!="._USR_ID." ";
                              //

                        $result=mysql_query("select $regs from $tablas where $filtro",$conn2) or die("error".mysql_error($conn2));

                     //   echo "select $regs from $tablas where $filtro";
                        if(mysql_num_rows($result)){
                                
                                $string.="<hr/><table><tr><td colspan=8> COINCIDENCIAS EN LA RED DE INMOCLICK <td></tr><tr><td colspan=6 style='font-weight:bold;border:2px solid #CCCCCC'>Coincidencias</td><td colspan=2 colspan=5 style='font-weight:bold;border:2px solid #CCCCCC'>Demandante</td></tr><tr><td  style='font-weight:bold'> INMOBILIARIA </td> <td style='font-weight:bold'> PRP_ID </td><td style='font-weight:bold'> Domicilio </td> <td style='font-weight:bold'> Inmueble </td><td style='font-weight:bold'> Condicion </td> <td style='font-weight:bold'> Precio  </td><td style='font-weight:bold'> Contacto </td><td style='font-weight:bold'> Enviar Mail</td></tr>";
                                while ($fil_res=mysql_fetch_array($result)) {

                                    $precio="";

                                    if($fil_res['prp_pre']){
                                        $precio.="\$".$fil_res['prp_pre'];
                                    }

                                    if($fil_res['prp_pre_dol']){
                                        $precio.=" USD".$fil_res['prp_pre_dol'];
                                    }

                                        $string.="<tr><td style='border:1px solid #CCCCCC;'>".$fil_res['usr_raz']."</td><td style='border:1px solid #CCCCCC;'><a href=\\\"javascript:ventana('prp_ficha', '&mod_edit=1&prp_id=$fil_res[prp_id]&usr_inmohost="._USR_ID."&usr_id=".$fil_res[usr_id]."', 'system/prp_ficha.php', 'Ficha de Propiedad');\\\">$fil_res[prp_id]</a></td><td style='border:1px solid #CCCCCC;'> ".trim(addslashes($fil_res['prp_dom']))." - [".$fil_res['loc_desc']." - ".$fil_res['pro_desc']."] </td><td style='border:1px solid #CCCCCC;'> $fil_res[tip_desc] </td>                                           <td style='border:1px solid #CCCCCC;'> $fil_res[con_desc] </td><td style='border:1px solid #CCCCCC;'> ".$precio."  </td><td style='border:1px solid #CCCCCC;'> $fila[dem_raz] - Tel: $fila[dem_tel] </td><td style='border:1px solid #CCCCCC;'><a href=\\\"javascript:ventana('env_mail', 'prp_id=$fil_res[prp_id]&usr_id="._USR_ID."&to=$fila[dem_mail]&subject=Solicitud de inmueble&dem_raz=$fila[dem_raz]', 'system/send_mail.php', 'Enviar Mail - Notificar Demanda');\\\"> $fila[dem_mail] </a></td></tr>";

                                }

                                $string.="</table>";
                                $volver=1;
                        }

                            mysql_close($conn2);
                   
                    }elseif($volver==1){
                        $string.="</table>";
                    }

                    if($volver){
                      print "
                                <script language='Javascript'>
                                    
                                            parent.Dialog.alert(\"<div style='font-size:12px;'><br>Estimado <b>".$_COOKIE['usuario']['usr_login']."</b>, Ud. acaba de agregar o modificar una demanda que coincide con una o m&aacute;s propiedades.<br><br>A trav&eacute;s del siguiente listado Ud. podr&aacute; comunicarse por telefono con el interesado o hacer click en<br>ENVIAR MAIL y el sistema enviar&aacute; automaticamente un aviso al interesado del inmueble en cartera.<br></div><br> $string  \", {windowParameters: {className:\"alert\", width:700, height:400},okLabel: \"Cerrar\" });
                                            

                               </script>
                                    
                            ";
                    }
                }

              
	}else{
		
		$cad="select * from demandas";
		$res=mysql_query($cad);
		
		while ($fila=mysql_fetch_array($res)){
						
				//RECUPERO LOCALIDADES
				$filt_loc="";
				$cad_loc="";
				$locs=split("x",$fila[loc_id]); //separo las localidades
				for ($i=0;$i<count($locs);$i++){ //recorro el array
				//	echo $locs[$i]."*$i*";
						if($locs[$i]!=""){ //por cada localidad armo el filtro
						/*
							comparo con domicilios
						*/
							$c=mysql_query("select loc_desc from localidades where loc_id=$locs[$i]");
							$r=mysql_result($c,0,0);
							$filt_loc_dom=" propiedades.prp_dom like '%$r%'";							
						/*
						fin
						*/
					
						$filt_loc.=" propiedades.loc_id=$locs[$i]";
					
						$loc_desc=mysql_result(mysql_query("select loc_desc from localidades where loc_id=$locs[$i]"),0,0);
						$cad_loc.="$loc_desc";
						if($i<count($locs)-2){
							$filt_loc.=" or ";
							$filt_loc_dom.=" or ";
							$cad_loc.=" o ";
						}
					}
				}
			//	print $filt_loc;
				
				//RECUPERO TIPOS DE CONSTRUCCION
				$filt_tip="";
				$cad_tip="";
				$tips=split("x",$fila[tip_id]);
				for ($i=0;$i<count($tips);$i++){
				//	echo $locs[$i]."*$i*";
					if($tips[$i]!=""){
						$filt_tip.=" propiedades.tip_id=$tips[$i]";
						$tip_desc=mysql_result(mysql_query("select tip_desc from tipo_const where tip_id=$tips[$i]"),0,0);
						$cad_tip.="$tip_desc";
						if($i<count($tips)-2){
							$filt_tip.=" or ";
							$cad_tip.=" o ";
						}
					}
				}
				
				
				//RECUPERO CONDICIONES
				$filt_con="";
				//echo $fila[loc_id];
				$cad_con="";
				$conds=split("x",$fila[con_id]);
				for ($i=0;$i<count($conds);$i++){
				//	echo $locs[$i]."*$i*";
					if($conds[$i]!=""){
						$filt_con.=" propiedades.con_id=$conds[$i]";
						$con_desc=mysql_result(mysql_query("select con_desc from condiciones where con_id=$conds[$i]"),0,0);
						$cad_con.="$con_desc";
						if($i<count($conds)-2){
							$filt_con.=" or ";
							$cad_con.=" o ";
						}
					}
				}												
				
				//Ya tengo los filtros. solo resta hacer la consulta en propiedades para el id q acabo de cargar o modificar
				$regs=" prp_id, 
						prp_dom,
						loc_desc,
						pro_desc,
						tip_desc,
						con_desc,
						prp_pre ";
				
				$tablas="propiedades,
						 localidades,
						 provincias,
						 tipo_const,
						 condiciones";
				
				$filtro="propiedades.pro_id=provincias.pro_id and
						 propiedades.loc_id=localidades.loc_id and
						 propiedades.tip_id=tipo_const.tip_id and
						 propiedades.con_id=condiciones.con_id and
						 propiedades.usr_id="._USR_ID." ";
				
				if($prp_id){
					$filtro.=" and propiedades.prp_id=$prp_id ";
				}
				

				if($fila[dem_dom]){
					$filtro.=" and (propiedades.prp_dom like '%$fila[dem_dom]%' or propiedades.prp_bar like '%$fila[dem_dom]%'"; 
					
					if($filt_loc_dom){
						 
						$filtro.=" or $filt_loc_dom ";
					}
					$filtro.= ")";		
				}
				
					
				
				/*
				if($fila[dem_barr]){
					$filtro.=" and (propiedades.prp_bar like '%$fila[dem_barr]%' or propiedades.prp_dom like '%$fila[dem_barr]%')";		
				}*/



				if($fila['dem_pre_min']){
                                    if($fila['dem_pre_max']){

                                        $filtro.= " and (propiedades.prp_pre between ".$fila['dem_pre_min']." and ".$fila['dem_pre_max']." or propiedades.pre_inmo between ".$fila['dem_pre_min']." and ".$fila['dem_pre_max']."  ) ";

                                    }else{
                                        $filtro.=" and (propiedades.prp_pre >= $fila[dem_pre_min] or propiedades.pre_inmo >= $fila[dem_pre_min]) ";
                                    }
					
				}elseif($fila['dem_pre_max']){
					$filtro.=" and (propiedades.prp_pre <= $fila[dem_pre_max] or propiedades.pre_inmo <= $fila[dem_pre_min]) ";
				}
				
				if($fila['dem_pre_min_dol']){
					 $filtro.=" and (propiedades.prp_pre_dol >= $fila[dem_pre_min_dol]) ";
				}
				
				if($fila['dem_pre_max_dol']){
					 $filtro.=" and (propiedades.prp_pre_dol <= $fila[dem_pre_max_dol]) ";
				}
				
				
				
				if($fila[pro_id]){
					$filtro.=" and propiedades.pro_id=$fila[pro_id] ";
				}
				
				if($filt_con){
					$filtro.="and ($filt_con)";		
				}
				
				if($filt_loc){
					$filtro.="and ($filt_loc)";		
				}
				
				if($filt_tip){
					$filtro.="and ($filt_tip)";		
				}

                                if($fila['dem_habitaciones_min']!=0){
                                    $filtro.=" and exists (select * from ser_x_prp_ihost where ser_id=3 and valor >= ".$fila['dem_habitaciones_min']." and propiedades.prp_id=ser_x_prp_ihost.prp_id and propiedades.usr_id=ser_x_prp_ihost.usr_id) ";
                                }

                                if($fila['dem_habitaciones_max']!=0){
                                    $filtro.=" and exists (select * from ser_x_prp_ihost where ser_id=3 and valor <= ".$fila['dem_habitaciones_max']." and propiedades.prp_id=ser_x_prp_ihost.prp_id and propiedades.usr_id=ser_x_prp_ihost.usr_id) ";
                                }


                                if($fila['dem_banos_min']!=0){
                                    $filtro.=" and exists (select * from ser_x_prp_ihost where ser_id=8 and valor >= ".$fila['dem_banos_min']." and propiedades.prp_id=ser_x_prp_ihost.prp_id and propiedades.usr_id=ser_x_prp_ihost.usr_id) ";
                                }

                                if($fila['dem_banos_max']!=0){
                                    $filtro.=" and exists (select * from ser_x_prp_ihost where ser_id=8 and valor <= ".$fila['dem_banos_max']." and propiedades.prp_id=ser_x_prp_ihost.prp_id and propiedades.usr_id=ser_x_prp_ihost.usr_id) ";
                                }

                                if($fila['dem_sup_total_min']!=0){
                                    $filtro.=" and exists (select * from ser_x_prp_ihost where ser_id=2 and valor >= ".$fila['dem_sup_total_min']." and propiedades.prp_id=ser_x_prp_ihost.prp_id and propiedades.usr_id=ser_x_prp_ihost.usr_id) ";
                                }

                                if($fila['dem_sup_total_max']!=0){
                                    $filtro.=" and exists (select * from ser_x_prp_ihost where ser_id=2 and valor <= ".$fila['dem_sup_total_max']." and propiedades.prp_id=ser_x_prp_ihost.prp_id and propiedades.usr_id=ser_x_prp_ihost.usr_id) ";
                                }


                                if($fila['dem_sup_cubierta_min']!=0){
                                    $filtro.=" and exists (select * from ser_x_prp_ihost where ser_id=7 and valor >= ".$fila['dem_sup_cubierta_min']." and propiedades.prp_id=ser_x_prp_ihost.prp_id and propiedades.usr_id=ser_x_prp_ihost.usr_id) ";
                                }

                                if($fila['dem_sup_cubierta_max']!=0){
                                    $filtro.=" and exists (select * from ser_x_prp_ihost where ser_id=7 and valor <= ".$fila['dem_sup_cubierta_max']." and propiedades.prp_id=ser_x_prp_ihost.prp_id and propiedades.usr_id=ser_x_prp_ihost.usr_id) ";
                                }

                                if($fila['dem_cochera']){
                                    if($fila['dem_cochera']==1){
                                        $filtro.=" and exists (select * from ser_x_prp_ihost where ser_id=4 and ( (valor like '%garage%' or valor like '%cochera%') and valor not like '%sin cochera%') and propiedades.prp_id=ser_x_prp_ihost.prp_id and propiedades.usr_id=ser_x_prp_ihost.usr_id)";
                                    }else{
                                        $filtro.=" and exists (select * from ser_x_prp_ihost where ser_id=4 and ( valor like '%sin cochera%') and propiedades.prp_id=ser_x_prp_ihost.prp_id and propiedades.usr_id=ser_x_prp_ihost.usr_id)";
                                    }
                                }
									
				//print "<Br> $prp_id select $regs from $tablas where $filtro <br>";		
				
				$result=mysql_query("select $regs from $tablas where $filtro");
				
				if(mysql_num_rows($result)){ //si encontro una demanda q satisface esa propiedad. 
					//print"--$fila[dem_id] --select $regs from $tablas where $filtro<br><br>";
					while ($fil_res=mysql_fetch_array($result)) {
						$string.="<tr><td  style='border:1px solid #CCCCCC;'> $fila[dem_dom] - $cad_loc </td> <td style='border:1px solid #CCCCCC;'> $cad_tip </td><td style='border:1px solid #CCCCCC;'> $cad_con </td> <td style='border:1px solid #CCCCCC;'> $fila[dem_pre_min] y $fila[dem_pre_max] -- U\$S$fila[dem_pre_min_dol] y U\$S$fila[dem_pre_max_dol] </td><td style='border:1px solid #CCCCCC;'> $fila[dem_raz] - Tel: $fila[dem_tel] </td><td style='border:1px solid #CCCCCC;'><a href=\\\"javascript:ventana('env_mail', 'prp_id=$fil_res[prp_id]&usr_id="._USR_ID."&to=$fila[dem_mail]&subject=Solicitud de inmueble&dem_raz=$fila[dem_raz]', 'system/send_mail.php', 'Enviar Mail - Notificar Demanda');\\\"> $fila[dem_mail] </a></td></tr></tr>";
						
					}
					
									
				}
		}
		
		if($string){  
		
			$string="<table width='100%'><tr><td colspan=4 style='font-weight:bold;border:2px solid #CCCCCC'>Coincidencias</td><td colspan=2 colspan=5 style='font-weight:bold;border:2px solid #CCCCCC'>Demandante</td></tr><tr><td style='font-weight:bold' width='145px;'> Domicilio </td> <td style='font-weight:bold' width='125px;'> Inmueble </td><td width='105px;' style='font-weight:bold'> Condicion </td> <td style='font-weight:bold' width='80px;'> Precio  </td><td  width='150px; 'style='font-weight:bold'> Contacto </td><td  width='100px;' style='font-weight:bold'> Enviar Mail</td></tr>".$string;
			$string.="</table>";
			print "
				<script language='javascript'>
						parent.Dialog.alert(\"<div style='font-size:12px;'><br>Estimado <b>".$_COOKIE['usuario']['usr_login']."</b>, Ud. acaba de agregar o modificar un inmueble que coincide con una o m&aacute;s demandas pendientes.<br><br>A trav&eacute;s del siguiente listado Ud. podr&aacute; comunicarse por tel&eacute;fono con el interesado o hacer click en<br>ENVIAR MAIL y el sistema enviar&aacute; automaticamente un aviso al interesado del inmueble en cartera.<br></div><br> $string \", {windowParameters: {className:\"alert\", width:700, height:400},
						okLabel: \"Cerrar\"
						 });
					hideToolTip();
				</script>
			";
			$volver=1;
		}else{
			$volver=0;
		}
		
	}
	
	return $volver;
	
}

function formato_fecha ($datetime, $modo){

		$datos = explode (" ", $datetime);
	
	switch ($modo){
	
		case "fecha":
			$new_fecha= substr($datos[0],8,2).'-'.substr($datos[0],5,2);
		break;

		case "fechaAll":
			$new_fecha= substr($datos[0],8,2).'-'.substr($datos[0],5,2).'-'.substr($datos[0],0,4);
		break;
		
		case "hora":
			$new_fecha = substr($datos[1],0,5);
		break;

		case "all":
			$new_fecha= substr($datos[0],8,2).'-'.substr($datos[0],5,2).' ('.substr($datos[1],0,5).')';
		break;

		case "trozoFecha":
			$new_fecha= explode ("-", $datos[0]);
		break;

		case "trozoHora":
			$new_fecha= explode (":", $datos[1]);
		break;
		
		default:
			$new_fecha = $datetime;
		break;
	}
	
	
	return $new_fecha;

}

function FUNC_brouserUsr(){ //echo FUNC_brouserUsr();
	if((ereg("Nav", $_SERVER["HTTP_USER_AGENT"])) || (ereg("Gold", $_SERVER["HTTP_USER_AGENT"])) || (ereg("X11", $_SERVER["HTTP_USER_AGENT"])) || (ereg("Mozilla", $_SERVER["HTTP_USER_AGENT"])) || (ereg("Netscape", $_SERVER["HTTP_USER_AGENT"])) AND (!ereg("MSIE", $_SERVER["HTTP_USER_AGENT"]) AND (!ereg("Konqueror", $_SERVER["HTTP_USER_AGENT"])))) $browser = "Netscape"; 

		elseif(ereg("MSIE", $_SERVER["HTTP_USER_AGENT"])) $browser = "MSIE";

		elseif(ereg("Lynx", $_SERVER["HTTP_USER_AGENT"])) $browser = "Lynx";

		elseif(ereg("Opera", $_SERVER["HTTP_USER_AGENT"])) $browser = "Opera";

		elseif(ereg("Netscape", $_SERVER["HTTP_USER_AGENT"])) $browser = "Netscape";

		elseif(ereg("Konqueror", $_SERVER["HTTP_USER_AGENT"])) $browser = "Konqueror";

		elseif((eregi("bot", $_SERVER["HTTP_USER_AGENT"])) || (ereg("Google", $_SERVER["HTTP_USER_AGENT"])) || (ereg("Slurp", $_SERVER["HTTP_USER_AGENT"])) || (ereg("Scooter", $_SERVER["HTTP_USER_AGENT"])) || (eregi("Spider", $_SERVER["HTTP_USER_AGENT"])) || (eregi("Infoseek", $_SERVER["HTTP_USER_AGENT"]))) $browser = "Bot";

		else $browser = "Other";
	
		return $browser;
}

/*	
	function redim_foto($foto,$dest)
	{
        $dim=@getimagesize($foto);
        $tama�o=@filesize($foto);
        $tam=640;
        $calidad=100;
        while($tama�o>70000)
        {
				$img_f=@ImageCreateFromJpeg($foto);//crea una variable para manejar la imagen
                $prop=@($tam/@imagesx($img_f));//calcula proporci�n
                $tam_x=$prop*(@imagesx($img_f));//recalcula los nuevos tama�os
                $tam_y=$prop*(@imagesy($img_f));
                $img_d=@imagecreate($tam_x,$tam_y);//crea imagen
                @ImageCopyResized($img_d,$img_f,0,0,0,0,$tam_x,$tam_y,imagesx($img_f),imagesy($img_f));//copia cambia
                @imageJpeg($img_d,$dest);
                clearstatcache();
                $tama�o=@filesize($dest);
                $tam-=1;
 		}
	}
*/
	function busq_binaria($foto,$dest)
	{
 		
		$upload=new upload();	
		
		/*$width=640;
		$prop = 0.5;
		$target_size = 70000;
		$tolerance = 10000;
		$inc=0.1;
		$i=0;
		$cad='';
		do{
			$img_f=ImageCreateFromJpeg($foto);//crea una variable para manejar la imagen
     		$tam_x=$prop*(imagesx($img_f));//recalcula los nuevos tama�os
   			$tam_y=$prop*(imagesy($img_f));
    		$img_d=imagecreatetruecolor($tam_x,$tam_y);//crea imagen
     		ImageCopyResized($img_d,$img_f,0,0,0,0,$tam_x,$tam_y,imagesx($img_f),imagesy($img_f));//copia cambia
			imagejpeg($img_d,$dest,10);
			clearstatcache();
			$diff = filesize($dest) - $target_size;
			if($diff > 0)
				$prop = $prop / (1.5 + $inc);
			else
				$prop = $prop * (1.5 - $inc);
			$inc=$inc+0.1;	
			$cad.="<br>Bucle: $i <\t>diff:$diff<\t>tolerance:$tolerance<\t>tam_x:$tam_x<\t>tam_y:$tam_y<\t>prop:$prop";
		}while(abs($diff) > $tolerance);
		*/
	}
	function redimensionar_foto($foto,$dest)
	{
		$fo = new Upload($_FILES[$foto]);
		if ($fo->uploaded) 
		{
		  // Guarda la foto sin cambios
		  $fo->Process($dest);
		  if ($fo->processed) { 
		    echo 'Foto original: copiada'; 
		  } else {
		    echo 'error : ' . $fo->error;
		  }
		  /*
		  // guarda la foto con un nuevo nombre
		  $fo->file_new_name_body = 'foto_nueva';
		  $fo->Process($dest);
		  if ($fo->processed) {
		    echo 'foto renombrada a foto_nueva: copiada';
		  } else { 
		    echo 'error : ' . $fo->error; 
		  }
		  
		  // guarda la foto con un nuevo nombre y tama�o de 100px de ancho
		  $fo->file_new_name_body = 'foto_modificada';
		  $fo->image_resize = true;
		  $fo->image_convert = jpg;
		  $fo->image_x = 100;
		  $fo->jpeg_quality = 50;
		  $fo->image_ratio_y = true;
		  $fo->Process($dest);
		  if ($fo->processed) {
		    echo 'foto renombrada, achicada, y convertida a JPG';
		    $fo->Clean();
		  } else {
		    echo 'error : ' . $fo->error;
		  }
		}		
		*/
		}
		return "FOTO $foto subida a $dest";
	}
	
	function redim_foto($foto,$dest,$nom_foto,$conn_id){
		
		$fo = new Upload($_FILES[$foto]);
		if ($fo->uploaded) {
		  
		  // guarda la foto con un nuevo nombre y tama�o de 100px de ancho
		  $fo->file_new_name_body = $nom_foto;
		  $fo->image_resize = true;
		  $fo->image_convert = jpg;
		  $fo->image_ratio=true;
		  $fo->image_x = 640;
		  $fo->image_y = 480;
		  $fo->jpeg_quality = 70;
		  //$fo->image_ratio_x = true;
		  $fo->Process('/tmp/'.$dest);
		  if ($fo->processed) {
		    //echo '<BR>foto renombrada, achicada, y convertida a JPG';
		    $fo->Clean();
		  } else {
		    echo 'Error al achicar la foto: ' . $fo->error." Foto: ".$foto ." _FILES=".$_FILES[$foto];
		  }
		
		  
			ftp_put($conn_id, "/fotos/".$nom_foto.".gif", '/tmp/'.$dest.$nom_foto.".jpg", FTP_ASCII);
			rename($dest.$nom_foto.".jpg" , $dest.$nom_foto.".gif");	
			
			

		}else{
			print "<br>Error : " . $fo->error ." Foto: ".$foto ." _FILES=".$_FILES[$foto];
		}		
	}	

function string_to_underscore_name($string)
                        
                {

                    $string = preg_replace('/[\'"]/', '', $string);

                    $string = preg_replace('/[^a-zA-Z0-9\.]+/', '_', $string);

                    $string = trim($string, '_');

                    $string = strtolower($string);



                    return $string;

                }


function armar_script_web($usr_id){

	$str="<? include \"../parametros.php\";
			mysql_query(\"start transaction\");\n\r";	
	
	$cadena="select cambio_id,usr_id,cam_per_fot1,cam_per_fot2,cam_per_fot3,cam_per_logo from cambios_pagina";
	$result=mysql_query($cadena);

	while ($fila=mysql_fetch_array($result)) {
		$cadena="select 	
						per_denom,
						per_info,
						per_serv,
						per_pag,
						per_fot1,
						per_fot2,
						per_fot3,
						per_logo,
						usr_raz,
						usr_dom,
						usr_tel,
						usr_mail,
						pro_id,
						loc_id,
						fecha_act
				   from
						usuarios,
						personaliz
					where
						usuarios.usr_id=personaliz.usr_id and
						usuarios.usr_id=$usr_id
					
		";
	
		
		
		$res1=mysql_query($cadena);
		
		if(mysql_num_rows($res1)){
				$web=mysql_fetch_array($res1);
				//print mysql_num_fields($res1)."aa";
				$per_denom=addslashes($web[per_denom]);
				$per_info=addslashes($web[per_info]);
				$per_serv=addslashes($web[per_serv]);
				$per_pag=addslashes($web[per_pag]);
				$usr_raz=addslashes($web[usr_raz]);
				$usr_dom=addslashes($web[usr_dom]);
				$usr_tel=addslashes($web[usr_tel]);
				$usr_mail=addslashes($web[usr_mail]);
				
				$cadena="update usuarios set loc_id=$web[loc_id],pro_id=$web[pro_id],usr_raz='$usr_raz',usr_dom='$usr_dom',usr_tel='$usr_tel',usr_mail='$usr_mail',fecha_act='$web[fecha_act]' where usr_id=$usr_id";
				$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: $cadena\".mysql_error();\r\n";		
				
				$cadena="update personaliz set per_denom='$per_denmo',per_info='$per_info',per_serv='$per_serv',per_pag='$per_pag',per_fot1='$web[per_fot1]',per_fot2='$web[per_fot2]',per_fot3='$web[per_fot3]',per_logo='$web[per_logo]' where usr_id=$usr_id";
				$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: $cadena\".mysql_error();\r\n";		
				
		}
	
	}
	
	
			$str.="
								
					if(\$error){
						mysql_query(\"rollback\");
						?>
							<link rel=stylesheet href=\"inmoclick.css\" type=text/css>
							<div id=tabla1 class=celda_2 style='position:absolute;left:25%;top:20%;'>
								<table align=center border=0 width=60% cellspacing=0 style=\"border-top:1px solid #990000;border-bottom:1px solid #990000;border-left:1px solid #990000;border-right:1px solid #990000;\">
									<tr>
										<td style=\"font-family:verdana;font-size:11px;font-color:#DDDDDD;\" colspan=6><b>Ocurrio un error en la consulta. La actualizaci�n no se pudo llevar a cabo. <?print \$error?></b></td>
									</tr>
									<tr>
										<td style=\"font-family:verdana;font-size:11px;font-color:#DDDDDD;\" colspan=6><b><? 
											mail(\"info@inmoclick.com.ar\",\"Informe de error usuario \$usr_id\ - \$usr_raz\",\"El usuario \$usr_id - \$usr_raz no ha podido actualizar sus inmuebles en internet:\$error\");					
											
										?>Se ha enviado un informe de error.</b></b></td>
									</tr>
								</table>		
							</div>
							
							<?
					}else{
						
						
						mysql_query(\"commit\");
						//mysql_query(\"rollback\");
					//	print\"actualizo joya\";
					//	print \$usr_cim;
					//	exit();
						?>
							<script language=\"javascript\">
									location.href='http://<?print \$ip?><?print \$ADMIN?>/detalle_modif_web.php?usr_id=<?print \$usr_id?>&usuario=<?print \$usuario?>&actualizacion=1&ip_local=<?print \$ip?>';
							</script>
						
						<?
					}
					
					?>
				";
				
				if($fp2=fopen("../inmo$usr_id/act_web_$usr_id.php","w+")){
					fputs($fp2,$str);
					return 1;
				}else{
					return 0;
				}


}


function armar_script_bar_priv($usr_id){
	
	$str="<? include \"../parametros.php\";
						mysql_query(\"start transaction\");\n\r";	
		
				$cadena="select cambio_id,cambio_det,bar_id,usr_id,cambio_fotos from cambios_bar_priv";
				
				$result=mysql_query($cadena);
				$str2="";
				$j=0;
				
				//Cuando se instale en cocucci, hay q agregar el campo usr_id en bar_priv en internet. y probar la subida. 
				while ($fila=mysql_fetch_array($result)){
				//while (0){
					$cadena="select * from bar_priv where usr_id=$fila[usr_id] and bar_id=$fila[bar_id]";
					$res1=mysql_query($cadena);
					
	//				print $cadena."<br>";
					
					switch ($fila[cambio_det]){
						case "alta":
								if(mysql_num_rows($res1)){
									
									$prp=mysql_fetch_array($res1);
									$cadena="insert into bar_priv  values($prp[bar_id],
																		  $prp[usr_id],
																			'$prp[bar_denom]',
																			'$prp[bar_sup_tot]',
																			'$prp[bar_sup_lot]',
																			'$prp[bar_cant_lot]',
																			'$prp[bar_serv]',
																			'$prp[bar_cont]',
																			'$prp[bar_tel]',
																			'$prp[bar_mail]',
																			'$prp[loc_id]',
																			'$prp[pro_id]',
																			'$prp[pai_id]',
																			'$prp[bar_zona]',
																			'$prp[bar_dir]',
																			'$prp[bar_comp_priv]',
																			'$prp[bar_url]',
																			'$prp[bar_logo]',
																			'$prp[bar_desc]'
																			)
																			
																			";
									$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: insert $prp[bar_id] - $prp[usr_id]\".mysql_error();\r\n";	

									//fotos	
									$res_alt=mysql_query("select * from fotos_x_bar where bar_id=$fila[bar_id] and usr_id=$fila[usr_id]");	
									
									while ($fila_fot=mysql_fetch_array($res_alt)){
											$cadena="delete from fotos_x_bar where bar_id=$fila[bar_id] and usr_id=$fila[usr_id] and fo_id='$fila_fot[fo_id]'";
											$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: $cadena\".mysql_error();\r\n";	
											$cadena="insert into fotos_x_bar values($fila[bar_id],$fila[usr_id],$fila_fot[fo_id],'$fila_fot[fo_desc]')";							
											$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: $cadena\".mysql_error();\r\n";	
									}	
										
								}//fin if mysql_num_rows
												  	
							break;	
							case "modificacion":
								//print $cadena."<br>";								
								if(mysql_num_rows($res1)){
									//print "modificacion<br>";
									$prp=mysql_fetch_array($res1);
								
																								
									$cadena="update bar_priv set 
																	bar_denom='$prp[bar_denom]',
																	bar_sup_tot='$prp[bar_sup_tot]',
																	bar_sup_lot='$prp[bar_sup_lot]',
																	bar_cant_lot='$prp[bar_cant_lot]',
																	bar_serv='$prp[bar_serv]',
																	bar_cont='$prp[bar_cont]',
																	bar_tel='$prp[bar_tel]',
																	bar_mail='$prp[bar_mail]',
																	loc_id='$prp[loc_id]',
																	pro_id='$prp[pro_id]',
																	pai_id='$prp[pai_id]',
																	bar_zona='$prp[bar_zona]',
																	bar_dir='$prp[bar_dir]',
																	bar_comp_priv='$prp[bar_comp_priv]',
																	bar_url='$prp[bar_url]',
																	bar_logo='$prp[bar_logo]',
																	bar_desc='$prp[bar_desc]'
															 where bar_id=$fila[bar_id] and usr_id=$fila[usr_id])";
									$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: update $prp[bar_id] - $prp[usr_id]\".mysql_error();\r\n";		
									
									//fotos	
									$res_alt=mysql_query("select * from fotos_x_bar where bar_id=$fila[bar_id] and usr_id=$fila[usr_id]");	
									$cadena="delete from fotos_x_bar where bar_id=$fila[bar_id] and usr_id=$fila[usr_id]";
									$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: $cadena\".mysql_error();\r\n";	
									while ($fila_fot=mysql_fetch_array($res_alt)){
											
											$cadena="insert into fotos_x_bar values($fila[bar_id],$fila[usr_id],$fila_fot[fo_id],'$fila_fot[fo_desc]')";							
											$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: $cadena\".mysql_error();\r\n";	
									}
									
									$vector=explode("x",$fila[cambios_fotos]);
									//print "VECTOR - ".count($vector);
									for($i=1;$i<=count($vector)-1;$i++){
										$verif=mysql_query("select * from fotos_x_bar where bar_id=$fila[bar_id] and usr_id=$fila[usr_id] and fo_id=$vector[$i]") or die(mysql_error());
										if(!mysql_num_rows($verif)){
											
												$str2.="exec('rm ./fotos/$fila[bar_id]-$fila[usr_id]-$vector[$i].gif');\r\n";
										}
									}					
									
									
								}	
								
								
							break;
							
							case "eliminacion":
								
									$cadena="delete from bar_priv where usr_id=$fila[usr_id] and bar_id=$fila[bar_id]";
									$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: $cadena\".mysql_error();\r\n";	
									
								//fotos	
								$res_alt=mysql_query("select * from fotos where bar_id=$fila[bar_id] and usr_id=$fila[usr_id]");	
								while ($fila_fot=mysql_fetch_array($res_alt)){
										$str2.="exec('rm ./fotos/$fila_fot[fo_desc]');\r\n";
								}	
									
										
								$cadena="delete from fotos_x_bar where usr_id=$fila[usr_id] and bar_id=$fila[bar_id]";					
								$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: $cadena\".mysql_error();\r\n";	
								
							break;
					}
				}
		
				$str.="
								
					if(\$error){
						\$e=1;
						mysql_query(\"rollback\");
						?>
							<link rel=stylesheet href=\"inmoclick.css\" type=text/css>
							<div id=tabla1 class=celda_2 style='position:absolute;left:25%;top:20%;'>
								<table align=center border=0 width=60% cellspacing=0 style=\"border-top:1px solid #990000;border-bottom:1px solid #990000;border-left:1px solid #990000;border-right:1px solid #990000;\">
									<tr>
										<td style=\"font-family:verdana;font-size:11px;font-color:#DDDDDD;\" colspan=6><b>Ocurrio un error en la consulta. La actualizaci�n no se pudo llevar a cabo. <?print \$error?></b></td>
									</tr>
									<tr>
										<td style=\"font-family:verdana;font-size:11px;font-color:#DDDDDD;\" colspan=6><b><? 
											mail(\"info@inmoclick.com.ar\",\"Informe de error usuario \$usr_id \$usr_raz \",\"El usuario \$usr_id \$usr_raz no ha podido actualizar sus barrios privados en internet:\$error\");					
											
										?>Se ha enviado un informe de error.</b></b></td>
									</tr>
								</table>		
							</div>
							
							<?
					}else{
							$str2
							\$e=0;
							mysql_query(\"commit\");
					}		
							";
	
				$str.="
						
						
						?>
							
						
							<script language=\"javascript\">
									location.href=\"http://<?print \$ip?>/inmohostV2.0/system/actualizador_pre.php?usr_id=<?print \$usr_id?>&borrar_cache_bar_priv=1&e=<?print \$e?>\";
							</script>
						
						<?
					
					
					?>
				";
				
				
				
			
				if($fp2=fopen("act_bar_priv_$usr_id.php","w+")){
					fputs($fp2,$str);
					return 1;
				}else{
					return 0;
				}
	
	
}

function armar_script_emp($usr_id){
	
	$str="<? include \"../parametros.php\";
						mysql_query(\"start transaction\");\n\r";	
		
				$cadena="select cambio_id,cambio_det,emp_id from cambios_emp";
				
				$result=mysql_query($cadena);
				$str2="";
				$j=0;
				
				//Cuando se instale en cocucci, hay q agregar el campo usr_id en bar_priv en internet. y probar la subida. 
				while ($fila=mysql_fetch_array($result)){
				//while (0){
					
					$cadena="select * from empleados where emp_id=$fila[emp_id]";
					$res1=mysql_query($cadena);
					
	//				print $cadena."<br>";
					$prp=mysql_fetch_array($res1);
					switch ($fila[cambio_det]){
						case "alta":
								if(mysql_num_rows($res1)){
									
								
									$cadena="delete from empleados where emp_id=$prp[emp_id] and usr_id=$usr_id";	
									$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: delete before insert $prp[emp_id] - $usr_id\".mysql_error();\r\n";	
									
									$cadena="insert into empleados  values( $prp[emp_id],
																		    '$prp[nombre]',
																			'$prp[apellido]',
																			'$prp[telefono]',
																			'$prp[domicilio]',
																			'$prp[email]',
																			'$prp[usr_login]',
																			'$prp[usr_pass]',
																			'$prp[priv_id]',
																			'$prp[usr_tpo]',
																			'$prp[fo_id]',
																			'$prp[tel_inmo]',
																			'$prp[sexo]',
																			'$prp[emp_adm]',
																			'$prp[mostrar]',
																			'$prp[sec_id]',
																			'$prp[descripcion]',
																			$usr_id
																			)
																			
																			";
									$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: insert $prp[emp_id] - $usr_id\".mysql_error();\r\n";	

									
										
								}//fin if mysql_num_rows
												  	
							break;	
							case "modificacion":
														
								if(mysql_num_rows($res1)){
									//print "modificacion<br>";
									$prp=mysql_fetch_array($res1);
								
																								
									$cadena="update empleados set 
																	nombre='$prp[nombre]',
																	apellido='$prp[apellido]',
																	telefono='$prp[telefono]',
																	email='$prp[email]',
																	domicilio='$prp[domicilio]',
																	usr_login='$prp[usr_login]',
																	usr_pass='$prp[usr_pass]',
																	usr_tpo='$prp[usr_tpo]',
																	priv_id='$prp[priv_id]',
																	fo_id='$prp[fo_id]',
																	sexo='$prp[sexo]',
																	tel_inmo='$prp[tel_inmo]',
																	emp_adm='$prp[emp_adm]',
																	mostrar='$prp[mostrar]',
																	sector='$prp[sec_id]',
																	descripcion='$prp[descripcion]'
															 where emp_id=$fila[emp_id] and usr_id=$usr_id
															 ";
									$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: update $prp[emp_id] - $prp[usr_id]\".mysql_error();\r\n";		
									
								}	
								
								
							break;
							
							case "eliminacion":
								
									$cadena="delete from empleados where usr_id=$usr_id and emp_id=$fila[emp_id]";
									$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: $cadena\".mysql_error();\r\n";	
									
								
								
							break;
					}
				}
		
							
				$str.="
					if(\$error){
						mysql_query(\"rollback\");
						\$e=1;
						?>
							<link rel=stylesheet href=\"inmoclick.css\" type=text/css>
							<div id=tabla1 class=celda_2 style='position:absolute;left:25%;top:20%;'>
								<table align=center border=0 width=60% cellspacing=0 style=\"border-top:1px solid #990000;border-bottom:1px solid #990000;border-left:1px solid #990000;border-right:1px solid #990000;\">
									<tr>
										<td style=\"font-family:verdana;font-size:11px;font-color:#DDDDDD;\" colspan=6><b>Ocurrio un error en la consulta. La actualizaci�n no se pudo llevar a cabo. <?print \$error?></b></td>
									</tr>
									<tr>
										<td style=\"font-family:verdana;font-size:11px;font-color:#DDDDDD;\" colspan=6><b><? 
											mail(\"info@inmoclick.com.ar\",\"Informe de error usuario \$usr_id \$usr_raz \",\"El usuario \$usr_id \$usr_raz no ha podido actualizar sus empleados en internet:\$error\");					
											
										?>Se ha enviado un informe de error.</b></b></td>
									</tr>
								</table>		
							</div>
							
							<?
					}else{
							$str2
						mysql_query(\"commit\");	
						\$e=0;
					}		";
					
				$str.="
						
						
						?>
							
						
							<script language=\"javascript\">
									location.href=\"http://<?print \$ip?>/inmohostV2.0/system/actualizador_pre.php?usr_id=$usr_id&borrar_cache_usuario=1&e=<?print \$e?>\";
							</script>
						
						<?
					
					
					?>
				";
				
				
				
			
				if($fp2=fopen("act_emp_$usr_id.php","w+")){
					fputs($fp2,$str);
					return 1;
				}else{
					return 0;
				}
	
	
}

function armar_script($usr_id){
	
		
				$str="<?  include \"../parametros.php\";
				
						 extract(\$_GET);
					     include \"../include/funciones/funciones.php\";
						 
						 
						 ";	
		
				$cadena="select cambio_id,cambio_det,prp_id,usr_id,cambios_fotos from cambios";
				
				$result=mysql_query($cadena);
				$str2="";
				$j=0;
				while ($fila=mysql_fetch_array($result)){
					
					$cadena="select * from propiedades where usr_id=$fila[usr_id] and prp_id=$fila[prp_id]";
					$res1=mysql_query($cadena);
					
	//				print $cadena."<br>";
					
					switch ($fila[cambio_det]){
						case ("alta" || "modificacion"):
								if(mysql_num_rows($res1)){
									
									$prp=mysql_fetch_array($res1);
								
									$prp_desc=addcslashes($prp[prp_desc],"$\\\'\"");
									$prp_servicios=addcslashes($prp[prp_servicios],"$\\\'\"");
									$prp_dom=addcslashes($prp[prp_dom],"$\\\'\"");
									$prp_nota=addcslashes($prp[prp_nota],"$\\\'\"");
									$prp_bar=addcslashes($prp[prp_bar],"$\\\'\"");
									
									$str.='$propiedad=PropiedadesPeer::retrieveByPK('.$fila['prp_id'].','.$fila['usr_id'].');';
									
									$str.='if(!$propiedad){
												$propiedad=new Propiedades();
											}';
									
									$str.='
									$propiedad->setPrpId('.$prp['prp_id'].');
								    $propiedad->setPrpDom("'.$prp_dom.'");
								    $propiedad->setPrpBar("'.$prp_bar.'");
								    $propiedad->setLocId('.$prp['loc_id'].');
								    $propiedad->setProId('.$prp['pro_id'].');
								    $propiedad->setPaiId('.$prp['pai_id'].');
								    $propiedad->setOriId('.$prp['ori_id'].');
								    $propiedad->setConId('.$prp['con_id'].');
								    $propiedad->setFotos('.$prp['fotos'].');
								    $propiedad->setPrpDesc("'.$prp_desc.'");
								    $propiedad->setUsrId('.$prp['usr_id'].');
								    $propiedad->setTipId('.$prp['tip_id'].');
								    $propiedad->setPrpMod("'.date("Y-m-d").'");
								    $propiedad->setPrpAlta("'.$prp['prp_alta'].'");
								    $propiedad->setPrpNota("'.$prp_nota.'");
								    $propiedad->setPrpPre('.$prp['prp_pre'].');
								    $propiedad->setPrpMostrar('.$prp['prp_mostrar'].');
								    $propiedad->setPrpPreDol('.$prp['prp_pre_dol'].');
								    $propiedad->setPrpCartel('.$prp['prp_cartel'].');
								    $propiedad->setPrpReferente('.$prp['prp_referente'].');
								    $propiedad->setPublica('.$prp['publica'].');
								    $propiedad->setPrpServicios("'.$prp_servicios.'");
								    $propiedad->setBarPrivId('.$prp['bar_priv_id'].');
								    $propiedad->setPrpVip('.$prp['prp_vip'].');
								    $propiedad->setMosPor1('.$prp['mos_por_1'].');
								    $propiedad->setMosPor2('.$prp['mos_por_2'].');
								    $propiedad->setMosPor3('.$prp['mos_por_3'].');
								    $propiedad->setMosPor4('.$prp['mos_por_4'].');
								    $propiedad->setPrpAnonimo('.$prp['prp_anonimo'].');
								    $propiedad->setPrpLat("'.$prp['prp_lat'].'");
								    $propiedad->setPrpLng("'.$prp['prp_lng'].'");
								    
								    
								    
									';
									
									//borro
									$str.='
											$c=new Criteria();
											$c->add(SerXPrpIhostPeer::USR_ID , '.$fila['usr_id'].');
											$c->add(SerXPrpIhostPeer::PRP_ID , '.$fila['prp_id'].');
											SerXPrpIhostPeer::doDelete($c);
											';
									
									//luego inserto								
									
									$res_alt=mysql_query("select * from ser_x_prp_ihost where prp_id=$fila[prp_id] and usr_id=$fila[usr_id]");	
									while ($fila_ser=mysql_fetch_array($res_alt)){
										
										$str.='
										
									 			$s=SerXPrpIhostPeer::retrieveByPK('.$fila_ser['ser_id'].','.$fila['prp_id'].','.$fila['usr_id'].');
									 			
									 			if(!$s){
										 		 	$s=new SerXPrpIhost();
									 			}	
									 					
									 			$s->setPrpId('.$fila_ser['prp_id'].');
									 			$s->setUsrId('.$fila_ser['usr_id'].');
									 			$s->setSerId('.$fila_ser['ser_id'].');
									 			$s->setValor("'.addcslashes($fila_ser['valor'],"$\\\'\"").'");
									 			$propiedad->addSerXPrpIhost($s);
									 		';
									}
									
										//borro
									$str.='
											$c=new Criteria();
											$c->add(FotosPeer::USR_ID , '.$fila['usr_id'].');
											$c->add(FotosPeer::PRP_ID , '.$fila['prp_id'].');
											FotosPeer::doDelete($c);
											';
									
									//luego inserto			
									
									//inserto en fotos
									$res_alt=mysql_query("select * from fotos where prp_id=$fila[prp_id] and usr_id=$fila[usr_id]");						
									while ($fila_fot=mysql_fetch_array($res_alt)){
										
											$str.='
												$f=FotosPeer::retrieveByPK('.$fila_fot['prp_id'].','.$fila_fot['usr_id'].','.$fila_fot['fo_nro'].');
									 			
									 			if(!$f){
													$f=new Fotos();
									 			}	
									 			
									 			$f->setPrpId('.$fila_fot['prp_id'].');
									 			$f->setUsrId('.$fila_fot['usr_id'].');
									 			$f->setFoNro('.$fila_fot['fo_nro'].');
									 			$f->setFoDesc("'.addcslashes($fila_fot['fo_desc'],"$\\\'\"").'");
										 		$f->setFoEnl("'.$fila_fot['fo_enl'].'");
										 		$propiedad->addFotos($f);
									 					
									 		';
										
										/*	$cadena="insert into fotos (fo_enl,prp_id,usr_id,fo_nro,fo_desc) values('$fila_fot[fo_enl]',$fila[prp_id],$fila[usr_id],$fila_fot[fo_nro],'$fila_fot[fo_desc]')";							
											$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: $cadena\".mysql_error();\r\n";	*/
									}
										
									$str.='$propiedad->save();';
								}//fin if mysql_num_rows
												  	
							break;	
							
							
							/*case "eliminacion":
								
								//fotos	
								$res_alt=mysql_query("select * from fotos where prp_id=$fila[prp_id] and usr_id=$fila[usr_id]");	
								while ($fila_fot=mysql_fetch_array($res_alt)){
										$str2.="exec('rm ./fotos/$fila_fot[fo_enl]');\r\n";
								}	
									
										
								$cadena="delete from fotos where usr_id=$fila[usr_id] and prp_id=$fila[prp_id]";					
								$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: $cadena\".mysql_error();\r\n";	
								$cadena="delete from ser_x_prp_ihost where usr_id=$fila[usr_id] and prp_id=$fila[prp_id]";
								$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: $cadena\".mysql_error();\r\n";	
								
								
								$cadena="delete from propiedades where usr_id=$fila[usr_id] and prp_id=$fila[prp_id]";
								$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: $cadena\".mysql_error();\r\n";	
							
								
							break;*/
					}
				}
		
				
						$cad="select distinct prp_id from cambios";
						$result=mysql_query($cad);
						
							$str.="
									\$usuarios=get_usuarios(\$usr_id);
									for(\$i=0;\$i<count(\$usuarios);\$i++){
							";
										$str.="mysql_query(\"insert into cam_red_cim values(\$usuarios[\$i],0,$usr_id)\");\r\n";
									
							$str.="}
								
							";		
				
				$usr_cim=mysql_result(mysql_query("select usr_cim from usuarios where usr_id=$usr_id"),0,0);
				$usr_raz=mysql_result(mysql_query("select usr_raz from usuarios where usr_id=$usr_id"),0,0);
	
				/*$str.="
				
					if(\$error){
						mysql_query(\"rollback\");
						\$e=1;
						?>
							<link rel=stylesheet href=\"inmoclick.css\" type=text/css>
							<div id=tabla1 class=celda_2 style='position:absolute;left:25%;top:20%;'>
								<table align=center border=0 width=60% cellspacing=0 style=\"border-top:1px solid #990000;border-bottom:1px solid #990000;border-left:1px solid #990000;border-right:1px solid #990000;\">
									<tr>
										<td style=\"font-family:verdana;font-size:11px;font-color:#DDDDDD;\" colspan=6><b>Ocurrio un error en la consulta. La actualizaci�n no se pudo llevar a cabo. <?print \$error?></b></td>
									</tr>
									<tr>
										<td style=\"font-family:verdana;font-size:11px;font-color:#DDDDDD;\" colspan=6><b><? 
											mail(\"info@inmoclick.com.ar\",\"Informe de error usuario \$usr_raz (\$usr_id) \",\"El usuario \$usr_raz (\$usr_id) no ha podido actualizar sus inmuebles en internet:\n\r \$error \n\r \");					
											
										?>Se ha enviado un informe de error.</b></b></td>
									</tr>
								</table>		
							</div>
							
							<?
					}else{
							$str2
							mysql_query(\"commit\");
							\$e=0;
					}		";*/
				
				$str.="
						
						
						?>
							<script language=\"javascript\">
									location.href=\"../act_inmohost.php?usr_id=<?print \$usr_id?>&ip=<?print \$ip?>&e=<?print \$e?>\";
							</script>
						
						<?
					
					
					?>
				";
				
				
				if($fp2=fopen("act_online_$usr_id.php","w+")){
					fputs($fp2,$str);
					return 1;
				}else{
					return 0;
				}
				
				
	}
	
function armar_script_medios($usr_id){

	$mails="";
	
	$str="<? include \"../parametros.php\r\n \";
	
				
			\$cad=mysql_query(\"select * from usuarios where usr_id="._USR_ID."\") or \$error=\"No selecciona usuarios\";
			\$res=mysql_fetch_array(\$cad);
			
			\$header = \"From: "._USR_RAZ." <\$res[usr_mail]>\";\r\n
			\$header.= \"Reply-To: "._USR_RAZ." <\$res[usr_mail]>\";\r\n
			\$subject=\"Publicacion en la grafica\";
			
			";	

	$diarios="select * from receptores";
	$res_dia=mysql_query($diarios);
//recorro todos los medios para armar un mail por cada medio.
	while ($fila_diarios=mysql_fetch_array($res_dia)){
		
		$str.="		
				\$to=\"$fila_diarios[mail]\";
			";
		if($fila_diarios[mailcc]){
		
			$str.=" 
				\$header=\"Cc: $fila_diarios[mailcc]\r\n\";
			";
		}
		
		//comienzo a armar el mail
		$mails.="Estimados $fila_diarios[med_raz]:\r\n\r\nPr�ximos avisos:\r\n\r\n";
				
		$cadena="select 
						cambios_medios.*,
						publicaciones.*
				 from 
					  cambios_medios,
					  publicaciones
				 where
				 	  cambios_medios.pub_id=publicaciones.pub_id and
				 	  publicaciones.dia_id=$fila_diarios[rec_id]";
		
		$result=mysql_query($cadena);	
		//recorro todas las publicaciones que hay para ese medio
		$i=1;
		while ($fila_cambios=mysql_fetch_array($result)){

			$cadena=" select 	
						propiedades.prp_pub
				   from
						propiedades
				   where
						propiedades.prp_id=$fila_cambios[prp_id] and
						propiedades.usr_id="._USR_ID."
				";
			 $res_pubs=mysql_query($cadena);
			 $prp_pub=mysql_result($res_pubs,0,0);
			
			//Completo el mail
			$fechas=split("x",$fila_cambios[pub_dia]);
			
			$mails.="\r\nAviso $i:## $prp_pub ";
			
			for($i=0;$i<count($fechas);$i++){
				
				$mails.=$fechas[$i]." - ";
			}
			
			$i++;
			
			$mails.=" ##\r\n";
				
		}				
		
		
		
		
			$mails.="\n\rAtte. "._USR_RAZ."\r\n";	
			$mails.=_USR_DOM."\r\n";	
			$mails.=_USR_TEL."\r\n";
		
		$str.="\$message=\"$mails\";\r\n
		
		\$res_env_mail=mail(\$to,\$subject,\$message,\$header);\r\n
		
		";	
				
					
	}
		$str.="?>
		
			<body onload=\"location.href='http://<?print \$ip?>/inmohostV2.0/system/actualizador_pre.php?borrar_cache_medios=1';\">
			</body>
		
		";		
	
		if($fp2=fopen("act_medios_$usr_id.php","w+")){
			fputs($fp2,$str);
			return 1;
		}else{
			return 0;
		}
}
/*
function armar_script_sf($usr_id){
			
				$str="<? include \"../parametros.php\";
					     include \"../include/funciones/funciones.php\";
						mysql_query(\"start transaction\");\n\r";	
		
				$cadena="select cambio_id,cambio_det,prp_id,usr_id,cambios_fotos from cambios";
				
				$result=mysql_query($cadena);
				$str2="";
				$j=0;
				while ($fila=mysql_fetch_array($result)){
					
					$cadena="select * from propiedades where usr_id=$fila[usr_id] and prp_id=$fila[prp_id]";
					$res1=mysql_query($cadena);
					
	//				print $cadena."<br>";
					
					switch ($fila[cambio_det]){
						case "alta":
								if(mysql_num_rows($res1)){
									
									$prp=mysql_fetch_array($res1);
								
									$prp_desc=$prp[prp_desc];
									$prp_servicios=$prp[prp_servicios];
									$prp_dom=$prp[prp_dom];
									$prp_nota=$prp[prp_nota];
									$prp_bar=$prp[prp_bar];
									//propiedad
									
									$cadena="delete from propiedades where prp_id=$prp[prp_id] and usr_id=$prp[usr_id]";
									$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: delete prp $prp[prp_id] - $prp[usr_id]\".mysql_error();\r\n";	
									
									$cadena="insert into propiedades (prp_id,prp_dom,prp_bar,loc_id,pro_id,pai_id,ori_id,con_id,prp_desc,prp_visitas,usr_id,tip_id,fo1_id,fo2_id,fo3_id,fo4_id,fo360_id,prp_mod,prp_nota,prp_pre,prp_pub,prp_mostrar,prp_pre_dol,prp_llave,prp_alta,prp_cartel,prp_referente,prp_tas,prp_aut,fo5_id,fo6_id,pre_inmo,pre_prop,pre_trans,prp_insc_dom,publica,prp_servicios,fotos,mos_por_1,mos_por_2,mos_por_3,mos_por_4,prp_anonimo,prp_vip) values($prp[prp_id],'$prp_dom','$prp_bar',$prp[loc_id],$prp[pro_id],$prp[pai_id],$prp[ori_id],$prp[con_id],'$prp_desc',$prp[prp_visitas],$prp[usr_id],$prp[tip_id],$prp[fo1_id],$prp[fo2_id],$prp[fo3_id],$prp[fo4_id],$prp[fo360_id],'$prp[prp_mod]','$prp_nota','$prp[prp_pre]','$prp[prp_pub]',$prp[prp_mostrar],$prp[prp_pre_dol],$prp[prp_llave],'$prp[prp_alta]','$prp[prp_cartel]',$prp[prp_referente],'$prp[prp_tas]','$prp[prp_aut]',$prp[fo5_id],$prp[fo6_id],'$prp[pre_inmo]','$prp[pre_prop]','$prp[pre_trans]','$prp[prp_insc_dom]',$prp[publica],'$prp_servicios',$prp[fotos],$prp[mos_por_1],$prp[mos_por_2],$prp[mos_por_3],$prp[mos_por_4],$prp[prp_anonimo],'$prp[prp_vip]')";
									$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: insert $prp[prp_id] - $prp[usr_id]\".mysql_error();\r\n";	

									//fotos	
									$res_alt=mysql_query("select * from fotos where prp_id=$fila[prp_id] and usr_id=$fila[usr_id]");	
									
									while ($fila_fot=mysql_fetch_array($res_alt)){
											$cadena="delete from fotos where prp_id=$fila[prp_id] and usr_id=$fila[usr_id] and fo_nro='$fila_fot[fo_nro]'";
											$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: $cadena\".mysql_error();\r\n";	
											$cadena="insert into fotos values('$fila_fot[fo_enl]',$fila[prp_id],$fila[usr_id],$fila_fot[fo_nro],'$fila_fot[fo_desc]')";							
											$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: $cadena\".mysql_error();\r\n";	
									}	
									
									//servicios
									$res_alt=mysql_query("select * from ser_x_prp_ihost where prp_id=$fila[prp_id] and usr_id=$fila[usr_id]");	
									while ($fila_ser=mysql_fetch_array($res_alt)){
											$cadena="delete from ser_x_prp_ihost where prp_id=$fila[prp_id] and usr_id=$fila[usr_id] and ser_id='$fila_ser[ser_id]'";
											$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: $cadena\".mysql_error();\r\n";	
											$cadena="insert into ser_x_prp_ihost values('$fila[prp_id]',$fila_ser[ser_id],'$fila_ser[valor]',$fila[usr_id])";							
											$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: $cadena\".mysql_error();\r\n";	
									}
										
								}//fin if mysql_num_rows
												  	
							break;	
							case "modificacion":
								//print $cadena."<br>";								
								if(mysql_num_rows($res1)){
									//print "modificacion<br>";
									$prp=mysql_fetch_array($res1);
								
									$prp_desc=$prp[prp_desc];
									$prp_servicios=$prp[prp_servicios];
									$prp_dom=$prp[prp_dom];
									$prp_nota=$prp[prp_nota];
									$prp_bar=$prp[prp_bar];
									
															
									$cadena="update propiedades set fotos=$prp[fotos],loc_id=$prp[loc_id],pro_id=$prp[pro_id],prp_bar='$prp_bar',prp_dom='$prp_dom',pai_id='$prp[pai_id]',con_id='$prp[con_id]',tip_id='$prp[tip_id]',prp_pre=$prp[prp_pre],prp_desc='$prp_desc',prp_nota='$prp_nota',prp_mod='$prp[prp_mod]',ori_id=$prp[ori_id],prp_pub='$prp[prp_pub]',prp_pre_dol='$prp[prp_pre_dol]',prp_llave='$prp[prp_llave]',prp_cartel='$prp[prp_cartel]',prp_referente='$prp[prp_referente]',prp_tas='$prp[prp_tas]',prp_aut='$prp[prp_aut]',pre_inmo='$prp[pre_inmo]',pre_prop='$prp[pre_prop]',pre_trans='$prp[pre_trans]',prp_insc_dom='$prp[prp_insc_dom]',publica=$prp[publica],prp_servicios='$prp_servicios',prp_mostrar=$prp[prp_mostrar],fo1_id=$prp[fo1_id],fo2_id=$prp[fo2_id],fo3_id=$prp[fo3_id],fo4_id=$prp[fo4_id],mos_por_1=$prp[mos_por_1],mos_por_2=$prp[mos_por_2],mos_por_3=$prp[mos_por_3],mos_por_4=$prp[mos_por_4],prp_anonimo=$prp[prp_anonimo],prp_vip='$prp[prp_vip]' where prp_id=$fila[prp_id] and (usr_id=$fila[usr_id] or usr_id=0)";
									$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: update insert $prp[prp_id] - $prp[usr_id]\".mysql_error();\r\n";		
									
									//fotos	
									$res_alt=mysql_query("select * from fotos where prp_id=$fila[prp_id] and usr_id=$fila[usr_id]");	
									$cadena="delete from fotos where prp_id=$fila[prp_id] and usr_id=$fila[usr_id]";
									$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: $cadena\".mysql_error();\r\n";	
									while ($fila_fot=mysql_fetch_array($res_alt)){
											
											$cadena="insert into fotos values('$fila_fot[fo_enl]',$fila[prp_id],$fila[usr_id],$fila_fot[fo_nro],'$fila_fot[fo_desc]')";							
											$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: $cadena\".mysql_error();\r\n";	
									}
									
									$vector=explode("x",$fila[cambios_fotos]);
									//print "VECTOR - ".count($vector);
									for($i=1;$i<=count($vector)-1;$i++){
										$verif=mysql_query("select * from fotos where prp_id=$fila[prp_id] and usr_id=$fila[usr_id] and fo_nro=$vector[$i]") or die(mysql_error());
										if(!mysql_num_rows($verif)){
											
												$str2.="exec('rm ../fotos/$fila[prp_id]-$fila[usr_id]-$vector[$i].gif');\r\n";
										}
									}					
									
									
									//servicios
									$res_alt=mysql_query("select * from ser_x_prp_ihost where prp_id=$fila[prp_id] and usr_id=$fila[usr_id]");	
									$cadena="delete from ser_x_prp_ihost where prp_id=$fila[prp_id] and usr_id=$fila[usr_id]";
									$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: $cadena\".mysql_error();\r\n";	
									while ($fila_ser=mysql_fetch_array($res_alt)){
											
											$cadena="insert into ser_x_prp_ihost values('$fila[prp_id]',$fila_ser[ser_id],'$fila_ser[valor]',$fila[usr_id])";							
											$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: $cadena\".mysql_error();\r\n";	
										
									}
									
									
								}	
								
								
							break;
							
							case "eliminacion":
								
									$cadena="delete from propiedades where usr_id=$fila[usr_id] and prp_id=$fila[prp_id]";
									$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: $cadena\".mysql_error();\r\n";	
							
								//fotos	
								$res_alt=mysql_query("select * from fotos where prp_id=$fila[prp_id] and usr_id=$fila[usr_id]");	
								while ($fila_fot=mysql_fetch_array($res_alt)){
										$str2.="exec('rm ./fotos/$fila_fot[fo_enl]');\r\n";
								}	
									
										
								$cadena="delete from fotos where usr_id=$fila[usr_id] and prp_id=$fila[prp_id]";					
								$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: $cadena\".mysql_error();\r\n";	
								$cadena="delete from ser_x_prp_ihost where usr_id=$fila[usr_id] and prp_id=$fila[prp_id]";
								$str.="mysql_query(\"$cadena\") or \$error=\"Consulta: $cadena\".mysql_error();\r\n";	
							break;
					}
				}
		
				$str.="\n
						\$command=\"chmod -R 777 ./fotos/*\";
						exec(\$command);
						\n";	
				
				
						$cad="select distinct prp_id from cambios";
						$result=mysql_query($cad);
						
							$str.="
									\$usuarios=get_usuarios(\$usr_id);
									for(\$i=0;\$i<count(\$usuarios);\$i++){
							";
										$str.="mysql_query(\"insert into cam_red_cim values(\$usuarios[\$i],0,$usr_id)\");\r\n";
									
							$str.="}
								
							";		
				
				
				
				$usr_cim=mysql_result(mysql_query("select usr_cim from usuarios where usr_id=$usr_id"),0,0);
				$usr_raz=mysql_result(mysql_query("select usr_raz from usuarios where usr_id=$usr_id"),0,0);
	
				$str.="
								
				\$cad1=\"select usr_cim,usr_raz from usuarios where usr_id=\$usr_id\";
				\$usr_cim=mysql_result(mysql_query(\$cad1),0,0);
				\$usr_raz=mysql_result(mysql_query(\$cad1),0,1);


					if(\$error){
						mysql_query(\"rollback\");
						\$e=1;
						?>
							<link rel=stylesheet href=\"inmoclick.css\" type=text/css>
							<div id=tabla1 class=celda_2 style='position:absolute;left:25%;top:20%;'>
								<table align=center border=0 width=60% cellspacing=0 style=\"border-top:1px solid #990000;border-bottom:1px solid #990000;border-left:1px solid #990000;border-right:1px solid #990000;\">
									<tr>
										<td style=\"font-family:verdana;font-size:11px;font-color:#DDDDDD;\" colspan=6><b>Ocurrio un error en la consulta. La actualizaci�n no se pudo llevar a cabo. <?print \$error?></b></td>
									</tr>
									<tr>
										<td style=\"font-family:verdana;font-size:11px;font-color:#DDDDDD;\" colspan=6><b><? 
											mail(\"info@inmoclick.com.ar\",\"Informe de error usuario \$usr_raz (\$usr_id) \",\"El usuario \$usr_raz (\$usr_id) no ha podido actualizar sus inmuebles en internet:\n\r \$error \n\r \");					
											
										?>Se ha enviado un informe de error.</b></b></td>
									</tr>
								</table>		
							</div>
							
							<?
					}else{
							$str2
							mysql_query(\"commit\");
							\$e=0;
					}		";
				
				$str.="
						
						
						?>
							<script language=\"javascript\">
									location.href=\"../act_inmohost.php?usr_id=<?print \$usr_id?>&ip=<?print \$ip?>&e=<?print \$e?>\";
							</script>
						
						<?
					
					
					?>
				";
				
				
				if($fp2=fopen("act_online_$usr_id.php","w+")){
					fputs($fp2,$str);
					return 1;
				}else{
					return 0;
				}
				
				
	}*/

function mandar_mail($From,$FromName,$to,$cc,$subject,$msg,$MAIL_SMTP,$MAIL_USR,$MAIL_PASS,$att_ruta,$att_nom){				
		
	/*	echo "mail smtp".$MAIL_SMTP."<br>";
		echo "mail smtp".$MAIL_USR."<br>";
		echo "mail smtp".$MAIL_PASS."<br>";
		echo "mail smtp".$From."<br>";
	*/
		$mail = new PHPMailer();
		$mail->SetLanguage("es","c:/wamp/www/inmohostV2.0/system/php/classes/language/");
		//$mail->Timeout=60;
		//$mail->SMTPDebug=true;
		$mail->IsSMTP();  // set mailer to use SMTP
		$mail->Host = $MAIL_SMTP;  // specify main and backup server
		$mail->SMTPAuth = true;     // turn on SMTP authentication
		$mail->Username = $MAIL_USR;  // SMTP username
		$mail->Password = $MAIL_PASS; // SMTP password
		
		$mail->From=$From;
		$mail->FromName=$FromName;
		$mail->AddAddress($to, $FromName);
		$mail->AddReplyTo($From);
		if($cc){
			$mail->AddCC($cc, $FromName);
		}


		if(count($att_nom)){
			for ($i=0;$i<count($att_nom);$i++){
				$mail->AddAttachment($att_ruta[$i],$att_nom[$i]);
				//print "$att_ruta[$i],$att_nom[$i]";
			}	
		}
		
		$mail->IsHTML(true);     //set email format to HTML
		
		$mail->Subject = $subject;
		$mail->Body=nl2br(htmlentities($msg));
		
		if(!$mail->Send())
		{
		    return $mail->ErrorInfo;
		}else{
			return 1;
		}
}


function comprimir ($archivo)
{
$fptr = fopen($archivo, "rb");
$dump = fread($fptr, filesize($archivo));
fclose($fptr);

//Comprime al m�ximo nivel, 9
$gzbackupData = gzencode($dump,9);

$fptr = fopen($archivo, "wb");
fwrite($fptr, $gzbackupData);
fclose($fptr);
//Devuelve el nombre del archivo comprimido
return $archivo;
} 

if (!function_exists('gzdecode')) {
    function gzdecode ($data) {
    	print "aaa";
        $flags = ord(substr($data, 3, 1));
        $headerlen = 10;
        $extralen = 0;
        $filenamelen = 0;
        if ($flags & 4) {
            $extralen = unpack('v' ,substr($data, 10, 2));
            $extralen = $extralen[1];
            $headerlen += 2 + $extralen;
        }
        if ($flags & 8) // Filename
            $headerlen = strpos($data, chr(0), $headerlen) + 1;
        if ($flags & 16) // Comment
            $headerlen = strpos($data, chr(0), $headerlen) + 1;
        if ($flags & 2) // CRC at end of file
            $headerlen += 2;
        $unpacked = gzinflate(substr($data, $headerlen));
        if ($unpacked === FALSE)
              $unpacked = $data;
        return $unpacked;
     }
}
//--------------------------------------------------------------------------------------------------
function descomprimir($archivo){

	$fptr = fopen($archivo, "rb");
	$dump = fread($fptr, filesize($archivo));
	fclose($fptr);
	
	$str=gzdecode($dump);
	
	$fptr = fopen($archivo, "wb");
	fwrite($fptr, $str);
	fclose($fptr);

}

function copiar_fotos($fo,$fo_enl,$id_foto){


		$conn_id = ftp_connect("localhost"); 
		$login = ftp_login($conn_id,"inmohost@inmoclick.com.ar","S0crate5-*"); 	
		
		//primero leo el contenido de la foto
		$contenido=fopen($fo,"r");
		$cadena=fgets($contenido,filesize($fo));
		
		$temp = tmpfile();
		//Upload the temporary file to server
		ftp_fput($conn_id, '/fotos/'.$fo_enl, $temp, FTP_ASCII);
			
		//Make the file writable by all
		ftp_site($conn_id,"CHMOD 0777 '/fotos/'.$fo_enl");
		
		//Write to file	
		$fp=fopen("/home/inmoclick/domains/inmoclick.com.ar/public_html/ftp_inmohost/fotos/".$fo_enl,"w");
		fputs($fp,$cadena);
		
	if($id_foto!=0){//si no viene el id no hay que redimensionar	
		redim_foto("/home/inmoclick/domains/inmoclick.com.ar/public_html/ftp_inmohost/fotos/".$fo_enl,"/home/inmoclick/domains/inmoclick.com.ar/public_html/ftp_inmohost/fotos/",$id_foto);
	}
		//Make the file writable only to owner
		ftp_site($conn_id,"CHMOD 0644 '/fotos/'.$fo_enl");	
		
		fclose($contenido);
		fclose($fp);
		
}


function traer_usuario($usr_id,$conexion = "inmoclick"){


        switch($conexion){
            case "inmoclick": 
                   include("php/conexion_inmoclick.php");

                   $resultado = mysql_query("select * from usuarios where usr_id=".$usr_id,$conn2);
                   if(mysql_num_rows($resultado)){
                        $usuario = mysql_fetch_array($resultado);
                        //return $usuario['usr_raz'].' '.$usuario['usr_tel'].' '.$usuario['usr_mail'].' '.$usuario['usr_dom'];
                        return $usuario['usr_raz'].' '.str_ireplace("-", "", $usuario['usr_tel']);
                   }else{
                       return '';
                   }
                   mysql_close($conn2);
                break;
            default:
                   include_once("../conexion_inmoclick.php");
                   $resultado = mysql_query("select * from usuarios where usr_id=".$usr_id,$conn2);

                   if(mysql_num_rows($resultado)){
                        $usuario = mysql_fetch_array($resultado);
                        return $usuario['usr_raz'].' <br/> '.$usuario['usr_tel'].' <br/>'.$usuario['usr_mail'].'<br/>'.$usuario['usr_dom'];
                   }else{
                       return '';
                   }
                    mysql_close($conn2);

                
                break;
            
        }


}


/*
 * var total = 0;
                                                                                    
                                                            if($('#lat').val()!=''){
                                                                total+=_PORCENTAJE_MAPA;
                                                            }

                                                            if( ($('#prp_pre').val()!=''&& $('#prp_pre').val()>1) || ($('#prp_pre_dol').val()!=''&&$('#prp_pre').val()>1) ){
                                                                                                
                                                                if($('#prp_ocultar_precio_si').attr('checked')){
                                                                    if($('#prp_pre').val() > _PRECIO_INMUEBLES_COTI){
                                                                        total+=_PORCENTAJE_PRECIO;
                                                                    }
                                                                }else{
                                                                    total+=_PORCENTAJE_PRECIO;
                                                                }
                                                                                                
                                                                                                
                                                                                               
                                                            }

                                                            if($('#prp_desc').val().length >= _LONGITUD_MINIMA_PRP_DESC){
                                                                total+=_PORCENTAJE_DESCRIPCION;
                                                            }

                                                            if($('#cantidad_fotos').val() == 1){
                                                                total+=_PORCENTAJE_UNA_FOTO;
                                                            }

                                                            //  console.log("cant fotos" + $('#cantidad_fotos').val());
                                                                                            
                                                            if($('#cantidad_fotos').val() >= 2 && $('#cantidad_fotos').val() <= 3){
                                                                total+=_PORCENTAJE_TRES_FOTOS;
                                                            }

                                                            if($('#cantidad_fotos').val() >= 4 && $('#cantidad_fotos').val() <= 5){
                                                                total+=_PORCENTAJE_CINCO_FOTOS;
                                                            }

                                                            if($('#cantidad_fotos').val() >= 6){
                                                                total+=_PORCENTAJE_SEIS_FOTOS;
                                                            }
 */

function calcular_puntaje_inmueble($prp_id, $usr_id){
        
    $total = 0;
    $query  = "select * from propiedades where usr_id = ".$usr_id." and prp_id = ".$prp_id;
    $resultado = mysql_query($query);
    if(mysql_num_rows($resultado)){
        $fila = mysql_fetch_array($resultado);
        //mapa
        if($fila['prp_lat'] !=''&& $fila['prp_lat'] != ''){
            $total +=_PORCENTAJE_MAPA;
        }
        
        //precio
        if(($fila['prp_pre']!='' && $fila['prp_pre']>1)  || ($fila['prp_pre_dol']!='' && $fila['prp_pre_dol']>1)){
            
            if($fila['prp_ocultar_precio']){
                if($fila['prp_pre'] > _PRECIO_INMUEBLES_COTI){
                    $total += _PORCENTAJE_PRECIO;
                }
            }else{
                $total += _PORCENTAJE_PRECIO;
            }
            
        }
        
        //descripcion
        if(strlen($fila['prp_desc'])>=_LONGITUD_MINIMA_PRP_DESC){
            $total += _PORCENTAJE_DESCRIPCION;
        }
        
        //fotos
        if($fila['fotos'] == 1){
            $total += _PORCENTAJE_UNA_FOTO;
            
        }else if($fila['fotos']>=2 && $fila['fotos']<=3){
            
            $total += _PORCENTAJE_TRES_FOTOS;
            
        }else if($fila['fotos']>=4 && $fila['fotos']<=5){
            
            $total += _PORCENTAJE_CINCO_FOTOS;
            
        }else if($fila['fotos']>=6){
            
            $total += _PORCENTAJE_SEIS_FOTOS;
            
        }
            
        
    }
    
    return $total;
}


?> 