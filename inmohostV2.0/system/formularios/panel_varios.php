<?php 


	include ("../php/config.php");
	
	
 switch ($op) {
     default:
			$titulo = "Listar Varios"; //
			$destino1 = "generico_listado"; // listadoPropiedades
			$url1 = _FILE_PHP_GENERICO_LISTADOS;
			$parametros = "mod_edit";
         break;
         //
 }
?>
<table width="240" border="0" align="center" cellpadding="0" cellspacing="0" id="tablaMorir">
  <tr>
    <td><form id="FormPanelVarios" name="FormPanelVarios" method="post" action="">
	<input type="hidden" name="fileXMLListado" value="<?php echo _FILE_XML_TEL_LISTADO; ?>"  />
	<input type="hidden" name="fileXMLHead" value="<?php echo _FILE_XML_TEL_HEAD; ?>"  />
      <table width="100%" border="0" cellpadding="1" cellspacing="1">
        <tr>
          <td colspan="2">
            <h1 align="left">Varios</h1>
			<hr />			</td>
          </tr>
        
        <tr>
         <td valign="top"><div align="center">
                 <?php if($usr_id!=2128){?>
                 <a href="javascript:display('menuPrincipal');ventana('panel_control','&amp;fileXML=<?php echo _FILE_XML_PANEL_PARAMETROS; ?>&amp;fileXSL=<?php echo _FILE_XSL_PANEL_PARAMETROS; ?>', '<?php echo _FILE_PHP_PANEL; ?>', 'Panel de Control - Parametros');" class="menuItem"><img src="interfaz/inmohost/images/iconos/32/configurar.png" width="32" height="32" border="0" /><br />
            Parametros</a>
                <?php } ?>
                </div></td>
          <td width="50%" valign="top"><div align="center"><a href="javascript:traeURL('<? echo _FILE_FORM_PANEL_RUBROS?>?usr_id=<?php echo $usr_id?>', 'contenidoMenuActual5');" class="menuItem" ><img src="interfaz/inmohost/images/iconos/32/rubros.png" width="32" height="32" border="0" /><br />
            Rubros</a></div></td>
        </tr>
        
        <tr>
          <td width="50%" valign="top">
		  <div align="center"><a href="javascript:traeURL('<? echo _FILE_FORM_PANEL_BAR_PRIV?>?usr_id=<?php echo $usr_id?>', 'contenidoMenuActual5');" class="menuItem"><img src="interfaz/inmohost/images/iconos/32/barrios.png" width="32" height="32" border="0" /><br />
            Barrios / Complejos</a></div></td>
          <td valign="top">
          	<div align="center"><a href="javascript:traeURL('<? echo _FILE_FORM_PANEL_SECTORES?>?usr_id=<?php echo $usr_id?>', 'contenidoMenuActual5');" class="menuItem" ><img src="interfaz/inmohost/images/iconos/32/usuario.png" width="32" height="32" border="0" /><br />
            Sectores</a></div></td>
          
        </tr>
        
        
      </table>
        </form>
    </td>
  </tr>
</table>