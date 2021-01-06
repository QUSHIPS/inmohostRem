<?php
		if (!$db)
		{
			include dirname(__FILE__)."/../conexion.php";
		}elseif($db == "inmoclick_database"){

                        include dirname(__FILE__)."/../conexion_inmoclick.php";
                        //$conn = conectar_inmoclick();
                }
		
                
                //hack para ocultar empleado admin
                $filtro_extra = false;
                if(strstr($tablas, 'empleados')){
                    $filtro_extra = "usr_login != 'puntosero' and usr_pass != 'punto7268'";
                }
                
                
		if(!$filtro){
                    if(!$filtro_extra){
			$cadena="select $regs from $tablas $xtras";	
                    }else{
                        $cadena="select $regs from $tablas where $filtro_extra $xtras";	
                    }
                }else{
                    if(!$filtro_extra){
			$cadena="select $regs from $tablas where $filtro $xtras";		
                    }else{
                        $cadena="select $regs from $tablas where $filtro and ($filtro_extra) $xtras";		
                    }
                }
			
                
                
                
                
		if(!$inicial){
			$inicial="Indistinto";			
		}	
		
		if(!$sinIndistinto){
			echo "<option value='0'>$inicial</option>";
		}
		
		if($tablas == " tipo_const "){
			$res=mysql_query($cadena) or die("ALGO NO ANDA $cadena".mysql_error());
			echo "<OPTGROUP label='Frecuentes' style='background-color:#FFFFCC'>";
			while ($fila=mysql_fetch_array($res)){
					if($fila[0] == 1 || $fila[0] == 5 || $fila[0] == 6 || $fila[0] == 16){
							echo "<option value='$fila[0]'>$fila[1]</option>";
					}
			}
			echo "</OPTGROUP>";
		}
		$res=mysql_query($cadena) or die("ALGO NO ANDA $cadena".mysql_error());
				

		while ($fila=mysql_fetch_array($res)){
				
			if($fila[2]){
				$aux=" $fila[2]";				
			}
                        
                        $option_desc = utf8_encode($fila[1]);
			
			if($xml==1){
			
				if(!$id_array){
					if($fila[0]==$id){
						if($fila[0] == $usr_id){
							echo "<option value='$fila[0]' selected style='background-color:#FFFFCC'><![CDATA[$option_desc $aux]]></option>";
						} else {
							echo "<option value='$fila[0]' selected ><![CDATA[$option_desc $aux]]></option>";
						}
					}else{
						if($fila[0] == $usr_id){
							echo "<option value='$fila[0]' style='background-color:#FFFFCC'><![CDATA[$option_desc $aux]]></option>";
						} else {
							echo "<option value='$fila[0]'><![CDATA[$option_desc $aux]]></option>";
						}
					}
				}else{
					if(array_key_exists($fila[0],$id_array)){
						echo "<option value='$fila[0]' selected><![CDATA[$option_desc $aux]]></option>";
					}else{
						echo "<option value='$fila[0]'><![CDATA[$option_desc $aux]]></option>";
					}
				}
				
			}else{
				if(!$id_array){
					if($fila[0]==$id){
						if($fila[0] == $usr_id){
							echo "<option value='$fila[0]' selected style='background-color:#FFFFCC'>$option_desc $aux</option>";
						} else {
							echo "<option value='$fila[0]' selected >$option_desc $aux</option>";
						}
					}else{
						if($fila[0] == $usr_id){
							echo "<option value='$fila[0]' style='background-color:#FFFFCC'>$option_desc $aux</option>";
						} else {
							echo "<option value='$fila[0]'>$option_desc $aux</option>";
						}
					}
				}else{
					if(array_key_exists($fila[0],$id_array)){
						echo "<option value='$fila[0]' selected>$option_desc $aux</option>";
					}else{
						echo "<option value='$fila[0]'>$option_desc $aux</option>";
					}
				}
			
			}
		}	

	
?>