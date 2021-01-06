<?php 

header("Content-type: application/xml");

	extract ($_GET);
	extract ($_REQUEST);
	
	include("../php/config.php");
        include("../php/configFileUpload.php");
       
        function calcular_color_visibilidad($puntaje){
    
    
    /*
                                 * de 0 a 19 red
                                 * de 20 a 30 #FEB8A7
                                 * 30 a 60 #FFDCAC
                                 * 60  80  #E1F3B0
                                 * 80  100 #D8F4B0 
                                 */
    
    $color = '#000000';
    
    if ($puntaje >=0 && $puntaje <=20){
        
        $color = '#FF0000;';
        
    }else if($puntaje >=20 && $puntaje <=50){
        
        $color = '#FF6600';
        
    }else if($puntaje >=50 && $puntaje <=70){
        
        $color = '#CACA00';
        
    }else if($puntaje >=70 && $puntaje <=82){
        
        $color = '#33CCFF';
        
    }else if($puntaje >=82 && $puntaje <=100){
        $color = '#339900';
    }
    return $color;
}

        
        
	
	/* CONSULTA A LA BASE DE DATOS 	*/

        if($buscador_avanzado == 1){
         include( dirname(__FILE__)."/../php/conexion_inmoclick.php");
         $db = $conn2;
        }else{
            $buscador_avanzado=0;
        }

	$offset=$offset;
	if (!$offset)
	{
		$offset=10;
	}
	if (!$base)
	$base=0;	
//variable ppal. a la que se le agregan los registros de las demas consultas

$regs = "propiedades.prp_id
		,usuarios.usr_raz
		,propiedades.usr_id
		,propiedades.prp_dom
		,provincias.pro_desc
		,propiedades.prp_nota
		,propiedades.prp_mostrar
                ,propiedades.prp_visibilidad
		";

$tablas = "	usuarios
		,propiedades
		,provincias
		";		

$filtro = "	propiedades.pro_id=provincias.pro_id 
			and propiedades.usr_id=usuarios.usr_id 
            
            ";

if($buscador_avanzado == 1){
    $filtro .= " and usuarios.visible = 1";
}

	$usr_id=$inmo_id;
	
	
	if($inmo_id==-2){
		$filtro .= " and usuarios.usr_id!="._USR_ID;
	}else if ($inmo_id){
		$filtro .= " and usuarios.usr_id=$inmo_id";
	}
	
	//agregar por id de propiedad
	if ($prp_id!=0)
		$filtro .= " and propiedades.prp_id=$prp_id";	
	
	//si la propiedad se tiene que mostrar
	/*
	if($susp=="true"){
		$filtro .= " and propiedades.prp_mostrar!=1 ";
	}else{
		$filtro .=" and propiedades.prp_mostrar=1";
	}
	*/
	
	if(($usr_id && !$inmo_id)){
		$filtro .= " and propiedades.usr_id=$usr_id";
		$min = 0;$max = 99999999;
		$minUS = 0;$maxUS=99999999;
	}
		
	//separar los rangos del precio 
	
	//precio en pesos
	if (strstr($max,'ili'))// && !$pre_medio)){
		$max=99999999;
		$regs .=" ,propiedades.prp_pre";
	//	$filtro .= " and $propiedades.prp_pre between $min and $max";
	//precio en dolares
	if (strstr($maxUS,'ili'))
	
		$maxUS=99999999;
		$regs .=" ,propiedades.prp_pre_dol";
	//	$filtro .= " and $propiedades.prp_pre_dol between $minUS and $maxUS";
	
	//condicion 
	if ($con_id!=0)
		$filtro .= " and propiedades.con_id=$con_id";
		
		$regs .= " ,condiciones.con_desc";	
		$tablas .= " ,condiciones";
		$filtro .= " and condiciones.con_id=propiedades.con_id";
	
	//agregar provincia
	if ($pro_id!=0)
		$filtro .= " and propiedades.pro_id=$pro_id";
	
	//agregar localidad
	if ($loc_id!=0)
		$filtro .= " and localidades.loc_id=$loc_id ";	
		
		$regs .= " ,localidades.loc_desc";	
		$tablas .= " ,localidades";
		$filtro .= " and propiedades.loc_id=localidades.loc_id";
	
	//agregar domicilio
	if ($prp_dom)
		$filtro .= " and (propiedades.prp_bar like '%$prp_dom%' or localidades.loc_desc like '%$prp_dom%' or propiedades.prp_dom like '%$prp_dom%')";	
	
		$regs .= " ,propiedades.prp_bar ";
	
	//agregar tipo de contruccion
	if ($tip_id!=0)
	{
		$filtro .= " and propiedades.tip_id=$tip_id ";
	}
	$regs .= " ,tipo_const.tip_desc ";
	$tablas .= " ,tipo_const";
	$filtro .= " and propiedades.tip_id=tipo_const.tip_id";
	
	//agregar fecha modificada	
		$regs .= " ,date_format(propiedades.prp_mod,'%d-%m-%Y') as prp_mod";
	
	//agregar descripci�n
		$regs .= " ,propiedades.prp_desc";
	
	//agregar filtro seg�n modificaci�n
	$fecha = date('Y-m-d');
	$fecha = explode("-",$fecha);
		
	if ($estado)
	{
		$filtro.=" and prp_mostrar='$estado' ";
	}else{
		$filtro.=" and prp_mostrar!=4 ";
	}
	
	if ($pes_ent && $pes_y)
	{
		$filtro .= " and propiedades.prp_pre between $pes_ent and $pes_y";
	}
	else if ($dol_ent && $dol_y)
	{
		$filtro .= " and propiedades.prp_pre_dol between $dol_ent and $dol_y";
	}
	else if($pre_medio)
	{
		$pes_ent=($pre_medio*0.8);
		$pes_y=($pre_medio*1.2);
		
		$filtro .= " and propiedades.prp_pre between $pes_ent and $pes_y";
	}
	//print "$pes_ent - $pes_y";
		$ord=$orden;
		switch ($orden){
		case 1: $orden = "propiedades.prp_mod"; 
			break;
		case 2: $orden = "provincias.pro_desc"; 
			break;
		case 3: $orden = "localidades.loc_desc"; 
			break;
		case 4: $orden = "propiedades.prp_bar"; 
			break;
		case 5: $orden = "propiedades.prp_pre";
			break;
		case 6: $orden = "propiedades.fo1_id"; 
			break;
		case 7: $orden = "propiedades.prp_id"; 
			break;
		default:
			$orden = "propiedades.prp_pre ";	
		} 	
