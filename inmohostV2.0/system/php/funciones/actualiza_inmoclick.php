<?php

function actualizar_inmoclick($tabla, $params) {

    /* 	if($params['pais_default']!=2){
      require_once(_PROJECT_CONFIGURACION_CLASS);
      }else{
      require_once(_PROJECT_CONFIGURACION_CLASS_CHILE);
      }


      $conn2=mysql_connect("localhost","inmoclick_root","uv0282-*");
      mysql_select_db("inmoclick_database",$conn2);


      $configuration = ProjectConfiguration::getApplicationConfiguration('inmoclick', 'dev', true);

      $databaseManager=new sfDatabaseManager($configuration);
      $databaseManager->initialize($configuration);
     */

    if ($params['usr_id'] != 2128) {

        $conn2 = mysql_connect("localhost", "inmoclick_root", "uv0282-*");
        mysql_select_db("inmoclick_database", $conn2);

        mysql_query("start transaction", $conn2);
        switch ($tabla) {
            case "propiedades":

                $error = false;
                $prp_id = $params['prp_id'];
                $usr_id = $params['usr_id'];
                $tipo = $params['tipo'];
                $array_estados = $params['array_estados'];
                $prp = $params['array_propiedad'];

                if (count($prp)) {


                    if ($tipo != "modificar_estado") {

                        $prp_desc = addcslashes($prp['prp_desc'], "$\\\'\"");
                        $prp_servicios = addcslashes($prp['prp_servicios'], "$\\\'\"");
                        $prp_dom = addcslashes($prp['prp_dom'], "$\\\'\"");
                        $prp_nota = addcslashes($prp['prp_nota'], "$\\\'\"");
                        $prp_bar = addcslashes($prp['prp_bar'], "$\\\'\"");


                        $cadena_inmoclick = "select * from propiedades where usr_id=$usr_id and prp_id=$prp_id";
                        $res_inmoclick = mysql_query("select * from propiedades where usr_id=$usr_id and prp_id=$prp_id", $conn2);
                        if (!mysql_num_rows($res_inmoclick)) { //hay que crearla
                            $value_referente = "";
                            $insert_referente = "";

                            if ($prp['prp_referente']) {
                                $value_referente = 'prp_referente,';
                                $insert_referente = $prp['prp_referente'] . ",";
                            }

                            if ($prp['bar_priv_id'] == '0') {
                                $valor_bar_priv = 'bar_priv_id,';
                                $valor_bar_priv_ins = "NULL,";
                            } else {
                                $valor_bar_priv = 'bar_priv_id,';
                                $valor_bar_priv_ins = "'" . $prp['bar_priv_id'] . "',";
                            }

                            $usuario = mysql_query("select u.plan_usuario_id,u.usr_tipo,ta.tipo_aviso_id from usuarios as u left join planes_usuarios as pu on(u.plan_usuario_id=pu.plan_usuario_id) left join tipos_avisos as ta on(pu.tipo_aviso_id=ta.tipo_aviso_id) where usr_id=".$usr_id, $conn2);
                            
                            $usuario_datos = mysql_fetch_assoc($usuario);
                            
                            if($usuario_datos['tipo_aviso_id'] == null){
                                $plan_usuario_null = mysql_query('select min(ta.tipo_aviso_id) as tipo_aviso_id from usuarios as u inner join tipos_avisos as ta on (u.usr_tipo = ta.tipo_usuario_id) where u.usr_id='.$usr_id, $conn2);
                                $plan_usuario_null_datos = mysql_fetch_assoc($plan_usuario_null);
                                $tipo_aviso_id = $plan_usuario_null_datos['tipo_aviso_id'];
                            }else{
                                $tipo_aviso_id = $usuario_datos['tipo_aviso_id'];
                            }

                            $actualiza_propiedad = "insert into propiedades (tipo_aviso_id,prp_id,
                                                                                                                    prp_dom,
                                                                                                                    prp_bar,
                                                                                                                    loc_id,
                                                                                                                    pro_id,
                                                                                                                    pai_id,
                                                                                                                    ori_id,
                                                                                                                    con_id,
                                                                                                                    fotos,
                                                                                                                    prp_desc,
                                                                                                                    usr_id,
                                                                                                                    tip_id,
                                                                                                                    prp_alta,
                                                                                                                    prp_nota,
                                                                                                                    prp_pre,
                                                                                                                    prp_mostrar,
                                                                                                                    prp_pre_dol,
                                                                                                                    prp_cartel,
                                                                                                                    $value_referente
                                                                                                                    publica,
                                                                                                                    prp_servicios,
                                                                                                                   $valor_bar_priv
                                                                                                                    prp_vip,
                                                                                                                    mos_por_1,
                                                                                                                    mos_por_2,
                                                                                                                    mos_por_3,
                                                                                                                    mos_por_4,
                                                                                                                    prp_anonimo,
                                                                                                                    prp_lat,
                                                                                                                    prp_lng,
                                                                                                                    prp_ocultar_precio,
                                                                                                                    prp_visibilidad,
                                                                                                                    fo360_id
                                                                                                                    ) values ( 
                                                                                                                    ".$tipo_aviso_id.",
                                                                                                                    " . $prp['prp_id'] . ",
                                                                                                                    '$prp_dom',
                                                                                                                    '$prp_bar',
                                                                                                                    '" . $prp['loc_id'] . "',
                                                                                                                    '" . $prp['pro_id'] . "',
                                                                                                                    '" . $prp['pai_id'] . "',
                                                                                                                    '" . $prp['ori_id'] . "',
                                                                                                                    '" . $prp['con_id'] . "',
                                                                                                                    '" . $prp['fotos'] . "',
                                                                                                                    '" . $prp_desc . "',
                                                                                                                    '" . $prp['usr_id'] . "',
                                                                                                                    '" . $prp['tip_id'] . "',
                                                                                                                    now(),
                                                                                                                    '" . $prp_nota . "',
                                                                                                                    '" . $prp['prp_pre'] . "',
                                                                                                                    '" . $prp['prp_mostrar'] . "',
                                                                                                                    '" . $prp['prp_pre_dol'] . "',
                                                                                                                    '" . $prp['prp_cartel'] . "',
                                                                                                                     $insert_referente
                                                                                                                    '" . $prp['publica'] . "',
                                                                                                                    '" . $prp_servicios . "',
                                                                                                                    $valor_bar_priv_ins
                                                                                                                    '" . $prp['prp_vip'] . "',
                                                                                                                    '" . $prp['mos_por_1'] . "',
                                                                                                                    '" . $prp['mos_por_2'] . "',
                                                                                                                    '" . $prp['mos_por_3'] . "',
                                                                                                                    '" . $prp['mos_por_4'] . "',
                                                                                                                    '" . $prp['prp_anonimo'] . "',
                                                                                                                    '" . $prp['prp_lat'] . "',
                                                                                                                    '" . $prp['prp_lng'] . "',
                                                                                                                    '" . $prp['prp_ocultar_precio'] . "',
                                                                                                                    '" . $prp['prp_visibilidad'] . "',
                                                                                                                    '" . $prp['fo360_id'] . "'
                                                                                                                        )";
                        } else {

                            $value_referente = "";
                            if (isset($prp['prp_referente'])) {
                                $value_referente = "prp_referente=" . $prp['prp_referente'] . ",";
                            } else {
                                $value_referente = "prp_referente=NULL,";
                            }

                            if ($prp['bar_priv_id'] == '0') {
                                // echo "entra";
                                $act_bar_priv = "update propiedades set bar_priv_id=NULL where prp_id=" . $prp['prp_id'] . " and usr_id=" . $prp['usr_id'] . "";
                                mysql_query($act_bar_priv, $conn2) or $errors[$ind_error++] = "Error al modificar bar_priv" . mysql_error();
                                $valor_bar_priv = "bar_priv_id = NULL,";
                            } else {
                                $valor_bar_priv = "bar_priv_id = '" . $prp['bar_priv_id'] . "',";
                            }
                            
                            $usuario = mysql_query("select u.plan_usuario_id,u.usr_tipo,ta.tipo_aviso_id from usuarios as u left join planes_usuarios as pu on(u.plan_usuario_id=pu.plan_usuario_id) left join tipos_avisos as ta on(pu.tipo_aviso_id=ta.tipo_aviso_id) where usr_id=".$usr_id, $conn2);
                            
                            $usuario_datos = mysql_fetch_assoc($usuario);
                            
                            if($usuario_datos['tipo_aviso_id'] == null){
                                $plan_usuario_null = mysql_query('select min(ta.tipo_aviso_id) as tipo_aviso_id from usuarios as u inner join tipos_avisos as ta on (u.usr_tipo = ta.tipo_usuario_id) where u.usr_id='.$usr_id, $conn2);
                                $plan_usuario_null_datos = mysql_fetch_assoc($plan_usuario_null);
                                $tipo_aviso_id = $plan_usuario_null_datos['tipo_aviso_id'];
                            }else{
                                $tipo_aviso_id = $usuario_datos['tipo_aviso_id'];
                            }


                            $actualiza_propiedad = "update
                                                                                                    propiedades set
                                                                                                                        tipo_aviso_id = ".$tipo_aviso_id.", 
                                                                                                                        fotos='" . $prp['fotos'] . "',
                                                                                                                        loc_id='" . $prp['loc_id'] . "',
                                                                                                                        pro_id='" . $prp['pro_id'] . "',
                                                                                                                        prp_bar='$prp_bar',
                                                                                                                        prp_dom='$prp_dom',
                                                                                                                        pai_id='" . $prp['pai_id'] . "',
                                                                                                                        con_id='" . $prp['con_id'] . "',
                                                                                                                        tip_id='" . $prp['tip_id'] . "',
                                                                                                                        prp_pre='" . $prp['prp_pre'] . "',
                                                                                                                        prp_desc='" . $prp['prp_desc'] . "',
                                                                                                                        prp_nota='" . $prp['prp_nota'] . "',
                                                                                                                        prp_mod=now(),
                                                                                                                        ori_id='" . $prp['ori_id'] . "',
                                                                                                                        prp_pub='" . $prp['prp_pub'] . "',
                                                                                                                        prp_pre_dol='" . $prp['prp_pre_dol'] . "',
                                                                                                                        prp_llave='" . $prp['prp_llave'] . "',
                                                                                                                        prp_cartel='" . $prp['prp_cartel'] . "',
                                                                                                                        $value_referente
                                                                                                                        prp_tas='" . $prp['prp_tas'] . "',
                                                                                                                        prp_aut='" . $prp['prp_aut'] . "',
                                                                                                                        pre_inmo='" . $prp['precio_inmo'] . "',
                                                                                                                        pre_prop='" . $prp['precio_prop'] . "',
                                                                                                                        pre_trans='" . $prp['precio_trans'] . "',
                                                                                                                        prp_insc_dom='" . $prp['prp_insc_dom'] . "',
                                                                                                                        publica='" . $prp['publica'] . "',
                                                                                                                        prp_servicios='" . $prp['prp_servicios'] . "',
                                                                                                                        prp_mostrar='" . $prp['prp_mostrar'] . "',
                                                                                                                        prp_anonimo='" . $prp['prp_anonimo'] . "',
                                                                                                                        prp_vip='" . $prp['prp_vip'] . "',
                                                                                                                        $valor_bar_priv
                                                                                                                        mos_por_1='" . $prp['mos_por_1'] . "',
                                                                                                                        mos_por_2='" . $prp['mos_por_2'] . "',
                                                                                                                        mos_por_3='" . $prp['mos_por_3'] . "',
                                                                                                                        mos_por_4='" . $prp['mos_por_4'] . "',
                                                                                                                        prp_lat='" . $prp['prp_lat'] . "',
                                                                                                                        prp_lng='" . $prp['prp_lng'] . "',
                                                                                                                        prp_ocultar_precio='" . $prp['prp_ocultar_precio'] . "',
                                                                                                                        prp_visibilidad = '" . $prp['prp_visibilidad'] . "',
                                                                                                                        fo360_id = '" . $prp['fo360_id'] . "'
                                                                                                    where prp_id=" . $prp['prp_id'] . " and usr_id=" . $prp['usr_id'] . ";";
                        }



                        //actualizo propiedad
                        mysql_query($actualiza_propiedad, $conn2) or $error.="no actualiza propiedad" . mysql_error($conn2) . "<br>" . $actualiza_propiedad;

                        //chequeo bar_priv
                        //echo "bar_id".$prp['bar_id'];



                        $elimina_servicios = "delete from ser_x_prp_ihost where usr_id=" . $prp['usr_id'] . " and prp_id=" . $prp['prp_id'] . "";
                        mysql_query($elimina_servicios, $conn2) or $error = "no elimina servicios" . mysql_error($conn2);
                        $elimina_fotos = "delete from fotos where usr_id=" . $prp['usr_id'] . " and prp_id=" . $prp['prp_id'] . "";
                        mysql_query($elimina_fotos, $conn2) or $error = "no elimina fotos" . mysql_error($conn2);


                        $array_servicios = $prp['array_servicios'];
                        $array_fotos = $prp['array_fotos'];
                        //$res_alt=mysql_query("select * from ser_x_prp_ihost where prp_id=".$prp['prp_id']." and usr_id=".$prp['usr_id']."");

                        foreach ($array_servicios as $servicio) {
                            $cadena_servicios = "insert into ser_x_prp_ihost (ser_id,prp_id,usr_id,valor) values ('" . $servicio['ser_id'] . "', '" . $servicio['prp_id'] . "','" . $servicio['usr_id'] . "','" . $servicio['valor'] . "' )";
                            mysql_query($cadena_servicios, $conn2) or $error.="no carga servicios" . mysql_error($conn2);
                        }

                        //inserto en fotos
                        foreach ($array_fotos as $fotos) {
                            $cadena_servicios = "insert into fotos (prp_id,usr_id,fo_nro,fo_enl,fo_desc) values ('" . $fotos['prp_id'] . "', '" . $fotos['usr_id'] . "','" . $fotos['fo_nro'] . "','" . $fotos['fo_enl'] . "' ,'" . $fotos['fo_desc'] . "')";
                            mysql_query($cadena_servicios, $conn2) or $error.="no carga fotos" . mysql_error($conn2);
                        }
                    } else {

                        //

                        for ($i = 0; $i < count($array_estados) - 1; $i++) {
                            $valores = explode(',', $array_estados[$i]);
                            $prp_id = $valores[0];
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

                                $str_upd = "UPDATE propiedades SET prp_mostrar=" . $prp_mostrar . ",prp_mod ='" . date("Y-m-d") . "',prp_visibilidad = " . $prp['prp_visibilidad'] . " WHERE prp_id=" . $prp_id . " AND usr_id=" . $prp['usr_id'] . "";
                                mysql_query($str_upd, $conn2) or $error = "no cambia estados" . mysql_error($conn2) . "<br>" . $str_upd;
                            }
                        }
                    }
                }//fin if mysql_num_rows

                if (!$error) {//PRIMERO ACTUALIZAR DBS
                    mysql_query("COMMIT", $conn2);
                    
                    $cadena = "select * from propiedades where prp_id = ".$prp_id." and usr_id = ".$usr_id;
                    $resultado = mysql_query($cadena);
                    $propiedad = mysql_fetch_array($resultado);
                    mysql_close($conn2);

                    if ($usr_id == 682) {
                        actualizar_db(array("usr_id" => $usr_id, "prp_id" => $prp_id,"host" => "mendozacontacto.com.ar", "db" => "contactosite_db", "usr" => "contactosite_usr", "pass" => "contacto321"));
                    }
                    //PRIMERO ACTUALIZAR DBS



                    if ($usr_id == 773) {
                        actualizar_db(array("usr_id" => $usr_id, "prp_id" => $prp_id, "host" => "stevanato.com.ar", "db" => "stevanato_db", "usr" => "stevanato_usr", "pass" => "stevanato321"));
                    }
                    
                    guardar_estadisticas($propiedad);
                    
                } else {
                    mysql_query("ROLLBACK", $conn2);
                    echo $error;
                }

                break;
            case "bar_priv":

                $usr_id = $params["usr_id"];
                $bar_id = $params["bar_id"];
                $tipo = $params["tipo"];
                $array_bar_priv = $params['array_bar_priv'];
                $error = false;



                if ($tipo == "alta" || $tipo == "modificacion") {

                    $query = "select * from bar_priv where bar_id=$bar_id and usr_id=$usr_id";
                    $res_bar_priv = mysql_query($query, $conn2);

                    if (!mysql_num_rows($res_bar_priv)) {

                        $actualiza_bar_priv = "insert into bar_priv values (  " . $array_bar_priv['bar_priv_id'] . ",
                            " . $array_bar_priv['usr_id'] . ",
                            '" . $array_bar_priv['bar_denom'] . "',
                            '',
                            '',
                            '',
                            '',
                            '',
                            '',
                            '',
                            '" . $array_bar_priv['bar_cont'] . "',
                            '" . $array_bar_priv['bar_tel'] . "',
                            '" . $array_bar_priv['bar_mail'] . "',
                            '" . $array_bar_priv['loc_id'] . "',
                            '" . $array_bar_priv['pro_id'] . "',
                            '" . $array_bar_priv['pai_id'] . "',
                            '" . $array_bar_priv['bar_zona'] . "',
                            '" . $array_bar_priv['bar_dir'] . "',
                            '" . $array_bar_priv['bar_comp_priv'] . "',
                            '" . $array_bar_priv['bar_url'] . "',
                            '" . $array_bar_priv['bar_logo']['name'] . "',
                            '" . $array_bar_priv['bar_desc'] . "',
                            '" . $array_bar_priv['bar_video'] . "',
                            '" . $array_bar_priv['bar_reglamento'] . "',
                            '" . $array_bar_priv['bar_reglamento_archivo'] . "',
                            '" . $array_bar_priv['bar_titulo_publicidad'] . "',
                            '" . $array_bar_priv['bar_lat'] . "',
                            '" . $array_bar_priv['bar_lng'] . "'
                            );";
                    } else {

                        $actualiza_bar_priv = "update bar_priv set 
                            bar_denom='" . $array_bar_priv['bar_denom'] . "',
                            bar_sup_tot='',
                            bar_sup_lot='',
                            bar_cant_lot='',
                            bar_alumbrado_sub='',
                            bar_urbanizado='',
                            bar_seguridad='',
                            bar_serv='',
                            bar_cont='" . $array_bar_priv['bar_cont'] . "',
                            bar_tel='" . $array_bar_priv['bar_tel'] . "',
                            bar_mail='" . $array_bar_priv['bar_mail'] . "',
                            loc_id='" . $array_bar_priv['loc_id'] . "',
                            pro_id='" . $array_bar_priv['pro_id'] . "',
                            pai_id='" . $array_bar_priv['pai_id'] . "',
                            bar_zona='" . $array_bar_priv['bar_zona'] . "',
                            bar_dir='" . $array_bar_priv['bar_dir'] . "',
                            bar_comp_priv='" . $array_bar_priv['bar_comp_priv'] . "',
                            bar_url='" . $array_bar_priv['bar_url'] . "',
                            bar_logo='" . $array_bar_priv['bar_logo']['name'] . "',
                            bar_desc='" . $array_bar_priv['bar_desc'] . "',
                            bar_video='" . $array_bar_priv['bar_video'] . "',
                            bar_reglamento='" . $array_bar_priv['bar_reglamento'] . "',
                            bar_reglamento_archivo='" . $array_bar_priv['bar_reglamento_archivo'] . "',
                            bar_titulo_publicidad='" . $array_bar_priv['bar_titulo_publicidad'] . "',
                            bar_lat = '" . $array_bar_priv['bar_lat'] . "',
                            bar_lng = '" . $array_bar_priv['bar_lng'] . "' 
                        where bar_id=" . $array_bar_priv['bar_priv_id'] . " and usr_id=" . $array_bar_priv['usr_id'] . ";";
                    }
                    //    echo "actualiza";
                    mysql_query($actualiza_bar_priv, $conn2) or $error = "no actualiza bar_priv - " . mysql_errno() . ':' . mysql_error($conn2);
                } elseif ($tipo == "eliminacion") {
                    mysql_query("delete from fotos_x_bar where bar_id=$bar_id and usr_id=$usr_id", $conn2);
                    mysql_query("delete from bar_priv where bar_id=" . $bar_id . "and usr_id=$usr_id", $conn2);
                }

                //     echo $error;
                if (!$error) {
                    mysql_query("COMMIT", $conn2);

                    $query_servicios = 'insert into servicios_x_bar_priv values ';

                    /**
                     * Inicio Servicios
                     */
                    $array_servicios = $array_bar_priv['array_servicios'];

                    foreach ($array_servicios as $servicio) {
                        mysql_query("delete from servicios_x_bar_priv where bar_id = $bar_id and usr_id=$usr_id and servicio_bar_priv_id=" . $servicio['servicio_bar_priv_id'], $conn2);
                        $query_servicios .= '(NULL,' . $servicio['servicio_bar_priv_id'] . ',' . $servicio['bar_id'] . ',' . $servicio['usr_id'] . ',"' . $servicio['valor'] . '"),';
                    }

                    $query_servicios = substr($query_servicios, 0, -1) . ';';

                    mysql_query($query_servicios, $conn2) or $error = "no inserta servicios en bar priv <br>" . mysql_error($conn2) . $query_servicios;
                    /**
                     * Fin Servicios
                     */
                    /**
                     * Inicio Fotos
                     */
                    $array_fotos = $array_bar_priv['array_fotos'];
                    if (count($array_fotos)) {
                        $c = '';
                        foreach ($array_fotos as $fotos) {
                            mysql_query("delete from fotos_x_bar where bar_id = $bar_id and usr_id=$usr_id and fo_id=" . $fotos['fo_id'], $conn2);
                            $cadena_fotos = "insert into fotos_x_bar (fo_det, bar_id,usr_id, fo_id,fo_enl) values ('" . $fotos['fo_desc'] . "'," . $bar_id . "," . $usr_id . "," . $fotos['fo_id'] . ",'" . $fotos['fo_enl'] . "')";
                            mysql_query($cadena_fotos, $conn2) or $error = "noo actualiza fotos_x_bar " . mysql_error($conn2) . $cadena_fotos;
                            $c.=' ' . $cadena_fotos;
                        }
                    }
                    /**
                     * Fin Fotos
                     */
                    if (!$error) {
                        mysql_query("COMMIT", $conn2);
                    } else {
                        echo $actualiza_bar_priv . "<br>" . $c;

                        echo $error;
                        mysql_query("ROLLBACK");
                    }

                    // echo"commit";
                    $resultado = "";
                } else {
                    echo $actualiza_bar_priv . "<br>" . $c;

                    echo $error;
                    mysql_query("ROLLBACK");
                }


                break;
            case "empleados":
                $error = false;
                $usr_id = $params["usr_id"];
                $emp_id = $params["emp_id"];
                $tipo = $params["tipo"];
                $fo_id = $params["fo_id"];
                $array_empleados = $params['array_empleados'];

                $cadena = "select * from empleados where emp_id=$emp_id and usr_id=$usr_id";
                $res1 = mysql_query($cadena, $conn2);

                //				print $cadena."<br>";

                if ($tipo == "alta" || $tipo == "modificacion") {

                    if (!mysql_num_rows($res1)) {

                        $actualizar_empleado = "insert into empleados (emp_id,
													nombre,
													apellido,
													telefono,
													email,
													domicilio,
													usr_login,
													usr_pass,
													priv_id,
													usr_tpo,
													fo_id,
													tel_inmo,
													sexo,
													mostrar,
                                                                                                        usr_id,
													sector
													)
											values (
													" . $array_empleados['emp_id'] . ",
													'" . $array_empleados['nombre'] . "',
													'" . $array_empleados['apellido'] . "',
													'" . $array_empleados['telefono'] . "',
													'" . $array_empleados['email'] . "',
													'" . $array_empleados['domicilio'] . "',
													'" . $array_empleados['usr_login'] . "',
													'" . $array_empleados['usr_pass'] . "',
													'" . $array_empleados['priv_id'] . "',
													'" . $array_empleados['usr_tpo'] . "',
													'" . $array_empleados['fo_id'] . "',
													'" . $array_empleados['tel_inmo'] . "',
													'" . $array_empleados['sexo'] . "',
													'" . $array_empleados['mostrar'] . "',
                                                                                                            $usr_id,
													'" . $array_empleados['sector'] . "'
													);";
                    } else {
                        if ($array_empleados['fo_id'] != -1) {
                            $empleado_fo_id = $fo_id;
                        } else {
                            $empleado_fo_id = -1;
                        }
                        $actualizar_empleado = "update  empleados set
													nombre='" . $array_empleados['nombre'] . "',
													apellido='" . $array_empleados['apellido'] . "',
													telefono='" . $array_empleados['telefono'] . "',
													email='" . $array_empleados['email'] . "',
													domicilio='" . $array_empleados['domicilio'] . "',
													usr_login='" . $array_empleados['usr_login'] . "',
													usr_pass='" . $array_empleados['usr_pass'] . "',
													priv_id='" . $array_empleados['riv_id'] . "',
													usr_tpo='" . $array_empleados['usr_tpo'] . "',
													fo_id='" . $empleado_fo_id . "',
													tel_inmo='" . $array_empleados['tel_inmo'] . "',
													sexo='" . $array_empleados['sexo'] . "',
													mostrar='" . $array_empleados['mostrar'] . "',
													sector='" . $array_empleados['sector'] . "'
                                                                                                   where
                                                                                                        emp_id = $emp_id and usr_id = $usr_id
											;";
                    }

                    mysql_query($actualizar_empleado, $conn2) or $error = "Error al actualizar empleado " . mysql_error() . $actualizar_empleado;
                } else if ($tipo == "eliminacion") {


                    mysql_query("delete from empleados where usr_id=$usr_id and emp_id=" . $emp_id, $conn2) or $error = "Error al eliminar empleado " . mysql_error();
                    /* 	$empleados=EmpleadosPeer::retrieveByPk($emp_id,$usr_id);
                      if($empleados){
                      $empleados->delete();
                      } */
                }

                if (!$error) {

                    mysql_query("COMMIT", $conn2);
                } else {
                    mysql_query("ROLLBACK", $conn2);
                    echo $error;
                }

                break;
            case "usuarios":

                $usr_id = $params["usr_id"];

                $cadena = "select * from usuarios where usr_id=$usr_id";
                $res1 = mysql_query($cadena, $conn2);

                //				print $cadena."<br>";

                if (mysql_num_rows($res1)) {

                    $prp = $params['array_usuario'];
                    $telefonos = $prp['telefonos'];
                    $cadena = "update usuarios set
                                                                                usr_raz = '" . $prp['usr_raz'] . "',
                                                                                titular = '" . $prp['titular'] . "',
                                                                                usr_dom = '" . $prp['usr_dom'] . "',
                                                                                pro_id = '" . $prp['pro_id'] . "',
                                                                                loc_id = '" . $prp['loc_id'] . "',
                                                                                usr_tel = '" . $prp['usr_tel'] . "',
                                                                                usr_mail = '" . $prp['usr_mail'] . "',
                                                                                web = '" . $prp['web'] . "',
                                                                                usr_matricula = '" . $prp['usr_matricula'] . "'
                                                                    where
                                                                            usr_id=$usr_id

                                                            ";
                    mysql_query($cadena, $conn2) or $error = "No se actualizo usuarios" . mysql_error();



                    $cadena = 'delete from telefonos_usuarios where usr_id=' . $usr_id;

                    mysql_query($cadena, $conn2);

                    foreach ($telefonos as $telefono) {
                        $insert = 'insert into telefonos_usuarios values ("",' . $usr_id . ',NULL,"' . $telefono['prefijo'] . '","' . $telefono['telefono'] . '")';
                        mysql_query($insert, $conn2);
                    }
                }

                if (!$error) {
                    mysql_query("COMMIT", $conn2);
                } else {
                    mysql_query("ROLLBACK", $conn2);
                    echo $error;
                }

                break;
            case "prp_referente":

                $usr_id = $params["usr_id"];
                $emp_id = $params["emp_id"];



                $cadena = "update propiedades set prp_referente = 0 where usr_id = $usr_id and prp_referente = $emp_id";
                $res1 = mysql_query($cadena, $conn2) or $error = "no actualiza referentes en inmoclick";

                if (!$error) {
                    mysql_query("COMMIT", $conn2);
                } else {
                    mysql_query("ROLLBACK", $conn2);
                    echo $error;
                }

                break;
        }
    }
}

