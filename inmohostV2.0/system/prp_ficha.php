<?php
	include ("php/config.php");
	include ("php/sec_head.php");
        include ("php/configFileUpload.php");


//var_dump($_SESSION);
	//libreria de dreamwaeaver XLST para inclucion de archivos de XML con XSLT
	include(_FILE_XSL_CLASS);
	
	// cambio la hoja de estylos por defecto
	$otraCSS = "styleInterno.css";
        
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>INMOHOST</title>
<?php
	include("head.php");
?>

<script language="JavaScript1.2" type="text/javascript" src="./javascript/jquery/jquery-1.7.1.min.js"></script>

<script language="javascript" type="text/javascript" src="<?php echo _FILE_JAVASCRIPT_SWF_OBJECT; ?>"></script>

<!--MENUEXTRA-->
<!--<script language="JavaScript1.2" type="text/javascript" src="<?php echo _FILE_JAVASCRIPT_MENUEXTRA; ?>"></script>-->
<?php echo "<style type=\"text/css\" media=\"screen\">
	//@import url(\""._FILE_CSS_MENUEXTRA."\");
</style>\n"; ?>
<!--//MENUEXTRA-->
<script language="JavaScript">
//parent.document.getElementById('propiedad_content').window.print();
</script>

<script language="javascript" type="text/javascript" src="<?php echo _FILE_JAVASCRIPT_TOOLTIP; ?>"></script>
<script language="javascript" type="text/javascript" src="<?php echo _FILE_JAVASCRIPT_ADDGALERY; ?>?cache=111"></script>

<link rel="stylesheet" type="text/css" media="print" href="../interfaz/inmohost/css/styleInternoPrint.css" />
<link rel="stylesheet" type="text/css" href="<?php echo _FILE_CSS_ADDGALERY?>">

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

</script>
<link rel="image_src" href="http://www.inmoclick.com.ar/ftp_inmohost/fotos/<?php echo $prp_id?>-<?php echo $usr_id?>-1.gif" />  


