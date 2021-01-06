<?php

header("Content-type: application/xml");
extract($_GET);
extract($_REQUEST);
include("../php/config.php");
echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\" ?>";
$xml = 1;
echo "<bar_priv> ";

if($mod_tip == "edit"){
    $cadena = "SELECT bar_priv . * , pro_desc, loc_desc, tipo_bar_priv_detalle
                            FROM bar_priv
                                    LEFT JOIN provincias ON bar_priv.pro_id = provincias.pro_id
                                    LEFT JOIN localidades ON bar_priv.loc_id = localidades.loc_id
                                    LEFT JOIN tipos_bar_priv ON bar_priv.bar_comp_priv = tipos_bar_priv.tipo_bar_priv_id 
                            where bar_id = $bar_id";
    
    $result = mysql_query($cadena);

    while($fila_bar = mysql_fetch_array($result)){
        $pro_id = $fila_bar[pro_id];
        $loc_id = $fila_bar[loc_id];
        $titulo_bar_priv = $fila_bar[bar_titulo_publicidad];

        echo "<provincias>";
        
        $regs = " pro_id,pro_desc ";
        $tablas = " provincias ";
        $filtro = " pai_id=$PAIS_DEFAULT";
        if(!$pro_id)
            $pro_id = $PROV_DEFAULT;

        $xtras = " order by pro_desc ASC";
        include("../" . _FILE_SCRIPT_PHP_SELECT);
        $regs = "";
        $tablas = "";
        $id = "";
        $xtras = "";
        echo "<selected>$pro_id</selected>";

        echo "
				</provincias>
				<localidades>";

        $regs = " distinct loc_id,loc_desc ";
        $tablas = " localidades,provincias ";
        $filtro = " localidades.pro_id=$pro_id ";
        $xtras = " order by loc_desc ASC";
        include("../" . _FILE_SCRIPT_PHP_SELECT);
        $regs = "";
        $tablas = "";
        $id = "";
        $filtro = "";
        $xtras = "";
        echo "<selected>$loc_id</selected>";

        echo "
				</localidades>
				<servicios>";
        
        $query_servicios = 'select * from servicios_bar_priv INNER JOIN servicios_tipo_bar_priv ON(servicios_tipo_bar_priv.servicio_bar_priv_id = servicios_bar_priv.servicio_bar_priv_id) where tipo_bar_priv_id = '.($bar_comp_priv ? $bar_comp_priv : $fila_bar['bar_comp_priv']).'';
        $cons_servicios = mysql_query($query_servicios);

        while($fila = mysql_fetch_array($cons_servicios)){
            print "<serv>";
            if($i % 2 == 0){
                print"<serv_par>1</serv_par>";
            }else{
                print"<serv_par>0></serv_par>";
            }

            $ser_desc = str_replace("*", "", $fila[servicio_bar_priv_desc]);
            $ser_desc = htmlspecialchars($ser_desc);

            print "<serv_num>$i></serv_num>";
            print "<serv_id>$fila[servicio_bar_priv_id]</serv_id>";
            print "<serv_desc><![CDATA[$ser_desc]]></serv_desc>";

            $query_servicios_valores = 'select * from servicios_x_bar_priv where bar_id = '. $bar_id;
            
            $cons_servicios_valores = mysql_query($query_servicios_valores);
            
            // Si la propiedad ya tiene servicios vemos si este servicio ya tiene algun valor
            if(mysql_num_rows($cons_servicios_valores)){
                while($fila2 = mysql_fetch_array($cons_servicios_valores)){
                    if($fila2[servicio_bar_priv_id] == $fila[servicio_bar_priv_id]){
                        $value = $fila2[valor];
                        break;
                    }
                }
            }

            if($fila[servicio_bar_priv_tip_dat] == "t" || $fila[servicio_bar_priv_tip_dat] == "ss"){
                print"<serv_type>text</serv_type>";
                print "<serv_name>ser_$fila[servicio_bar_priv_id]</serv_name>";
                print "<serv_valor><![CDATA[$value]]></serv_valor>";
                print "<serv_opciones></serv_opciones>";
            }else if($fila[servicio_bar_priv_tip_dat] == "s"){
                print "<serv_type>select</serv_type>";
                print "<serv_name>ser_$fila[servicio_bar_priv_id]</serv_name>";
                print "<serv_valor><![CDATA[$value]]></serv_valor>";
                $consulta_desde = mysql_query("select * from ser_selectores_bar_priv where servicio_bar_priv_id =" . $fila[servicio_bar_priv_id] . " and tipo_select='asc' order by nro_opcion");
                print "<serv_opciones>";       //print " <select name=\"desde_$i\">";
                while($cons_d = mysql_fetch_array($consulta_desde)){
                    if($cons_d[desc_opcion] == $value){
                        print"<opcion selected='1'>" . $cons_d[desc_opcion] . "</opcion>";
                    }else{
                        print"<opcion selected='0'>" . $cons_d[desc_opcion] . "</opcion>";
                    }
                }//while
                print"</serv_opciones>";
            }else{
                print "<serv_type>checkbox</serv_type>";
                print "<serv_name><![CDATA[ser_$fila[servicio_bar_priv_id]]]></serv_name>";
                print "<serv_opciones></serv_opciones>";
                if($value == "on"){
                    print"<serv_valor>checked</serv_valor>";
                }else{
                    print"<serv_valor></serv_valor>";
                }
            }
            $value = "";
            print "</serv>";
            $i++;
        }

        echo "
				</servicios>
                                
                                <bar_titulo_publicidad>
                                    <option value=''>Elegir una opcion</option>
                                    <option value='lanzamiento'>lanzamiento</option>
                                    <option value='ultimos_lotes'>Ultimos lotes</option>
                                    <option value='financiacion_propia'>Financiacion Propia</option>
                                    <selected>".$titulo_bar_priv."</selected>
                                </bar_titulo_publicidad>

				";


        //datos para mostrar el detalle
        /* 	echo"<bar_comp_priv_desc>";

          switch ($fila_bar[bar_comp_priv]){

          case 0: echo "Barrio Privado";break;
          case 1: echo "Complejo";break;
          case 2: echo "Barrio Semi Privado";break;
          case 3: echo "Loteo / Desarrollo";break;

          }

          echo"</bar_comp_priv_desc>"; */

        echo "<bar_comp_priv>";
        $regs = " distinct tipo_bar_priv_id,tipo_bar_priv_detalle ";
        $tablas = " tipos_bar_priv ";

        include("../" . _FILE_SCRIPT_PHP_SELECT);
        $regs = "";
        $tablas = "";
        $id = "";
        $filtro = "";
        $xtras = "";
        echo "<selected>".(isset($bar_comp_priv) && $bar_comp_priv != '' ? $bar_comp_priv : $fila_bar[bar_comp_priv])."</selected>
            </bar_comp_priv>
            
            <pro_desc><![CDATA[$fila_bar[pro_desc]]]></pro_desc>
            <loc_desc><![CDATA[$fila_bar[loc_desc]]]></loc_desc>
            <bar_zona><![CDATA[$fila_bar[bar_zona]]]></bar_zona>
            <bar_dir><![CDATA[".stripslashes($fila_bar[bar_dir])."]]></bar_dir>
            <bar_denom><![CDATA[".stripslashes($fila_bar[bar_denom])."]]></bar_denom>
            <bar_cont><![CDATA[$fila_bar[bar_cont]]]></bar_cont>
            <bar_tel><![CDATA[$fila_bar[bar_tel]]]></bar_tel>
            <bar_mail><![CDATA[$fila_bar[bar_mail]]]></bar_mail>
            <bar_sup_tot><![CDATA[$fila_bar[bar_sup_tot]]]></bar_sup_tot>
            <bar_sup_lot><![CDATA[$fila_bar[bar_sup_lot]]]></bar_sup_lot>
            <bar_cant_lot><![CDATA[$fila_bar[bar_cant_lot]]]></bar_cant_lot>
            <bar_alumbrado_sub><![CDATA[$fila_bar[bar_alumbrado_sub]]]></bar_alumbrado_sub>
            <bar_urbanizado><![CDATA[$fila_bar[bar_urbanizado]]]></bar_urbanizado>
            <bar_seguridad><![CDATA[$fila_bar[bar_seguridad]]]></bar_seguridad>
            <bar_lat><![CDATA[$fila_bar[bar_lat]]]></bar_lat>
            <bar_lng><![CDATA[$fila_bar[bar_lng]]]></bar_lng>
            <bar_desc><![CDATA[".stripslashes(htmlspecialchars($fila_bar[bar_desc]))."]]></bar_desc>
            <bar_serv><![CDATA[".stripslashes($fila_bar[bar_serv])."]]></bar_serv>
            <bar_url><![CDATA[$fila_bar[bar_url]]]></bar_url>
            <bar_logo><![CDATA[$fila_bar[bar_logo]]]></bar_logo>
            <bar_video><![CDATA[$fila_bar[bar_video]]]></bar_video>
            <bar_lat><![CDATA[$fila_bar[bar_lat]]]></bar_lat>
            <bar_lng><![CDATA[$fila_bar[bar_lng]]]></bar_lng>
            <bar_reglamento><![CDATA[".stripslashes($fila_bar[bar_reglamento])."]]></bar_reglamento>
            <bar_reglamento_archivo><![CDATA[$fila_bar[bar_reglamento_archivo]]]></bar_reglamento_archivo>


        <imagenes>";
        $cad_fotos = "select * from fotos_x_bar where bar_id=$bar_id and usr_id=" . _USR_ID;
        $res_fotos = mysql_query($cad_fotos);
        $i = 0;
        
        while($fil_fotos = mysql_fetch_array($res_fotos)){
            echo "<foto>
                    <fo_enl><![CDATA[$fil_fotos[fo_desc]]]></fo_enl>
                    <fo_desc><![CDATA[".$fil_fotos[fo_enl]."]]></fo_desc>
            </foto>";
            $i++;
        }

        for($j = $i; $j < 10; $j++){
            print "
                <foto>
                   <foto_enl></foto_enl>
                </foto>";
        }

        echo "</imagenes>";
    }
}else if($mod_tip == "add"){

    $cadena = "select * from tipos_bar_priv";
    $resultado = mysql_query($cadena);
    
    if(isset($pro_desc)) echo "<pro_desc><![CDATA[$pro_desc]]></pro_desc>";
    if(isset($loc_desc)) echo "<loc_desc><![CDATA[$loc_desc]]></loc_desc>";
    if(isset($bar_zona)) echo "<bar_zona><![CDATA[$bar_zona]]></bar_zona>";
    if(isset($bar_dir)) echo "<bar_dir><![CDATA[".stripslashes($bar_dir)."]]></bar_dir>";
    if(isset($bar_denom)) echo "<bar_denom><![CDATA[".stripslashes($bar_denom)."]]></bar_denom>";
    if(isset($bar_cont)) echo "<bar_cont><![CDATA[$bar_cont]]></bar_cont>";
    if(isset($bar_tel)) echo "<bar_tel><![CDATA[$bar_tel]]></bar_tel>";
    if(isset($bar_mail)) echo "<bar_mail><![CDATA[$bar_mail]]></bar_mail>";
    if(isset($bar_lat)) echo "<bar_lat><![CDATA[$bar_lat]]></bar_lat>";
    if(isset($bar_lng)) echo "<bar_lng><![CDATA[$bar_lng]]></bar_lng>";
    if(isset($bar_desc)) echo "<bar_desc><![CDATA[".stripslashes(htmlspecialchars($bar_desc))."]]></bar_desc>";
    if(isset($bar_serv)) echo "<bar_serv><![CDATA[".stripslashes($bar_serv)."]]></bar_serv>";
    if(isset($pro_desc)) echo "<bar_url><![CDATA[$bar_url]]></bar_url>";
    if(isset($bar_logo)) echo "<bar_logo><![CDATA[$bar_logo]]></bar_logo>";
    if(isset($bar_video)) echo "<bar_video><![CDATA[$bar_video]]></bar_video>";
    if(isset($bar_reglamento)) echo "<bar_reglamento><![CDATA[".stripslashes($bar_reglamento)."]]></bar_reglamento>";
    if(isset($bar_reglamento_archivo)) echo "<bar_reglamento_archivo><![CDATA[$bar_reglamento_archivo]]></bar_reglamento_archivo>";

    echo "<bar_comp_priv>";
    while($fila = mysql_fetch_array($resultado)){
        echo "<option value='".$fila['tipo_bar_priv_id']."'><![CDATA[".$fila['tipo_bar_priv_detalle']."]]></option>";
    }
    echo "	</bar_comp_priv>";
    
    echo " <bar_titulo_publicidad>
        <option value=''>Elegir una opcion </option>
        <option value='lanzamiento'>lanzamiento</option>
        <option value='ultimos_lotes'>Ultimos lotes</option>
        <option value='financiacion_propia'>Financiacion Propia</option>

    </bar_titulo_publicidad>
    <bar_alumbrado_sub>0</bar_alumbrado_sub>
    <bar_urbanizado>0</bar_urbanizado>
    <bar_seguridad>0</bar_seguridad>";


    echo "<provincias>";
    $regs = " pro_id,pro_desc ";
    $tablas = " provincias ";
    $filtro = " pai_id=$PAIS_DEFAULT";
    if(!$pro_id)
        $pro_id = $PROV_DEFAULT;
    $xtras = " order by pro_desc ASC";
    include("../" . _FILE_SCRIPT_PHP_SELECT);
    $regs = "";
    $tablas = "";
    $id = "";
    $xtras = "";
    echo "<selected>$pro_id</selected>";

    echo "
				</provincias>
				<localidades>";

    $regs = " distinct loc_id,loc_desc ";
    $tablas = " localidades,provincias ";
    $filtro = " localidades.pro_id=$pro_id ";
    $xtras = " order by loc_desc";
    include("../" . _FILE_SCRIPT_PHP_SELECT);
    $regs = "";
    $tablas = "";
    $id = "";
    $filtro = "";
    $xtras = "";
    echo "<selected>$loc_id</selected>";

    echo "</localidades>";

    $query_servicios = 'select * from servicios_bar_priv INNER JOIN servicios_tipo_bar_priv ON(servicios_tipo_bar_priv.servicio_bar_priv_id = servicios_bar_priv.servicio_bar_priv_id) '.($bar_comp_priv ? 'where tipo_bar_priv_id = '.$bar_comp_priv : '');
    $cons_servicios = mysql_query($query_servicios);

    // Consulta de los servicios de la propiedad
    if(mysql_num_rows($cons_servicios)){
        print "<cantservicios><![CDATA[".mysql_num_rows($cons_servicios)."]]></cantservicios>";
        $i = 0;
        print "<servicios>";
        while($fila = mysql_fetch_array($cons_servicios)){
            print "<serv>";
            if($i % 2 == 0){
                print"<serv_par>1</serv_par>";
            }else{
                print"<serv_par>0></serv_par>";
            }
            $ser_desc = str_replace("*", "", $fila[servicio_bar_priv_desc]);
            //$ser_desc=htmlentities($ser_desc);
            print "<serv_num>$i</serv_num>";
            print "<serv_id>$fila[servicio_bar_priv_id]</serv_id>";
            print "<serv_desc><![CDATA[$ser_desc]]></serv_desc>";
            if($fila[servicio_bar_priv_tip_dat] == "t" || $fila[servicio_bar_priv_tip_dat] == "ss"){
                print"<serv_type>text</serv_type>";
                print "<serv_name><![CDATA[ser_$fila[servicio_bar_priv_id]]]></serv_name>";
                print "<serv_valor><![CDATA[$value]]></serv_valor>";
                print "<serv_opciones></serv_opciones>";
            }else if($fila[servicio_bar_priv_tip_dat] == "s"){
                print "<serv_type>select</serv_type>";
                print "<serv_name>ser_$fila[servicio_bar_priv_id]</serv_name>";
                print "<serv_valor><![CDATA[$value]]></serv_valor>";
                $consulta_desde = mysql_query("select * from ser_selectores_bar_priv where servicio_bar_priv_id=" . $fila[servicio_bar_priv_id] . " and tipo_select='asc' order by nro_opcion");
                print "<serv_opciones>";       //print " <select name=\"desde_$i\">";
                while($cons_d = mysql_fetch_array($consulta_desde)){
                    if($cons_d[desc_opcion] == $value){
                        print"<opcion selected='1'>" . $cons_d[desc_opcion] . "</opcion>";
                    }else{
                        print"<opcion selected='0'>" . $cons_d[desc_opcion] . "</opcion>";
                    }
                }//while
                print"</serv_opciones>";
            }else{
                print "<serv_type>checkbox</serv_type>";
                print "<serv_name><![CDATA[ser_$fila[servicio_bar_priv_id]]]></serv_name>";
                print "<serv_opciones></serv_opciones>";
                if($value == "on"){
                    print"<serv_valor>checked</serv_valor>";
                }else{
                    print"<serv_valor></serv_valor>";
                }
            }
            $value = "";
            print "</serv>";
            $i++;
        }//fin while	
        print "</servicios>";
    }


    echo "<imagenes>";
    for($i = 1; $i < 11; $i++){
        print "
                <foto>
                        <foto_enl></foto_enl>
                </foto>";
    }
    print "</imagenes>";
}
echo "</bar_priv>";
?>
