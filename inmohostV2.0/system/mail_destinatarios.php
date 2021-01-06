<?php
include("php/config.php");
include ("php/conexion_inmoclick.php");
//libreria de dreamwaeaver XLST para inclucion de archivos de XML con XSLT


// cambio la hoja de estylos por defecto
$otraCSS = "styleInterno.css";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>INMOHOST</title>

    <script language="javascript">



          function actualizar_destinatarios(){

                //busca la ventana de propiedad abierta y guarda las coordenadas
            for(i=0;i<parent.window.length;i++){

                    if(parent.window[i].name=="env_mail_content"){


                             cantidad_mails = document.getElementById('cant').value;
                             destinatarios_actuales = parent.window[i].document.getElementById('mail_to').value;

                             destinatarios_act = destinatarios_actuales.split(';');


                             for(k=0;k<=destinatarios_act.length;k++){
                                    
                                 if(destinatarios_act[0]!=''){
                                       for(j=1;j<=cantidad_mails;j++){
                                           if(destinatarios_act[k]== document.getElementById('mail_'+j).title){
                                                tr = document.getElementById('tr_'+j);
                                                check = document.getElementById('check_'+j);
                                                tr.style.background = '#FF9900';
                                                check.checked = true;
                                           }
                                       }
                                 }
                             }


                    }

            }


             
          }
       
           function seleccionar(objeto,i){

                check = document.getElementById('check_'+i);
                mail = document.getElementById('mail_'+i);

                if(check.checked){
                        objeto.style.background='#FFF';
                        check.checked=false;
                        agregar_destinatario(mail.title,'quitar');
                }else{
                        objeto.style.background='#FF9900';
                        check.checked=true;
                        agregar_destinatario(mail.title,'agregar');
                }

                

           }


        function agregar_destinatario(destinatario,accion){
            //busca la ventana de propiedad abierta y guarda las coordenadas
            for(i=0;i<parent.window.length;i++){
                    
                    if(parent.window[i].name=="env_mail_content"){

                            destinatarios_actuales = parent.window[i].document.getElementById('mail_to').value;

                            if(accion=='agregar'){
                                if(destinatario == 'todos'){
                                        destinatario='';
                                        cantidad_mails = document.getElementById('cant').value;
                                        for(j=1;j<=cantidad_mails;j++){

                                            mail = document.getElementById('mail_'+j).title;
                                            destinatario = destinatario + ';' + mail;

                                            tr = document.getElementById('tr_'+j);
                                            check = document.getElementById('check_'+j);
                                            tr.style.background = '#FF9900';
                                            check.checked = true;

                                        }

                                    parent.window[i].document.getElementById('mail_to').value=destinatario;
                                }else{
                                    if(destinatarios_actuales.indexOf(destinatario)==-1){
                                         parent.window[i].document.getElementById('mail_to').value=parent.window[i].document.getElementById('mail_to').value.replace(/ /g,'') + destinatario + ';';
                                    }
                                }
                            }else if(accion=='quitar'){
                                    if(destinatario == 'todos'){
                                        cantidad_mails = document.getElementById('cant').value;

                                        for(j=1;j<=cantidad_mails;j++){
                                            tr = document.getElementById('tr_'+j);
                                            check = document.getElementById('check_'+j);
                                            tr.style.background = '#FFF';
                                            check.checked = false;
                                        }


                                        parent.window[i].document.getElementById('mail_to').value='';
                                    }else{
                                        destinatarios_actuales = destinatarios_actuales.replace(destinatario + ";","");
                                        parent.window[i].document.getElementById('mail_to').value = destinatarios_actuales;
                                    }
                            }
                    }
            }

        }



    </script>
    </head>
    <body onload='actualizar_destinatarios("")'>
             <?php
        include("head.php");
        ?>
        <script language="javascript" type="text/javascript" src="<?php echo _FILE_JAVASCRIPT_SWF_OBJECT; ?>"></script>

        <!--MENUEXTRA-->
        <script language="JavaScript1.2" type="text/javascript" src="<?php echo _FILE_JAVASCRIPT_MENUEXTRA; ?>"></script>
        <?php echo "<style type=\"text/css\" media=\"screen\">
	@import url(\"" . _FILE_CSS_MENUEXTRA . "\");
</style>\n"; ?>
        <!--//MENUEXTRA-->
            <?php  $cadena = "SELECT DISTINCT usuarios . *
                                FROM usuarios
                                LEFT JOIN propiedades ON ( usuarios.usr_id = propiedades.usr_id )
                                LEFT JOIN redes_x_usuarios ON ( usuarios.usr_id = redes_x_usuarios.usr_id )
                                WHERE usuarios.visible =1
                                AND propiedades.prp_mostrar =1
                                AND usuarios.usr_tipo =2
                                AND usuarios.web !=  ''
                                AND redes_x_usuarios.red_id =1 order by usuarios.usr_raz" ;
                  $resultado = mysql_query($cadena,$conn2) or die(mysql_error($conn2));?>


        <style>
            #table_destinatarios td{
                border:1px solid #CCC;
            }
            #table_destinatarios tr:hover{
                  background-color: #FF9900;
            }
            #table_destinatarios tr{
                  cursor: pointer;
            }

            /*#tr_destinatarios:hover{
                
            }*/
        </style>

        <table class="tableClara" id="table_destinatarios">

            <tr> <td colspan="2"><a href="#" onclick="agregar_destinatario('todos','agregar');return false;" >  >Agregar Todos  </a></td></tr>


            <tr> <td colspan="2"> <a href="#" onclick="agregar_destinatario('todos','quitar');return false;" >  >Quitar Todos  </a> </td></tr>

        <?php
                $i=0;
            while($fila = mysql_fetch_array($resultado)){
                 $i++;
                ?>
            

                    <tr class="tr_destinatarios" onclick="seleccionar(this,'<?php echo $i?>')" id="tr_<?php echo $i?>">
                        <td> <input type="checkbox" value=""  id="check_<?php echo $i?>" onclick="seleccionar(this)"/>  </td>
                        <td><a href="#" id="mail_<?php echo $i?>" onclick="return false;" title="<?php echo $fila['usr_mail']?>"> <?php echo ucfirst(strtolower($fila['usr_raz']))?> </a></td>
                    </tr>

                    
                 <?php 
                       
                 }

                 mysql_close($conn2);
            ?>
                    </table>
                    <input type="hidden" name="cant" id="cant" value="<?php echo $i?>">

    </body>
</html>