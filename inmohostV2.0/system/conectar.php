<?php
	
include ("php/config.php");
include ("php/sec_head.php");

include (_FILE_UTIL_MEN);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>::::::::::::</title>
<?php
	include("head.php");
	
	$ip_server=$HTTP_HOST;

?>
</head>
<body>

<table width="100%" border="0" cellpadding="1" cellspacing="2">
  <tr>
    <td valign="top" class="tableOscura"><h2 align="right">Conectando</h2></td>
  </tr>
  <tr>
    <td width="50%" valign="top"><h2 align="left"></h2>
    	  
    </td>
</tr>
</table>

<?
//parent.Dialog.info(\"<div style='font-size:12px;'><br><br><br>Aguarde mientras se Actualiza el sistema.</div><br> $string  \", {width:350, height:100,showprogress: true});
	if($propiedades){
		?>
			<script language="javascript">
				parent.$('pieMensajes').innerHTML='<?php echo _MENS_ACT_TEMP_1; ?>';
			</script>
		<?

		/*
		require_once("php/classes/nuSoap/lib/nusoap.php");
		
		
		$cadena="select cambio_id,cambio_det,prp_id,usr_id,cambios_fotos from cambios";
				
				$result=mysql_query($cadena);
				$str2="";
				$j=0;
				
				while ($fila=mysql_fetch_array($result)){
					
					$cadena="select * from propiedades where usr_id=$fila[usr_id] and prp_id=$fila[prp_id]";
					$res1=mysql_query($cadena);
					
	//				print $cadena."<br>";
					
					switch ($fila[cambio_det]){
					
					
						case "eliminacion":
								
								$prp=mysql_fetch_array($res1);
								$propiedad=array();
								$propiedad[0]=$prp[prp_id]; //prp_id
								$propiedad[1]=$prp[usr_id]; //usr_id
								$servicios=array();
								$fotos=array();
						break;
						
						default:
								if(mysql_num_rows($res1)){
									

									$prp=mysql_fetch_array($res1);
									
									$propiedad=array();
									$propiedad[0]=$prp[prp_id]; //prp_id
									$propiedad[1]=$prp[prp_dom]; //prp_dom
									$propiedad[2]=$prp[prp_bar];  //prp_bar   
									$propiedad[3]=$prp[loc_id];   
									$propiedad[4]=$prp[pro_id];
									$propiedad[5]=$prp[pai_id];
									$propiedad[6]=$prp[ori_id];
									$propiedad[7]=$prp[con_id];
									$propiedad[8]=$prp[prp_desc];
									$propiedad[9]=$prp[usr_id];
									$propiedad[10]=$prp[tip_id];
									$propiedad[11]=$prp[prp_mod];
									$propiedad[12]=$prp[prp_alta];
									$propiedad[13]=$prp[prp_nota];
									$propiedad[14]=$prp[prp_pre];
									$propiedad[15]='';//prp_pub
									$propiedad[16]=$prp[prp_mostrar];
									$propiedad[17]=$prp[prp_pre_dol];
									$propiedad[18]=$prp[prp_cartel];
									$propiedad[19]=$prp[prp_referente];
									$propiedad[20]=$prp[publica];
									$propiedad[21]=$prp[prp_servicios];
									$propiedad[22]=$prp[bar_priv_id];
									$propiedad[23]=$prp[prp_vip];
									$propiedad[24]=$prp[mos_por_1];
									$propiedad[25]=$prp[mos_por_2];
									$propiedad[26]=$prp[mos_por_3];
									$propiedad[27]=$prp[mos_por_4];
									$propiedad[28]=$prp[prp_anonimo];
									
									$sep="####";									
									//fotos	
									$res_alt=mysql_query("select * from fotos where prp_id=$fila[prp_id] and usr_id=$fila[usr_id]");	
									$fotos=array();										
									while ($fila_fot=mysql_fetch_array($res_alt)) {
										$fo_desc=str_replace($sep,'##',$fila_fot[4]);
										$fotos[]=$fila_fot[0].$sep.$fila_fot[1].$sep.$fila_fot[2].$sep.$fila_fot[3].$sep.$fo_desc;
									}
									
									//servicios
									$res_alt=mysql_query("select * from ser_x_prp_ihost where prp_id=$fila[prp_id] and usr_id=$fila[usr_id]");	
									$servicios=array();
									while ($fila_ser=mysql_fetch_array($res_alt)){
										$valor=str_replace($sep,'##',$fila_ser[3]);
										$servicios[]=$fila_ser[0].$sep.$fila_ser[1].$sep.$fila_ser[2].$sep.$fila_ser[3];
									}
										
								}//fin if mysql_num_rows
												  	
							break;	
							
					}
				}
			
			 $client=new nusoap_client("http://inmoclick-symfony/webServices.wsdl",array("trace" => 1, "exceptions" => 0));
			//$client = new SoapClient();
			
			 $e=$client->call("propiedades_editInmohostWsdl",array("propiedad"=>array($propiedad),"servicios"=>$servicios,"fotos"=>$fotos,"sep"=>$sep));

			 echo $e;
			 echo '<h2>Request</h2>';
 			 echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
			 echo '<h2>Response</h2>';
 			 echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';

			
		//	echo $propiedad[8];
			 
				*/
					
		
			$conn_id = ftp_connect($INTERNET_HOST); 
			$login = ftp_login($conn_id,$INTERNET_USR,$INTERNET_PASS); 
			@ftp_pasv($conn_id,1);
			//$fotos=mysql_query("select fo1_id, fo2_id, fo3_id, fo4_id, fo5_id, fo6_id, cambio_fo1, cambio_fo2, cambio_fo3, cambio_fo4 from $cambios where cambio_det!='eliminacion' ");
		 	if ((!$conn_id) || (!$login)) { 
		 	 		 if(!$conn_id)
						print "Error en la conexión. Revise su conexión a Internet";
					else 
						print "Error en login";
					
		        exit; 
		    }else{
		        print "CONECTADO";
		    }
			    
			$script=armar_script(_USR_ID);
			
			
			$upload = ftp_put($conn_id,"$INTERNET_DIR/act_online_"._USR_ID.".php","act_online_"._USR_ID.".php",FTP_BINARY); 
//			$chmod = @ftp_site($conn_id,"CHMOD 0777 $INTERNET_DIR/act_online_$usr_id.php");
			
			if (!$upload){ 
			        print "Error al subir las actualizaciones";
			        
			        exit();
			}else if(!$script){
				print"Error al armar el script";
				exit();
					
			}else{	
				$fotos=mysql_query("select prp_id,cambios_fotos from cambios where cambio_det!='eliminacion' ");
				while($foto=mysql_fetch_array($fotos)){
					$vector=explode("x",$foto[cambios_fotos]);
					for($i=0;$i<=count($vector)-1;$i++){
						if($vector[$i]){
							$verif=mysql_query("select * from fotos where prp_id=$foto[prp_id] and usr_id=$usr_id and fo_nro=$vector[$i]") or die(mysql_error());
							
							if(mysql_num_rows($verif)){
								$id_foto=$foto[prp_id]."-".$usr_id."-".$vector[$i].".gif";
								$archivo1="$INTERNET_DIR/fotos/".$id_foto;
								$archivo2="../fotos/".$id_foto;
								//print"INTERNET $archivo2 -> $archivo1 <br>";
								$res=ftp_put($conn_id,"$archivo1","$archivo2",FTP_BINARY);
							
//								$chmod = ftp_site($conn_id,"CHMOD 0777 $archivo1");	
							}
						}
					}
				}	 
			}	
		//aaa

		print"
			<script>
				
		  		window.location.href='http://www.inmoclick.com.ar/ftp_inmohost/act_online_"._USR_ID.".php?usr_id="._USR_ID."&usr_cim="._USR_CIM."&ip=$ip_server';
			</script>";
	}//fin if propiedades

	
	if($medios){
		    	?>
			<script language="javascript">
				parent.$('pieMensajes').innerHTML='<?php echo _MENS_ACT_TEMP_2; ?>';
			</script>
		<?
		echo "
	  	<tr>
    		<td width=\"50%\" valign=\"top\"><h2 align=\"left\"> Chequeando mensajes para enviar...<br></h2></td>
		</tr>";
		$subject="Publicacion en la grafica";
		
		$diarios="select * from receptores";
		$res_dia=mysql_query($diarios);
		//recorro todos los medios para armar un mail por cada medio.
		while ($fila_diarios=mysql_fetch_array($res_dia)){
		
				$to=$fila_diarios[mail];
				
				if($fila_diarios[mailcc]){
					$cc=$fila_diarios[mailcc];
				}
				
				
				$msg="Estimados $fila_diarios[med_raz]:\r\n\r\nPróximos avisos:\r\n\r\n";
		
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
					
					$msg.="\r\nAviso $i:## $prp_pub ";
					
					for($j=0;$j<count($fechas);$j++){
						
						$msg.=$fechas[$j]." - ";
					}
					
					$i++;
					
					$msg.=" ##\r\n";
						
				}
				
				$msg.="\n\rAtte. "._USR_RAZ."\r\n";
				$msg.=_USR_DOM."\r\n";	
				$msg.=_USR_TEL."\r\n";
				
					$res=mandar_mail($from,_USR_RAZ,$to,$cc,$subject,$msg,$MAIL_SMTP,$MAIL_USR,$MAIL_PASS);
				
				if($res!=1){
					
					echo "
						<tr>
    						<td width=\"50%\" valign=\"top\"><h2 align=\"left\"> No se pudieron enviar los mensajes. <br>Revise su conexion a Internet.<br> Mensaje de Error: $res</h2></td>
						</tr>";
					echo"
						<table width=\"100%\">
						<tr>
							<td width=\"100%\" align=center><input type=\"button\" name=\"Aceptar\" value=\"Aceptar\" onclick=\"parent.Windows.close('win_actualizador')\"></td>
						</tr>
					";
					?>
						<script language="javascript">
							parent.$('pieMensajes').innerHTML='';
						</script>
					<?
				
				}
								
		}
		
		print"
			<tr>
    			<td width=\"50%\" valign=\"top\"><h2 align=\"left\"> Todos los mensajes fueron enviados.<br></h2></td>
			</tr>
			<tr>
    			<td width=\"50%\" valign=\"top\"><input type=\"button\" name=\"Aceptar\" value=\"Aceptar\" onclick=\"parent.Windows.close('win_actualizador')\"></td>
			</tr>	
			";
		?>
						<script language="javascript">
							parent.$('pieMensajes').innerHTML='<?php echo _MENS_ACT_OK; ?>';
						</script>
					<?
			
	}
	
	if($red_cim){
		
		
		
	}
	
	
	if($bar_priv){
		
		?>
			<script language="javascript">
				parent.$('pieMensajes').innerHTML='<?php echo _MENS_ACT_TEMP_3; ?>';
			</script>
		<?

	
			$conn_id = ftp_connect($INTERNET_HOST); 
			$login = ftp_login($conn_id,$INTERNET_USR,$INTERNET_PASS); 
			@ftp_pasv($conn_id,1);
			//$fotos=mysql_query("select fo1_id, fo2_id, fo3_id, fo4_id, fo5_id, fo6_id, cambio_fo1, cambio_fo2, cambio_fo3, cambio_fo4 from $cambios where cambio_det!='eliminacion' ");
			 	if ((!$conn_id) || (!$login)) { 
			 	 		 if(!$conn_id)
							print "Error en la conexión. Revise su conexión a Internet";
						else 
							print "Error en login";
						
			        exit; 
			    }else{
			        print "CONECTADO";
			    }
			    
			    
			$script=armar_script_bar_priv(_USR_ID);
			
		
			$upload = @ftp_put($conn_id,"$INTERNET_DIR/act_bar_priv_"._USR_ID.".php","act_bar_priv_"._USR_ID.".php",FTP_BINARY); 
//			$chmod = @ftp_site($conn_id,"CHMOD 0777 $INTERNET_DIR/act_online_$usr_id.php");
				
			if (!$upload){ 
			        print "Error al subir las actualizaciones";
			        exit();
			}else if(!$script){
				print"Error al armar el script";
				exit();
					
			}else{	
				
				$fotos=mysql_query("select bar_id,cambio_fotos,bar_logo from cambios_bar_priv where cambio_det!='eliminacion' ");
				while($foto=mysql_fetch_array($fotos)){
					$vector=explode("x",$foto[cambio_fotos]);
					for($i=0;$i<=count($vector)-1;$i++){
						if($vector[$i]){
							$verif=mysql_query("select * from fotos_x_bar where bar_id=$foto[bar_id] and usr_id=$usr_id and fo_id=$vector[$i]") or die(mysql_error());
							
							if(mysql_num_rows($verif)){
								$id_foto="bar_".$foto[bar_id]."-".$usr_id."-".$vector[$i].".gif";
								$archivo1="$INTERNET_DIR/fotos/".$id_foto;
								$archivo2="../fotos/".$id_foto;
						//		print"INTERNET $archivo2 -> $archivo1 <br>";
								$res=ftp_put($conn_id,"$archivo1","$archivo2",FTP_BINARY);
//								$chmod = ftp_site($conn_id,"CHMOD 0777 $archivo1");	
							}
						}
					}
					
					if($foto[bar_logo]!=""){
						
						$archivo1="$INTERNET_DIR/logos/".$foto[bar_logo];
						$archivo2="extra/logos/".$foto[bar_logo];
				//		print"INTERNET $archivo2 -> $archivo1 <br>";
						$res=ftp_put($conn_id,"$archivo1","$archivo2",FTP_BINARY);
					}
					
				}
								
					 
			}	
		
		

		print"
			<script>
		  		window.location.href='http://www.inmoclick.com.ar/ftp_inmohost/act_bar_priv_"._USR_ID.".php?usr_id="._USR_ID."&ip=$ip_server';
			</script>";
		
	}
	
	if($usuario){
		
		?>
			<script language="javascript">
				parent.$('pieMensajes').innerHTML='<?php echo _MENS_ACT_TEMP_4; ?>';
			</script>
		<?

	
			$conn_id = ftp_connect($INTERNET_HOST); 
			$login = ftp_login($conn_id,$INTERNET_USR,$INTERNET_PASS); 
			@ftp_pasv($conn_id,1);
			
			 	if ((!$conn_id) || (!$login)) { 
			 	 		 if(!$conn_id)
							print "Error en la conexión. Revise su conexión a Internet";
						else 
							print "Error en login";
						
			        exit; 
			    }else{
			        print "CONECTADO";
			    }
			    
			    
			$script=armar_script_emp(_USR_ID);
		//	exit();
		
			$upload = @ftp_put($conn_id,"$INTERNET_DIR/act_emp_"._USR_ID.".php","act_emp_"._USR_ID.".php",FTP_BINARY); 
//			$chmod = @ftp_site($conn_id,"CHMOD 0777 $INTERNET_DIR/act_online_$usr_id.php");
				
			if (!$upload){ 
			        print "Error al subir las actualizaciones";
			        exit();
			}else if(!$script){
				print"Error al armar el script";
				exit();
					
			}else{	
				
				$fotos=mysql_query("select fo_id from cambios_emp");
				while($foto=mysql_fetch_array($fotos)){
					
					if($foto[fo_id]!=-1){
						$id_foto="emp_".$foto[fo_id]."-".$usr_id.".gif";
						$archivo1="$INTERNET_DIR/fotos/".$id_foto;
						$archivo2="../fotos/".$id_foto;
			//			print"INTERNET $archivo2 -> $archivo1 <br>";
						$res=ftp_put($conn_id,"$archivo1","$archivo2",FTP_BINARY);
						
					}
				}
			}	
		//print "aaa";

		print"
			<script>
		  		window.location.href='http://www.inmoclick.com.ar/ftp_inmohost/act_emp_"._USR_ID.".php?usr_id="._USR_ID."&ip=$ip_server';
			</script>";
		
	}
	
?>
</body>
</html>