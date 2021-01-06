<?php

header("Content-type: application/xml");
	extract ($_GET);
	extract ($_REQUEST);
	include("../php/config.php");	
	echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\" ?>";
	$xml=1;	
	echo "
    <XMLTEXTO>
		<datos> ";
		$sinIndistinto=1;
		if($mod_tip=="add"){
				
				print"
				<paises>";
		 			$regs=" pai_id,pai_desc ";
					$tablas=" pais ";
					if(!$pai_id)
						$pai_id=$PAIS_DEFAULT;
					$filtro=" pai_id=$pai_id";
					$xtras=" order by pai_desc ASC";	 
				include("../"._FILE_SCRIPT_PHP_SELECT);
					$regs="";
	                $tablas="";
	                $id="";
	                $xtras="";
	                
	                echo "<selected>$pai_id</selected>";
	            echo "</paises>
				<provincias>";
		 			$regs=" pro_id,pro_desc ";
					$tablas=" provincias ";
					if(!$pro_id)
						$pro_id=$PROV_DEFAULT;
					
					$xtras=" order by pro_desc ASC";	
					
					
				include("../"._FILE_SCRIPT_PHP_SELECT);
					$regs="";
	                $tablas="";
	                $id="";
	                $xtras="";
	                echo "<selected>$pro_id</selected>";
	               
				
				echo "
				</provincias>
				<localidades>";
				
						$regs=" distinct loc_id,loc_desc ";
						$tablas=" localidades,provincias ";
						$filtro=" localidades.pro_id=$pro_id ";
						$xtras=" order by loc_desc ASC";	
												
					include("../"._FILE_SCRIPT_PHP_SELECT);
						$regs="";
		                $tablas="";
		                $id="";
		                $filtro="";
						$xtras="";			                
		                echo "<selected>$loc_id</selected>";
		               
		
		           echo"
				</localidades>
				<tipoCons>";
			
					$regs=" tip_id,tip_desc ";
					$tablas=" tipo_const ";
					$xtras=" order by tip_desc ASC";	
					
					include("../"._FILE_SCRIPT_PHP_SELECT);
					$regs="";
	                $tablas="";
	                $id="";
	                $xtras="";	
	                echo "<selected>$tip_id</selected>";
	                
	
	        	echo"
				</tipoCons>
				<tipoCond>";
			
					$regs=" con_id,con_desc ";
					$tablas=" condiciones ";
					//$id=$con_id;
					$xtras=" order by con_desc ASC";	
					
				include("../"._FILE_SCRIPT_PHP_SELECT);
					$regs="";
	                $tablas="";
	                $xtras="";
	                //$id="";
	                echo "<selected>$con_id</selected>";


	
	           echo"
			</tipoCond>


			";


                      echo"
			  <cocheras>
                                        <option value='0'>Indistinto </option>
                                        <option value='1'>SI</option>
                                        <option value='2'>NO</option>
                          </cocheras>

                                ";
                         

                     echo "<dem_inmobiliaria><![CDATA[1]]></dem_inmobiliaria>
			<dem_red_inmoclick><![CDATA[0]]></dem_red_inmoclick>";
		}elseif($mod_tip=="edit"){   
	
				$cadena="select * from demandas where dem_id=$dem_id";
				$result=mysql_query($cadena);
				
				$fil=mysql_fetch_array($result);
				print"	
				<paises>";
		 			$regs=" pai_id,pai_desc ";
					$tablas=" pais ";
					if(!$pai_id)
						$pai_id=$PAIS_DEFAULT;
						
					$xtras=" order by pai_desc ASC";		
				include("../"._FILE_SCRIPT_PHP_SELECT);
					$regs="";
	                $tablas="";
	                $id="";
	                $xtras="";
	                echo "<selected>$pai_id</selected>";
	            echo "
	            </paises>
				<provincias>";
			 			$regs=" pro_id,pro_desc ";
						$tablas=" provincias ";
						$pro_id=$fil[pro_id];
						$xtras=" order by pro_desc ASC";	
					include("../"._FILE_SCRIPT_PHP_SELECT);
						$regs="";
		                $tablas="";
		                $id="";
		                $xtras="";
		                echo "<selected>$pro_id</selected>";
					
				echo "
				</provincias>
				<localidades>";
							//RECUPERO LOCALIDADES
						
						$locs=split("x",$fil[loc_id]); //separo las localidades
							
						$regs=" distinct loc_id,loc_desc ";
						$tablas=" localidades,provincias ";
						$filtro=" localidades.pro_id=$pro_id ";
						$xtras=" order by loc_desc ASC";						
					include("../"._FILE_SCRIPT_PHP_SELECT);
						$regs="";
		                $tablas="";
		                $filtro="";
		                $xtras="";
		               	for ($i=0;$i<count($locs);$i++){
		              	  echo "<selected>$locs[$i]</selected>";
		               	} 
		
		           echo"
				</localidades>
				<tipoCons>";
		           
		           
						$tips=split("x",$fil[tip_id]);
				
						$regs=" tip_id,tip_desc ";
						$tablas=" tipo_const ";
						$xtras=" order by tip_desc ASC";
						
					include("../"._FILE_SCRIPT_PHP_SELECT);
						$regs="";
		                $tablas="";
		                $xtras="";
		               	for ($i=0;$i<count($tips);$i++){
		              	  echo "<selected>$tips[$i]</selected>";
		               	}
		
		           echo"
				</tipoCons>
				<tipoCond>";
		           //RECUPERO CONDICIONES
					
					//$id_array=split("x",$fil[con_id]);
						$cons=split("x",$fil[con_id]);
				
						$regs=" con_id,con_desc ";
						$tablas=" condiciones ";
						$xtras=" order by con_desc ASC";
						//$id=$con_id;
					include("../"._FILE_SCRIPT_PHP_SELECT);
						$regs="";
		                $tablas="";
		                $xtras="";
		              	for ($i=0;$i<count($cons);$i++){
		                	echo "<selected>$cons[$i]</selected>";
		              	}
		                $id_array="";
		
		           echo"
				</tipoCond>
                                <cocheras>
                                        <option value='0'>Indistinto </option>
                                        <option value='1'>SI</option>
                                        <option value='2'>NO</option>

                                ";

                                      echo "<selected>".$fil['dem_cochera']."</selected>";

                                echo "
                                </cocheras>


				<dem_dom><![CDATA[".$fil['dem_dom']."]]></dem_dom>
				
				<dem_barr><![CDATA[".$fil['dem_barr']."]]></dem_barr>
				
				<dem_pre_min><![CDATA[".$fil['dem_pre_min']."]]></dem_pre_min>
				
				<dem_pre_max><![CDATA[".$fil['dem_pre_max']."]]></dem_pre_max>

                                <dem_pre_max_dol><![CDATA[".$fil['dem_pre_max_dol']."]]></dem_pre_max_dol>

                                <dem_pre_min_dol><![CDATA[".$fil['dem_pre_min_dol']."]]></dem_pre_min_dol>
				
				<dem_desc><![CDATA[".$fil['dem_desc']."]]></dem_desc>
				
				<dem_raz><![CDATA[".$fil['dem_raz']."]]></dem_raz>
				
				<dem_tel><![CDATA[".$fil['dem_tel']."]]></dem_tel>

				<dem_mail><![CDATA[".$fil['dem_mail']."]]></dem_mail>

				<dem_id><![CDATA[".$fil['dem_id']."]]></dem_id>

                                <dem_habitaciones_min><![CDATA[".$fil['dem_habitaciones_min']."]]></dem_habitaciones_min>

                                <dem_habitaciones_max><![CDATA[".$fil['dem_habitaciones_max']."]]></dem_habitaciones_max>

                                <dem_banos_min><![CDATA[".$fil['dem_banos_min']."]]></dem_banos_min>

                                <dem_banos_max><![CDATA[".$fil['dem_banos_max']."]]></dem_banos_max>

                                <dem_sup_total_min><![CDATA[".$fil['dem_sup_total_min']."]]></dem_sup_total_min>

                                <dem_sup_total_max><![CDATA[".$fil['dem_sup_total_max']."]]></dem_sup_total_max>

                                <dem_sup_cubierta_min><![CDATA[".$fil['dem_sup_total_min']."]]></dem_sup_cubierta_min>

                                <dem_sup_cubierta_max><![CDATA[".$fil['dem_sup_total_max']."]]></dem_sup_cubierta_max>

                               
";


                                if($fil['dem_inmobiliaria']){
                                    echo " <dem_inmobiliaria><![CDATA[1]]></dem_inmobiliaria>";
                                }else{
                                    echo " <dem_inmobiliaria><![CDATA[0]]></dem_inmobiliaria>";
                                }

                                if($fil['dem_red_inmoclick']){
                                    echo "<dem_red_inmoclick><![CDATA[1]]></dem_red_inmoclick>";
                                }else{
                                    echo "<dem_red_inmoclick><![CDATA[0]]></dem_red_inmoclick>";
                                }


                                
					
			
			}	
		
		print"   
		</datos>
	</XMLTEXTO>	
";
		
?>