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

	var fechasSeleccionadas = new Array;
</script>
<script language="javascript" type="text/javascript" src="<?php echo _FILE_JAVASCRIPT_TOOLTIP; ?>"></script>
</head>
<body>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr >
    <td colspan="2"><h1>&nbsp;</h1></td>
  </tr>
  <tr >
    <td colspan="2">
<?php

	$fileXML = _FILE_XML_PRP_PUBLICACIONES;
	$fileXSL = _FILE_XSL_PRP_PUBLICACIONES;

	if(isset($fileXML) && isset($fileXSL)){
		$new_xsl = new MM_XSLTransform();
		$new_xsl->setXML($fileXML."?prp_id=".$prp_id."&dia=".$dia."&mes=".$mes."&ano=".$ano);
		$new_xsl->setXSL($fileXSL);
		$new_xsl->addParameter("fileCalendario", _FILE_PHP_MEN_CALENDARIO);
		$new_xsl->addParameter("prp_usr", $prp_usr);
		$new_xsl->addParameter("FILE_XML_PRP_PUBLICACIONES_RESUMEN_LISTADO", _FILE_XML_PRP_PUBLICACIONES_RESUMEN_LISTADO);
		$new_xsl->addParameter("FILE_XML_PRP_PUBLICACIONES_RESUMEN_HEAD", _FILE_XML_PRP_PUBLICACIONES_RESUMEN_HEAD);
		$new_xsl->addParameter("FILE_PHP_GENERICO_LISTADOS", _FILE_PHP_GENERICO_LISTADOS);
		echo $new_xsl->Transform();
	}
?>	  </td>
  </tr>
</table>
  <br />
<br />
<!--TOOLTIP-->
<div id="toolTipBox">
<iframe id="iframeToolTip" name="iframeToolTip" src="about:blank" scrolling="no" frameborder="0" style="margin:0px; padding:0px; border:none;" ></iframe>
</div>
<!--FIN TOOLTIP-->
</body>
</html>