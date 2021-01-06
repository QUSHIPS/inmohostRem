<?php

	
	include ("php/config.php");
	include ("php/sec_head.php");

	//libreria de dreamwaeaver XLST para inclucion de archivos de XML con XSLT
	include(_FILE_XSL_CLASS);
	
	// cambio la hoja de estylos por defecto
	$otraCSS = "styleInterno.css";

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
	var paginaCitasActual = "<?php echo $_SERVER['PHP_SELF']; ?>?usr_id=<?php echo $usr_id; ?>";
</script>
<script language="javascript" type="text/javascript" src="<?php echo _FILE_JAVASCRIPT_TOOLTIP; ?>"></script>
</head>
<body>

<form id="agendaCitaEditar" name="agendaCitaEditar" method="post" action="<?php print _FILE_PHP_ABM_MENS_CITAS;?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr >
      <td colspan="2"><h1>&nbsp;</h1></td>
    </tr>
    <tr >
      <td colspan="2">
<?php

	$fileXML = _FILE_XML_AGENDA_CITAS_EDIT."?cita_id=$cita_id&usr_id=$usr_id";
	$fileXSL = _FILE_XSL_AGENDA_CITAS_EDIT;
	if(isset($fileXML) && isset($fileXSL)){
		$new_xsl = new MM_XSLTransform();
		$new_xsl->setXML($fileXML);
		$new_xsl->setXSL($fileXSL);
		$new_xsl->addParameter("usr_id", $usr_id);
		$new_xsl->addParameter("FILECALENDARIO", _FILE_PHP_MEN_CALENDARIO."&usr_id=".$usr_id);
		$new_xsl->addParameter("ABMCITAS", _FILE_PHP_ABM_MENS_CITAS);
		$new_xsl->addParameter("cita_id", $cita_id);
		$new_xsl->addParameter("desdeCitas", $desdeCitas);
		$new_xsl->addParameter("desdeCitasDia", $desdeCitasDia);
		$new_xsl->addParameter("desdeCitasMes", $desdeCitasMes);
		$new_xsl->addParameter("desdeCitasAno", $desdeCitasAno);
		$new_xsl->addparameter("hastaCitas", $hastaCitas);
		$new_xsl->addparameter("hastaCitasDia", $hastaCitasDia);
		$new_xsl->addparameter("hastaCitasMes", $hastaCitasMes);
		$new_xsl->addparameter("hastaCitasAno", $hastaCitasAno);
		$new_xsl->addparameter("ventanaDesde", $ventanaDesde);
		
		echo $new_xsl->Transform();
	}
?></td>
    </tr>
  </table>
</form>
<br />
<br />
<!--TOOLTIP-->
<div id="toolTipBox">
<iframe id="iframeToolTip" name="iframeToolTip" src="about:blank" scrolling="no" frameborder="0" style="margin:0px; padding:0px; border:none;" ></iframe>
</div>
<!--FIN TOOLTIP-->
</body>
</html>