<?php

extract($_GET);
extract($_POST);
extract($_FILES);

$ind_error = 0;
$ind_exito = 0;
$errors = array();
$msg_exitos = array();
$MAX_TAM_FOT = 150000;
define("_CARPETA_FOTOS", dirname(__FILE__) . '/../../../fotos/');
mysql_query("start transaction");
define("TEMPFOLDER", "/home/gabriel/");

include(dirname(__FILE__).'/../configFileUpload.php');


switch ($mod_tip) {
    case "add":
        //  echo "entra";


        $filtro_verif = "
						prp_dom like '$prp_dom' and
						con_id=$con_id and
						tip_id=$tip_id and
						pro_id=$pro_id and
						loc_id=$loc_id and
						propiedades.usr_id=$usr_id and
                                                propiedades.prp_mostrar!=4";
        if ($prp_pre != "") {
            $filtro_verif .= " and prp_pre=$prp_pre";
        }
        if ($prp_pre_dol != "") {
            $filtro_verif .= " and prp_pre_dol=$prp_pre_dol";
        }
        $verif = mysql_query("select * from propiedades where $filtro_verif") or die("error" . mysql_error());

        if (mysql_num_rows($verif)) {
            $errors[$ind_error++] = _MENS_PRP_EXISTE;

            while ($ids = mysql_fetch_array($verif)) {
                $error_ids[] = $ids['prp_id'];
            }
        } else {
            $max_id = mysql_query("select max(prp_id) from propiedades where usr_id=$usr_id"); //obtiene maximo de propiedades para agregar en tabla
            if (@mysql_num_rows($max_id)) {
                $max_id = mysql_result($max_id, 0, 0) + 1;
            } else {
                $max_id = 1;
            }
            //Formatea la cadena para ser insertada en la base de datos sin que los caracteres "\" � "'" la da�en.
            $prp_desc = addslashes($prp_desc);
            $prp_dom = addslashes($prp_dom);
            $prp_bar = addslashes($prp_bar);
            $prp_nota = addslashes($prp_nota);
            $prp_pub = addslashes($prp_pub);
            $prp_pub = strip_tags($prp_pub);
            $prp_servicios = addslashes($prp_servicios);
            if ($publica == "on")
                $publica = 1;
            else
                $publica = 0;

            if ($prop_nombre || $prop_apellido) {
                $max_prop = mysql_query("select max(prop_id) from propietarios");
                $max_prop = mysql_result($max_prop, 0, 0) + 1;
                $propietarios = "insert
								into
							    	propietarios
								values ( '$max_prop',
										'$prop_nombre',
										'$prop_apellido',
										'$prop_tel',
										'$prop_dom',
										'$prop_mail',
										'$prop_nota')";
                mysql_query($propietarios) or $errors[$ind_error++] = _MENS_INS_PRP_ERROR_PROP . mysql_error();
            } else {
                $max_prop = NULL;
            }

            ($mos_por_1 == 'on') ? $mos_por_1 = 1 : $mos_por_1 = 0;
            ($mos_por_2 == 'on') ? $mos_por_2 = 1 : $mos_por_2 = 0;
            ($mos_por_3 == 'on') ? $mos_por_3 = 1 : $mos_por_3 = 0;
            ($mos_por_4 == 'on') ? $mos_por_4 = 1 : $mos_por_4 = 0;



            $fo360_id = apta_procrear($tip_id,$con_id,$prp_pre,$valor3,$valor11,$valor13,$valor0);

            $nota = $prp_nota;
            $desc = $prp_desc;


            $insertar = "insert into propiedades (prp_id,
												prp_dom,
												prp_bar,
												loc_id,
												pro_id,
												pai_id,
												ori_id,
												con_id,
												prp_desc,
												prp_visitas,
												usr_id,
												tip_id,
												fo1_id,
												fo2_id,
												fo3_id,
												fo4_id,
												fo360_id,
												prp_nota,
												prp_pre,
												prp_pub,
												prp_mostrar,
												prp_pre_dol,
												prp_llave,
												prp_alta,
												prp_cartel,
												prp_referente,
												prp_tas,
												prp_aut,
												fo5_id,
												fo6_id,
												pre_inmo,
												pre_prop,
												pre_trans,
												prp_insc_dom,
												publica,
												prp_servicios,
												fotos,
												mos_por_1,
												mos_por_2,
												mos_por_3,
												mos_por_4,
												prp_anonimo,
												prop_id,
												prp_vip,
												bar_priv_id,
												prp_lat,
												prp_lng,
                                                                                                prp_ocultar_precio,
                                                                                                prp_visibilidad

												)
											values (
												$max_id,
												'$prp_dom',
												'$prp_bar',
												$loc_id,
												$pro_id,
												$pai_id,
												'$ori_id',
												$con_id,
												'$desc',
												1,
												$usr_id,
												$tip_id,
												$max_id,
												$max_id,
												$max_id,
												$max_id,
												$fo360_id,
												'$nota',
												'$prp_pre',
												'$prp_pub',
												1,
												'$prp_pre_dol',
												'$prp_llave',
												now(),
												'$prp_cartel',
												'$emp_id',
												'$prp_tas',
												'$prp_aut',
												'$max_id',
												'$max_id',
												'$precio_inmo',
												'$precio_prop',
												'$precio_trans',
												'$prp_insc_dom',
												$publica,
												'$prp_servicios',
												'$cant_fotos',
												'$mos_por_1',
												'$mos_por_2',
												'$mos_por_3',
												'$mos_por_4',
												'$prp_anonimo',
												'$max_prop',
												'$bar_id',
												'$prp_vip',
												'$lat',
												'$lng',
                                                                                                '$prp_ocultar_precio',
                                                                                                '$prp_visibilidad');";


            $msg_exitos[$ind_exito++] = "El inmueble se ingreso con exito en con el identificador $max_id";
            mysql_query($insertar) or $errors[$ind_error++] = _MENS_INS_PRP_ERROR . mysql_error() . $insertar;
            $cambio_fotos = "";
            $x = 1;
            $j = 0;


            if ($bar_id == '0') {
                $act_bar_priv = "update propiedades set bar_priv_id=NULL where prp_id=$max_id and usr_id=$usr_id";
                mysql_query($act_bar_priv) or $errors[$ind_error++] = "Error al modificar bar_priv" . mysql_error();
            }

            /* FOTOS */
            $j = 0;
            $conn_id = ftp_connect(_HOST_FTP);
            $login = ftp_login($conn_id, _USUARIO_FTP, _PASSWORD_FTP);
            if (isset($array_fotos) && count($array_fotos)) {
                foreach ($array_fotos as $key => $foto) {

                    $nom_foto = $foto . ".jpg";
                    if (ftp_size($conn_id, '/fotos/' . $nom_foto) != -1 && ftp_size($conn_id, '/fotos/' . $nom_foto) > 0) {
                        $j++;
                        $result = ftp_rename($conn_id, '/fotos/' . $nom_foto, '/fotos/' . $max_id . "-" . $usr_id . "-" . $orden[$key] . ".gif");
                        $array_fotos_final[] = array("prp_id" => $max_id, 'usr_id' => $usr_id, 'fo_enl' => $max_id . "-" . $usr_id . "-" . $orden[$key] . ".gif", 'fo_nro' => $orden[$key], 'fo_desc' => addslashes(isset($array_descripcion[$key]) ? $array_descripcion[$key] : ""));
                        $cadena = "insert into fotos values('" . $max_id . "-" . $usr_id . "-" . $orden[$key] . ".gif" . "'," . $max_id . ",$usr_id," . $orden[$key] . ",'" . addslashes(isset($array_descripcion[$key]) ? $array_descripcion[$key] : "") . "')";
                        mysql_query($cadena) or $errors[$ind_error++] = _MENS_INS_PRP_ERROR_FOTO . "<br>" . $cadena . "<br>" . mysql_error();
                        //  echo "result.".$result;
                    }

//                    /* BORRAR LUEGO DE TESTEAR */
//                    $j++;
//                    $array_fotos_final[] = array("prp_id" => $max_id, 'usr_id' => $usr_id, 'fo_enl' => $max_id . "-" . $usr_id . "-" . $j . ".gif", 'fo_nro' => $j, 'fo_desc' => addslashes(isset($array_descripcion[$key]) ? $array_descripcion[$key] : ""));
//                    $cadena = "insert into fotos values('" . $max_id . "-" . $usr_id . "-" . $j . ".gif" . "'," . $max_id . ",$usr_id," . $j . ",'" . addslashes(isset($array_descripcion[$key]) ? $array_descripcion[$key] : "") . "')";
//                    mysql_query($cadena) or $errors[$ind_error++] = _MENS_INS_PRP_ERROR_FOTO . "<br>" . $cadena . "<br>" . mysql_error();
//
//                    /*                     * *********************** */
                }
            }
            ftp_close($conn_id);


            /* FIN FOTOS */

            $cant_fotos = $j;
            mysql_query("update propiedades set fotos=$cant_fotos where usr_id=$usr_id and prp_id=$max_id") or $errors[$ind_error++] = _MENS_UPD_PRP_ERROR_PRP_PROP . "<br>" . mysql_error();
            if (!$prp_cartel) {
                $prp_cartel = 0;
            }

            $detalles = mysql_query("select loc_desc,pro_desc,con_desc from localidades,provincias,condiciones where localidades.loc_id=$loc_id and provincias.pro_id=$pro_id and condiciones.con_id=$con_id");
            $detalles = mysql_fetch_row($detalles);


            //print "$ins";
            //
            //
            //**************************************** nuevos servicios ***********************************

            $cadena = "select max(ser_id) from servicios_ihost";

            $max = mysql_result(mysql_query($cadena), 0,0);


            for($i = 1;$i <= $max; $i++){
                $valor = "valor".$i;
                if(isset($$valor)){
                    $insertar = "insert into ser_x_prp_ihost values($max_id," . $i . ",'".addslashes($$valor)."',$usr_id)";
                    $array_servicios[] = array('prp_id' => $max_id, 'usr_id' => $usr_id, 'ser_id' => $i, 'valor' => addslashes($$valor));
                    mysql_query($insertar) or $errors[$ind_error++] = _MENS_INS_SERVICIOS . "<br>" . mysql_error();
                }
            }

//            print_r($array_servicios);
//
//            die();
////
//
//            $cons_tip = mysql_query("select
//									servicios_ihost.*
//								from
//									ser_tipo_const,
//									servicios_ihost
//								where
//									servicios_ihost.ser_id=ser_tipo_const.ser_id and
//									ser_tipo_const.tip_id=$tip_id and
//									servicios_ihost.ser_id!=6 and
//									servicios_ihost.ser_id!=5
//								ORDER BY
//									servicios_ihost.ser_desc");
//            $array_servicios = array();
//            if (mysql_num_rows($cons_tip)) {
//                //print "<input type=hidden name=num_ser value=".mysql_num_rows($cons_tip).">";
//                $i = 0;
//                while ($fila = mysql_fetch_array($cons_tip)) {
//                    if ($fila[ser_tip_dat] == "t" || $fila[ser_tip_dat] == "ss") {
//                        $valor = "valor" . $i;
//                        $insertar = "insert into ser_x_prp_ihost values($max_id," . $fila[ser_id] . ",'" . addslashes($$valor) . "',$usr_id)";
//                        $array_servicios[] = array('prp_id' => $max_id, 'usr_id' => $usr_id, 'ser_id' => $fila['ser_id'], 'valor' => addslashes($$valor));
//                        $cadena_altas_online.=$insertar . ";";
//                    } else if ($fila[ser_tip_dat] == "s") {
//                        $desde = "valor" . $i;
//                        $insertar = "insert into ser_x_prp_ihost values($max_id," . $fila[ser_id] . ",'" . addslashes($$desde) . "',$usr_id)";
//                        $array_servicios[] = array('prp_id' => $max_id, 'usr_id' => $usr_id, 'ser_id' => $fila['ser_id'], 'valor' => addslashes($$desde));
//                        $cadena_altas_online.=$insertar . ";";
//                    } else {
//                        $valor = "valor" . $i;
//                        $insertar = "insert into ser_x_prp_ihost values($max_id," . $fila[ser_id] . ",'" . addslashes($$valor) . "',$usr_id)";
//                        $array_servicios[] = array('prp_id' => $max_id, 'usr_id' => $usr_id, 'ser_id' => $fila['ser_id'], 'valor' => addslashes($$valor));
//                        $cadena_altas_online.=$insertar . ";";
//                    }
//                    //print"<input type=hidden name=ser_id$i value=$fila[ser_id]>";
//                    mysql_query($insertar) or $errors[$ind_error++] = _MENS_INS_SERVICIOS . "<br>" . mysql_error();
//                    $i++;
//                }//while
//            }//if

            if ($emp_id == 0) {
                $prp_referente = null;
            }

            $array_propiedad = array(
                'prp_id' => $max_id,
                'prp_dom' => $prp_dom,
                'prp_bar' => $prp_bar,
                'loc_id' => $loc_id,
                'pro_id' => $pro_id,
                'pai_id' => $pai_id,
                'ori_id' => $ori_id,
                'con_id' => $con_id,
                'prp_desc' => $desc,
                'prp_visitas' => 1,
                'usr_id' => $usr_id,
                'tip_id' => $tip_id,
                'prp_alta' => date("Y-m-d"),
                'prp_nota' => $nota,
                'prp_pre' => $prp_pre,
                'prp_pub' => $prp_pub,
                'prp_mostrar' => 1,
                'prp_pre_dol' => $prp_pre_dol,
                'prp_mod' => date("Y-m-d"),
                'prp_cartel' => $prp_cartel,
                'prp_referente' => $prp_referente,
                'publica' => $publica,
                'prp_servicios' => $prp_servicios,
                'bar_priv_id' => $bar_id,
                'fotos' => $cant_fotos,
                'mos_por_1' => $mos_por_1,
                'mos_por_2' => $mos_por_2,
                'mos_por_3' => $mos_por_3,
                'mos_por_4' => $mos_por_4,
                'prp_anonimo' => $prp_anonimo,
                'prp_vip' => $prp_vip,
                'prp_lat' => $lat,
                'prp_lng' => $lng,
                'prp_visibilidad' => $prp_visibilidad,
                'prp_ocultar_precio' => $prp_ocultar_precio,
                'array_servicios' => $array_servicios,
                'array_fotos' => $array_fotos_final,
                'fo360_id' => $fo360_id
            );
        }

        if (!$errors) {
            mysql_query("commit");
            actualizar_inmoclick("propiedades", array("array_propiedad" => $array_propiedad, "prp_id" => $max_id, "usr_id" => $usr_id, "tipo" => $alta, "pais_default" => $PAIS_DEFAULT));
            buscar_coincidencia(0, $max_id);

            $resultado = hay_que_confirmar($array_propiedad);
            if ($resultado['confirmar']) {

                enviar_aprobacion($resultado, $max_id, $usr_id);
                // echo $resultado['mensaje'];
            }

            if ($duplicar == "1") {
                $msg_exitos = false;
                $edited = false;
                $prp_id = $max_id;
            }

//						mysql_query("rollback");
        } else {




//                        if($confirmar_propiedad){
//
//                        }

            mysql_query("rollback");
        }




        break;
    /*     * *********************************************************************************************************************
     * **********************************************   FIN ALTA DE PROPIEDAD  ***********************************************
     * ********************************************************************************************************************* */

    /*     * *********************************************************************************************************************
     * ***********************************   BAJA DE PROPIEDAD (MODIFICACION de ESTADO) **************************************
     * ********************************************************************************************************************* */
    case "del":
        $arr_estados = split(':', $estados);

        for ($i = 0; $i < count($arr_estados) - 1; $i++) {
            $borrar = 0;
            $prp_mostrar = 0;
            $valores = explode(',', $arr_estados[$i]);
            $prp_id = $valores[0];
            // Si cambio de valor hago los cambios
            if ($valores[1] != $valores[2]) {


                switch ($valores[1]) {
                    case 'prp_mos':
                        $prp_mostrar = 1;
                        $cad_msg = "mostrar";
                        break;
                    case 'prp_vend':
                        $prp_mostrar = 2;
                        $cad_msg = "vendida/alquilada";
                        break;
                    case 'prp_susp':
                        $prp_mostrar = 3;
                        $cad_msg = "suspendida";
                        break;
                    case 'prp_elim':
                        $prp_mostrar = 4;
                        $cad_msg = "eliminada";
                        break;
                }
                if (!$borrar && $prp_mostrar) {

                    $prp_visibilidad = calcular_puntaje_inmueble($prp_id, $usr_id);
                    $str_upd = "UPDATE propiedades SET prp_mostrar=$prp_mostrar,prp_mod='" . date("Y-m-d h:i:s") . "',prp_visibilidad = " . $prp_visibilidad . " WHERE prp_id=$prp_id AND usr_id=$usr_id";

                    mysql_query($str_upd) or $errors[$ind_error++] = "NO SE PUDO Actualizar el estado de la propiedad con ID: $prp_id";

                    $cons1 = "select
								 *
							from
								propiedades
							where
								prp_id=$prp_id
								and usr_id=$usr_id";
                    $cons1 = mysql_query($cons1) or $errors[$ind_error++] = "NO se pudieron obtener los datos de la propiedad con ID:$prp_id para CAMBIAR SU ESTADO";
                    $cons1 = mysql_fetch_array($cons1);
                    //mysql_query($eli) or $errors[$ind_error++]="NO se pudieron crear los cambios de la propiedad con ID:$prp_id para modificarla";
                    $msg_exitos[$ind_exito++] = "El estado de la Propiedad con ID: $prp_id ha sido modificado a " . $cad_msg;
                }
                /* 	else if ($borrar && $prp_mostrar!=1)
                  {
                  echo "entra2";

                  $cons1="select
                 *
                  from
                  propiedades
                  where
                  prp_id=$prp_id
                  and usr_id=$usr_id";
                  $cons1=mysql_query($cons1)or $errors[$ind_error++]="NO se pudieron obtener los datos de la propiedad con ID:$prp_id para ELIMINARLA";
                  $cons1=mysql_fetch_row($cons1);
                  $max=mysql_query("select max(cambio_id) from cambios");
                  $max=mysql_result($max,0,0)+1;

                  mysql_query($eli) or $errors[$ind_error++]="NO se pudieron crear los cambios de la propiedad con ID:$prp_id";
                  $del_serv="DELETE FROM ser_x_prp_ihost WHERE prp_id=$prp_id AND usr_id=$usr_id";
                  mysql_query($del_serv) or $errors[$ind_error++]="NO se pudieron borrar los servicios de la propiedad con ID:$prp_id";
                  $del_prop="DELETE FROM propietarios WHERE prop_id=" . $cons1[45];
                  mysql_query($del_prop) or $errors[$ind_error++]="NO se pudo borrar el propietario de la propiedad con ID:$prp_id";
                  $del_pub="DELETE FROM publicaciones WHERE prp_id=$prp_id";
                  mysql_query($del_pub) or $errors[$ind_error++]="NO se pudieron borrar las publicaciones de la propiedad con ID:$prp_id";
                  // Borrado de FOTOS
                  mysql_query("delete from foto1 where fo1_id=$prp_id and (fo1_usr=$usr_id or fo1_usr=0)");
                  mysql_query("delete from foto2 where fo2_id=$prp_id and (fo2_usr=$usr_id or fo2_usr=0)");
                  mysql_query("delete from foto3 where fo3_id=$prp_id and (fo3_usr=$usr_id or fo3_usr=0)");
                  mysql_query("delete from foto4 where fo4_id=$prp_id and (fo4_usr=$usr_id or fo4_usr=0)");
                  mysql_query("delete from foto5 where fo5_id=$prp_id and (fo5_usr=$usr_id or fo5_usr=0)");
                  mysql_query("delete from foto6 where fo6_id=$prp_id and (fo6_usr=$usr_id or fo6_usr=0)");
                  mysql_query("delete from fotos where prp_id=$prp_id and usr_id=$usr_id");

                  $del_citas="DELETE FROM citas WHERE prp_id=$prp_id";
                  mysql_query($del_citas) or $errors[$ind_error++]="NO se pudieron borrar las citas de la propiedad con ID:$prp_id";
                  $del_prp="DELETE FROM propiedades WHERE prp_id=$prp_id AND usr_id=$usr_id";
                  mysql_query($del_prp) or $errors[$ind_error++]="NO se pudo borrar la propiedad con ID:$prp_id";
                  $msg_exitos[$ind_exito++]="La Propiedad con ID: $prp_id ha sido eliminada";
                  } */ else {
                    //   echo "entra3";
                    $errors[$ind_error++] = "Ocurrio un error al actualizar el estado de la propiedad con ID: " . $valores[0];
                }
            }
            $borrar = 0;
            $prp_mostrar = 0;
        }
        if (!$msg_exitos && count($errors)) {
            $msg_exitos[$ind_exito++] = "No se modifico el estado de ninguna propiedad";
        }


        if (!count($errors)) {

            mysql_query("commit");


            actualizar_inmoclick("propiedades", array("array_propiedad" => array("prp_mod" => date('Y-m-d'), "usr_id" => $usr_id, "prp_visibilidad" => $prp_visibilidad), "array_estados" => $arr_estados, "tipo" => "modificar_estado", "prp_id" => $prp_id, "usr_id" => $usr_id, "pais_default" => $PAIS_DEFAULT));
        } else {


            mysql_query("rollback");
        }

        break;
    /*     * *********************************************************************************************************************
     * **********************************************   FIN BAJA DE PROPIEDAD  ***********************************************
     * ********************************************************************************************************************* */

    /*     * *********************************************************************************************************************
     * *******************************************   MODIFICACION DE PROPIEDAD  **********************************************
     * ********************************************************************************************************************* */
    case "edit":


        $seg_prop = mysql_query("select * from propiedades where usr_id=$usr_id and prp_id=$prp_id") or $errors[$ind_error++] = "No se pudieron obtener datos de la Propiedad";
        if (!mysql_num_rows($seg_prop)) {
            $errors[$ind_error++] = "No es su propiedad";
        }

        $seg_prop_result = mysql_fetch_array($seg_prop);

        $cadena_prop_vieja = $seg_prop_result['prp_dom'] . '--' . $seg_prop_result['prp_bar'] . '--' . $seg_prop_result['prp_pre'] . '--' . $seg_prop_result['prp_desc'] . '--' . $seg_prop_result['fotos'];

        if ((int)$prop_id > 0) {

            $act_prop = "
				update
					propietarios
				set
					prop_nombre='$prop_nombre',
					prop_apellido='$prop_apellido',
					prop_tel='$prop_tel',
					prop_dom='$prop_dom',
					prop_mail='$prop_mail',
					prop_nota='$prop_nota'
				where
					propietarios.prop_id=$prop_id

			";

            mysql_query($act_prop) or $errors[$ind_error++] = "Error al modificar Propietarios";
        } else if ($prop_apellido || $prop_nombre) {
            $max_prop = mysql_query("select max(prop_id) from propietarios");
            $prop_id = mysql_result($max_prop, 0, 0) + 1;
            $propietarios = "insert
				into
					propietarios
				values ($prop_id,
					'$prop_nombre',
					'$prop_apellido',
					'$prop_tel',
					'$prop_dom',
					'$prop_mail',
					'$prop_nota')";

            mysql_query($propietarios) or $errors[$ind_error++] = "No se pudieron ingresar los datos del Propietario";
        }



        /* FOTOS */
         $conn_id = ftp_connect(_HOST_FTP);
            
        if ($conn_id) {
           $login = ftp_login($conn_id, _USUARIO_FTP, _PASSWORD_FTP);
            if ($login) {


                if (isset($array_fotos) && count($array_fotos)) {
                    mysql_query("delete from fotos where prp_id=$prp_id and usr_id=$usr_id");
                    $j = 0;

                      
                    //    array_multisort($orden,SORT_ASC,$array_fotos,SORT_ASC,$array_descripcion,SORT_ASC);
//                    print_r($orden);
//                    echo "<p>";
//                    print_r($array_fotos);
//                    echo "<p>";
//                    print_r($array_descripcion);
//
//                    die();

                    $cambiado = array();
                    foreach ($array_fotos as $key => $foto) {


                        if (strstr($foto, ".gif")) {
                            $j++;
                            $nom_foto = $foto;
                            //echo $j;
                          //  echo ftp_size($conn,'/fotos/' . $prp_id . "-" . $usr_id . "-" . $orden[$key] . ".gif");
////
//                            die();

                            $res = ftp_size($conn_id, '/fotos/' . $prp_id . "-" . $usr_id . "-" . $orden[$key] . ".gif");


                            // var_dump($res);
                            if ($res != -1 && !in_array($j, $cambiado)) {
                                $nombre_aux = '/fotos/' . $prp_id . "-" . $usr_id . "-aux.gif";
                                $cambiado[] = $orden[$key];
                                ftp_rename($conn_id, '/fotos/' . $prp_id . "-" . $usr_id . "-" . $orden[$key] . ".gif", $nombre_aux);
                                ftp_rename($conn_id, '/fotos/' . $nom_foto, '/fotos/' . $prp_id . "-" . $usr_id . "-" . $orden[$key] . ".gif");
                                ftp_rename($conn_id, $nombre_aux, '/fotos/' . $nom_foto);
                                // die();
                            } elseif (!in_array($j, $cambiado)) {

                                ftp_rename($conn_id, '/fotos/' . $nom_foto, '/fotos/' . $prp_id . "-" . $usr_id . "-" . $orden[$key] . ".gif");
                            }


                            $cadena = "insert into fotos values('" . $prp_id . "-" . $usr_id . "-" . $orden[$key] . ".gif" . "'," . $prp_id . ",$usr_id," . $orden[$key] . ",'" . addslashes(isset($array_descripcion[$key]) ? $array_descripcion[$key] : "") . "')";
                            mysql_query($cadena) or $errors[$ind_error++] = _MENS_INS_PRP_ERROR_FOTO . "<br>" . $cadena . "<br>" . mysql_error();
                            $array_fotos_final[] = array("prp_id" => $prp_id, 'usr_id' => $usr_id, 'fo_enl' => $prp_id . "-" . $usr_id . "-" . $orden[$key] . ".gif", 'fo_nro' => $orden[$key], 'fo_desc' => addslashes(isset($array_descripcion[$key]) ? $array_descripcion[$key] : ""));
                        } elseif ($foto != "eliminada") {

                            $nom_foto = $foto . ".jpg";
                            if (ftp_size($conn_id, '/fotos/' . $nom_foto) != -1 && ftp_size($conn_id, '/fotos/' . $nom_foto) > 0) {
                                $j++;
                                if ('/fotos/' . $nom_foto != '/fotos/' . $prp_id . "-" . $usr_id . "-" . $orden[$key] . ".gif") {
//                                    echo '**/fotos/' . $nom_foto. ',/fotos/' . $prp_id . "-" . $usr_id . "-" . $orden[$key] . ".gif";
                                    ftp_rename($conn_id, '/fotos/' . $nom_foto, '/fotos/' . $prp_id . "-" . $usr_id . "-" . $orden[$key] . ".gif");
                                    //                                    rename(_CARPETA_FOTOS.$nom_foto, _CARPETA_FOTOS.$prp_id."-".$usr_id."-".$j.".gif");
                                }
                                $array_fotos_final[] = array("prp_id" => $prp_id, 'usr_id' => $usr_id, 'fo_enl' => $prp_id . "-" . $usr_id . "-" . $orden[$key] . ".gif", 'fo_nro' => $orden[$key], 'fo_desc' => addslashes(isset($array_descripcion[$key]) ? $array_descripcion[$key] : ""));
                                $cadena = "insert into fotos values('" . $prp_id . "-" . $usr_id . "-" . $orden[$key] . ".gif" . "'," . $prp_id . ",$usr_id," . $orden[$key] . ",'" . addslashes(isset($array_descripcion[$key]) ? $array_descripcion[$key] : "") . "')";
                                mysql_query($cadena) or $errors[$ind_error++] = _MENS_INS_PRP_ERROR_FOTO . "<br>" . $cadena . "<br>" . mysql_error();
                            }
                        }
                    }
                }
                ftp_close($conn_id);
            } else {
                //mail('gabriel@puntosero.com', 'no hizo login:', "propiedad:$prp_id - $usr_id",$headers);
            }
        } else {
            //mail('gabriel@puntosero.com', 'no se conecto:', "propiedad:$prp_id - $usr_id",$headers);
        }



