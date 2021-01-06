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
	function seleccionar(form,a){
	
		var i;
		var existe_seleccion=0;
		
		total=eval('document.'+form+'.'+a+'.options.length');
	
		for (i=0;i<total;i++){
	
				if (eval("document."+form+"."+a+".options["+i+"].text")){
					(eval("document."+form+"."+a+".options["+i+"].selected = 'TRUE'"));
					
				}
	
		}
	
	}


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
      
    <form id="informesPrp" name="informesPrp" method="post" >
      <input type="hidden" name="fileXMLListado" value="<?php echo _FILE_XML_INF_LISTADO; ?>"  />
	<input type="hidden" name="fileXMLHead" value="<?php echo _FILE_XML_INF_HEAD; ?>"  />
	<input type="hidden" name="tipo_inf" value="<?php echo $tipo_inf ?>"  />
	<input type="hidden" name="propiedades_personal" value="<?php echo $propiedades_personal ?>"  />
	
	
<?php

if($tipo_inf!="tasaciones"){
	if(isset($fileXML) && isset($fileXSL)){
		$new_xsl = new MM_XSLTransform();
		$new_xsl->setXML($fileXML."?tipo_inf=$tipo_inf&usr_id=$usr_id");
		$new_xsl->setXSL($fileXSL);
		$new_xsl->addParameter("destino1","generico_listado");
		$new_xsl->addParameter("titulo","Informe de $tipo_inf");
		$new_xsl->addParameter("url",_FILE_PHP_GENERICO_LISTADOS);
		$new_xsl->addParameter("parametros","mod_inf");
		$new_xsl->addParameter("fileCalendario",_FILE_PHP_MEN_CALENDARIO."&usr_id=".$usr_id);
		echo $new_xsl->Transform();
	}
}else{
	?>
	 
	 <input type="hidden" name="fileXSLListado" value="<?php echo _FILE_XSL_INF_LIST_TASA ?>" />
	
	<?php
	if(isset($fileXML) && isset($fileXSL)){
		$new_xsl = new MM_XSLTransform();
		$new_xsl->setXML($fileXML."?tipo_inf=$tipo_inf&usr_id=$usr_id");
		$new_xsl->setXSL($fileXSL);
		$new_xsl->addParameter("destino1","generico_listado");
		$new_xsl->addParameter("titulo","Informe de $tipo_inf");
		$new_xsl->addParameter("url",_FILE_PHP_INF_LIST_TASA);
		$new_xsl->addParameter("parametros","mod_inf");
		$new_xsl->addParameter("fileCalendario",_FILE_PHP_MEN_CALENDARIO);
		echo $new_xsl->Transform();
	}
	
}
?>
</form>
</td>
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