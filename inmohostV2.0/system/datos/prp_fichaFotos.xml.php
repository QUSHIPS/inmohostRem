<?php 
header("Content-type: application/xml");

	extract ($_GET);
	extract ($_REQUEST);


echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\" ?>";

if(strpos($usr_id,"-")!==false){

    $cadena_usr = explode("-",$usr_id);
    $usr_id_prp = $cadena_usr[0];
    $usr_id = $cadena_usr[1];
 

}

if( isset($usr_id_prp)&&$usr_id!=$usr_id_prp){
    include("../php/conexion_inmoclick.php");
    $cadena="select * from fotos where usr_id=$usr_id_prp and prp_id=$prp_id";
}else{
   include("../php/config.php");
    $cadena="select * from fotos where usr_id=$usr_id and prp_id=$prp_id";
}



$result=mysql_query($cadena);
//if(isset($cache_fotos)){
//    die('################################'.$cache_fotos);
//    exit;
//}

echo "
<XML>
	<img mod_edit=\"$mod_edit\">";
if (!mysql_num_rows($result))
{
	if($usr_id!=_USR_ID){
		print "
				<imagen>
					<src><![CDATA[$prp_id-$usr_id-1.gif?cache_fotos=$cache_fotos]]></src>
					<desc><![CDATA[]]></desc>
					<src2> <![CDATA[http://www.inmoclick.com.ar/ftp_inmohost/fotos/$prp_id-$usr_id-1.gif?cache_fotos=$cache_fotos]]> </src2>
				</imagen>
		";
		
	}else{
		print "
				<imagen>
					<src><![CDATA[0-0-0.jpg]]></src>
					<desc><![CDATA[Fotos No Disponibles]]></desc>
				</imagen>
		";
	}
}
else 
{
	while ($fila=mysql_fetch_array($result))
	{
		echo "		
			<imagen> 
					<src><![CDATA[".$fila[fo_enl]."?cache_fotos=$cache_fotos]]></src>
					<desc><![CDATA[".$fila[fo_desc]."]]></desc>
					<src2><![CDATA[http://www.inmoclick.com.ar/ftp_inmohost/fotos/".$fila[fo_enl]."?cache_fotos=$cache_fotos]]></src2>
			</imagen>";
	}
}
echo "
	</img>
</XML>";

?>