//**************************************** nuevos servicios ***********************************


        $cadena = "delete from ser_x_prp_ihost where prp_id=$prp_id and usr_id=$usr_id";
        mysql_query($cadena) or $errors[$ind_error++] = "No se pudieron borrar servicios";

        $cadena = "select max(ser_id) from servicios_ihost";

            $max = mysql_result(mysql_query($cadena), 0,0);


            for($i = 1;$i <= $max; $i++){
                $valor = "valor".$i;
                if(isset($$valor)){
                    $insertar = "insert into ser_x_prp_ihost values($prp_id," . $i . ",'".addslashes($$valor)."',$usr_id)";
                    $array_servicios[] = array('prp_id' => $max_id, 'usr_id' => $usr_id, 'ser_id' => $i, 'valor' => addslashes($$valor));
                    mysql_query($insertar) or $errors[$ind_error++] = _MENS_INS_SERVICIOS . "<br>" . mysql_error();
                }
            }



//
//        $cons_tip = mysql_query("select
//									servicios_ihost.*
//								from
//									ser_tipo_const,
//									servicios_ihost
//								where
//									servicios_ihost.ser_id=ser_tipo_const.ser_id and
//									ser_tipo_const.tip_id=1 and
//									servicios_ihost.ser_id!=6 and
//									servicios_ihost.ser_id!=5
//								ORDER BY
//									servicios_ihost.ser_desc");
//
//
//        if (mysql_num_rows($cons_tip)) {
//            //print "<input type=hidden name=num_ser value=".mysql_num_rows($cons_tip).">";
//            $i = 0;
//            while ($fila = mysql_fetch_array($cons_tip)) {
//                if ($fila[ser_tip_dat] == "t" || $fila[ser_tip_dat] == "ss") {
//                    $valor = "valor" . $i;
//                    $insertar = "insert into ser_x_prp_ihost values($prp_id," . $fila[ser_id] . ",'" . addslashes($$valor) . "',$usr_id)";
//                    $array_servicios[] = array('prp_id' => $prp_id, 'usr_id' => $usr_id, 'ser_id' => $fila['ser_id'], 'valor' => addslashes($$valor));
//                } else if ($fila[ser_tip_dat] == "s") {
//                    $desde = "valor" . $i;
//                    $insertar = "insert into ser_x_prp_ihost values($prp_id," . $fila[ser_id] . ",'" . addslashes($$desde) . "',$usr_id)";
//                } else {
//                    $valor = "valor" . $i;
//                    $insertar = "insert into ser_x_prp_ihost values($prp_id," . $fila[ser_id] . ",'" . addslashes($$valor) . "',$usr_id)";
//                }
//                mysql_query($insertar) or $errors[$ind_error++] = "No se pudieron cargar los Servicios<br>$insertar";
//                $cadena_modif_online.=$insertar . ";";
//                $i++;
//            }//while
//        }//if
        //************************************ fin nuevos servicios ***********************************
        $num_fotos = mysql_query("select count(fo_nro) from fotos where prp_id=$prp_id and usr_id=$usr_id");
        $num_fotos = mysql_result($num_fotos, 0, 0);
        if ($publica == "on")
            $publica = 1;
        else
            $publica = 0;





        $prp_desc = addslashes($prp_desc);
        $prp_dom = addslashes($prp_dom);
        $prp_bar = addslashes($prp_bar);
        $prp_nota = addslashes($prp_nota);
        $prp_pub = addslashes($prp_pub);
        $prp_servicios = addslashes($prp_servicios);

