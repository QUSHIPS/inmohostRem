<?php
    include ("php/config.php");
    include ("php/sec_head.php");
    include("head.php");

    $dom = "argentina";
    if ($pro_id) {
        $cadena = "select pro_desc from provincias where pro_id=$pro_id";
        $pro_desc = mysql_result(mysql_query($cadena), 0, 0);
    }

    if ($loc_id) {
        $cadena = "select loc_desc from localidades where loc_id=$loc_id";
        $loc_desc = mysql_result(mysql_query($cadena), 0, 0);
    }
    if ($prp_dom != "") {
        $p_dom.=$prp_dom . ",";
    }
    $dom = $p_dom . $loc_desc . "," . $pro_desc . "," . $dom;
    $lat = $prp_lat;
    $lng = $prp_lng;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

        <script type="text/javascript" src='https://maps.googleapis.com/maps/api/js?key=<?php echo $MAP_KEY ?>&sensor=true'></script>

        <script src="javascript/maps.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo _FILE_JAVASCRIPT_AJAX; ?>"></script>
        <style>
            #mapa_buscar{
                width: 700px;
                border: 1px solid #000;
                height: 430px;
                .gmnoprint img {max-width: none; }
                .gm-style img { max-width: none; }
                .gm-style label { width: auto; display: inline; }
            }
            
        </style>
    </head>
    <body onload="initialize('<?php echo $dom ?>', '<?php echo $lat ?>', '<?php echo $lng ?>', '<?php echo $win_prp ?>');">
        <div id="buscador" class="tableClara">
            <form name="form_map" action="javascript:showAddress(document.getElementById('domicilio').value+','+document.getElementById('loc_id').options[document.getElementById('loc_id').selectedIndex].text+','+document.getElementById('pro_id').options[document.getElementById('pro_id').selectedIndex].text+',argentina','','','<?php echo $win_prp ?>')">
                <div id="mapa_filtros"><div id="selection"></div></div>
                <div id="outline"></div>


                <input type="text" size="50" name="domicilio" id="domicilio" value="<?php echo $prp_dom ?>" onkeypress="checkEnter(event e, 'form_map')" />
                <span id="div_loc_id">
                    <select name="loc_id" id="loc_id" class="inputForm">
                        <?php
                            $regs = " loc_id,loc_desc ";
                            $tablas = " localidades ";
                            $filtro = " pro_id=$pro_id";
                            $id = $loc_id;
                            $xtras = " order by loc_desc ASC";
                            include(_FILE_SCRIPT_PHP_SELECT);
                            $regs = "";
                            $tablas = "";
                            $id = "";
                            $xtras = "";
                        ?>
                    </select> 
                </span>
                <select name="pro_id" id="pro_id" class="inputForm" onchange="act_select('loc_id,loc_desc', 'localidades', 'pro_id=' + this.value, 'loc_id', '', 'php/funciones', 'loc_desc');">
                <?php
                    $regs = " pro_id,pro_desc ";
                    $tablas = " provincias ";
                    $filtro = " pai_id=1";
                    $id = $pro_id;
                    if (!$pro_id)
                        $pro_id = $PROV_DEFAULT;
                    $xtras = " order by pro_desc ASC";
                    include(_FILE_SCRIPT_PHP_SELECT);
                    $regs = "";
                    $tablas = "";
                    $id = "";
                    $xtras = "";
                ?>
                </select>
                <input type="button" name="Buscar" class="botonForm" value="Buscar Direccion" onclick="showAddress(document.getElementById('domicilio').value + ',' + document.getElementById('loc_id').options[document.getElementById('loc_id').selectedIndex].text + ',' + document.getElementById('pro_id').options[document.getElementById('pro_id').selectedIndex].text + ',argentina', '', '', '<? echo $win_prp ?>')">
                <div id="mapa_resultados"></div>
                <div class="clearfloat">&nbsp;</div>
            </form>
            <div id="mapa_buscar"></div>
        </div>
    </body>
</html>
