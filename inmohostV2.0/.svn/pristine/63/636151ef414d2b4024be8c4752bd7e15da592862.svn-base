<?php

header("Content-type: application/xml");


	extract ($_GET);
	extract ($_REQUEST);

	if(!isset($page)) $page = 0;
	include("../php/conexion_inmoclick.php");
	if($prp_id)
	{
		$filtro .= " and propiedades.prp_id=$prp_id";
	}

	if($desdeVisitasDia!="00" && $desdeVisitasMes!="00" && $desdeVisitasAno!="0000"  && (isset($desdeVisitasDia)&&isset($desdeVisitasMes)&&isset($desdeVisitasAno)))
	{	//si solo viene la fecha desde (por ejemplo desde el buscar), muestra las consultas desde esa fecha en adelante
		$fecha_d="$desdeVisitasAno-$desdeVisitasMes-$desdeVisitasDia";
		$filtro .= " and info_x_dia.fecha >= '$fecha_d'";
	}
	if($desdeVisitasDia!="00"  && $desdeVisitasMes!="00"  && $desdeVisitasAno!="0000"  && $hastaVisitasDia!="00"  && $hastaVisitasMes!="00"  && $hastaVisitasAno!="0000"  && (isset($hastaVisitasDia)&&isset($hastaVisitasMes)&&isset($hastaVisitasAno)))
	{
		$fecha_d="$desdeVisitasAno-$desdeVisitasMes-$desdeVisitasDia";
		$fecha_h="$hastaVisitasAno-$hastaVisitasMes-$hastaVisitasDia";
		$filtro .= " and info_x_dia.fecha between '$fecha_d' and '$fecha_h'";

	}//fin if
	
	if($tip_id)
	{
		$filtro .=" and propiedades.tip_id=$tip_id ";
	}//fin if
	if($con_id)
	{
		$filtro .=" and propiedades.con_id=$con_id ";
	}//fin if

        if($estado!=0){
            $filtro .=" and propiedades.prp_mostrar=".$estado;
        }


	$datos="

                    select
                               propiedades.prp_id,
                               propiedades.prp_mostrar,
                               propiedades.fotos,
                               propiedades.prp_dom,
                               sum(info_x_dia.sol_inf) as sol_inf,
                               sum(info_x_dia.sol_fot) as sol_fot,
                               sum(info_x_dia.visitas) as visitas,
                               tipo_const.tip_desc,
                               condiciones.con_desc,
                               date_format(propiedades.prp_mod,'%d-%m-%Y') as prp_mod
                

                  
                        ";

        $from = "  from
                                propiedades inner join info_x_dia on (propiedades.prp_id = info_x_dia.prp_id and propiedades.usr_id = info_x_dia.usr_id)
                                left join tipo_const on (propiedades.tip_id = tipo_const.tip_id)
                                left join condiciones on (propiedades.con_id=condiciones.con_id)";

        $where = "      where
                                propiedades.usr_id = $usr_id and prp_mostrar!=4";

			
		$datos .=$from.$where.$filtro." group by propiedades.prp_id";

                
                if($orden == ''){
                    $datos .=" order by	info_x_dia.fecha DESC";

                }elseif($orden == 'prp_id'){
                    $datos .=" order by	propiedades.".$orden." ASC";
               }else{
                    $datos .=" order by	".$orden." ASC";
               }

               //echo $datos;
               $prp_publicados_con_foto  = "";
                $prp_visitas_totales  = "";
                $prp_sol_inf_totales = "";
                $prp_sol_fot_totales = "";
                $prp_ultima_publicacion= "";


            /*  canitdad de fotos por inmueble*/

               $cantidad_fotos = " select count(1) from (
                                                        SELECT DISTINCT propiedades.prp_id, info_x_dia.usr_id
                                                        $from
                                                        $where
                                                        AND propiedades.fotos >0 ";
               $cantidad_fotos .=$filtro;
               $cantidad_fotos .=") c";
       //        echo $cantidad_fotos;
               $res_cantidad_fotos = mysql_query($cantidad_fotos);
               if(mysql_num_rows($res_cantidad_fotos)){
                   $prp_publicadas_con_foto = mysql_result($res_cantidad_fotos,0,0);
               }

               /*  canitdad de fotos por inmueble*/

               /*  totales por inmueble*/
               $totales= " select
                              sum(info_x_dia.visitas) as visitas,
                              sum(info_x_dia.sol_inf) as sol_inf,
                              sum(info_x_dia.sol_fot) as sol_fot
                       ";




               $totales.=$from.$where.$filtro;
               $res_totales= mysql_query($totales);
               if(mysql_num_rows($res_totales)){
                   $prp_visitas_totales= mysql_result($res_totales,0,0);
                   $prp_sol_inf_totales= mysql_result($res_totales,0,1);
                   $prp_sol_fot_totales= mysql_result($res_totales,0,2);
               }


               /*  totales por inmueble*/


                /*ultima fecha de modificacion/**/
                $ultima_publicacion="
                                       select
                                                      max(prp_mod) as prp_mod,
                                                      prp_mostrar
                                                ";
                $ultima_publicacion .= " from propiedades ".$where." group by propiedades.usr_id";
                
             
                $res_ultima_publicacion=mysql_query($ultima_publicacion);
                if(mysql_num_rows($res_ultima_publicacion)){
                   $prp_ultima_publicacion= mysql_result($res_ultima_publicacion,0,0);
                   
                   $fecha = explode(" ",$prp_ultima_publicacion);
                   $fecha = explode("-",$fecha[0]);
                   
                   
                   
                   $prp_ultima_publicacion = $fecha[2]."-".$fecha[1]."-".$fecha[0];
                }


               /*ultima fecha de modificacion/**/
		
		$offset=$offset;
		if (!$base) $base=0;
		if (!$offset) $offset=10;
		//print"<br> $datos <br>";
		$limit .= " limit $base,$offset";
		$datos_consultas=mysql_query($datos);
		$totaldatos=mysql_numrows($datos_consultas);
		$datos .= $limit;
		$datos_consultas=mysql_query($datos);
		echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\" ?>";
		echo "<inmodb><paginacion><offset>$offset</offset><totalDatos>$totaldatos</totalDatos><paginaActual>$page</paginaActual></paginacion>

                <prp_publicados_con_foto>$prp_publicadas_con_foto </prp_publicados_con_foto>
                <prp_visitas_totales>$prp_visitas_totales </prp_visitas_totales>
                <prp_sol_inf_totales>$prp_sol_inf_totales </prp_sol_inf_totales>
                <prp_sol_fot_totales>$prp_sol_fot_totales </prp_sol_fot_totales>
                <prp_ultima_publicacion>$prp_ultima_publicacion </prp_ultima_publicacion>

                <propiedades>

                    
                ";
		if ($datos_consultas)
		{
			while($fila=mysql_fetch_array($datos_consultas))
			{
 				
				print "
					<columna>
                                            	
						<prp_id><![CDATA[".$fila['prp_id']."]]></prp_id>
						<fotos><![CDATA[".$fila['fotos']."]]></fotos>
						<prp_dom><![CDATA[".$fila['prp_dom']."]]></prp_dom>
						<tip_desc><![CDATA[".$fila['tip_desc']."]]></tip_desc>
						<con_desc><![CDATA[".$fila['con_desc']."]]></con_desc>
						<prp_mod><![CDATA[".$fila['prp_mod']."]]></prp_mod>
						<visitas><![CDATA[".$fila['visitas']."]]></visitas>
						<sol_inf><![CDATA[".$fila['sol_inf']."]]></sol_inf>
						<sol_fot><![CDATA[".$fila['sol_fot']."]]></sol_fot>
						<prp_mostrar><![CDATA[".$fila['prp_mostrar']."]]></prp_mostrar>
						
					</columna>
				";
			}
		}
		echo "</propiedades></inmodb>";


?>