//        $referer = $_SERVER['HTTP_REFERER'];
//         if ($prop_id == 0 || $prop_id === 0 || $prop_id == '0') {
//             echo "prop_id: $prop_id. Prop_apellido: $prop_apellido \r\n propiedad:$prp_id - $usr_id: referer: $referer ";
//             //mail('gabriel@puntosero.com', 'propietario en cero', "prop_id: $prop_id. Prop_apellido: $prop_apellido \r\n propiedad:$prp_id - $usr_id: referer: $referer ");
//        }
        $fo360_id = apta_procrear($tip_id,$con_id,$prp_pre,$valor3,$valor11,$valor13,$valor0);
        $act_prp = "update propiedades set fotos=$num_fotos,loc_id=$loc_id,pro_id=$pro_id,prp_bar='$prp_bar',prp_dom='$prp_dom',pai_id='$pai_id',con_id='$con_id',tip_id='$tip_id',prp_pre='$prp_pre',prp_desc='$prp_desc',prp_nota='$prp_nota',prp_mod=now(),ori_id=$ori_id,prp_pub='$prp_pub',prp_pre_dol='$prp_pre_dol',prp_llave='$prp_llave',prp_cartel='$prp_cartel',prp_referente='$emp_id',prp_tas='$prp_tas',prp_aut='$prp_aut',pre_inmo='$precio_inmo',pre_prop='$precio_prop',pre_trans='$precio_trans',prp_insc_dom='$prp_insc_dom',publica=$publica,prp_servicios='$prp_servicios',prp_mostrar=$prp_mostrar,prp_anonimo='$prp_anonimo',prop_id='$prop_id',prp_vip='$prp_vip',bar_priv_id='$bar_id',prp_lat='$lat',prp_lng='$lng',prp_ocultar_precio='$prp_ocultar_precio',prp_visibilidad='$prp_visibilidad',fo360_id='$fo360_id' where prp_id=$prp_id and (usr_id=$usr_id or usr_id=0);";
        mysql_query($act_prp) or $errors[$ind_error++] = "Error al modificar Propiedades" . mysql_error();

        if ($bar_id == '0') {
            $act_bar_priv = "update propiedades set bar_priv_id=NULL where prp_id=$prp_id and usr_id=$usr_id";
            mysql_query($act_bar_priv) or $errors[$ind_error++] = "Error al modificar bar_priv" . mysql_error();
        }


        //ahora hago la verificaci�n
        //si la suma de propiedades actuales supera el m�ximo y el numero m�ximo no es cero(ilimitados)
        if ($mos_por_1 == "on") {
            $mos_por_1 = 1;
        } else {
            $mos_por_1 = 0;
            $msg_exitos[$ind_exito++] = "El inmueble <b>NO</b> se publica en <b>Portales Inmobiliarios</b><br>";
        }
        if ($mos_por_2 == "on") {
            $mos_por_2 = 1;
        } else {
            $mos_por_2 = 0;
            $msg_exitos[$ind_exito++] = "El inmueble <b>NO</b> se publica en <b>CIM</b><br>";
        }
        if ($mos_por_3 == "on") {
            $mos_por_3 = 1;
        } else {
            $mos_por_3 = 0;
            $msg_exitos[$ind_exito++] = "El inmueble <b>NO</b> se publica en <b>CCPIM</b><br>";
        }

        $mos_por_4 = 0;




        $cadena = "update propiedades set mos_por_1='$mos_por_1',mos_por_2='$mos_por_2',mos_por_3='$mos_por_3',mos_por_4='$mos_por_4' where usr_id=$usr_id and prp_id=$prp_id";
        mysql_query($cadena);

        $msg_exitos[$ind_exito++] = "La propiedad ha sido modificada";


        if (!$errors) {

            mysql_query("commit");


            if ($emp_id == 0 || $emp_id == '') {
                $prp_referente = null;
            } else {
                $prp_referente = $emp_id;
            }

            $array_fotos = array();
            $cad_foto = "select * from fotos where usr_id=$usr_id and prp_id=$prp_id";
            $res_foto = mysql_query($cad_foto);
            while ($a_foto = mysql_fetch_array($res_foto)) {
                $array_fotos[] = array('prp_id' => $a_foto['prp_id'], 'usr_id' => $a_foto['usr_id'], 'fo_enl' => $a_foto['fo_enl'], 'fo_nro' => $a_foto['fo_nro'], 'fo_desc' => $a_foto['fo_desc']);
            }

            $array_servicios = array();
            $cad_ser = "select * from ser_x_prp_ihost where usr_id=$usr_id and prp_id=$prp_id";
            $res_ser = mysql_query($cad_ser);
            while ($a_ser = mysql_fetch_array($res_ser)) {
                $array_servicios[] = array('prp_id' => $a_ser['prp_id'], 'usr_id' => $a_ser['usr_id'], 'ser_id' => $a_ser['ser_id'], 'valor' => $a_ser['valor']);
            }

            $array_propiedad = array(
                'prp_id' => $prp_id,
                'prp_dom' => $prp_dom,
                'prp_bar' => $prp_bar,
                'loc_id' => $loc_id,
                'pro_id' => $pro_id,
                'pai_id' => $pai_id,
                'ori_id' => $ori_id,
                'con_id' => $con_id,
                'prp_desc' => $prp_desc,
                'usr_id' => $usr_id,
                'tip_id' => $tip_id,
                'prp_nota' => $prp_nota,
                'prp_pre' => $prp_pre,
                'prp_pub' => $prp_pub,
                'prp_mostrar' => $prp_mostrar,
                'prp_pre_dol' => $prp_pre_dol,
                'prp_mod' => date("Y-m-d"),
                'prp_cartel' => $prp_cartel,
                'prp_referente' => $prp_referente,
                'publica' => $publica,
                'prp_servicios' => $prp_servicios,
                'bar_priv_id' => $bar_id,
                'fotos' => $num_fotos,
                'mos_por_1' => $mos_por_1,
                'mos_por_2' => $mos_por_2,
                'mos_por_3' => $mos_por_1,
                'mos_por_4' => $mos_por_4,
                'prp_anonimo' => $prp_anonimo,
                'prp_vip' => $prp_vip,
                'prp_lat' => $lat,
                'prp_lng' => $lng,
                'prp_visibilidad' => $prp_visibilidad,
                'prp_ocultar_precio' => $prp_ocultar_precio,
                'fo360_id' => $fo360_id,
                'array_servicios' => $array_servicios,
                'array_fotos' => $array_fotos_final
            );


            $cadena_prop_nueva = $prp_dom . '--' . $prp_bar . '--' . $prp_pre . '--' . $prp_desc . '--' . $j;

            $headers = 'From: gabriel@inmoclick.com.ar' . "\r\n" .
                    'Reply-To: gabriel@inmoclick.com.ar' . "\r\n";

            //echo $cadena_prop_nueva."<br>".$cadena_prop_vieja;
            /*  if($usr_id==2040){

              // mail('gabriel@puntosero.com', 'se acaba modificar una propiedad', "usuario: $usr_id, propiedad: $prp_id \r\n propiedad vieja: $cadena_prop_vieja \r\n propiedad nueva: $cadena_prop_nueva",$headers);
              } */
            borrar_cache($usr_id, $prp_id);
            actualizar_inmoclick("propiedades", array("array_propiedad" => $array_propiedad, "prp_id" => $prp_id, "usr_id" => $usr_id, "tipo" => $alta, "pais_default" => $PAIS_DEFAULT));



            $resultado = hay_que_confirmar($array_propiedad);
            if ($resultado['confirmar']) {
                enviar_aprobacion($resultado, $prp_id, $usr_id);
            }

//            buscar_coincidencia(0, $prp_id);



            if ($duplicar == "1") {
                $msg_exitos = false;
                $edited = false;
            }
        } else {
            
            mysql_query("rollback");
        }


        break;
    /*     * *********************************************************************************************************************
     * *****************************************   FIN MODIFICACION DE PROPIEDAD  ********************************************
     * ********************************************************************************************************************* */
}

