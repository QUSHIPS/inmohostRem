<?php 
header("Content-type: application/xml");
extract ($_GET);
extract ($_REQUEST);

include("../php/config.php");

//Ya tengo los filtros multiples. solo resta hacer la consulta en propiedades
	$regs=" prp_id,
			prp_dom,
			loc_desc,
			pro_desc,
			tip_desc,
			con_desc,
                        fotos,
			prp_pre,
                        prp_referente,
                        usr_raz,
                        date_format(prp_alta,'%d-%m-%Y') as prp_alta,
                        date_format(prp_mod,'%d-%m-%Y') as prp_mod,
                        propiedades.prp_id,
                        propiedades.usr_id,
                        prp_desc,
                        prp_nota,
                        prp_ocultar_precio
                        ";
	
	$tablas="propiedades,
			 localidades,
			 provincias,
			 tipo_const,
			 condiciones,
                         usuarios";
	
	$filtro="propiedades.pro_id=provincias.pro_id and
			 propiedades.loc_id=localidades.loc_id and
			 propiedades.tip_id=tipo_const.tip_id and
			 propiedades.con_id=condiciones.con_id and
			 propiedades.usr_id="._USR_ID." and 
			 propiedades.prp_id=$prp_id and
                         propiedades.usr_id= usuarios.usr_id ";



$cad=mysql_query("select $regs from $tablas where $filtro");
$fila=mysql_fetch_array($cad);
$msg=" ";
switch($tipo){

    case "enviar_ficha":
        $msg ='
                    <p> Ficha ID: '.$fila['prp_id'].' - '.$fila['usr_id'].'</p>



<table width="600px" id="ficha_mail">
                                <tr>
                                   <td style="border:1px solid #CCC" width="20%">
                                        <div align="center">
                                             <img  src="http://www.inmoclick.com.ar/inmohost/logos/logo_'.$fila['usr_id'].'.gif" />
                                            
                                        </div>
                                    </td>
                                    <td style="border:1px solid #CCC" width="25%">
                                        <div align="center">
                                            <h3>Publicaci&oacute;n: '.$fila['prp_alta'].'</h3>
                                        </div>
                                    </td>
                                    <td style="border:1px solid #CCC" width="25%">
                                        <h3 align="center">Modificaci&oacute;n: '.$fila['prp_mod'].'</h3>
                                    </td>
                                </tr>';
                                      if($fila['fotos']>0){
                                          $resultado_fotos = mysql_query("select * from fotos where prp_id=".$fila['prp_id']." and ".$fila['usr_id']."");
                                          if(mysql_num_rows($resultado_fotos)){
                                              $msg.='<tr>';
                                              $i=0;
                                                while($fila_fotos = mysql_fetch_array($resultado_fotos)){

                                                    if($i%3==0){
                                                        $msg.='</tr><tr>';
                                                    }
                                                    $msg.='<td style="border:1px solid #CCC" width="150"> <img src="http://www.inmoclick.com.ar/ftp_inmohost/fotos/'.$fila['prp_id'].'-'.$fila['usr_id'].'-'.$fila_fotos['fo_nro'].'.gif" width="230"/></td>';

                                                   $i++;
                                                }
                                                $msg.='</tr>';

                                          }
                                      }


                            $msg.='
                                <tr>
                                    <td style="border:1px solid #CCC" colspan="3">
                                        <table style="width: 100%;" border="0" cellspacing="1" cellpadding="3" align="center">
                                            <tbody>

                                                ';
                                        if($fila['prp_referente']){
                                            $resultado = mysql_query("select * from empleados where emp_id = ".$fila['prp_referente']);
                                            if(mysql_num_rows($resultado)){
                                                $referente = mysql_fetch_array($resultado);
                                                $msg.='<tr><td style="border:1px solid #CCC" colspan="2"><b>Referente del inmueble</b></td></tr>
                                                <tr><td style="border:1px solid #CCC" align="center"><img src="http://www.inmoclick.com.ar/ftp_inmohost/fotos/emp_1-'.$fila['usr_id'].'.gif" width="70px"/></td><td style="border:1px solid #CCC"> Referente:'.$referente['nombre'].' '.$referente['apellido'].'<br/>
                                                    Telefono: '.$referente['telefono'].'<br/>
                                                    E-mail:'.$referente['email'].'</td>
                                                </tr> ';
                                            }
                                        }

                                        if($fila['prp_ocultar_precio']){
                                            $precio = 'Consultar';
                                        }else{
                                            $precio = $fila['prp_pre'];
                                        }
                                        
                                        
                                        $msg.='

                                                <tr>
                                                    <td style="border:1px solid #CCC" colspan="2">Inmueble</td>
                                                </tr>
                                                <tr>
                                                    <td style="border:1px solid #CCC">ID: '.$fila['prp_id'].'</td>
                                                    <td style="border:1px solid #CCC">Precio: '.$precio.'</td>
                                                </tr>
                                                <tr>
                                                    <td style="border:1px solid #CCC" width="50%">Inmueble: '.$fila['tip_desc'].'</td>
                                                    <td style="border:1px solid #CCC" width="50%">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="border:1px solid #CCC">Condici&oacute;n: '.$fila['con_desc'].'</td>
                                                    <td style="border:1px solid #CCC">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="border:1px solid #CCC" colspan="2">Domicilio: '.$fila['prp_dom'].'</td>
                                                </tr>
                                                <tr>
                                                    <td style="border:1px solid #CCC">Localidad: '.$fila['loc_desc'].'</td>
                                                    <td style="border:1px solid #CCC">Provincia: '.$fila['pro_desc'].'</td>
                                                </tr>
                                                <tr>
                                                    <td style="border:1px solid #CCC" colspan="2">Servicios: </td>
                                                </tr>

                                                ';

                                     $cons_tip=mysql_query("select
									servicios_ihost.*
								from
										ser_tipo_const,
										servicios_ihost
								where
										servicios_ihost.ser_id=ser_tipo_const.ser_id and
										ser_tipo_const.tip_id=1 and
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
										usr_id=$usr_id and
                                                                                valor != '' and
                                                                                valor != 'Indistinto'
                                                            ");


                                        if(mysql_num_rows($cons_servi))
                                            {

                                                    $i=0;
                                                $msg.='<tr>';
                                                    while ($fila3=mysql_fetch_array($cons_tip))
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
                                                         if($value!=''){

                                                            if($i%2==0){
                                                                 $msg.='</tr><tr>';
                                                            }
                                                            $msg.='<td style="border:1px solid #CCC">';
                                                            $ser_desc=str_replace("*","",$fila3[ser_desc]);
                                                           

                                                          
                                                           
                                                             $msg.= ''.$ser_desc.': ';
                                                             $msg.=$value;
                                                            
                                                           
                                                            
                                                            $value="";
                                                            $msg.= "</td>";
                                                            $i++;
                                                        }
                                                    }//fin while
                                                    $msg.= "</tr>";
                                            }//fin if


                                        if($fila['prp_nota']){
                                            $msg.='<tr class="tableClara"><td style="border:1px solid #CCC" colspan="2">Nota:    '.$fila['prp_nota'].' </td></tr>';
                                        }
                                        $msg.='

                                                
                                                <tr>
                                                    <td style="border:1px solid #CCC" colspan="2">

                                                            Descripcion: '.$fila['prp_desc'].'
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>


                                    </td>
                                </tr>
                        </table>';



           
        break;
    case "coincidencia_demanda":
            $msg="Estimado $dem_raz:\n\rTenemos en algrado de comunicarle que contamos un inmueble de caracter&iacute;sitcas\nsimilares a la que Ud. solicit&oacute; en su momento. Si a&uacute;n esta interesado en \nrecibir asesoramiento, por favor, no dude en contactarse con nosotros. Sin \nm&aacute;s, le dejo una breve descripci&oacute;n del inmueble a continuaci&oacute;n:\n\r
						\n\r$fila[tip_desc] - $fila[con_desc] - $fila[prp_dom] - $fila[loc_desc] - $fila[prp_pre];
                ";
    break;

}



	

echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>";
echo "<XMLTEXTO>";
echo "<to><![CDATA[$to]]> </to>";			
echo "<from><![CDATA[$MAIL_USR]]></from>";
echo "<subject><![CDATA[$subject]]></subject>";		
echo "<msg><![CDATA[$msg]]></msg>";
echo "<dem_raz><![CDATA[$dem_raz]]></dem_raz>";
echo "<propiedad>
            <prp_id> </prp_id>
            <pro_desc> </pro_desc>
            <loc_desc> </loc_desc>
            <tip_desc> </tip_desc>

      </propiedad>";
echo "</XMLTEXTO>";


/*
$fila=mysql_fetch_array($cons_ficha);
		echo "
		    <XMLTEXTO>
                              <to><![CDATA[$to]]> </to>
                              <from><![CDATA[$MAIL_USR]]></from>
                              <subject><![CDATA[$subject]]></subject>
                              <msg><![CDATA[$msg]]></msg>
                              <dem_raz><![CDATA[$dem_raz]]></dem_raz>
			      <propiedad>
		 				<menuAu>1</menuAu>
						<editFicha>1</editFicha>
						<editEstado>1</editEstado>
						<editImprimir>1</editImprimir>";

                                    echo"
        				<prp_id>$prp_id</prp_id>
				        <usr_id>$usr_id</usr_id>
				        <inmo_id>$fila[usr_id]</inmo_id>
				        ";

		  				echo"
		  				<usr_raz>$fila[usr_raz]</usr_raz>
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
										ser_tipo_const.tip_id=1 and
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
	        <prp_desc><![CDATA[$fila[prp_desc]]]>
	        </prp_desc>
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
	        <prp_nota><![CDATA[$fila[prp_nota]]]></prp_nota>
	        <prp_mostrar><![CDATA[$fila[prp_mostrar]]]></prp_mostrar>
	        ";
				if($fila[fotos]>0){
					$cad="select fo_enl,fo_desc from fotos where prp_id=$fila[prp_id] and usr_id=".$fila[usr_id];
					$res=mysql_query($cad);
					$fo=mysql_fetch_array($res);
					echo "<fo_enl><![CDATA[$fo[fo_enl]]]></fo_enl>
						  <fo_desc><![CDATA[$fo[fo_desc]]]></fo_desc>
						   <red><![CDATA[0]]></red>
						  <amp>&#x26;</amp>	";
				}else{
					if($fila[usr_id]!=_USR_ID){
						echo "<fo_enl><![CDATA[/home/inmoclick/domains/inmoclick.com.ar/public_html/ftp_inmohost/fotos/$fila[prp_id]-$fila[usr_id]-1.gif]]></fo_enl>
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

*/
?>