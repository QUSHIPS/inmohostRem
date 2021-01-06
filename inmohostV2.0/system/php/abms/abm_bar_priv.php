<?php

extract($_POST);
extract($_FILES);
$ind_error = 0;
$ind_exito = 0;
$MAX_TAM_FOT = 70000;
mysql_query("start transaction");
include('../configFileUpload.php');


switch($mod_tip){
    case "add":
        if(!$errors){

            $verif = mysql_query("select * from bar_priv");
            if(mysql_num_rows($verif)){
                $max_id = mysql_query("select max(bar_id) from bar_priv");
                $max_id = mysql_result($max_id, 0, 0) + 1;
            }else{
                $max_id = 1;
            }

            $conn_id = ftp_connect(_HOST_FTP);
            $login = ftp_login($conn_id, _USUARIO_FTP, _PASSWORD_FTP);
            if(isset($bar_logo['name']) && $bar_logo['name'] != ""){

                if($bar_logo['size'] < $MAX_TAM_FOT){
//						echo "entra2";
//                                                print_r($bar_logo);
                    //copy($bar_logo,$rutaSystema.'extra/logos/bar_log_'._USR_ID.'_'.$max.'gif');				
                    ftp_put($conn_id, '/fotos/' . 'bar_log_' . _USR_ID . '_' . $max_id . '.gif', $bar_logo['tmp_name'], FTP_ASCII);
                    $bar_logo = "bar_log_" . _USR_ID . "_$max_id.gif";
                }else{
                    //echo "entra";
//                                                print_r($_FILES['bar_logo']);
                    redim_foto("bar_logo", "/fotos/", "bar_log_" . _USR_ID . "_$max_id", $conn_id);
                    $bar_logo = "bar_log_" . _USR_ID . "_$max_id.gif";
                }
            }

            $reglamento_archivo = '';
            if(isset($bar_reglamento_archivo['name']) && $bar_reglamento_archivo['name'] != ''){
                $reglamento_archivo = string_to_underscore_name($bar_reglamento_archivo['name']);
                ftp_put($conn_id, '/reglamentos_barrios_privados/' . 'reglamento_' . _USR_ID . '_' . $max_id . '_' . $reglamento_archivo, $bar_reglamento_archivo['tmp_name'], FTP_ASCII);
            }

            $bar_denom = trim(addslashes($bar_denom));
            $bar_cont = trim(addslashes($bar_cont));
            $bar_zona = trim(addslashes($bar_zona));
            $bar_desc = trim(addslashes($bar_desc));
            $bar_reglamento = trim(addslashes($bar_reglamento));

            $cadena = "insert 
                into
                    bar_priv
                values
                    ($max_id,
                    $usr_id,
                    '$bar_denom',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '$bar_cont',
                    '$bar_tel',
                    '$bar_mail',
                    '$loc_id',
                    '$pro_id',
                    '$PAIS_DEFAULT',
                    '$bar_zona',
                    '$bar_dir',
                    '$bar_comp_priv',
                    '$bar_url',
                    '$bar_logo',
                    '$bar_desc',
                    '$bar_video',
                    '$bar_reglamento',
                    '".$reglamento_archivo."',
                    '$bar_titulo_publicidad',
                    '$bar_lat',
                    '$bar_lng'
                    )";

            mysql_query($cadena) or $errors = "no inserta en bar priv" . mysql_error() . $cadena;


            /**
             * Inicio Servicios
             */
            if($servicios){
                $query_servicios = 'insert into servicios_x_bar_priv values ';
                $array_servicios = array();

                foreach($servicios as $k => $val){
                    $k_aux = explode('_', $k);
                    $array_servicios[] = array('servicio_bar_priv_id' => $k_aux[1], 'bar_id' => $max_id, 'usr_id' => $usr_id, 'valor' => $val);
                    $query_servicios .= '(NULL,' . $k_aux[1] . ',' . $max_id . ',' . $usr_id . ',"' . $val . '"),';
                }

                $query_servicios = substr($query_servicios, 0, -1) . ';';

                mysql_query($query_servicios) or $errors = "no inserta servicios en bar priv <br>" . mysql_error() . $query_servicios;
            }
            /**
             * Fin Servicios
             */

            
             /* FOTOS */
            $j = 0;
             $conn_id = ftp_connect(_HOST_FTP);
            $login = ftp_login($conn_id, _USUARIO_FTP, _PASSWORD_FTP);
            
            if (isset($array_fotos) && count($array_fotos)) {
                foreach ($array_fotos as $key => $foto) {

                    $nom_foto = $foto . ".jpg";
                    if (ftp_size($conn_id, '/fotos/' . $nom_foto) != -1 && ftp_size($conn_id, '/fotos/' . $nom_foto) > 0) {
                        $j++;
                        $result = ftp_rename($conn_id, '/fotos/' . $nom_foto, '/fotos/bar-' . $max_id . "-" . $usr_id . "-" . $orden[$key] . ".gif");
                        $array_fotos_final[] = array("bar_id" => $max_id, 'usr_id' => $usr_id, 'fo_enl' => "bar-". $max_id . "-" . $usr_id . "-" . $orden[$key] . ".gif", 'fo_id' => $orden[$key], 'fo_desc' => addslashes(isset($array_descripcion[$key]) ? $array_descripcion[$key] : ""));
                        $cadena = "insert into fotos_x_bar (bar_id,usr_id, fo_id, fo_det, fo_enl) values($max_id,$usr_id,".$orden[$key].",'".addslashes(isset($array_descripcion[$key]) ? $array_descripcion[$key] : "")."','bar-" . $max_id . "-" . $usr_id . "-" . $orden[$key] . ".gif')";
                        mysql_query($cadena) or $errors[$ind_error++] = $cadena . "<br>" . mysql_error();
                        //  echo "result.".$result;
                    }

//                    /* BORRAR LUEGO DE TESTEAR */
//                    $j++;
//                    $array_fotos_final[] = array("prp_id" => $max_id, 'usr_id' => $usr_id, 'fo_enl' => $max_id . "-" . $usr_id . "-" . $j . ".gif", 'fo_nro' => $j, 'fo_desc' => addslashes(isset($array_descripcion[$key]) ? $array_descripcion[$key] : ""));
//                    $cadena = "insert into fotos values('" . $max_id . "-" . $usr_id . "-" . $j . ".gif" . "'," . $max_id . ",$usr_id," . $j . ",'" . addslashes(isset($array_descripcion[$key]) ? $array_descripcion[$key] : "") . "')";
//                    mysql_query($cadena) or $errors[$ind_error++] = _MENS_INS_PRP_ERROR_FOTO . "<br>" . $cadena . "<br>" . mysql_error();
//
//                    /**************************/
                }
            }
            ftp_close($conn_id);
            /* FIN FOTOS */

            if(!$errors){
                mysql_query("commit");

                $array_bar_priv = array(
                    'bar_priv_id' => $max_id,
                    'usr_id' => $usr_id,
                    'bar_denom' => $bar_denom,
                    'bar_cont' => $bar_cont,
                    'bar_tel' => $bar_tel,
                    'bar_mail' => $bar_mail,
                    'loc_id' => $loc_id,
                    'pro_id' => $pro_id,
                    'pai_id' => $PAIS_DEFAULT,
                    'bar_zona' => $bar_zona,
                    'bar_dir' => $bar_dir,
                    'bar_comp_priv' => $bar_comp_priv,
                    'bar_url' => $bar_url,
                    'bar_logo' => $bar_logo,
                    'bar_desc' => $bar_desc,
                    'bar_video' => $bar_video,
                    'bar_reglamento' => $bar_reglamento,
                    'bar_reglamento_archivo' => $reglamento_archivo,
                    'bar_titulo_publicidad' => $bar_titulo_publicidad,
                    'bar_lat' => $bar_lat,
                    'bar_lng' => $bar_lng,
                    'array_servicios' => $array_servicios,
                    'array_fotos' => $array_fotos_final
                );

                actualizar_inmoclick("bar_priv", array("array_bar_priv" => $array_bar_priv, "bar_id" => $max_id, "usr_id" => $usr_id, "tipo" => "alta"));

                $resultado = "El barrio privado fue agregado al sistema";
            }else{
                if(is_array($errors)){
                    foreach($errors as $error)
                        echo $error.'<br />';
                }
                $resultado = "Error al cargar el barrio";
                mysql_query("ROLLBACK");
            }
        }


        /*         * *********************************************************************************************************************
         * *****************************************   FIN ALTA BARRIO  ********************************************
         * ********************************************************************************************************************* */
        break;
    case "edit":
        
        if($bar_id){

             $conn_id = ftp_connect(_HOST_FTP);
            $login = ftp_login($conn_id, _USUARIO_FTP, _PASSWORD_FTP);

            if(isset($bar_reglamento_archivo['name']) && $bar_reglamento_archivo['name'] != ''){
                $reglamento_archivo = string_to_underscore_name($bar_reglamento_archivo['name']);
                ftp_put($conn_id, '/reglamentos_barrios_privados/' . 'reglamento_' . _USR_ID . '_' . $bar_id . '_' . $reglamento_archivo, $bar_reglamento_archivo['tmp_name'], FTP_ASCII);
            }else{
                $cad = "select bar_reglamento_archivo from bar_priv where bar_id=$bar_id";
                $res = mysql_query($cad);
                $reglamento_archivo = mysql_result($res, 0, 0);
            }

            if($bar_logo['name'] != ''){
                if($bar_logo['size'] < $MAX_TAM_FOT){
                    ftp_put($conn_id, '/fotos/' . 'bar_log_' . _USR_ID . '_' . $bar_id . '.gif', $bar_logo['tmp_name'], FTP_ASCII);
                    $bar_logo = "bar_log_" . _USR_ID . "_$bar_id.gif";
                }else{
                    //echo "entra";                                              print_r($_FILES['bar_logo']);
                    redim_foto("bar_logo", "fotos/", "bar_log_" . _USR_ID . "_$bar_id", $conn_id);
                    $bar_logo = "bar_log_" . _USR_ID . "_$bar_id.gif";
                }
            }else{
                $cad = "select bar_logo from bar_priv where bar_id=$bar_id";
                $res = mysql_query($cad);
                $bar_logo = mysql_result($res, 0, 0);
            }


            //**************************************** nuevos servicios ***********************************
            $cadena = "delete from servicios_x_bar_priv where bar_id=$bar_id and usr_id=$usr_id";

            mysql_query($cadena) or $errors[$ind_error++] = "No se pudieron borrar servicios";

            if($servicios){
                $query_servicios = 'insert into servicios_x_bar_priv values ';
                
                $array_servicios = array();
                
                foreach($servicios as $k => $val){
                    $k_aux = explode('_', $k);
                    $array_servicios[] = array('servicio_bar_priv_id' => $k_aux[1], 'bar_id' => $bar_id, 'usr_id' => $usr_id, 'valor' => $val);
                    $query_servicios .= '(NULL,' . $k_aux[1] . ',' . $bar_id . ',' . $usr_id . ',"' . $val . '"),';
                }

                $query_servicios = substr($query_servicios, 0, -1) . ';';

                mysql_query($query_servicios) or $errors = "no inserta servicios en bar priv <br>" . mysql_error() . $query_servicios;
            }

            $bar_denom = trim(addslashes($bar_denom));
            $bar_serv = trim(addslashes($bar_serv));
            $bar_cont = trim(addslashes($bar_cont));
            $bar_zona = trim(addslashes($bar_zona));
            $bar_desc = trim(addslashes($bar_desc));
            $bar_reglamento = trim(addslashes($bar_reglamento));

            $cadena = "update bar_priv set bar_denom='$bar_denom',bar_sup_tot='$bar_sup_tot', bar_sup_lot='$bar_sup_lot',bar_cant_lot='$bar_cant_lot', bar_alumbrado_sub='$bar_alumbrado_sub', bar_urbanizado='$bar_urbanizado', bar_seguridad='$bar_seguridad', bar_serv='$bar_serv', bar_cont='$bar_cont', bar_tel='$bar_tel', bar_mail='$bar_mail', loc_id='$loc_id', pro_id='$pro_id', pai_id='$PAIS_DEFAULT', bar_zona='$bar_zona', bar_dir='$bar_dir', bar_comp_priv='$bar_comp_priv', bar_url='$bar_url', bar_desc='$bar_desc', bar_video='$bar_video', bar_reglamento='$bar_reglamento', bar_reglamento_archivo='$reglamento_archivo', bar_titulo_publicidad='$bar_titulo_publicidad', bar_logo = '$bar_logo', bar_lat = '$bar_lat', bar_lng = '$bar_lng ' where bar_id=$bar_id";

            mysql_query($cadena) or $errors = "no modifica en bar priv" . mysql_error() . $cadena;

            /* FOTOS */
            $conn_id = ftp_connect(_HOST_FTP);
            

            if($conn_id){
                $login = ftp_login($conn_id, _USUARIO_FTP, _PASSWORD_FTP);
                if($login){
                    if(isset($array_fotos) && count($array_fotos)){
                        mysql_query("delete from fotos_x_bar where bar_id=$bar_id and usr_id=$usr_id");
                        $j = 0;
                        $cambiado = array();
                        foreach($array_fotos as $key => $foto){
                            if(strstr($foto, ".gif")){
                                $j++;
                                $nom_foto = $foto;
                                $res = ftp_size($conn_id, '/fotos/bar-' . $bar_id . "-" . $usr_id . "-" . $orden[$key] . ".gif");
                                
                                if($res != -1 && !in_array($j, $cambiado)){
                                    $nombre_aux = '/fotos/bar-' . $bar_id . "-" . $usr_id . "-aux.gif";
//                                
//                                  echo '/fotos/' . $prp_id . "-" . $usr_id . "-" . $orden[$key] . ".gif,".$nombre_aux."<br/>";
//                                  echo '/fotos/' . $nom_foto. ',/fotos/' . $prp_id . "-" . $usr_id . "-" . $orden[$key] . ".gif"."<br>";
//                                  echo $nombre_aux .',/fotos/' . $nom_foto."<br>";

                                    $cambiado[] = $orden[$key];
                                    
                                    ftp_rename($conn_id, '/fotos/bar-' . $bar_id . "-" . $usr_id . "-" . $orden[$key] . ".gif", $nombre_aux);
                                    ftp_rename($conn_id, '/fotos/' . $nom_foto, '/fotos/bar-' . $bar_id . "-" . $usr_id . "-" . $orden[$key] . ".gif");
                                    ftp_rename($conn_id, $nombre_aux, '/fotos/' . $nom_foto);
                                }elseif(!in_array($j, $cambiado)){
//                                echo '---/fotos/' . $nom_foto.',/fotos/' . $prp_id . "-" . $usr_id . "-" . $orden[$key] . ".gif"."<br>";
                                    ftp_rename($conn_id, '/fotos/' . $nom_foto, '/fotos/bar-' . $bar_id . "-" . $usr_id . "-" . $orden[$key] . ".gif");
                                }

                                //  echo 'rename:'.'/fotos/' . $nom_foto.',/fotos/' . $prp_id . "-" . $usr_id . "-" . $orden[$key] . ".gif<br/>";
                                //  rename(_CARPETA_FOTOS.$nom_foto, _CARPETA_FOTOS.$prp_id."-".$usr_id."-".$j.".gif");
                                $cadena = "insert into fotos_x_bar (bar_id,usr_id, fo_id, fo_det, fo_enl) values(" . $bar_id . ",$usr_id," . $orden[$key] . ",'" . addslashes(isset($array_descripcion[$key]) ? $array_descripcion[$key] : "") . "','bar-" . $bar_id . "-" . $usr_id . "-" . $orden[$key] . ".gif" . "')";
   
                                mysql_query($cadena) or $errors[$ind_error++] = "<br>" . $cadena . "<br>" . mysql_error();
                                $array_fotos_final[] = array("bar_id" => $bar_id, 'usr_id' => $usr_id, 'fo_enl' => "bar-".$bar_id."-".$usr_id."-".$orden[$key].".gif", 'fo_id' => $orden[$key], 'fo_desc' => addslashes(isset($array_descripcion[$key]) ? $array_descripcion[$key] : ""));
                            }elseif($foto != "eliminada"){

                                $nom_foto = $foto . ".jpg";
                                if(ftp_size($conn_id, '/fotos/' . $nom_foto) != -1 && ftp_size($conn_id, '/fotos/' . $nom_foto) > 0){
                                    $j++;
                                    if('/fotos/' . $nom_foto != '/fotos/bar-' . $bar_id . "-" . $usr_id . "-" . $orden[$key] . ".gif"){
//                                    echo '**/fotos/' . $nom_foto. ',/fotos/' . $prp_id . "-" . $usr_id . "-" . $orden[$key] . ".gif";
                                        ftp_rename($conn_id, '/fotos/' . $nom_foto, '/fotos/bar-' . $bar_id . "-" . $usr_id . "-" . $orden[$key] . ".gif");
                                        //rename(_CARPETA_FOTOS.$nom_foto, _CARPETA_FOTOS.$prp_id."-".$usr_id."-".$j.".gif");
                                    }
                                    $array_fotos_final[] = array("bar_id" => $bar_id, 'usr_id' => $usr_id, 'fo_enl' => "bar-".$bar_id."-".$usr_id."-".$orden[$key].".gif", 'fo_id' => $orden[$key], 'fo_desc' => addslashes(isset($array_descripcion[$key]) ? $array_descripcion[$key] : ""));
                                    $cadena = "insert into fotos_x_bar (bar_id,usr_id, fo_id, fo_det, fo_enl) values(" . $bar_id . ",$usr_id," . $orden[$key] . ",'" . addslashes(isset($array_descripcion[$key]) ? $array_descripcion[$key] : "") . "','bar-" . $bar_id . "-" . $usr_id . "-" . $orden[$key] . ".gif" . "')";

                                    mysql_query($cadena) or $errors[$ind_error++] = "<br>" . $cadena . "<br>" . mysql_error();
                                }
                            }
                        }
                    }
                }else{
                    //mail('gabriel@puntosero.com', 'no hizo login:', "propiedad:$prp_id - $usr_id",$headers);
                }
            }else{
                //mail('gabriel@puntosero.com', 'no se conecto:', "propiedad:$prp_id - $usr_id",$headers);
            }
            
            $array_bar_priv = array(
                'bar_priv_id' => $bar_id,
                'usr_id' => $usr_id,
                'bar_denom' => $bar_denom,
                'bar_sup_tot' => $bar_sup_tot,
                'bar_sup_lot' => $bar_sup_lot,
                'bar_cant_lot' => $bar_cant_lot,
                'bar_alumbrado_sub' => $bar_alumbrado_sub,
                'bar_urbanizado' => $bar_urbanizado,
                'bar_seguridad' => $bar_seguridad,
                'bar_serv' => $bar_serv,
                'bar_cont' => $bar_cont,
                'bar_tel' => $bar_tel,
                'bar_mail' => $bar_mail,
                'loc_id' => $loc_id,
                'pro_id' => $pro_id,
                'pai_id' => $PAIS_DEFAULT,
                'bar_zona' => $bar_zona,
                'bar_dir' => $bar_dir,
                'bar_comp_priv' => $bar_comp_priv,
                'bar_url' => $bar_url,
                'bar_logo' => $bar_logo,
                'bar_desc' => $bar_desc,
                'bar_video' => $bar_video,
                'bar_reglamento' => $bar_reglamento,
                'bar_reglamento_archivo' => $reglamento_archivo,
                'bar_titulo_publicidad' => $bar_titulo_publicidad,
                'bar_lat' => $bar_lat,
                'bar_lng' => $bar_lng,
                'array_servicios' => $array_servicios,
                'array_fotos' => $array_fotos_final
            );

            if(!$errors){
                mysql_query("commit");

                actualizar_inmoclick("bar_priv", array("array_bar_priv" => $array_bar_priv, "bar_id" => $bar_id, "usr_id" => $usr_id, "tipo" => "modificacion"));
                borrar_cache($usr_id, $bar_id);
                $resultado = "El barrio privado fue modificado";
            }else{
                if(is_array($errors)){
                    foreach($errors as $error)
                        echo $error.'<br />';
                }
                
                $resultado = "Error al modificar el barrio";
                mysql_query("ROLLBACK");
            }
        }else{
            $errors = "No llega el ID";
        }
        break;
}

function borrar_cache($usr_id, $bar_id) {

    $conn_id = ftp_connect(_HOST_CACHE_FTP);
    if ($conn_id) {
        $login = ftp_login($conn_id, _USUARIO_CACHE_FTP, _PASSWORD_CACHE_FTP);
        if ($login) {
            $cadena = "select * from fotos_x_bar where usr_id=$usr_id and bar_id=$bar_id";
            $result = mysql_query($cadena);
            while ($foto = mysql_fetch_array($result)) {

                $ratio = '997:475';

                $tamaños = calcularTamaño(997, 475, $foto['fo_enl'], $ratio);
                $cadena = md5($tamaños['width'] . 'x' . $tamaños['height'] . 'x' . 90 . 'x' . $ratio . '-/ftp_inmohost/fotos/' . $foto['fo_enl']);
                ftp_delete($conn_id, $cadena);
            }
        }
    }
}

function calcularTamaño($maxWidth, $maxHeight, $foEnl, $cropRatio = null) {


    $size = GetImageSize(_FOTOS_INMOCLICK . $foEnl);

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

?>