function traer_imagen($imagen, $mime) {

    switch ($mime) {
        case IMAGETYPE_JPEG:
            return @imagecreatefromjpeg($imagen);
            break;
        case IMAGETYPE_PNG:
            return @imagecreatefrompng($imagen);
            break;
        case IMAGETYPE_GIF:
            return @imagecreatefromgif($imagen);
            break;
        default:
            return false;
            break;
    }
}

function es_fotografia_valida($imageFile, $granularity = 20) {

    $resultado = array();

    $granularity = max(1, abs((int) $granularity));
    $colors = array();

    $size = @getimagesize($imageFile);
    if ($size === false) {
        user_error("Unable to get image size data");
        $resultado['mensaje'] = "error en tamaño de imagen:" . $imageFile;
        $resultado['ok'] = false;
    }

    $img = traer_imagen($imageFile, $size[2]);

    if (!$img) {
        user_error("Unable to open image file");
        $resultado['mensaje'] = "error para abrir imagen:" . $imageFile;
        $resultado['ok'] = false;
    }
    $cuenta = 0;
    $contenedor = "";
    for ($x = 0; $x < $size[0]; $x += $granularity) {
        for ($y = 0; $y < $size[1]; $y += $granularity) {
            $thisColor = imagecolorat($img, $x, $y);
            $rgb = imagecolorsforindex($img, $thisColor);

            $hash = md5($rgb['red'] . "" . $rgb['green'] . "" . $rgb['blue'] . "" . $rgb['alpha']);

            if (!strstr($contenedor, $hash)) {
                $contenedor.= $hash . ",";
                $cuenta++;
            }
        }
    }
    //  arsort($colors);

    if ($size[0] > 450) {
        $max = 400;
    } else {
        $max = 200;
    }

    if ($cuenta > $max) {
        $resultado['mensaje'] = "";
        $resultado['ok'] = true;
    } else {
        $resultado['mensaje'] = "La cuenta es menor de $max: " . $imageFile;
        $resultado['ok'] = false;
    }

    return $resultado;
}

