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
<script language="javascript" type="text/javascript" src="<?php echo _FILE_JAVASCRIPT_SWF_OBJECT; ?>"></script>

<!--MENUEXTRA-->
<script language="JavaScript1.2" type="text/javascript" src="<?php echo _FILE_JAVASCRIPT_MENUEXTRA; ?>"></script>
<?php echo "<style type=\"text/css\" media=\"screen\">
	@import url(\""._FILE_CSS_MENUEXTRA."\");
</style>\n"; ?>
<!--//MENUEXTRA-->

<script language="javascript" type="text/javascript" src="<?php echo _FILE_JAVASCRIPT_TOOLTIP; ?>"></script>
</head>
<body>
    <?php


           
	//	require("php/classes/class.phpmailer.php");
		require("php/classes/phpmailer/class.smtp.php");
		$errores=false;
		if($to){
                    
                    
                    $to = explode(";",$to);
                    
                    if(count($to)){

                        foreach($to as $mail_dest){
                            if($mail_dest!=''){
                               $mail_dest = trim($mail_dest);
                               if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $mail_dest)){
                                   //print_r($to);
                                 //   echo $mail_dest;
                                    $mail = new PHPMailer();

                                    $mail->IsSMTP(); // set mailer to use SMTP
                                    $mail->Host = $MAIL_SMTP;  // specify main and backup server


                                    $mail->From=$from;
                                    $mail->FromName=$dem_raz;
                                    $mail->AddAddress($mail_dest, $dem_raz);
                                    $mail->AddReplyTo($from);

                                    if($MAIL_REQUIERE_AUTENTICACION){
                                       $mail->SMTPAuth = true;     // turn on SMTP authentication
                                       $mail->Username = $MAIL_USR;  // SMTP username
                                       $mail->Password = $MAIL_PASS; // SMTP password
                                    }
                                    if($MAIL_CONFIGURACION_SSL){
                                        //echo $MAIL_CONFIGURACION_SSL;
                                       $mail->SMTPSecure = $MAIL_CONFIGURACION_SSL;
                                    }
                                    if($MAIL_PUERTO_SMTP){
                                    //    echo $MAIL_PUERTO_SMTP;
                                        $mail->Port = $MAIL_PUERTO_SMTP;
                                    }

                                    $mail->SMTPDebug =0;
                                    $mail->IsHTML(true);


                                    $mail->Subject = $subject;
                                    $mail->Body= stripslashes($msg);
                                    $mail->SetLanguage('en', $ruta_systema.'php/classes/');

                                    if(@!$mail->Send())
                                    {
                                         $errores[] = array("mail"=>$mail_dest, "mensaje"=>"NO SE PUDO ENVIAR EL MENSAJE".$mail->ErrorInfo);
                                    }else{
                                        $exitos[] = array("mail"=>$mail_dest,"mensaje"=>"Enviado");
                                    }

                               }else{
                                   $errores[] = array("mail"=>$mail_dest, "mensaje"=>"NO SE PUDO ENVIAR EL MENSAJE"."E-MAIL INVALIDO");
                               }
                            }
                        }

                    }

                }



?>
    <p> </p>
<table width="100%" border="0" cellspacing="3" cellpadding="3" class="tableClara">

    <tr class="tr1"> <td colspan="2"> Resultados de sus envios  </td> </tr>
    <tr class="tr3"> <td colspan="2">Email enviado a  <?php echo (count($exitos))?> Destinatarios </td> </tr>
    <tr class="tableClara"> <td>Mail</td> <td>Estado</td></tr>


    <?php foreach($exitos as $exito):?>
        <tr> <td> <?php echo $exito['mail']?> </td> <td> <?php echo $exito['mensaje']?> </td></tr>
    <?php endforeach?>

    <?php foreach($errores as $error):?>

        <tr> <td> <?php echo $error['mail']?> </td> <td> <?php echo $error['mensaje']?>. </td></tr>

    <?php endforeach?>
  
</table>
<!--TOOLTIP-->
<div id="toolTipBox">
<iframe id="iframeToolTip" name="iframeToolTip" src="about:blank" scrolling="no" frameborder="0" style="margin:0px; padding:0px; border:none;" ></iframe>
</div>
<!--FIN TOOLTIP-->
</body>
</html>