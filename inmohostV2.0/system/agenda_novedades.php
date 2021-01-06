<?php

	
	include ("php/config.php");
	include ("php/sec_head.php");
        extract($_GET);
        extract($_POST);
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
<script language="javascript" type="text/javascript" src="<?php echo _FILE_JAVASCRIPT_TOOLTIP; ?>"></script>

<script language="JavaScript">
	
	function agrega_nov(){
			desc=document.agendaNovedadAgregar.nov_desc.value;
			de=document.agendaNovedadAgregar.emp_desde.options[document.agendaNovedadAgregar.emp_desde.selectedIndex].value;
			a=document.agendaNovedadAgregar.emp_desde.options[document.agendaNovedadAgregar.emp_desde.selectedIndex].value;
			if(desc!=''&&de){
				//alert(document.agendaNovedadAgregar.mod_tip.value);			
				document.agendaNovedadAgregar.submit();
			}else{
				alert("Complete los datos del formulario");
			}
	}

	
</script>
</head>
<body>


  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr >
      <td colspan="2"><h1>&nbsp;</h1></td>
    </tr>
    <tr >
      <td colspan="2">
<?php
	if(isset($fileXML) && isset($fileXSL)){

                echo $usr_login;
		
		$new_xsl = new MM_XSLTransform();
		$new_xsl->addParameter(novedades_mensajes,_FILE_PHP_ABM_MENS_NOV);
		$new_xsl->setXML($fileXML."&usr_id="._USR_ID);
		$new_xsl->setXSL($fileXSL);
		echo $new_xsl->Transform();
	}
?></td>
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