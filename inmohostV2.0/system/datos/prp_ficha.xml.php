<?php 
header("Content-type: application/xml");
extract ($_GET);
extract ($_REQUEST);
include("../php/config.php");
$cadena="";

  //echo $usr_id_prp." - ".$prp_id;
if(isset($usr_id_prp)&&$usr_id_prp != _USR_ID || $usr_id != _USR_ID){
    mysql_close($db);
    include(dirname(__FILE__)."/../php/conexion_inmoclick.php");
    $db = $conn2;
    $cadena=" and usr_id=$usr_id_prp";
    $usr_id=$usr_id;

  
}



echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\" ?>";


			
			$consulta="
			select 
				propiedades.prp_id, 
				propiedades.usr_id,
				usuarios.usr_raz,
				usuarios.usr_dom,
				usuarios.usr_tel,
				usuarios.usr_mail,
				usuarios.web,
				propiedades.prp_dom,
				propiedades.prp_bar,
				localidades.loc_desc,
				provincias.pro_desc,
				prp_mod,
				prp_nota,
				prp_pre,
				prp_desc,
				prp_pre_dol,
				prp_llave,
				prp_cartel,
				prp_alta,
				prp_mod,
				prp_referente,
				con_desc,
				tip_desc,
				prp_servicios,
				propiedades.con_id,
				propiedades.tip_id,
				propiedades.loc_id,
				propiedades.pro_id,
				bar_priv_id,
				prp_vip,
				fotos,
				prp_anonimo,
				prp_mostrar,
				prp_tas,
				pre_inmo
			 from 
				propiedades,
				usuarios,
				localidades,
				provincias,
				condiciones,
				tipo_const
			 where 
				 propiedades.prp_id=$prp_id and
				 propiedades.tip_id=tipo_const.tip_id and
				 propiedades.con_id=condiciones.con_id and
				 propiedades.usr_id=usuarios.usr_id and 
				 propiedades.loc_id=localidades.loc_id and
				 propiedades.pro_id=provincias.pro_id and
				 propiedades.usr_id=$usr_id and
                                 propiedades.prp_mostrar != 4
			";
			
	$cons_ficha=mysql_query($consulta) or die ("no valido");
	if(mysql_num_rows($cons_ficha))
	{
		$fila=mysql_fetch_array($cons_ficha);
		echo "
		    <XMLTEXTO>
			      <propiedad>
		 				<menuAu>1</menuAu>
						<editFicha>1</editFicha>
						<editEstado>1</editEstado>
						<editImprimir>1</editImprimir>";
						if($usr_id==_USR_ID){
							echo"<editCitas>1</editCitas>
                                                        <editPro>1</editPro>    
                                                        ";

						}else {
							echo"<editCitas>0</editCitas>
                                                             <editPro>0</editPro>
                                                                ";
						}
		echo"
						
						<editSimil>1</editSimil>
						<editBarPriv>";
		
								if($fila[bar_priv_id]){
									echo $fila[bar_priv_id];									
								}else{
									echo "";
								}
		
		
						echo"</editBarPriv>
						<prp_id>$prp_id</prp_id>
				        <usr_id>$usr_id</usr_id>
				        <inmo_id>$fila[usr_id]</inmo_id>
				        ";
				        if($fila[prp_cartel]){
				        	print"<prp_cartel>Si</prp_cartel>";
				        }else{
				        	print"<prp_cartel>No</prp_cartel>";
				        }
		  				echo"
		  				<usr_raz><![CDATA[$fila[usr_raz]]]></usr_raz>
		  				<usr_dom>$fila[usr_dom]</usr_dom>
		  				<usr_tel>$fila[usr_tel]</usr_tel>
		  				<usr_mail>$fila[usr_mail]</usr_mail>
		  				<web>$fila[web]</web>
		  				
		  				
		  				<prp_llave>$fila[prp_llave]</prp_llave>
				        <prp_alta>$fila[prp_alta]</prp_alta>
				        <prp_mod>$fila[prp_mod]</prp_mod>
				        <tip_desc>$fila[tip_desc]</tip_desc>
				        <con_desc>$fila[con_desc]</con_desc>
				        ";
		$cons_tip=mysql_query("select 
									servicios_ihost.* 
								from 
										ser_tipo_const,
										servicios_ihost
								where
										servicios_ihost.ser_id=ser_tipo_const.ser_id and
										ser_tipo_const.tip_id=".$fila[tip_id]." and
										servicios_ihost.ser_id!=6 and 
										servicios_ihost.ser_id!=5
                                                                                
										");	

				// Consulta de los servicios de la propiedad
		$cons_servi=mysql_query("select 
										 *
								 from
										ser_x_prp_ihost	
								 where
										prp_id=$prp_id and
										usr_id=$usr_id");
		
		if(mysql_num_rows($cons_tip))
		{
			print "<cantservicios>" . mysql_num_rows($cons_tip)."</cantservicios>";
			$i=0;
			print "<servicios>";
			while ($fila3=mysql_fetch_array($cons_tip)) 
			{
				print "<serv>";
				$ser_desc=str_replace("*","",$fila3[ser_desc]);
				print "<serv_desc><![CDATA[$ser_desc]]></serv_desc>";
				if ($mod_tip=='edit')
				{
					// Si la propiedad ya tiene servicios vemos si este servicio ya tiene algun valor
					if(mysql_num_rows($cons_servi))
					{
						mysql_data_seek($cons_servi,0);	
						while($fila2=mysql_fetch_array($cons_servi))
						{
							if($fila2[ser_id]==$fila3[ser_id])
							{
								$value=$fila2[valor];	
								break;
							}
						}
					}		
				}
				print "<serv_valor><![CDATA[$value]]></serv_valor>";
				$value="";
				print "</serv>";
				$i++;
			}//fin while		
			print "</servicios>";	
		}//fin if	
                
                $tiene_fotos =($fila['fotos']>0)?"1":"0";
		echo"
		 	<prp_pre_dol>$fila[prp_pre_dol]</prp_pre_dol>
			<existencia>1</existencia>
			<prp_dom><![CDATA[" . $fila[prp_dom] . "]]></prp_dom>
	        <prp_bar><![CDATA[" . $fila[prp_bar] . "]]></prp_bar>
	        <loc_desc>$fila[loc_desc]</loc_desc>
	        <pro_desc>$fila[pro_desc]</pro_desc>
	        <prp_pre><![CDATA[".$fila[prp_pre]."]]></prp_pre>
	        <prp_pre_dol><![CDATA[".$fila[prp_pre_dol]."]]></prp_pre_dol>
	        <pre_inmo><![CDATA[".$fila[pre_inmo]."]]></pre_inmo>
	        <prp_desc><![CDATA[".nl2br($fila[prp_desc])."]]> </prp_desc>
                <tiene_fotos><![CDATA[".trim($tiene_fotos)."]]></tiene_fotos>
	        <referente>
	        	";
					$cad_ref="select * from empleados where emp_id=$fila[prp_referente]".$cadena;
					$res_ref=mysql_query($cad_ref);
					if(mysql_num_rows($res_ref)){
						$ref=mysql_fetch_array($res_ref);
						echo "
								<prp_referente>$ref[emp_id]</prp_referente>
								<nombre>$ref[nombre] $ref[apellido]</nombre>
								<telefono>$ref[telefono]</telefono>
								<email>$ref[email]</email>
								<fotos>$ref[fo_id]</fotos>
								";
								echo"<foto>emp_$ref[fo_id]-".$usr_id.".gif</foto>";
					}
					
			echo"
	        </referente>
	        <prp_servicios><![CDATA[$fila[prp_servicios]]]></prp_servicios>
	        <prp_nota><![CDATA[".nl2br($fila[prp_nota])."]]></prp_nota>
                <cache_fotos><![CDATA[".str_replace(" ","",($fila['prp_mod'])?$fila['prp_mod']:$fila['prp_alta'])."]]></cache_fotos>
	        <prp_mostrar><![CDATA[$fila[prp_mostrar]]]></prp_mostrar>
                    
	        ";
				if($fila[fotos]>0){
					$cad="select fo_enl,fo_desc from fotos where prp_id=$fila[prp_id] and usr_id=".$fila[usr_id].' order by fo_nro ASC';
					$res=mysql_query($cad);
                                        if(mysql_num_rows($res)){
                                            echo "<fotos>";
                                            while($fo = mysql_fetch_array($res)){
                                                
                                                echo "<foto><fo_enl><![CDATA[".$fo['fo_enl']."]]></fo_enl>
						  <fo_desc><![CDATA[".$fo['fo_desc']."]]></fo_desc>
						   <red><![CDATA[0]]></red>
						  <amp>&#x26;</amp>
                                                  </foto>";
                                            }
                                            echo "</fotos>";
                                        }
                                        
                                        
                                        
//					$fo=mysql_fetch_array($res);
					
				}else{
					if($fila[usr_id]!=_USR_ID){
						echo "<fo_enl><![CDATA[www.inmoclick.com.ar/ftp_inmost/fotos/image.php?image=$fila[prp_id]-$fila[usr_id]-1.gif&width=640&heigh=480]]></fo_enl>
							 <fo_desc><![CDATA[]]></fo_desc>
							 <red><![CDATA[1]]></red>
							<amp>&#x26;</amp>";	
					}else{
						echo "<fo_enl><![CDATA[0-0-0.jpg]]></fo_enl>
						 <red><![CDATA[0]]></red>
							<amp>&#x26;</amp>";	
					}
					
				}
		echo"
			</propiedad>
		</XMLTEXTO>";
	}else{
						//no existe
						echo"
						   <XMLTEXTO>
							      <propiedad>
							       			0
							      </propiedad>
					   	    </XMLTEXTO>";
}
?>