function hay_que_confirmar($propiedad) {

    $resultado = array();
    $resultado['confirmar'] = false;

    if ($propiedad['prp_mostrar'] == 1 && $propiedad['mos_por_1'] == 1) {

        $body = "<table>  ";

        foreach ($propiedad['array_fotos'] as $fotos) {
            $res = es_fotografia_valida(_FOTOS_INMOCLICK . $fotos['fo_enl']);

            if (!$res['ok']) {
                if(!fotos_aprobadas($propiedad['usr_id'], $propiedad['prp_id'], $fotos['fo_enl'])){
                    $resultado['confirmar'] = true;
                    $body .="<tr><td>La fotografia: " . $fotos['fo_enl'] . " puede no ser valida. MENSAJE: " . $res['mensaje'] . "</td></tr> <tr> <td><img src='http://www.inmoclick.com.ar/ftp_inmohost/fotos/" . $fotos['fo_enl'] . "'  width='640px' height='480px'><br /><i>Hash: ".md5_file("http://www.inmoclick.com.ar/ftp_inmohost/fotos/" . $fotos['fo_enl'])."</i></td> </tr>";
                }
            }
        }
        
        if (count($propiedad['array_fotos']) == 1) {
            if(!fotos_aprobadas($propiedad['usr_id'], $propiedad['prp_id'], $fotos['fo_enl'])){
                $resultado['confirmar'] = true;
                $body .="<tr><td>Ha cargado una sola foto</td></tr> <tr> <td><img src='http://www.inmoclick.com.ar/ftp_inmohost/fotos/" . $propiedad['prp_id'] . "-" . $propiedad['usr_id'] . "-1.gif' width='640px' height='480px'><br /><i>Hash :".md5_file("http://www.inmoclick.com.ar/ftp_inmohost/fotos/" . $propiedad['prp_id'] . "-" . $propiedad['usr_id'] . "-1.gif")."</i> </td> </tr>";
            }
        }

        if($propiedad['usr_id'] == 4619){
            $resultado['confirmar'] = true;
            $body .="<tr><td>Probando ... NO ME BORREN EL USUARIO CARAS DE VERGA !! D: by Nico</td></tr>";
        }

        if (preg_match("/\d{5}/", $propiedad['prp_desc']) > 0) {
            $resultado['confirmar'] = true;

            $body .= "<tr><td>Tiene un Numero de telefono </td></tr><tr><td> " . $propiedad['prp_desc'] . " </td></tr>";
        }

        $body .= "</table>";

        $resultado['mensaje'] = $body;
    }
    
    return $resultado;
}

