<?php

	$rutaSystema = "system/";
	$rutaInterfaz = "interfaz/";
	$pagina_login=1;
	include ($rutaSystema."php/config.php");
        
        if(!strstr($_SERVER['HTTP_HOST'], 'www')&&!strstr($_SERVER['HTTP_HOST'], '192')&&!strstr($_SERVER['HTTP_HOST'], 'localhost')){
           header("Location: http://localhost/inmohost/online/inmohostV2.0/?usr_id=".$usr_id);
        }

        if($usr_id!=2128){
            $conexion_inmoclick=mysql_connect("localhost","inmoclick_root","uv0282-*");
            mysql_select_db("inmoclick_database_old",$conexion_inmoclick);
            $result = mysql_query("select usr_activo from usuarios where usr_id=$usr_id",$conexion_inmoclick);
            $visible = mysql_result($result, 0,0);
            $plan = mysql_query("select servicio_x_usuario_valor from servicios_x_usuarios where usr_id=".$usr_id." and servicio_usuario_id=5");
            $plan_inmohost = mysql_result($plan, 0,0);
            mysql_close($conexion_inmoclick);
        }else{
            $visible=1;
        }
        $mensaje = false;
        $visible = 0;
       /* $mensaje = ' <p>ESTIMADOS USUARIOS, ESTAMOS REALIZANDO ALGUNAS MEJORAS Y TAREAS DE MANTENIMIENTO.</p>
            <p>POR EL MOMENTO NO SE PUEDE ACCEDER AL SISTEMA. </p> 
            <p>EN UNOS INSTANTES EL SERVICIO ESTARA FUNCIONANDO. LE AGRADECEMOS POR SU PACIENCIA. MUCHAS GRACIAS</p> 
            <p>ATTE. EQUIPO INMOCLICK</p> ';*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" " http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Inmohost</title>
<head>
<?php include($rutaSystema."head.php"); ?>
<script type="text/javascript">
		var url_login = "login_ajax.php";
		var what = "LoginStatus(req.responseText)";
		function CheckLogin()
		{
			var username = document.getElementById("user").value;
			var password = document.getElementById("pass").value;

			DoCallback("usuario="+username+"&pass="+password);
		}
		function LoginStatus(Status)
		{
			if(Status == 0)
				alert("Nombre de usuario o contrase�a incorrectos");
			else
				document.ingreso.submit();
		}
</script>
</head>
<body onload="document.getElementById('ingresar').focus(); fondoDegradado('<?php echo $_INMO_COLOR1; ?>', '<?php echo $_INMO_COLOR2; ?>');"  onresize="fondoDegradado('<?php echo $_INMO_COLOR1; ?>', '<?php echo $_INMO_COLOR2; ?>');">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>      
   
    <table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="bottom"><img src="interfaz/inmohost/images/logo.png" alt="Inmohost" width="295" height="72" /></td>
        </tr>
        <tr>
          <td><form id="ingreso" name="ingreso" method="post" action="<?php print $rutaAbsoluta."inmohost.php" ?>">
            <table width="200" border="0" align="center" cellpadding="0" cellspacing="5">
             
              <tr>
                <td colspan="2"><div align="center">
                       <?php  if($visible): ?>
                        
                          <?php if($plan_inmohost == 1 || ($usr_id != 2489)){?>
                        
                                <input name="ingresar" type="button" class="botonForm" id="ingresar" value="Ingresar" tabindex="3" onclick="javascript:abreWindow('login.php?pagina_login=1&usr_id=<?php echo $usr_id?>','INMOHOST','780', '600', 'no');" />
                          <?php }else{?>      
                                <table style="border:2px solid red;color:#FFF;" width="700px;">
                                   <tr>
                                       <td style="color:#FFF;text-align:center;">  <b> Estimado Usuario. 
                                               
                                               Para poder ingresar a su panel debe dirigirse a <a style="color:#FFF;text-decoration: underline;" href="http://www.inmoclick.com.ar/es/usuarios/iniciar-sesion.html">www.inmoclick.com.ar </a>, y luego ingresar su 
                                                        usuario y contraseña. 
                                                                             
                                                                                     <BR/>
                                                                                       <BR/>
                                           </b></td>
                                   </tr>
                                   <tr>      <td style="color:#FFF;text-align:center;"> <b>Cualquier duda comuniquese a los telefonos: 4527086 - 156674885. </b></td></tr>
                                   <tr>         <td style="color:#FFF;text-align:center;"><b> O envienos un email a info@inmoclick.com.ar</b> </td></tr>
                                   <tr><td style="color:#FFF;text-align:center;"><b> Atte. Equipo Inmoclick</b> </td>
                                       </tr>
                                   <a href="../../prueba.php"></a>
                               </table>
                                
                          <?php }?>      
                       <?php else:?>
                                
                                        <input name="ingresar" type="hidden" class="botonForm" id="ingresar" value="Ingresar" tabindex="3"/>

                                        <table style="border:2px solid red;color:#FFF;" width="700px;">
                                            <tr>
                                                <td style="color:#FFF;text-align:center;">  <b> 
                                                        <?php if(!$mensaje):?>
                                                                                 ESTIMADO CLIENTE, EL SISTEMA INMOHOST SE ENCUENTRA MOMENTANEAMENTE DESHABILITADO
                                                                                    POR TAREAS DE MANTENIMIENTO. EN BREVE ESTARA OPERATIVO NUEVAMENTE.
                                                                                    
                                                                                    GRACIAS POR SU COMPRESION.


<!--                                                                                                     ESTO PUEDE DEBERSE A VARIOS MOTIVOS:
                                                                                                 - TAREAS DE MANTENIMIENTO<BR/>
                                                                                                 - ALGUN ERROR QUE ESTE CAUSANDO QUE EL SITIO NO PUEDA VERSE CORRECTAMENTE
                                                                                                 - FALTA DE PAGO (Recuerde que el vencimiento del servicio es al dia 15 de cada mes)

                                                                                                 <BR/>
                                                                                                 -- EN EL TRANSCURSO DE LA MAÑANA ESTARA SOLUCIONADO-->
                                                       <?php else:?>
                                                                        <?php echo $mensaje ?>                         
                                                                                                 
                                                       <?php endif?>
                                                    </b></td>
                                            </tr>
                                            <tr>      <td style="color:#FFF;text-align:center;"> <b>CUALQUIER DUDA PUEDE COMUNICARSE A LOS TELEFONOS: 4527086 - 156674885. </b></td></tr>
                                            <tr>         <td style="color:#FFF;text-align:center;"><b> O ENVIENOS UN E-MAIL A info@inmoclick.com.ar</b> </td></tr>
                                            <tr>         <td style="color:#FFF;text-align:center;"><b> LE ROGAMOS SEPAN DISCULPAR LAS MOLESTIAS</b> </td></tr>
                                            <tr><td style="color:#FFF;text-align:center;"><b> ATTE. EQUIPO INMOCLICK</b> </td>
                                                </tr>
                                        </table>

                                                </td> </tr>

                                        </table>

                       
                       <?php endif?>
                </div>

                </td>
              </tr>
            </table>
          </form></td>
        </tr>
      </table></td></tr>
</table>

<!--FONDO DREGRADADO-->
<div style="position: relative;">
	<div id="fondoDegradado" style="position:absolute; top:0; left:0;"></div>
	<div id="general" style="position:absolute; top:0; left:0;"></div>
</div>
<!--FIN FONDO DREGRADADO-->


</body>
</html>
