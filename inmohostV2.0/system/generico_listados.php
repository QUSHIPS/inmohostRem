<?php

	
	include ("php/config.php");
	include ("php/sec_head.php");

	//libreria de dreamwaeaver XLST para inclucion de archivos de XML con XSLT
	include(_FILE_XSL_CLASS);
	
	// cambio la hoja de estylos por defecto
	$otraCSS = "styleInterno.css";
	
	//Recibe 3 valores
	// $fileXMLHead => archivo xml.php con la estructura
	// $fileXMLListado => archivo xml.php con los datos
	// $mod_edit => tipo de edicion a utilizar en _FILE_JAVASCRIPT_LISTADO

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>INMOHOST</title>
<?php

	include("head.php");
?>
<script language="javascript" type="text/javascript">

var prpQuery = "<?php echo $_SERVER['QUERY_STRING']; ?>&usr_id=<?php echo $usr_id?>";// globalQuery
var prpMod = "<?php echo $_REQUEST['mod_edit']; ?>";// globalQuery
var prpFileListado = "<?php echo $fileXMLListado; ?>";
var fileMenAgendaTelefonoNew = "<?php echo _FILE_AGENDA_MEN_TELEFONO_NEW."?mod_edit=1"; ?>"; // tool tip de telefonos
var fileMenAgendaTelefonoDato = "<?php echo _FILE_AGENDA_MEN_TELEFONO_DATO."?mod_edit=1"; ?>"; // tool tip de telefonos
var filePrpPublicacionesDato = "<?php echo _FILE_PRP_PUBLICACIONES."?mod_edit=1"; ?>"; // tool tip de telefonos
var fileCitasEdit =  "<?php echo _FILE_PHP_AGENDA_CITAS_EDIT."?mod_edit=1"; ?>"; // tool tip de citas a agregar
var fileNotasEdit =  "<?php echo _FILE_PHP_AGENDA_TEL_EDIT."?mod_edit=1"; ?>"; // tool tip de tels editar 
var fileTasEdit =  "<?php echo _FILE_PHP_AGENDA_TAS_EDIT."?mod_edit=1"; ?>"; // tool tip de tas editar 
var fileDemEdit = "<?php echo _FILE_PHP_DEMANDAS_EDIT."?mod_edit=1"; ?>"; // tool tip de Demandas a editar


<?php
	if($fileXMLHead==_FILE_XML_CITAS_HEAD || $fileXMLHead == _FILE_XML_TAS_HEAD || $fileXMLHead == _FILE_XML_NOVEDADES_HEAD || $fileXMLHead == _FILE_XML_DEMANDAS_HEAD || _FILE_XML_CONSULTAS_HEAD){
	?>
	
	parent.ventana('agenda_resumen','', '<?php echo _FILE_PHP_RESUMEN_PRINCIPAL; ?>', 'Resumen de movimentos');
	<?php
	
	}
?>


function marcar_todas(){
       
       for(i=0;i<=document.forms[0].elements.length;i++){
           
           if(document.forms[0][i].type=='checkbox'){
               
               if(document.forms[0][i].checked){
                   document.forms[0][i].checked=false; 
               }else{
                   document.forms[0][i].checked=true; 
               }
              
           }
            
           
       }
    
}

</script>
<script language="javascript" type="text/javascript" src="<?php echo _FILE_JAVASCRIPT_LISTADO; ?>"></script>
<script language="javascript" type="text/javascript" src="<?php echo _FILE_JAVASCRIPT_TOOLTIP; ?>"></script>
<?php echo "<script language='javascript' type='text/javascript' src='"._FILE_JAVASCRIPT_SORTABLE."'></script>\n"; ?>
</head>

<body onload="cargoXML('<?php echo $fileXMLHead; ?>', 'HeadResultados', '', 'head');">
     <form>
