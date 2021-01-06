<?php

header("Content-type: application/xml");


	extract ($_GET);
	extract ($_REQUEST);

	if(!isset($page)) $page = 0;
	include("../php/conexion_inmoclick.php");
	if($prp_id)
	{
		$filtro .= " and consultas.prp_id=$prp_id";
	}

	if($desdeConsultasDia!="00" && $desdeConsultasMes!="00" && $desdeConsultasAno!="0000"  && (isset($desdeConsultasDia)&&isset($desdeConsultasMes)&&isset($desdeConsultasAno)))
	{	//si solo viene la fecha desde (por ejemplo desde el buscar), muestra las consultas desde esa fecha en adelante
		$fecha_d="$desdeConsultasAno-$desdeConsultasMes-$desdeConsultasDia";
		$filtro .= " and consultas.consulta_fecha >= '$fecha_d'";
	}
	if($desdeConsultasDia!="00"  && $desdeConsultasMes!="00"  && $desdeConsultasAno!="0000"  && $hastaConsultasDia!="00"  && $hastaConsultasMes!="00"  && $hastaConsultasAno!="0000"  && (isset($hastaConsultasDia)&&isset($hastaConsultasMes)&&isset($hastaConsultasAno)))
	{
		$fecha_d="$desdeConsultasAno-$desdeConsultasMes-$desdeConsultasDia";
		$fecha_h="$hastaConsultasAno-$hastaConsultasMes-$hastaConsultasDia";
		$filtro .= " and consultas.consulta_fecha between '$fecha_d' and '$fecha_h'";

	}//fin if
	
	if($tipo_consulta_id)
	{
		$filtro .=" and consultas.tipo_consulta_id=$tipo_consulta_id";
	}//fin if
	if($consulta_nombre)
	{
		$filtro .=" and consultas.consulta_nombre like '%$consulta_nombre%'";
	}//fin if
	if($consulta_email)
	{
		$filtro .=" and consultas.consulta_email like '%$consulta_email%'";
	}
	if($consulta_telefono)
	{
		$filtro .=" and consultas.consulta_telefono like '%$consulta_telefono%'";
	}

        if($consulta_leida!=-1)
        {
            	$filtro .=" and consultas.consulta_leida=$consulta_leida";
        }

        

	$datos="
			select
                               consultas.consulta_id,
                               consultas.prp_id,
                               consultas.consulta_nombre,
                               consultas.consulta_telefono,
                               consultas.consulta_email,
                               consultas.consulta_mensaje,
                               date_format(consultas.consulta_fecha,'%d-%m-%Y') as consulta_fecha,
                               consultas.tipo_consulta_id,
                               consultas.consulta_email_destino,
                               consultas.consulta_leida,
                               tipos_consultas.tipo_consulta_detalle

                       from
                                consultas left join propiedades on (consultas.prp_id = propiedades.prp_id and consultas.usr_id = propiedades.usr_id) 
                                left join tipos_consultas on (consultas.tipo_consulta_id = tipos_consultas.tipo_consulta_id)
                        where
                                consultas.usr_id = ".$usr_id." and
                                consultas.tipo_consulta_id!=2    
                                ";

			
		$datos .=$filtro;

                if($orden == ''){
                    $datos .=" order by	consultas.consulta_fecha DESC";

                }elseif($orden == 'prp_id'){
                    $datos .=" order by	consultas.".$orden." ASC";
               }else{
                    $datos .=" order by	".$orden." ASC";
                }
                    
		
		$offset=$offset;
		if (!$base) $base=0;
		if (!$offset) $offset=10;
		//print"<br> $datos <br>";
		$limit .= " limit $base,$offset";
		$datos_consultas=mysql_query($datos);
		$totaldatos=mysql_numrows($datos_consultas);
		$datos .= $limit;
		$datos;
		$datos_consultas=mysql_query($datos);
		echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\" ?>";
		echo "<inmodb><paginacion><offset>$offset</offset><totalDatos>$totaldatos</totalDatos><paginaActual>$page</paginaActual></paginacion><propiedades>";
		if ($datos_consultas)
		{
			while($fila=mysql_fetch_array($datos_consultas))
			{
 				
				print "
					<columna>
                                            	<consulta_id><![CDATA[".$fila['consulta_id']."]]></consulta_id>
						<prp_id><![CDATA[".$fila['prp_id']."]]></prp_id>
						<tipo_consulta_detalle><![CDATA[".$fila['tipo_consulta_detalle']."]]></tipo_consulta_detalle>
						<consulta_nombre><![CDATA[".$fila['consulta_nombre']."]]></consulta_nombre>
						<consulta_telefono><![CDATA[".$fila['consulta_telefono']."]]></consulta_telefono>
						<consulta_email><![CDATA[".$fila['consulta_email']."]]></consulta_email>
						<consulta_mensaje><![CDATA[".$fila['consulta_mensaje']."]]></consulta_mensaje>
						<consulta_fecha><![CDATA[".$fila['consulta_fecha']."]]></consulta_fecha>
						<consulta_email_destino><![CDATA[".$fila['consulta_email_destino']."]]></consulta_email_destino>
						<consulta_leida><![CDATA[".$fila['consulta_leida']."]]></consulta_leida>
						
					</columna>
				";
			}
		}
		echo "</propiedades></inmodb>";


?>