<?php
header("Content-type: application/xml");

	extract ($_GET);
	extract ($_REQUEST);

	include("../php/config.php");
echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\" ?>";
echo '
<inmodb>
		<cabezera>
			<head id="prp_id" tamano="5" link=""><![CDATA[ID propiedad]]></head>
                        <head id="fotos" tamano="5" link=""><![CDATA[Nro Fotos]]></head>
			<head id="prp_dom" tamano="20" link=""><![CDATA[Domicilio]]></head>
			<head id="tip_desc" tamano="5" link=""><![CDATA[tip_desc]]></head>
			<head id="con_desc" tamano="5" link=""><![CDATA[con_desc]]></head>
			<head id="prp_mod" tamano="5" link=""><![CDATA[Modificada]]></head>
                        <head id="visitas" tamano="5" link=""><![CDATA[Visitas]]></head>
			<head id="sol_inf" tamano="5" link=""><![CDATA[Sol Informacion]]></head>
			<head id="sol_fot" tamano="5" link=""><![CDATA[Interesados]]></head>
			<head id="prp_mostrar" tamano="5" link=""><![CDATA[Estado]]></head>
		</cabezera>
</inmodb>';

?>