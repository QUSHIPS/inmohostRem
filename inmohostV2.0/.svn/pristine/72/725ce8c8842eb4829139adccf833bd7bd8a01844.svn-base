<?php


	include ("../php/config.php");

 switch ($op) {
     default:
			$titulo = "Listar Visitas"; //
			$destino1 = "generico_listado"; // listadoPropiedades
			$url1 = _FILE_PHP_GENERICO_LISTADOS;
			$parametros = "mod_edit";
         break;
         //
 }
?>
<table width="240" border="0" align="center" cellpadding="0" cellspacing="0" id="tablaMorir">
  <tr>
    <td><form id="FormAgendaVisitas" name="FormAgendaVisitas" method="post" action="">
	<input type="hidden" name="fileXMLListado" value="<?php echo _FILE_XML_VISITAS_LISTADO; ?>"  />
	<input type="hidden" name="fileXMLHead" value="<?php echo _FILE_XML_VISITAS_HEAD; ?>"  />
	<input type="hidden" name="usr_id" value="<?php echo _USR_ID; ?>"  />
      <table width="100%" border="0" cellpadding="1" cellspacing="1">
        <tr>
          <td width="150%" colspan="3">
            <h1 align="left">Reporte de Visitas a mis inmuebles</h1>
			<hr />			</td>
          </tr>
		<tr>
		  <td colspan="3">

		<table width="100%" border="0" cellpadding="1" cellspacing="1" class="tableOscura" id="tablaListarVisitas">
              <tr class="tableClara">
                <td><div align="right">Desde:</div></td>
                <td>
				<input name="desdeVisitas" type="text" id="desdeVisitas" value="00-00-0000" class="inputFecha" readonly />
				<input id="desdeVisitasDia" type="hidden" name="desdeVisitasDia" value="00" />
				<input id="desdeVisitasMes" type="hidden" name="desdeVisitasMes" value="00" />
				<input id="desdeVisitasAno" type="hidden" name="desdeVisitasAno" value="0000" />
                  <a id="iniciaForm" href="javascript:;" title="seleccionar fecha" class="menu" onclick="position(event); toolTip('<?php echo _FILE_PHP_MEN_CALENDARIO; ?>&destino=desdeVisitas&usr_id=<?php echo _USR_ID ?>',this)" tabindex="1"><img src="interfaz/inmohost/images/iconos/calendario.gif" width="16" height="15" border="0" align="absmiddle" /></a>
				  </td>
              </tr>
              <tr class="tableClara">
                <td><div align="right">Hasta:</div></td>
                <td>
                  <input name="hastaVisitas" type="text" id="hastaVisitas" value="00-00-0000" class="inputFecha" readonly />
				<input id="hastaVisitasDia" type="hidden" name="hastaVisitasDia" value="00" />
				<input id="hastaVisitasMes" type="hidden" name="hastaVisitasMes" value="00" />
				<input id="hastaVisitasAno" type="hidden" name="hastaVisitasAno" value="0000" />
                  <a href="javascript:;" title="seleccionar fecha" class="menu" onclick="position(event); toolTip('<?php echo _FILE_PHP_MEN_CALENDARIO; ?>&destino=hastaVisitas&usr_id=<?php echo _USR_ID ?>',this)" tabindex="2"><img src="interfaz/inmohost/images/iconos/calendario.gif" width="16" height="15" border="0" align="absmiddle" /></a>
				  </td>
              </tr>
             <tr class="tableClara">
                <td><div align="right">Inmueble:</div></td>
                <td>
			<select name="tip_id" class="inputForm" tabindex="3" onkeypress="if (event.keyCode == 13){chequeaForm('FormAgendaTasaciones', '<?php echo $destino1; ?>', '<?php echo $titulo; ?>', '<?php echo $url1; ?>', '<?php echo $parametros; ?>');}">
                <?php
                /* REGS= ID,Descripcion  */
					$regs=" tip_id,tip_desc ";
					$tablas=" tipo_const ";
					$id=$usr_id;
					$xtras=" order by tip_desc ASC";
                include("../"._FILE_SCRIPT_PHP_SELECT);
                	$regs="";
					$tablas="";
					$filtro="";
					$id="";
					$xtras="";
                ?>
			</select>				</td>
              </tr>
              <tr class="tableClara">
                <td><div align="right">En:</div></td>
                <td>
				<select name="con_id" class="inputForm" tabindex="4" onkeypress="if (event.keyCode == 13){chequeaForm('FormAgendaVisitas', '<?php echo $destino1; ?>', '<?php echo $titulo; ?>', '<?php echo $url1; ?>', '<?php echo $parametros; ?>');}">
                <?php
                /* REGS= ID,Descripcion  */
					$regs=" con_id,con_desc ";
					$tablas=" condiciones ";
					$xtras=" order by con_desc ASC";
                include("../"._FILE_SCRIPT_PHP_SELECT);
                	$regs="";
					$tablas="";
					$filtro="";
					$id="";
					$xtras="";
                ?>
                                    </select>                </td>
              </tr>
              <tr class="tableClara">
                <td><div align="right">Estado:</div></td>
                <td>
				<select style="width:190px" name='estado' class="inputForm"  id='estado'>
          			<option value='0'>Indistinto</option>
          			<option value='2'>Alquilada/Vendida</option>
          			<option value='1' selected="true">Mostrar</option>
          			<option value='3'>Suspendida</option></select>            </td>
              </tr>
              
              <tr class="tableClara">
                <td><div align="right">Prp ID:</div></td>
                <td><input name="prp_id" type="text" class="inputForm" id="prp_id" style="width:60px" tabindex="7"  onkeypress="if (event.keyCode == 13){chequeaForm('FormAgendaVisitas', '<?php echo $destino1; ?>', '<?php echo $titulo; ?>', '<?php echo $url1; ?>', '<?php echo $parametros; ?>');}" /></td>
              </tr>

              <tr class="tableClara">
                <td><div align="right">Cant. por pagina:</div></td>
                <td>
                    <select style="width:100px" name="offset" class="inputForm" id="offset" tabindex="12" onkeypress="if (event.keyCode == 13){$('prp_id').value=''; chequeaForm('FormAgendaVisitas', '<?php echo $destino1; ?>', '<?php echo $titulo; ?>', '<?php echo $url1; ?>', '<?php echo $parametros; ?>');}" >
                          <option value="10" selected="selected">10</option>
                          <option value="50">50</option>
                          <option value="100">100</option>
                          <option value="500">500</option>
                          <option value="1000">1000</option>
                    </select>


                </td>
              </tr>




             <tr class="tableClara">
                <td colspan="2"><div align="right"><input name="listar" type="button" class="botonForm" id="listar" value="Listar" tabindex="8" onclick="chequeaForm('FormAgendaVisitas', '<?php echo $destino1; ?>', '<?php echo $titulo; ?>', '<?php echo $url1; ?>', '<?php echo $parametros; ?>');" onkeypress="if (event.keyCode == 13){chequeaForm('FormAgendaVisitas', '<?php echo $destino1; ?>', '<?php echo $titulo; ?>', '<?php echo $url1; ?>', '<?php echo $parametros; ?>');}" /></div></td>
              </tr>
          </table>
		  </td>
		  </tr>

      </table>
        </form>
    </td>
  </tr>
</table>


