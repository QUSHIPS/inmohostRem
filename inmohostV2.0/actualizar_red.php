<?php
	/*	extract($_GET);

		if($usr_id){

			include("system/php/config.php");

			mysql_query("BEGIN",$db);

			//borro usuarios
			mysql_query("DELETE FROM usuarios where usr_id!=$usr_id",$db) or $error="No borra usuarios. ".mysql_error();

			//borro propiedades de la red
			mysql_query("delete from ser_x_prp_ihost where usr_id!=$usr_id",$db) or $error="no borra servicios".mysql_error();
			mysql_query("delete from fotos where usr_id!=$usr_id",$db) or $error="no borra fotos".mysql_error();
			mysql_query("delete from propiedades where usr_id!=$usr_id",$db) or $error="no borra propiedades".mysql_error();


			//conecto a inmoclick
			if($PAIS_DEFAULT!=2){
				$conn_inmoclick=mysql_connect("localhost","inmoclick_root","uv0282-*");
				mysql_select_db("inmoclick_database",$conn_inmoclick);
			}else{
				$conn_inmoclick=mysql_connect("localhost","chileprop_usr","chileprop321");
				mysql_select_db("chileprop_db",$conn_inmoclick);
			}

			mysql_query("BEGIN",$db);
			mysql_set_charset('latin1',$db);
			mysql_set_charset('latin1',$conn_inmoclick);

			//leo datos de usuarios de inmoclick
			$res=mysql_query("
								select
										distinct
										usuarios.*
								from
										usuarios,
										propiedades
								where
										propiedades.usr_id=usuarios.usr_id and
										propiedades.prp_mostrar=1 and
										propiedades.mos_por_1=1 and
										usuarios.visible=1 and
										usuarios.web!='' and
										usuarios.usr_id!=$usr_id

					",$conn_inmoclick) or $error="no lee usuarios inmoclick".mysql_error();
			//guardo los datos en usuarios inmohost
			while ($fila=mysql_fetch_array($res)){

				$cad="insert into
								usuarios
									(usr_id,usr_raz,usr_usr,usr_pass,usr_dom,usr_tel,usr_mail,usr_tipo,usr_acc,loc_id,pro_id,pai_id,fecha_act,visible,usr_cim,usr_ccpim,web,titular)
								values

									(".$fila['usr_id'].",'".addslashes($fila['usr_raz'])."','".$fila['usr_usr']."','".$fila['usr_pass']."','".addslashes($fila['usr_dom'])."','".$fila['usr_tel']."','".$fila['usr_mail']."','".$fila['usr_tipo']."','".$fila['usr_acc']."','".$fila['loc_id']."','".$fila['pro_id']."',".$fila['pai_id'].",'".$fila['fecha_act']."',".$fila['visible'].",'".$fila['usr_cim']."','".$fila['usr_ccpim']."','".$fila['web']."','".addslashes($fila['titular'])."')";

				mysql_query($cad,$db) or $error="no inserta usuarios a inmohost".$cad;

				//por cada usuario leo sus propiedades desde inmoclick
				$res_props=mysql_query("select
													*
											from
													propiedades
											where
													propiedades.prp_mostrar=1 and
													propiedades.mos_por_1=1 and
													propiedades.usr_id=".$fila['usr_id'],$conn_inmoclick) or $error="no lee propiedades de inmoclick".mysql_error();

				while ($prp=mysql_fetch_array($res_props)){
					//por cada propiedad guardo en inmohost
					$cad="INSERT INTO propiedades
												(prp_id,prp_dom,prp_bar,loc_id,pro_id,pai_id,ori_id,con_id,prp_desc,prp_visitas,usr_id,tip_id,fo1_id,fo2_id,fo3_id,fo4_id,fo360_id,prp_mod,prp_nota,prp_pre,prp_pub,prp_mostrar,prp_pre_dol,prp_llave,prp_alta,prp_cartel,prp_referente,prp_tas,prp_aut,fo5_id,fo6_id,pre_inmo,pre_prop,pre_trans,prp_insc_dom,publica,prp_servicios) VALUES
												(
														".$prp['prp_id'].",
														'".addslashes($prp['prp_dom'])."',
														'".addslashes($prp['prp_bar'])."',
														".$prp['loc_id'].",
														".$prp['pro_id'].",
														".$prp['pai_id'].",
														'".$prp['ori_id']."',
														".$prp['con_id'].",
														'".addslashes($prp['prp_desc'])."',
														'".$prp['prp_visitas']."',
														".$prp['usr_id'].",
														".$prp['tip_id'].",
														'".$prp['fo1_id']."',
														'".$prp['fo2_id']."',
														'".$prp['fo3_id']."',
														'".$prp['fo4_id']."',
														'".$prp['fo360_id']."',
														'".DATE('Y-m-d')."',
														'".addslashes($prp['nota'])."',
														'".$prp['prp_pre']."',
														'".addslashes($prp['prp_pub'])."',
														".$prp['prp_mostrar'].",
														'".$prp['prp_pre_dol']."',
														0,
														'".$prp['prp_alta']."',
														0,
														0,
														0,
														0,
														'".$prp[29]."',
														'".$prp[30]."',
														0,
														0,
														0,
														'".$prp[34]."',
														'".$prp[35]."',
														'".addslashes($prp['prp_servicios'])."'
														 )";
					mysql_query($cad
								,$db) or $error="No inserta propiedades".$cad;




					//leo servicios de inmoclick
					$res_serv=mysql_query("select * from ser_x_prp_ihost where usr_id=$prp[usr_id] and prp_id=$prp[prp_id]",$conn_inmoclick) or $error="no lee servicios".mysql_error();

					//borro ser_x_prp_ihost en inmohost
					mysql_query("DELETE FROM ser_x_prp_ihost where usr_id=$prp[usr_id] and prp_id=$prp[prp_id]",$db) or $error="no borra servicios".mysql_error();
					while($fila_ser=mysql_fetch_array($res_serv)){
						//guardo servicios en inmohost
						mysql_query("INSERT INTO ser_x_prp_ihost values($fila_ser[prp_id],$fila_ser[ser_id],'".addslashes($fila_ser['valor'])."',$fila_ser[usr_id])",$db) or $error="no inserta servicios".mysql_error();
					}
				}


			}

			if(!$error){
				mysql_query("COMMIT",$db);
				mysql_query("COMMIT",$conn_inmoclick);
				mysql_close($db);
				mysql_close($conn_inmoclick);
			}else{
				mysql_query("ROLLBACK",$db);
				mysql_query("ROLLBACK",$conn_inmoclick);

				echo $error;
				mysql_close($db);
				mysql_close($conn_inmoclick);
				exit;
			}

		}*/
?>