function enviar_aprobacion($resultado, $prp_id, $usr_id) {

    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $headers .= 'From: inmohost@inmoclick.com.ar' . "\r\n" .
            'Reply-To: gabriel@inmoclick.com.ar' . "\r\n";

    $cadena = $resultado['mensaje'] . ' <BR/>

    Para editar el inmueble: <br/>
    <table width="100%"><tr>  <td colspan="3"> Acciones:</td>  </tr>
        <tr>
            <td>
                <table style="width: 100%;">
                    <tr>
                        <td><a href="http://www.inmoclick.com.ar/web/es/usuarios/confirmaPropiedad/resultado/si/prp_id/' . $prp_id . '/usr_id/' . $usr_id . '.html"><b>Confirmar</b></a></td>
                        <td><a href="http://www.inmoclick.com.ar/web/es/usuarios/confirmaPropiedad/resultado/no/prp_id/' . $prp_id . '/usr_id/' . $usr_id . '.html"><b>No Confirmar</b></a></td>
                        <td><a href="http://www.inmoclick.com.ar/web/es/usuarios/confirmaPropiedad/editar/1/prp_id/' . $prp_id . '/usr_id/' . $usr_id . '/edit_key/' . md5('key_7086') . '.html"><b>EDITAR</b></a></td>
                    </tr>
                </table>
            </td>
         </tr>
    </table>';
    
    //echo $cadena;
    if (strstr($_SERVER['HTTP_HOST'], 'www.inmohost.com.ar')) {
        mail('propiedades@inmoclick.com.ar', 'aprobar propiedad', $cadena, $headers);
    }
}

