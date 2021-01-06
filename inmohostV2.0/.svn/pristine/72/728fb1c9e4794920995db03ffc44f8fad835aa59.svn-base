<?php 
header("Content-type: application/xml");
echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\" ?>";

	include("../php/conexion_inmoclick.php");
	
	$cadena="SELECT usuarios . * , localidades.loc_desc, provincias.pro_desc, count( prp_id ) AS cant
FROM usuarios
LEFT JOIN localidades ON ( usuarios.loc_id = localidades.loc_id )
LEFT JOIN provincias ON ( usuarios.pro_id = provincias.pro_id )
LEFT JOIN propiedades ON ( usuarios.usr_id = propiedades.usr_id )
LEFT JOIN redes_x_usuarios ON ( usuarios.usr_id = redes_x_usuarios.usr_id )
WHERE usuarios.web != ''
AND usuarios.visible =1
AND propiedades.prp_mostrar =1
AND redes_x_usuarios.red_id =1
AND usuarios.usr_tipo =2
GROUP BY usuarios.usr_id order by usuarios.fecha_act DESC
				    
				    ";
	$result=mysql_query($cadena);
	echo "
<inmodb>";
	while ($fila=mysql_fetch_array($result)) {
		$cad="select * from red_cim_sol ";		
	
		echo "
			<usuarios>
				<usr_red>0</usr_red>
		        <usr_id><![CDATA[$fila[usr_id]]]></usr_id>
		        <usr_raz><![CDATA[$fila[usr_raz]]]></usr_raz>
		        <usr_titular><![CDATA[$fila[titular]]]></usr_titular>
			<usr_logo><![CDATA[http://www.inmoclick.com.ar/inmohost/logos/logo_".$fila['usr_id'].".gif]]></usr_logo>
		        <loc_des><![CDATA[$fila[loc_desc]]]></loc_des>
		        <pro_des><![CDATA[$fila[pro_desc]]]></pro_des>
		        <pai_des><![CDATA[$fila[pai_desc]]]></pai_des>
		        <usr_dom><![CDATA[$fila[usr_dom]]]></usr_dom>
		        <usr_tel><![CDATA[$fila[usr_tel]]]></usr_tel>
		        <usr_web><![CDATA[$fila[web]]]></usr_web>
		        <usr_mail><![CDATA[$fila[usr_mail]]]></usr_mail>
		        <usr_cim><![CDATA[$fila[usr_cim]]]></usr_cim>
		        <cant_inm><![CDATA[$fila[cant]]]></cant_inm>
		        
		    </usuarios>
	";
		
	}
	    
   echo"	
</inmodb>";

?>