//}
/*
else 
{
	if ($inmo_id==0)
	{
		$filtro .= " and propiedades.usr_id=usuarios.usr_id ";
	}
	else 
	{
		$filtro .= " and usuarios.usr_id=$inmo_id
				and	propiedades.usr_id=usuarios.usr_id ";
	}	
	$orden = "propiedades.prp_pre ";	
}
	
*/	
//print "precio $pre_medio - base: $base";


/*if($pre_medio && $base==0){
	
	$pre_max=99999999;
	$todo_2 = mysql_query("select prp_pre from $tablas where $filtro order by $orden desc") or die ($err_1001);

	for($j=0;$j<(mysql_num_rows($todo_2));$j++)
	{
		$pre=mysql_result($todo_2,$j,0);
		
		if($pre_medio < $pre){
			$pre_max=$pre;
		}
		
		if( $pre_medio < $pre_max && $pre_medio >= $pre){
			$pagina=$j;
			print "pagina $j";
			break;
		}
	}
	$orden="propiedades.prp_pre ";
	$base=(int)($pagina/$offset)*10;
	$page=(int)($pagina/$offset);
}// fin if pre_medio
*/

$orden.=" $sentido";
if ($mod_edit=='mod_del' && $prp_id)
{
	 $filtro .= " and prp_id='$prp_id'";
}
	$limit .= " limit $base,$offset";

$consulta = "select $regs from $tablas where $filtro order by $orden $limit";
//print $consulta;
$cons=mysql_query($consulta,$db) or die("Consulta propiedades".mysql_error());
$consulta2 = "select count(prp_id) from $tablas where $filtro";
$cons2=mysql_query($consulta2,$db) or die("Consulta cantidad".mysql_error());


	echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\" ?>";
	echo "
	<XMLTEXTO>
		<inmodb>";