function borrar_cache($usr_id, $prp_id) {
        
    
//        $ch = curl_init(_URL_FOTOS_INMOCLICK.'/eliminar_cache.php?ur_id='.$usr_id.'&prp_id='.$prp_id);
//        curl_exec($ch);
        
        
    $conn_id = ftp_connect(_HOST_CACHE_FTP);
    if ($conn_id) {

        $login = ftp_login($conn_id, _USUARIO_CACHE_FTP, _PASSWORD_CACHE_FTP);
       
        if ($login) {
            ftp_exec('conn_id', 'prompt off');
            $cadena = "select * from fotos where usr_id=$usr_id and prp_id=$prp_id";
            $result = mysql_query($cadena);
            
            $comando = "mdelete ";
            
            while ($foto = mysql_fetch_array($result)) {

                $ratio = '640:480';
                $tamaños = calcularTamaño(204, 153, $foto['fo_enl'], $ratio);

                $cadena = md5($tamaños['width'] . 'x' . $tamaños['height'] . 'x' . 90 . 'x' . $ratio . '-/' . $foto['fo_enl']);
                //ftp_delete($conn_id, $cadena);
                $comando.= $cadena.' ';


                $tamaños = calcularTamaño(198, 148, $foto['fo_enl'], $ratio);
                $cadena = md5($tamaños['width'] . 'x' . $tamaños['height'] . 'x' . 90 . 'x' . $ratio . '-/' . $foto['fo_enl']);
                $comando.= $cadena.' ';
                
                ftp_delete($conn_id, $cadena);

                $tamaños = calcularTamaño(150, 150, $foto['fo_enl'], $ratio);
                $cadena = md5($tamaños['width'] . 'x' . $tamaños['height'] . 'x' . 90 . 'x' . $ratio . '-/' . $foto['fo_enl']);
                $comando.= $cadena.' ';
                
                ftp_delete($conn_id, $cadena);


                $tamaños = calcularTamaño(640, 480, $foto['fo_enl'], $ratio);
                $cadena = md5($tamaños['width'] . 'x' . $tamaños['height'] . 'x' . 90 . 'x' . $ratio . '-/' . $foto['fo_enl']);
                $comando.= $cadena.' ';
                ftp_delete($conn_id, $cadena);



                $tamaños = calcularTamaño(181, 135, $foto['fo_enl'], $ratio);
                $cadena = md5($tamaños['width'] . 'x' . $tamaños['height'] . 'x' . 90 . 'x' . $ratio . '-/' . $foto['fo_enl']);
                $comando.= $cadena.' ';
                ftp_delete($conn_id, $cadena);

                $tamaños = calcularTamaño(95, 82, $foto['fo_enl'], $ratio);
                $cadena = md5($tamaños['width'] . 'x' . $tamaños['height'] . 'x' . 90 . 'x' . $ratio . '-/' . $foto['fo_enl']);
                $comando.= $cadena.' ';
                ftp_delete($conn_id, $cadena);

                $tamaños = calcularTamaño(304, 228, $foto['fo_enl'], $ratio);
                $cadena = md5($tamaños['width'] . 'x' . $tamaños['height'] . 'x' . 90 . 'x' . $ratio . '-/' . $foto['fo_enl']);
                $comando.= $cadena.' ';
                ftp_delete($conn_id, $cadena);
                
                $tamaños = calcularTamaño(100, 100, $foto['fo_enl'], $ratio);
                $cadena = md5($tamaños['width'] . 'x' . $tamaños['height'] . 'x' . 90 . 'x' . $ratio . '-/' . $foto['fo_enl']);
                $comando.= $cadena.' ';
                ftp_delete($conn_id, $cadena);

                $tamaños = calcularTamaño(200, 150, $foto['fo_enl']);
                $cadena = md5($tamaños['width'] . 'x' . $tamaños['height'] . 'x' . 90 .  '-/' . $foto['fo_enl']);
                $comando.= $cadena.' ';
                ftp_delete($conn_id, $cadena);


                $tamaños = calcularTamaño(150, 150, $foto['fo_enl']);
                $cadena = md5($tamaños['width'] . 'x' . $tamaños['height'] . 'x' . 90 .  '-/' . $foto['fo_enl']);
                $comando.= $cadena.' ';
                ftp_delete($conn_id, $cadena);

                $tamaños = calcularTamaño(120, 91, $foto['fo_enl']);
                $cadena = md5($tamaños['width'] . 'x' . $tamaños['height'] . 'x' . 90 .  '-/' . $foto['fo_enl']);
                $comando.= $cadena.' ';
                ftp_delete($conn_id, $cadena);

                $tamaños = calcularTamaño(460, 346, $foto['fo_enl']);
                $cadena = md5($tamaños['width'] . 'x' . $tamaños['height'] . 'x' . 90 .  '-/' . $foto['fo_enl']);
                $comando.= $cadena.' ';
                ftp_delete($conn_id, $cadena);

                $tamaños = calcularTamaño(150, 113, $foto['fo_enl']);
                $cadena = md5($tamaños['width'] . 'x' . $tamaños['height'] . 'x' . 90 .  '-/' . $foto['fo_enl']);
                $comando.= $cadena.' ';
                ftp_delete($conn_id, $cadena);

                $tamaños = calcularTamaño(130, 97, $foto['fo_enl']);
                $cadena = md5($tamaños['width'] . 'x' . $tamaños['height'] . 'x' . 90 .  '-/' . $foto['fo_enl']);
                $comando.= $cadena.' ';
                
                
                $tamaños = calcularTamaño(80, 80, $foto['fo_enl']);
            
                $cadena = md5($tamaños['width'] . 'x' . $tamaños['height'] . 'x' . 90 . '-/' . $foto['fo_enl']);
                $comando.= $cadena.' ';
                ftp_delete($conn_id, $cadena);
                
                
                $tamaños = calcularTamaño(640, 480, $foto['fo_enl']);
                $cadena = md5($tamaños['width'] . 'x' . $tamaños['height'] . 'x' . 90 . '-/' . $foto['fo_enl']);
                $comando.= $cadena.' ';
                ftp_delete($conn_id, $cadena);


                $resultado = "OK";
            }
            
             ftp_exec($conn_id, $comando);
           // echo $comando;
        }
    }
}