function actualizar_db($datos = array()) {

    if (count($datos)) {

        $conn = mysql_connect($datos['host'], $datos['usr'], $datos['pass']);
        mysql_select_db($datos['db'], $conn);

        //debo hacer una conexion a la base de datos de inmoclick
        $conn2 = mysql_connect("localhost", "inmoclick_root", "uv0282-*");
        mysql_select_db("inmoclick_database", $conn2);

        mysql_query("BEGIN", $conn);

        //elimino la propiedad de la otra base de datos
        $eliminada = mysql_query("delete from propiedades where usr_id=" . $datos['usr_id'] . " and prp_id=" . $datos['prp_id'], $conn);

        if($eliminada === false) die(mysql_error());

        //tomo propiedades de inmoclick
        $res_propiedades = mysql_query("select * from propiedades where usr_id=" . $datos['usr_id'] . " and prp_id=" . $datos['prp_id'], $conn2) or die(mysql_error());

        mysql_num_rows($res_propiedades);
        $i = 0;
        //guardo propiedades en la otra base de datos

        while ($fila = mysql_fetch_array($res_propiedades)) {

            $cadp = "insert into propiedades ( prp_id, prp_dom, prp_bar, loc_id,pro_id,pai_id,ori_id,con_id, prp_desc,prp_visitas,usr_id,tip_id,prp_mod,prp_nota,prp_pre,prp_pub,prp_mostrar,prp_pre_dol,prp_llave,prp_alta,prp_cartel,prp_referente,prp_tas,prp_aut,pre_inmo,pre_prop,pre_trans,prp_insc_dom,publica,prp_servicios,fotos,mos_por_1,mos_por_2,mos_por_3,mos_por_4,prp_anonimo) values('" . $fila['prp_id'] . "','" . addslashes($fila['prp_dom']) . "','" . addslashes($fila['prp_bar']) . "','" . $fila['loc_id'] . "','" . $fila['pro_id'] . "','" . $fila['pai_id'] . "','" . $fila['ori_id'] . "','" . $fila['con_id'] . "','" . addslashes($fila['prp_desc']) . "','" . $fila['prp_visitas'] . "','" . $fila['usr_id'] . "','" . $fila['tip_id'] . "','" . $fila['prp_mod'] . "','" . addslashes($fila['prp_nota']) . "','" . $fila['prp_pre'] . "','" . addslashes($fila['prp_pub']) . "','" . $fila['prp_mostrar'] . "','" . $fila['prp_pre_dol'] . "','" . $fila['prp_llave'] . "','" . $fila['prp_alta'] . "','" . $fila['prp_cartel'] . "','" . $fila['prp_referente'] . "','" . $fila['prp_tas'] . "','" . $fila['prp_aut'] . "','" . $fila['pre_inmo'] . "','" . $fila['pre_prop'] . "','" . $fila['pre_trans'] . "','" . $fila['prp_insc_dom'] . "','" . $fila['publica'] . "','" . addslashes($fila['prp_servicios']) . "','" . $fila['fotos'] . "','" . $fila['mos_por_1'] . "','" . $fila['mos_por_2'] . "','" . $fila['mos_por_3'] . "','" . $fila['mos_por_4'] . "','" . $fila['prp_anonimo'] . "')";
            $r = mysql_query($cadp, $conn);
            if($r === false) die("sss" . $cadp);
            $i++;
        }

        //echo $i;
        mysql_query("COMMIT", $conn);
    }
    
}