//Si encontro alguna propiedad
if(mysql_result($cons2, 0, 0)!=0){

	if(!isset($page)) $page = 0;
	
	echo"
			<paginacion>
				<offset>$offset</offset>
				<base>$base</base>
				<totalDatos>".mysql_result($cons2, 0, 0)."</totalDatos>
				<paginaActual>$page</paginaActual>
				<usr_id>$usr_id</usr_id>
				<inmo_id>$inmo_id</inmo_id>
				<prp_id>$prp_id</prp_id>
				<inmo_id2>$inmo_id2</inmo_id2>
			</paginacion>
		<propiedades>";
	if ($mod_edit!='mod_del')
	{
		while ($fila=mysql_fetch_array($cons)) 
		{
			if ($fila[usr_id]==_USR_ID)
			{
				$cita=1;
			}
			else 
			{
				$cita=0;
			}
                        
                        $cadena_precios = '';
                        
                        if($fila[prp_pre]>0){
                            $cadena_precios = '($)'.$fila[prp_pre];
                        }
                        
                        if($fila[prp_pre_dol]>0){
                            $cadena_precios .= '-(USD)'.$fila[prp_pre_dol];
                        }
                        
                        
                           
                        
                        
			echo "
			<columna>
				<prp_id>$fila[prp_id]</prp_id>
                                <buscador_avanzado>".$buscador_avanzado."</buscador_avanzado>
				<prp_dom><![CDATA[$fila[prp_dom]<br>$fila[prp_bar] [$fila[loc_desc] - $fila[pro_desc]]]]></prp_dom>
                                <prp_mostrar><![CDATA[$fila[prp_mostrar]]]> </prp_mostrar>
				<prp_tip><![CDATA[$fila[tip_desc]]]></prp_tip>
				<prp_con><![CDATA[$fila[con_desc]]]></prp_con>
				<prp_mod><![CDATA[$fila[prp_mod]]]></prp_mod>
				<prp_pes><![CDATA[$cadena_precios]]></prp_pes>
				
				<prp_inmo><![CDATA[$fila[usr_raz]]]></prp_inmo>";
				$cf="select fo_enl from fotos where prp_id=$fila[prp_id] and usr_id=$fila[usr_id] order by fo_nro ASC limit 1";
				$resf=mysql_query($cf,$db);
				
				if($fila[usr_id]==_USR_ID){
					if (mysql_num_rows($resf)) {
						echo"<prp_fot><![CDATA[<img src='"._URL_FOTOS_INMOCLICK."/image.php?width=80&height=80&cropratio=640:480&image=".mysql_result($resf,0,0)."'>]]></prp_fot>";
					}else{
						echo"<prp_fot><![CDATA[<img src='"._URL_FOTOS_INMOCLICK."/image.php?width=80&height=80&cropratio=640:480&image=0-0-0.jpg'>]]></prp_fot>";
					}
				}else{
                                    
					echo"<prp_fot><![CDATA[<img src='"._URL_FOTOS_INMOCLICK."/image.php?width=80&height=80&cropratio=640:480&image=$fila[prp_id]-$fila[usr_id]-1.gif'>]]></prp_fot>";					
				}
				
                                
                                /*
                                 * de 0 a 19 red
                                 * de 20 a 30 #FEB8A7
                                 * 30 a 60 #FFDCAC
                                 * 60  80  #E1F3B0
                                 * 80  100 #D8F4B0 
                                 */
                                
                                $color = calcular_color_visibilidad($fila[prp_visibilidad]);
				
				echo"
				<prp_inmoID><![CDATA[$fila[usr_id]]]></prp_inmoID>
                                <prp_visibilidad><![CDATA[<font style='font-weight:bold;color:".$color."'> $fila[prp_visibilidad] </font>]]></prp_visibilidad>    
				<prp_citas><![CDATA[$cita]]></prp_citas>
				<prp_ficha>1</prp_ficha>
			</columna>
			";
		}
	}
	else 
	{
			while ($fila=mysql_fetch_array($cons)) 
			{	
				$prp_mos=$fila[prp_mostrar];
				switch ($prp_mos)
				{
					case '1':
						$prp_mostrar=1;
						break;
					case '2':
						$prp_alq_ven=1;
						break;
					case '3':
						$prp_susp=1;
						break;
					case '4':
						$prp_susp=1;
						break;										
				}
				echo "
				
				
				<columna>
					<prp_id>$fila[prp_id]</prp_id>
					<prp_dom><![CDATA[$fila[prp_dom] - $fila[prp_bar] [$fila[loc_desc] - $fila[pro_desc]]]></prp_dom>
					<prp_tip><![CDATA[$fila[tip_desc]]]></prp_tip>
					<prp_con><![CDATA[$fila[con_desc]]]></prp_con>
					<prp_mos><![CDATA[$prp_mostrar]]></prp_mos>
					<prp_vend><![CDATA[$prp_alq_ven]]></prp_vend>
					<prp_susp><![CDATA[$prp_susp]]></prp_susp>
					<prp_elim>0</prp_elim>
					<prp_ficha>1</prp_ficha>
				</columna>
				";	
				$prp_mostrar=0;
				$prp_alq_ven=0;
				$prp_susp=0;
			}
	}
//Si no Hay Propiedades
}else{
	print"	
		<propiedades> 0";
}

	print"	
		</propiedades>
	</inmodb>
	</XMLTEXTO>";

        mysql_close($db);
?>