function calcularTamaño($maxWidth, $maxHeight, $foEnl, $cropRatio = null) {


    $ch = curl_init(_URL_FOTOS_INMOCLICK.'/image_size.php?image='. $foEnl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $size = json_decode(curl_exec($ch),true);
    curl_close($ch);

    $width = $size[0];
    $height = $size[1];

    // Ratio cropping
    $offsetX = 0;
    $offsetY = 0;

    if ($cropRatio) {
        $cropRatio = explode(':', (string) $cropRatio);
        if (count($cropRatio) == 2) {
            $ratioComputed = $width / $height;
            $cropRatioComputed = (float) $cropRatio[0] / (float) $cropRatio[1];

            if ($ratioComputed < $cropRatioComputed) { // Image is too tall so we will crop the top and bottom
                $origHeight = $height;
                $height = $width / $cropRatioComputed;
                $offsetY = ($origHeight - $height) / 2;
            } else if ($ratioComputed > $cropRatioComputed) { // Image is too wide so we will crop off the left and right sides
                $origWidth = $width;
                $width = $height * $cropRatioComputed;
                $offsetX = ($origWidth - $width) / 2;
            }
        }
    }
    // Setting up the ratios needed for resizing. We will compare these below to determine how to
    // resize the image (based on height or based on width)
    $xRatio = $maxWidth / $width;
    $yRatio = $maxHeight / $height;

    if ($xRatio * $height < $maxHeight) { // Resize the image based on width
        $tnHeight = ceil($xRatio * $height);
        $tnWidth = $maxWidth;
    } else { // Resize the image based on height
        $tnWidth = ceil($yRatio * $width);
        $tnHeight = $maxHeight;
    }


    return array("width" => $tnWidth, "height" => $tnHeight);
}

function apta_procrear($tip_id , $con_id , $prp_pre , $antiguedad, $gas, $luz, $agua){


    $resultado = 0;

    if($con_id == 1){
        //vivienda a estrenar
        if($tip_id == 1 || $tip_id == 4 || $tip_id == 5 || $tip_id == 21){
            if($antiguedad == "A Estrenar" && $prp_pre <= 850000 && $prp_pre >=10000){
                $resultado = 1;
            }
        }else if($tip_id == 6 || $tip_id == 24){
            if($gas == "Si" && $luz == "Si" && $agua == "Si" &&  $prp_pre <= 150000 && $prp_pre >=15000){
                $resultado = 1;
            }
        }

    }

    return $resultado;

}

function fotos_aprobadas($usr_id, $prp_id, $fotos){
    $aprobadas = true;

    $query_fotos_aprobadas = "select * from fotos_aprobadas where usr_id=$usr_id and prp_id=$prp_id";

    $conn2=mysql_connect("localhost","inmoclick_root","uv0282-*");
    mysql_select_db("inmoclick_database",$conn2);

    $fotos_aprobadas = mysql_query($query_fotos_aprobadas, $conn2);

    while($foto_aprobada = mysql_fetch_assoc($fotos_aprobadas)){ //Si no hay fotos aprobadas, requiere aprobacion.
        foreach($fotos as $foto){
            if(md5(file_get_contents("http://www.inmoclick.com.ar/ftp_inmohost/fotos/".$foto['fo_enl'])) == $foto_aprobada['hash']){ //Verificar si es la misma foto
                if($foto_aprobada['ok'] == 1){ $aprobadas = true; }else{ $aprobadas = false; break; } //Si encontramos una no aprobada, entonces enviar mail para confirmar.
            }else{
                $aprobadas = false; //La foto es nueva, requiere aprobacion.
                break;
            }
        }
    }
    
    return $aprobadas;
}

?>