function guardar_estadisticas($propiedad){
     
        $error = null;
        
        $conn2 = mysql_connect("localhost", "inmoclick_root", "uv0282-*");
        mysql_select_db("inmoclick_database", $conn2);
        mysql_query("start transaction", $conn2);
        
        $cad = "select valor from ser_x_prp_ihost where usr_id = ".$propiedad['usr_id']." and prp_id = ".$propiedad['prp_id']." and ser_id = 27";
        $res = mysql_query($cad);
        $precio_pesos_metro = mysql_result($res, 0,0);
        
        $cad = "select valor from ser_x_prp_ihost where usr_id = ".$propiedad['usr_id']." and prp_id = ".$propiedad['prp_id']." and ser_id = 28";
        $res = mysql_query($cad);
        $precio_dolares_metro = mysql_result($res, 0,0);
        
        $cad = "select valor from ser_x_prp_ihost where usr_id = ".$propiedad['usr_id']." and prp_id = ".$propiedad['prp_id']." and ser_id = 25";
        $res = mysql_query($cad);
        $expensas = mysql_result($res, 0,0);
        
        if($propiedad['prp_id']&&$propiedad['usr_id']){
            
           $cad = "select * from historicos_propiedades where propiedad_id = ".$propiedad['id']." order by historico_propiedad_fecha DESC limit 1";
           $res = mysql_query($cad)  or $error = $cad.mysql_error();;
           
           
           if(mysql_num_rows($res)){
               $historico_propiedad = mysql_fetch_array($res);
           }else{
            
               $historico_propiedad = null;
           }
           

           
           $insertar = false;
//           echo ''.!isset($historico_propiedad).' || '.$propiedad['prp_pre'].'!='.$historico_propiedad['prp_pre'].'||'.$propiedad['prp_pre_dol'].'!='.$historico_propiedad['prp_pre_dol'].'||'.$precio_pesos_metro.'!='.$historio_propiedad['historico_propiedad_precio_metro_pesos'].'||'.$precio_dolares_metro.'!='.$historio_propiedad['historico_propiedad_precio_metro_dolares'].'||'.(float)$expensas .'!='.(float)$historico_propiedad['historico_propiedad_expensas'];
           
           if(!isset($historico_propiedad) || $propiedad['prp_pre']!=$historico_propiedad['prp_pre'] || 
                                              $propiedad['prp_pre_dol']!=$historico_propiedad['prp_pre_dol'] || 
                                              (float)$precio_pesos_metro!=(float)$historico_propiedad['historico_propiedad_precio_metro_pesos'] ||   
                                              (float)$precio_dolares_metro !=(float)$historico_propiedad['historico_propiedad_precio_metro_dolares'] ||    
                                              (float)$expensas !=(float)$historico_propiedad['historico_propiedad_expensas']
                     ){
              $insertar = true;
           }
           
           
           if($insertar){
            
                $cadena = "insert into historicos_propiedades values (   ''
                                                                         ,".$propiedad['id'].",
                                                                         ".$propiedad['prp_id'].",
                                                                         ".$propiedad['usr_id'].",
                                                                         '".$propiedad['prp_pre']."',
                                                                         '".$propiedad['prp_pre_dol']."',
                                                                         '".$precio_pesos_metro."',
                                                                         '".$precio_dolares_metro."',
                                                                         '".$expensas."',
                                                                         '".date("Y-m-d h:i:s")."'
                                                                         )";
                mysql_query($cadena) or $error = $cadena.mysql_error();
            
           //     echo "entra2";
                
           }
           
           
        }
        if(isset($error)){
            echo $error;
        }else{
         
            mysql_query('COMMIT');
        }
        mysql_close();
    
}

?>