<div align="center" id="listadoDatos">
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
    
   

    <?php  if($fileXMLHead != _FILE_XML_VISITAS_HEAD){ ?>

            <tr>
            <td width="50%"><a><h1 onclick="window.parent.window.display('menuPrincipal');"><img src="../interfaz/inmohost/images/iconos/20/buscar.png" alt="Reformular Busqueda" width="20" height="20" hspace="5" border="0" align="absmiddle" />Reformular Busqueda</h1></a>

            </td>

            <td width="50%">
                
                <table width="100%">
                    <tr>
                        <td>
                            <a href="javascript:marcar_todas()"><b>[X] Marcar Todas</b>    </a>
                            </td>
                        <td>
                <div align="right">
                    
                    
                            <h1>resultados encontrados: <span id="prpTotalDatos">&nbsp;</span></h1>
            </div>
                            </td>
                        </tr>
                    </table>
            
            </td>
          </tr>
    <?php }else{?>



           <tr>
                <td width="50%"><a><h1 onclick="window.parent.window.display('menuPrincipal');"><img src="../interfaz/inmohost/images/iconos/20/buscar.png" alt="Reformular Busqueda" width="20" height="20" hspace="5" border="0" align="absmiddle" />Reformular Busqueda</h1></a>

                </td>

                <td width="50%"><div align="right">
                  <h1>resultados encontrados: <span id="prpTotalDatos">&nbsp;</span></h1>
                </div></td>
          </tr>
           <tr>
                <td colspan="2">
                    <h1>Inmuebles publicados con foto: <span id="prp_publicados_con_foto">  </span></h1>
                </td>
          </tr>
          <tr>
                <td colspan="2">
                    <h1>Total de visitas a los inmuebles listados: <span id="prp_visitas_totales">  </span></h1>
                </td>
          </tr>
          <tr>
                <td colspan="2">
                    <h1>Solicitudes de informacion: <span id="prp_sol_inf_totales">  </span></h1>
                </td>
          </tr>
          <tr>
                <td colspan="2">
                    <h1>Interesados (Anotaron su telefono): <span id="prp_sol_fot_totales">  </span></h1>
                </td>
          </tr>
          <tr>
                <td colspan="2">
                    <h1>Fecha &uacute;ltima publicaci&oacute;n: <span id="prp_ultima_publicacion">  </span></h1>
                </td>
          </tr>


    <?php }?>
  <tr>
    <td colspan="2">

	<div align="center">
	  <table width="98%" border="0" cellspacing="1" cellpadding="0" class="tabla" id="HeadResultados">
		<tbody >
		</tbody>
      </table>
    </div>
	</td>
  </tr>
  <tr><td colspan="2"><h1><span id="preCarga"></span></h1></td></tr>
 
  <tr id="prpPaginacion" style="display:none">
    <td colspan="2">
	<h1 align="center">p&aacute;gina actual: <span id="prpPaginaActual">&nbsp;</span> - cantidad por p&aacute;gina: <span id="prpOffset">&nbsp;</span></h1>
	<h1 align="center" id="prpPaginasTotales"></h1>	</td>
  </tr>
  <tr>
    <td align="right">
    	<input name="imprimirBoton" type="button" class="boton" id="imprimirBoton" onclick="if (confirm('Imprimir Listado?')){ window.print(); };" value="Imprimir" />
    </td>
    <?php
    if($fileXMLHead == _FILE_XML_NOVEDADES_HEAD){
    print"
    	<td>
    		<input name=\"LeidasBoton\" type=\"button\" class=\"boton\" id=\"leidasBoton\" onclick=\"marcar_leidas(".$_COOKIE['usuario']['emp_id'].");location.reload();\" value=\"Leidas\" />
	    </td>
	";
    }elseif($fileXMLHead == _FILE_XML_CONSULTAS_HEAD){
    ?>
        <td>
            <img id="img_precarga" style="display:none;" src='http://www.inmohost.com.ar/online/inmohostV2.0/interfaz/inmohost/images/precarga_comun.gif'></img>
            <span id="input_marcar_leidas">
    		<input name="LeidasBoton" type="button" class="boton" id="leidasBoton" onclick="marcar_consultas_leidas('<?php echo $_COOKIE['usuario']['emp_id']?>','<?php echo $offset?>');location.reload();" value="Marcar Leidas" />
            </span>
	    </td>
   <?php
    }else{
    ?>
     <td>
    	<input name="Cerrar" type="button" class="boton" id="imprimirBoton" onclick="parent.Windows.close('generico_listado')" value="Cerrar" />
    </td>
	<?php } ?>
  </tr>

</table>
</div>
<!--TOOLTIP-->
<div id="toolTipBox">
<iframe id="iframeToolTip" name="iframeToolTip" src="about:blank" scrolling="no" frameborder="0" style="margin:0px; padding:0px; border:none;" ></iframe>
</div>
<!--FIN TOOLTIP-->
  </form>
</body>
</html>