<?php
if($imprimir){
?>
<body onload="focus();print();">
<?php
}else{
	echo "<body>";
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
        <table> <tr class="tr3"><td>  <?php (isset($mensaje))?print $mensaje:print ""?> </td> </tr></table>
<?php
       // $datos_propietario = traer_usuario($usr_id);


        if($MAIL_SMTP && $MAIL_USR && $MAIL_PASS){
            $enviarMail=1;
        }else{
            $enviarMail=0;
        }

        
        $url_recomendar_facebook = str_replace(array('$prp_id','$usr_id','$descripcion'), array($prp_id,$usr_id,'propiedad'), $URL_RECOMENDAR_FACEBOOK);
       
	//echo $datos_propietario;
	// Para que muestre los servicios
	$query=$_SERVER['QUERY_STRING']."&mod_tip=edit";
        //echo $query;
	$Item_xsl = new MM_XSLTransform();
	$usr_id_prp=substr($query,(strpos($query,"&usr_id=")+8),(strpos($query,"&mod_tip="))-(strpos($query,"&usr_id=")+8));
	$Item_xsl->setXML(_FILE_XML_PRP_FICHA."?".$query);
//        echo _FILE_XML_PRP_FICHA."?".$query;
	$Item_xsl->setXSL(_FILE_XSL_PRP_FICHA);
	$Item_xsl->addParameter("prp_fotosXML", _PROXY); //_FILE_XML_PRP_FOTOS."?prp_id=$prp_id&usr_id=$usr_id&mod_edit=$mod_edit");
	$Item_xsl->addParameter("mod_edit", $mod_edit);
	$Item_xsl->addParameter("prp_id", $prp_id);
	$Item_xsl->addParameter("mod_tip", $mod_tip);
	$Item_xsl->addParameter("usr_id", $usr_id);
	$Item_xsl->addParameter("usr_id_prp", $usr_id_prp."-".$usr_id);
	$Item_xsl->addParameter("imp_foto", $imp_foto);
	$Item_xsl->addParameter("usr_id_propiedad", $usr_id_prp);
        $Item_xsl->addParameter("url_fotos_inmoclick", _URL_FOTOS_INMOCLICK);
        
        if($usr_id_prp == $usr_id){
            $Item_xsl->addParameter("url_recomendar_facebook",  $url_recomendar_facebook);
        }else{
            $Item_xsl->addParameter("url_recomendar_facebook",  0);
        }
        
	
	
	if($imprimir){
		$Item_xsl->addParameter("display", "none");
		$Item_xsl->addParameter("border", "1");
	}else{
		$Item_xsl->addParameter("display", "");
		$Item_xsl->addParameter("border", "0");
	}
	$Item_xsl->addParameter("fileFicha", _FILE_PHP_PRP_FICHA);
	$Item_xsl->addParameter("fileFichaEdit", _FILE_PHP_PRP_FICHA_EDIT);
	$Item_xsl->addParameter("fileBarPrivXML", _FILE_XML_BAR_PRIV_DET);
	$Item_xsl->addParameter("fileBarPrivXSL", _FILE_XSL_BAR_PRIV_DET);
	$Item_xsl->addParameter("fileBarPrivPHP", _FILE_PHP_BAR_PRIV_DET);

	
	$Item_xsl->addParameter("rutaFotos", $rutaAbsolutaFichaFoto);
	
	
	$Item_xsl->addParameter("fileFichaEstado", _FILE_PHP_PRP_LISTADO);
	$Item_xsl->addParameter("fileCita", _FILE_PHP_AGENDA_CITAS);
	
	$Item_xsl->addParameter("fileExportar", _FILE_PHP_EXPORTACION);
	$Item_xsl->addParameter("filePropietario", _FILE_PRP_PROPIETARIOS."?prp_id=$prp_id&usr_id=$usr_id");
        
	$Item_xsl->addParameter("enviarMail", $enviarMail);
	echo $Item_xsl->Transform();
?>	</td>
  </tr>
</table>
    
    
    
    <script language="javascript">
    
            jQuery.noConflict();
jQuery(document).ready(function(jQuery) {
    
             if(jQuery('.ad-gallery')){
                                         
                                         console.log('entra');
                    jQuery('.ad-gallery').adGallery({
                        loader_image: _IMAGENES_ADD_GALERY + 'loader.gif',
                        update_window_hash: false,
                        display_back_and_forward: false,
                                            
                        callbacks: {
                            init: function() {
                                this.preloadAll(); //PRELOAD DE TODAS LAS IMAGENES
                            }
                        }
                    });
                }
    
});
    </script>
    <?php // echo 'propiedad'.$_GET['limite_propiedad_excedido']?>
    <?php if($limite_propiedad_excedido==1&&$usr_id!=2128){?>
        <script language="javascript">
        
            msg = 'MENSAJE IMPORTANTE: Ud. posee un total de <?php echo $cantidad_propiedades?> inmuebles,\n\n\
                         recuerde que su limite maximo de inmuebles es de <?php echo $cantidad_maxima_propiedades?>.\n\
                     Para poder seguir cargando inmuebles debe considerar cambiar de plan. \n\
                        <a target="_blank" href="http://www.inmoclick.com.ar/es/consulta-servicio-profesional.html?tipo_plan=Plan Plus&usr_id=<?php echo $usr_id?>">VER PLANES</a>';
            parent.Dialog.alert(msg, {windowParameters: {className:'alert', width:400, height:200}});	


   
        </script>
    
            <?php 
            
                $cadena = "select usr_raz,usr_mail from usuarios where usr_id = ".$usr_id;
                $result = mysql_query($cadena);
                $usr_raz = mysql_result($result, 0,0);
                $usr_mail = mysql_result($result, 0,1);
                enviar_alerta($usr_id,$usr_raz,$usr_mail);
            ?>
    
    <?php }?>
<!--TOOLTIP-->
<div id="toolTipBox">
<iframe id="iframeToolTip" name="iframeToolTip" src="about:blank" scrolling="no" frameborder="0" style="margin:0px; padding:0px; border:none;" ></iframe>
</div>
<!--FIN TOOLTIP-->
</body>
</html>

<?php
function enviar_alerta($usr_id,$usr_raz,$usr_mail) {

    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $headers .= 'From: inmohost@inmoclick.com.ar' . "\r\n" .
            'Reply-To: marcos.herrera@inmoclick.com.ar' . "\r\n";

       $body.='<table><tr>
				<td>
				<table width="100%">
						<tr><b>Datos del usuario:</b></td></tr>
                                                <tr><td>ID:</td><td> '.$usr_id.'</td></tr>
                                                <tr><td>Razon Social:</td><td>'.$usr_raz.' </td></tr>
                                                <tr><td>Email:</td><td>'.$usr_mail.' </td></tr>
                                                  ';  
				    	$body.='
				    	</table>
						</td>
					</tr></table>';
    //echo $cadena;
    if (strstr($_SERVER['HTTP_HOST'], 'www.inmohost.com.ar')) {
        mail('marcos.herrera@inmoclick.com.ar', 'El usuario '.$usr_raz.' ha excedido su limite de propiedades', $body, $headers);
        mail('info@puntosero.com', 'El usuario '.$usr_raz.' ha excedido su limite de propiedades', $body, $headers);
    }
}
?>