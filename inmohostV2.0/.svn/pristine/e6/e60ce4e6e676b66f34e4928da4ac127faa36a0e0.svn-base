<?php


	include ("../php/config.php");

 switch ($op) {
     default:
			$titulo = "Listar Consultas"; //
			$destino1 = "generico_listado"; // listadoPropiedades
			$url1 = _FILE_PHP_GENERICO_LISTADOS;
			$parametros = "mod_edit";
         break;
         //
 }
?>
<table width="240" border="0" align="center" cellpadding="0" cellspacing="0" id="tablaMorir">
  <tr>
    <td><form id="FormAgendaConsultas" name="FormAgendaConsultas" method="post" action="">
	<input type="hidden" name="fileXMLListado" value="<?php echo _FILE_XML_CONSULTAS_LISTADO; ?>"  />
	<input type="hidden" name="fileXMLHead" value="<?php echo _FILE_XML_CONSULTAS_HEAD; ?>"  />
	<input type="hidden" name="usr_id" value="<?php echo _USR_ID; ?>"  />
      <table width="100%" border="0" cellpadding="1" cellspacing="1">
        <tr>
          <td width="150%" colspan="3">
            <h1 align="left">Consultas</h1>
			<hr />			</td>
          </tr>
		<tr>
		  <td colspan="3">

		<table width="100%" border="0" cellpadding="1" cellspacing="1" class="tableOscura" id="tablaListarConsultas">
              <tr class="tableClara">
                <td><div align="right">Desde:</div></td>
                <td>
				<input name="desdeConsultas" type="text" id="desdeConsultas" value="00-00-0000" class="inputFecha" readonly />
				<input id="desdeConsultasDia" type="hidden" name="desdeConsultasDia" value="00" />
				<input id="desdeConsultasMes" type="hidden" name="desdeConsultasMes" value="00" />
				<input id="desdeConsultasAno" type="hidden" name="desdeConsultasAno" value="0000" />
                  <a id="iniciaForm" href="javascript:;" title="seleccionar fecha" class="menu" onclick="position(event); toolTip('<?php echo _FILE_PHP_MEN_CALENDARIO; ?>&destino=desdeConsultas&usr_id=<?php echo _USR_ID ?>',this)" tabindex="1"><img src="interfaz/inmohost/images/iconos/calendario.gif" width="16" height="15" border="0" align="absmiddle" /></a>
				  </td>
              </tr>
              <tr class="tableClara">
                <td><div align="right">Hasta:</div></td>
                <td>
                  <input name="hastaConsultas" type="text" id="hastaConsultas" value="00-00-0000" class="inputFecha" readonly />
				<input id="hastaConsultasDia" type="hidden" name="hastaConsultasDia" value="00" />
				<input id="hastaConsultasMes" type="hidden" name="hastaConsultasMes" value="00" />
				<input id="hastaConsultasAno" type="hidden" name="hastaConsultasAno" value="0000" />
                  <a href="javascript:;" title="seleccionar fecha" class="menu" onclick="position(event); toolTip('<?php echo _FILE_PHP_MEN_CALENDARIO; ?>&destino=hastaConsultas&usr_id=<?php echo _USR_ID ?>',this)" tabindex="2"><img src="interfaz/inmohost/images/iconos/calendario.gif" width="16" height="15" border="0" align="absmiddle" /></a>
				  </td>
              </tr>
              <tr class="tableClara">
                <td>
                    <div align="right">Nombre:</div>
                </td>
                <td>
                    <input name="consulta_nombre" type="text" class="inputForm" id="consulta_nombre" style="width:60px" tabindex="7"  onkeypress="if (event.keyCode == 13){chequeaForm('FormAgendaConsultas', '<?php echo $destino1; ?>', '<?php echo $titulo; ?>', '<?php echo $url1; ?>', '<?php echo $parametros; ?>');}" />
                </td>
              </tr>
              <tr class="tableClara">
                <td>
                    <div align="right">E-Mail:</div>
                </td>
                <td>
                    <input name="consulta_email" type="text" class="inputForm" id="consulta_email" style="width:60px" tabindex="7"  onkeypress="if (event.keyCode == 13){chequeaForm('FormAgendaConsultas', '<?php echo $destino1; ?>', '<?php echo $titulo; ?>', '<?php echo $url1; ?>', '<?php echo $parametros; ?>');}" />
                </td>
              </tr>
              <tr class="tableClara">
                <td>
                    <div align="right">Tipo:</div></td>
                <td>
                    <select name="tipo_consulta_id" class="inputForm" tabindex="4" onkeypress="if (event.keyCode == 13){chequeaForm('FormAgendaConsultas', '<?php echo $destino1; ?>', '<?php echo $titulo; ?>', '<?php echo $url1; ?>', '<?php echo $parametros; ?>');}">
                <?php
                /* REGS= ID,Descripcion  */
					$regs=" tipo_consulta_id,tipo_consulta_detalle";
					$tablas=" tipos_consultas ";
					
                                        $filtro="tipo_consulta_id!=4 and tipo_consulta_id!=2";
                                        $db = "inmoclick_database";
                include("../"._FILE_SCRIPT_PHP_SELECT);
                	$regs="";
					$tablas="";
					$filtro="";
					$id="";
					$xtras="";
                                        $db = "";
                ?>
                    </select>
                </td>
              </tr>
              <tr class="tableClara">
                <td>
                    <div align="right">Estado:</div></td>
                <td>
                    <select name="consulta_leida" class="inputForm" tabindex="4" onkeypress="if (event.keyCode == 13){chequeaForm('FormAgendaConsultas', '<?php echo $destino1; ?>', '<?php echo $titulo; ?>', '<?php echo $url1; ?>', '<?php echo $parametros; ?>');}">
                        <option value="-1"> Indistinto </option>
                        <option value="1"> Leidas </option>
                        <option value="0"> Sin Leer </option>
                    </select>
                </td>
              </tr>
              <tr class="tableClara">
                <td><div align="right">Cant. por pagina:</div></td>
                <td>
                    <select style="width:100px" name="offset" class="inputForm" id="offset" tabindex="12" onkeypress="if (event.keyCode == 13){$('prp_id').value=''; chequeaForm('FormAgendaConsultas', '<?php echo $destino1; ?>', '<?php echo $titulo; ?>', '<?php echo $url1; ?>', '<?php echo $parametros; ?>');}" >
                          <option value="10" selected="selected">10</option>
                          <option value="50">50</option>
                          <option value="100">100</option>
                          <option value="500">500</option>
                          <option value="1000">1000</option>
                    </select>


                </td>
              </tr>
              
              <tr class="tableClara">
                <td><div align="right">Prp ID:</div></td>
                <td><input name="prp_id" type="text" class="inputForm" id="prp_id" style="width:60px" tabindex="7"  onkeypress="if (event.keyCode == 13){chequeaForm('FormAgendaConsultas', '<?php echo $destino1; ?>', '<?php echo $titulo; ?>', '<?php echo $url1; ?>', '<?php echo $parametros; ?>');}" /></td>
              </tr>

             <tr class="tableClara">
                <td colspan="2"><div align="right"><input name="listar" type="button" class="botonForm" id="listar" value="Listar" tabindex="8" onclick="chequeaForm('FormAgendaConsultas', '<?php echo $destino1; ?>', '<?php echo $titulo; ?>', '<?php echo $url1; ?>', '<?php echo $parametros; ?>');" onkeypress="if (event.keyCode == 13){chequeaForm('FormAgendaConsultas', '<?php echo $destino1; ?>', '<?php echo $titulo; ?>', '<?php echo $url1; ?>', '<?php echo $parametros; ?>');}" /></div></td>
              </tr>
          </table>
		  </td>
		  </tr>

      </table>
        </form>
    </td>
  </tr>
</table>


