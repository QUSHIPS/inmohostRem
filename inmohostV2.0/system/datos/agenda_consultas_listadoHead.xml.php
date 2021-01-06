<?php
header("Content-type: application/xml");

	extract ($_GET);
	extract ($_REQUEST);

	include("../php/config.php");
echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\" ?>";
echo '
<inmodb>
		<cabezera>

                        <head id="consulta_id" tamano="2" link=""><![CDATA[Nro Int.]]></head>
			<head id="prp_id" tamano="5" link=""><![CDATA[ID propiedad]]></head>
                        <head id="tipo_consulta_detalle" tamano="5" link=""><![CDATA[Tipo]]></head>
			<head id="consulta_nombre" tamano="5" link=""><![CDATA[Nombre]]></head>
			<head id="consulta_telefono" tamano="5" link=""><![CDATA[Telefono]]></head>
                        <head id="consulta_email" tamano="5" link=""><![CDATA[Email]]></head>
			<head id="consulta_mensaje" tamano="20" link=""><![CDATA[Mensaje]]></head>
			<head id="consulta_fecha" tamano="5" link=""><![CDATA[Fecha]]></head>
			<head id="consulta_email_destino" tamano="5" link=""><![CDATA[Email Destino]]></head>
			<head id="consulta_leida" tamano="5" link=""><![CDATA[Leida]]></head>

		</cabezera>
</inmodb>';

?>