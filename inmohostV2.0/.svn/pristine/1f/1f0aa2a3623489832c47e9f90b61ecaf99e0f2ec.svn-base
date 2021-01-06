<?php
include"../conexion.php";

$cadena = "select 
                                            servicios_ihost.* 
                            from 
                                            servicios_ihost inner join ser_tipo_const on 
                                                (servicios_ihost.ser_id = ser_tipo_const.ser_id)
                            where
                                            ser_tipo_const.tip_id=$tip_id 

                            order by servicios_ihost.ser_desc";

$cons_tip  = mysql_query($cadena);

    $respuesta = '<table width="100%" border="0" align="left" cellspacing="0" cellpadding="0">
    <tbody>
        <tr>
            <td width="50%" valign="top" colspan="2">

                <div style="display:block">';
    
    
    
    if (isset($prp_id) && isset($usr_id)) {
        
            $query = "select  * from ser_x_prp_ihost where prp_id=".$prp_id." and usr_id=".$usr_id;
            $resultado = mysql_query($query);
            while ($fila = mysql_fetch_array($resultado)){
                $ser_x_prp_ihost[$fila['ser_id']] =  $fila['valor'];
            }
            
            $respuesta.= formatear_servicios($cons_tip, $respuesta, $ser_x_prp_ihost);
    }else{

        $respuesta.= formatear_servicios($cons_tip, $respuesta);
    }

$respuesta.='</div>
                        </td> 
                        
                    </tr>
                  </tbody>
                  
                </table>';

echo $respuesta;


function formatear_servicios($cons_tip,$respuesta,$ser_x_prp_ihost = null){
    
       
 //   print_r($ser_x_prp_ihost);
     if (mysql_num_rows($cons_tip)) {
            
            $cantidad = mysql_num_rows($cons_tip);
            $mitad = (int)($cantidad/2);
            
            $i = 0;
           while ($fila = mysql_fetch_array($cons_tip)) {
               
               
               
               
               if($i == $mitad+1){
                    $respuesta.='</div>
                        </td>
                        <td valign="top" colspan="2">

                                <div style="display:block">
                        
                    ';
                    
                    $align1 = 'left'; 
                    $align2 = 'rightt';
                    $align3 = 'left';
                    $width = '';
                }else if($i > $mitad+1){
                    $align1 = 'left'; 
                    $align2 = 'rightt';
                    $align3 = 'left';
                    $width = '';
                    
                }else{    
                    $width = 'width:180px;';
                    $align1 = 'left'; 
                    $align2 = 'left';
                    $align3 = 'right';
                }
                
                
                $value = '';
                
                if(isset($ser_x_prp_ihost)){
                    if(isset($ser_x_prp_ihost[$fila['ser_id']])){
                        $value = $ser_x_prp_ihost[$fila['ser_id']];
                    }
                }
      
                $ser_desc = ucfirst(utf8_encode($fila['ser_desc']));

                if ($fila['ser_tip_dat'] == "t" || $fila['ser_tip_dat'] == "ss"){
                    
                               $respuesta.='
                        <div align="'.$align1.'" style="height:25px; border-bottom:#CCCCCC 1px solid; padding-'.$align2.':10px; padding-top:3px;">
                                <div align="'.$align3.'" style="float:left;'.$width.'" id="valor'.$fila['ser_id'].'_div">'.$ser_desc.':</div>
                                <input type="text" class="inputForm" style="width:75px;" value="'.$value.'" name="valor'.$fila['ser_id'].'">
                                
                            </div>'; 
                    
                } else if ($fila['ser_tip_dat'] == "s") {

                    $respuesta.='
                          <div align="'.$align1.'" style="height:25px; border-bottom:#CCCCCC 1px solid; padding-'.$align2.':10px; padding-top:3px;">
                            <div align="'.$align3.'" style="float:left;'.$width.'" id="valor'.$fila['ser_id'].'_div">'.$ser_desc.'</div>:
                            <select class="inputForm" name="valor'.$fila['ser_id'].'">
                                ';
                                $consulta_desde = mysql_query("select * from ser_selectores where ser_id=" . $fila['ser_id'] . " and tipo_select='asc' order by nro_opcion");
                                while ($cons_d = mysql_fetch_array($consulta_desde)) {
                                    
                                    $desc_opcion =  utf8_encode($cons_d['desc_opcion']);
                                    
                                    if ($cons_d['desc_opcion'] == $value) {
                                        $respuesta.='<option selected value="'. $desc_opcion .'">'. $desc_opcion .'</option>';
                                    } else {
                                        $respuesta.='<option value="'. $desc_opcion .'">'. $desc_opcion .'</option>';
                                    }
                                }//while
                                 $respuesta.='
                            </select>
                            <span id="destacado2"><br></span>
                        </div>';
                } 
              
                
                
                $i++;
            }//fin while	
        }
    
    return $respuesta;
}




?>
   