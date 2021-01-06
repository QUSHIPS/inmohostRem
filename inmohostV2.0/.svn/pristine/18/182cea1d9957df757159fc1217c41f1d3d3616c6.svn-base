<?php
extract($_GET);
extract($_REQUEST);

include("/php/config.php");

$query_servicios = 'select * from servicios_bar_priv LEFT JOIN servicios_x_bar_priv ON(servicios_bar_priv.servicio_bar_priv_id = servicios_x_bar_priv.servicio_bar_priv_id) where bar_id = ' . $bar_id . ($tipo_bar_priv_id ? ' and tipo_bar_priv_id = ' . $tipo_bar_priv_id : '');

$cons_servicios = mysql_query($query_servicios);

$array_servicios = array();

$i = 1;

while($fila = mysql_fetch_array($cons_servicios)){
    
    $ser_desc = str_replace("*", "", $fila['servicio_bar_priv_desc']);
    $ser_desc = htmlspecialchars($ser_desc);
    
    // Si la propiedad ya tiene servicios vemos si este servicio ya tiene algun valor
    if(mysql_num_rows($cons_servicios)){
        mysql_data_seek($cons_servicios, 0);
        while($fila2 = mysql_fetch_array($cons_servicios)){
            if($fila2['servicio_bar_priv_id'] == $fila['servicio_bar_priv_id']){
                $value = $fila2['valor'];
                break;
            }
        }
    }

    if($fila[servicio_bar_priv_tip_dat] == 't' || $fila[servicio_bar_priv_tip_dat] == 'ss'){
        
        $tipo_servicio = array(
            'serv_type' => 'text'
        );
        print"<serv_type>text</serv_type>";
        print "<serv_name>ser_$fila[servicio_bar_priv_id]</serv_name>";
        print "<serv_valor>$value</serv_valor>";
        print "<serv_opciones></serv_opciones>";
    }else if($fila[servicio_bar_priv_tip_dat] == "s"){
        print "<serv_type>select</serv_type>";
        print "<serv_name>ser_$fila[servicio_bar_priv_id]</serv_name>";
        print "<serv_valor>$value</serv_valor>";
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
        print "<serv_name>ser_$fila[servicio_bar_priv_id]</serv_name>";
        print "<serv_opciones></serv_opciones>";
        if($value == "on"){
            print"<serv_valor>checked</serv_valor>";
        }else{
            print"<serv_valor></serv_valor>";
        }
    }
    $value = "";
   
    
    $array_servicios[] = array(
        'serv_par' => $i % 2 == 0 ? 1 : 0,
        'serv_num' => $i,
        'serv_id' => $fila['servicio_bar_priv_id'],
        'serv_desc' => $ser_desc
    );
    
    $i++;
}
?>