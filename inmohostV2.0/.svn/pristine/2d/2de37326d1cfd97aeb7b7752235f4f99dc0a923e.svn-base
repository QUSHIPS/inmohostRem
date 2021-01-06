<?php
extract($_POST);
$ind_error=0;
$ind_exito=0;

mysql_query("start transaction");
switch ($mod_tip)
{
	case "add":
			
			$max_id = mysql_query ("select max(dem_id) from demandas"); //obtiene el id maximo de novedades para agregar en tabla
			if(mysql_num_rows($max_id) )
			{
				$max_id = mysql_result($max_id,0,0) + 1;
			}else{
				$max_id=1;
			}



			$locs=$aux_loc_id;
			$str_locs="x";
			
			for($i=0;$i<count($locs);$i++){
				$str_locs.=$locs[$i]."x";	
			}
			
					
			$tips=$aux_tip_id;
			$str_tips="x";
			
			for($i=0;$i<count($tips);$i++){
				$str_tips.=$tips[$i]."x";	
			}

			$conds=$aux_con_id;
			$str_conds="x";
			
			for($i=0;$i<count($conds);$i++){
				$str_conds.=$conds[$i]."x";	
			}
			
			if(!$pai_id){
				$pai_id=$PAIS_DEFAULT;
			}

                        if(!$dem_inmobiliaria){
                            $dem_inmobiliaria=0;
                        }
                        if(!$dem_red_inmoclick){
                            $dem_red_inmoclick=0;
                        }

		   $cadena="insert into demandas 
							values ($max_id,
								'$dem_raz',
								'$dem_tel',
								'$dem_mail',
								'$dem_desc',
								'".date("Y-m-d")."',
								'$dem_barr',
								'$str_locs',
								'$pro_id',
								'$pai_id',
								'$dem_pre_min',
								'$str_conds',
								'$str_tips',
								'$dem_dom',
								'$dem_pre_max',
								'$dem_pre_min_dol',
								'$dem_pre_max_dol',
                                                                '$dem_habitaciones_min',
                                                                '$dem_habitaciones_max',
                                                                '$dem_banos_min',
                                                                '$dem_banos_max',
                                                                '$dem_sup_total_min',
                                                                '$dem_sup_total_max',
                                                                '$dem_sup_cubierta_min',
                                                                '$dem_sup_cubierta_max',
                                                                '$dem_cochera',
                                                                '$dem_inmobiliaria',
                                                                '$dem_red_inmoclick'
								)";
			
			
			mysql_query($cadena) or $errors="Error al intentar cargar la demanda".mysql_error().$insertar;	
			
						
			$dem_id=$max_id;
			$mensaje="La Demanda fue agregada con &eacute;xito";
	break;
	/***********************************************************************************************************************
	***********************************************   FIN ALTA DE PROPIEDAD  ***********************************************
	***********************************************************************************************************************/
		
	/***********************************************************************************************************************
	*************************************************   BAJA DE PROPIEDAD  *************************************************
	***********************************************************************************************************************/
	case "del":
	break;
	/***********************************************************************************************************************
	***********************************************   FIN BAJA DE PROPIEDAD  ***********************************************
	***********************************************************************************************************************/
	
	/***********************************************************************************************************************
	********************************************   MODIFICACION DE PROPIEDAD  **********************************************
	***********************************************************************************************************************/	
	case "edit":
		
		if($dem_id){
						
			$locs=$aux_loc_id;
			$str_locs="x";
			
			for($i=0;$i<count($locs);$i++){
				$str_locs.=$locs[$i]."x";	
			}
			
			$tips=$aux_tip_id;
			$str_tips="x";
			
			for($i=0;$i<count($tips);$i++){
				$str_tips.=$tips[$i]."x";	
			}
			
			$conds=$aux_con_id;
			$str_conds="x";
			
			for($i=0;$i<count($conds);$i++){
				$str_conds.=$conds[$i]."x";	
			}
			
			if(!$pai_id){
				$pai_id=$PAIS_DEFAULT;
			}

                        if(!$dem_inmobiliaria){
                            $dem_inmobiliaria=0;
                        }
                        if(!$dem_red_inmoclick){
                            $dem_red_inmoclick=0;
                            
                        }
                //    echo "entra".$dem_red_inmoclick;
			
			$cadena="update demandas set
										 dem_raz='$dem_raz',
										 dem_tel='$dem_tel',
										 dem_mail='$dem_mail',
										 dem_desc='$dem_desc',
										 dem_fecha=now(),
										 dem_barr='$dem_barr',
										 loc_id='$str_locs',
										 pro_id='$pro_id',
										 pai_id=$pai_id,
										 dem_pre_min='$dem_pre_min',
										 dem_pre_max='$dem_pre_max',
										 dem_pre_max_dol='$dem_pre_max_dol',
										 dem_pre_min_dol='$dem_pre_min_dol',
										 dem_dom='$dem_dom',
										 con_id='$str_conds',
										 tip_id='$str_tips',
                                                                                 dem_habitaciones_min='$dem_habitaciones_min',
                                                                                 dem_habitaciones_max='$dem_habitaciones_max',
                                                                                 dem_banos_min='$dem_banos_min',
                                                                                 dem_banos_max='$dem_banos_max',
                                                                                 dem_sup_total_min='$dem_sup_total_min',
                                                                                 dem_sup_total_max='$dem_sup_total_max',
                                                                                 dem_sup_cubierta_min='$dem_sup_cubierta_min',
                                                                                 dem_sup_cubierta_max='$dem_sup_cubierta_max',
                                                                                 dem_cochera='$dem_cochera',
                                                                                 dem_inmobiliaria='$dem_inmobiliaria',
                                                                                 dem_red_inmoclick='$dem_red_inmoclick'
							where
										dem_id=$dem_id			 
										 
										 ";
			//print $cadena;
				
			mysql_query($cadena) or $errors="Error al intentar modificar la demanda".mysql_error().$cadena;	
			
			
			//print "$cadena";
			$mensaje="La demanda fue editada con &eacute;xito";
		}
			
	break;
	/***********************************************************************************************************************
	******************************************   FIN MODIFICACION DE PROPIEDAD  ********************************************
	***********************************************************************************************************************/
}
if (!$errors)	
{
	mysql_query("commit");
        
        buscar_coincidencia($dem_id);
//	mysql_query("rollback");
}
else 
{
	mysql_query("rollback");
}


?>
