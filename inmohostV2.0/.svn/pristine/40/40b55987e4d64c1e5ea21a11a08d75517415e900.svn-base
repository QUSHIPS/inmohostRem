<?php
	
include ("php/config.php");
include ("php/sec_head.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<script language="javascript" type="text/javascript" src="<?php echo _FILE_JAVASCRIPT_RSS; ?>"></script>
<?php
	include("head.php");
	
	$conn_id = @ftp_connect($INTERNET_HOST); 
	$login = @ftp_login($conn_id,$INTERNET_USR,$INTERNET_PASS); 
	ftp_pasv($conn_id,1);
	
?>
</head>
<body>
<table width="100%" border="0" cellpadding="1" cellspacing="2">
  <tr>
    <td valign="top" class="tableOscura">
    <?
		if ($conn_id&&$login) {
		
			//if(_USR_CIM==1){
					
					$upload = ftp_get($conn_id,"actualizar_usrs_5.php","$INTERNET_DIR/inmo$usr_id/actualizar_usrs_5.php",FTP_BINARY); 
					$upload2 = ftp_get($conn_id,"../descargar_5.php","$INTERNET_DIR/inmo$usr_id/descargar_5.php",FTP_BINARY); 
					//sleep(3);

					if (!$upload || !$upload2){ 
					    echo "La actualizacion de la red cim no se llevo a cabo<br>";
					 	exit;
					}
					?>
					<script languaje=javascript>
						location.href="actualizar_usrs_5.php?usr_id=<?print _USR_ID?>";
					</script>

				<?
				
			/*	
			}else{
				
					ftp_pasv($conn_id,1);
					
					$upload = @ftp_get($conn_id,"../descargar_5.php","$INTERNET_DIR/inmo$usr_id/descargar_5.php",FTP_BINARY); 
				
					if (!$upload){ 
					    echo "La actualizacion de inmohost no se llevo a cabo. Vuelta a intentar<br>";
					exit;
					}
					?>
					
					<script languaje=javascript>
						location.href="../descargar_5.php?usr_id=<?print _USR_ID?>";
					</script>

				<?
			}*/
			
		}else{
		?>
					No se pudo realizar la conexion para descargar los archivos de actualizacion
					<?exit;?>
			<?
		}
			?>
    
    </td>
  </tr>
	
</table>
</body>
</html>