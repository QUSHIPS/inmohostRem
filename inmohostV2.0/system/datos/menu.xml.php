<?php 
header("Content-type: application/xml");
echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\" ?>";

	include("../php/config.php");
	
	// estado 1 ? 0 habilatdo o desabilato. si estado == 0 destino = ""
	// destino funcion javascript || (URL por javascript )
	// inicio solo una por cat (parece abierta por defecto) // revisar rodrigo en subCat
	
echo "
<XMLMENU>
      <contenido id='1' icono='interfaz/inmohost/images/iconos/32/inmueble.png' inicio='1'>
        <titulo><![CDATA[Inmuebles]]></titulo>
        <web_default>"._FILE_FORM_BUSCAR_PROPIEDADES_AV."?op=buscar</web_default>
		<items>
			<item id='1'  icono='interfaz/inmohost/images/iconos/32/buscar.png' estado='1' destino='traeURL(\""._FILE_FORM_BUSCAR_PROPIEDADES_AV."?op=buscar\", \"contenidoMenuActual1\")' inicio='1'>
				<![CDATA[Buscar]]>
			</item>
			<item id='2'  icono='interfaz/inmohost/images/iconos/32/agregar.png' estado='1' destino='ventana(\"prp_agregar\", \"&amp;mod_edit=1&amp;mod_tip=add&amp;win_prp=prp_modificar\", \""._FILE_PHP_PRP_FICHA_EDIT."\", \"Agregar un Inmueble\"); display(\"menuPrincipal\"); ' inicio='0'>
				<![CDATA[Agregar]]>
			</item>
			<item id='3'  icono='interfaz/inmohost/images/iconos/32/editar.png' estado='1' destino='traeURL(\""._FILE_FORM_BUSCAR_PROPIEDADES_AV."?op=modi\", \"contenidoMenuActual1\")' inicio='0'>
				<![CDATA[Modificar]]>
			</item>
			<item id='4'  icono='interfaz/inmohost/images/iconos/32/eliminar.png' estado='1' destino='traeURL(\""._FILE_FORM_BUSCAR_PROPIEDADES_AV."?op=del\", \"contenidoMenuActual1\")' inicio='0'>
				<![CDATA[Modificar Estado]]>
			</item>
			<!--item id='6'  icono='interfaz/inmohost/images/iconos/32/medios.png' estado='1' destino='traeURL(\""._FILE_FORM_PRP_MEDIOS."\", \"contenidoMenuActual1\");' inicio='0'>
				<![CDATA[Medios Publicitarios]]>
			</item-->
		</items>
      </contenido>
      <contenido id='2'  icono='interfaz/inmohost/images/iconos/32/archivo.png' inicio='0'>
        <titulo><![CDATA[Agenda]]></titulo>
         <web_default>"._FILE_FORM_AGENDA_CITAS."?usr_login=$usr_login&amp;usr_id="._USR_ID."</web_default>
		<items>
			<item id='1'  icono='interfaz/inmohost/images/iconos/32/novedades.png' estado='1' destino='traeURL(\""._FILE_FORM_AGENDA_NOVEDADES."?usr_login=$usr_login&amp;usr_id="._USR_ID."\", \"contenidoMenuActual2\")' inicio='0'>
				<![CDATA[Novedades]]>
			</item>
			<item id='2'  icono='interfaz/inmohost/images/iconos/32/citas.png' estado='1' destino='traeURL(\""._FILE_FORM_AGENDA_CITAS."?usr_login=$usr_login&amp;usr_id="._USR_ID."\", \"contenidoMenuActual2\")' inicio='0'>
				<![CDATA[Citas]]>
			</item>
			<item id='3'  icono='interfaz/inmohost/images/iconos/32/tasaciones.png' estado='1' destino='traeURL(\""._FILE_FORM_AGENDA_TASACIONES."?usr_login=$usr_login&amp;usr_id="._USR_ID."\", \"contenidoMenuActual2\")' inicio='0'>
				<![CDATA[Tasaciones]]>
			</item>
			<item id='4'  icono='interfaz/inmohost/images/iconos/32/demanda.png' estado='1' destino='traeURL(\""._FILE_FORM_AGENDA_DEMANDAS."?usr_login=$usr_login&amp;usr_id="._USR_ID."\", \"contenidoMenuActual2\")' inicio='0'>
				<![CDATA[Pedidos]]>
			</item>
			<item id='5'  icono='interfaz/inmohost/images/iconos/32/telefono.png' estado='1' destino='traeURL(\""._FILE_FORM_AGENDA_TELEFONOS."?usr_login=$usr_login&amp;usr_id="._USR_ID."\", \"contenidoMenuActual2\");' inicio='0'>
				<![CDATA[Telefonos]]>
			</item>
		</items>
      </contenido>
      <contenido id='3' icono='interfaz/inmohost/images/iconos/32/inmueble.png' inicio='0'>
        <titulo><![CDATA[Web]]></titulo>
         <web_default>"._FILE_FORM_WWW_PLANTILLAS."</web_default>
		<items>
			<item id='1'  icono='interfaz/inmohost/images/iconos/32/www.png' estado='1' destino='ventana(\"urlExterna\", \"\", \"http://"._USR_WWW."\", \""._USR_WWW."\"); display(\"menuPrincipal\");' inicio='0'>
				<![CDATA[Mi Pagina Web]]>
			</item>";
		
		if(strcmp(_USR_WEBMAIL,_USR_WWW."/mail")!=0){
			echo"
				<item id='2' icono='interfaz/inmohost/images/iconos/32/publicar.png' estado='1' destino='ventana(\"editor\",\"\", \"http://"._USR_WEBMAIL."\", \"Consultas\"); display(\"menuPrincipal\");' inicio='0'>
				<![CDATA[Revisar Correo]]>";
		}else {
			echo"
				<item id='2' icono='interfaz/inmohost/images/iconos/32/publicar.png' estado='1' destino='ventana(\"editor\", \"&amp;f_email=$MAIL_USR&amp;f_pass=$MAIL_PASS&amp;lng=es&amp;tem=default\", \"http://"._USR_WEBMAIL."/process.php\", \"Consultas\"); display(\"menuPrincipal\");' inicio='0'>
				<![CDATA[Revisar Correo]]>";
		}
				
		echo"
			</item>
			<item id='3'  icono='interfaz/inmohost/images/iconos/32/demanda.png' estado='1' destino='traeURL(\""._FILE_FORM_WWW_CONSULTAS."\", \"contenidoMenuActual3\")' inicio='0'>
				<![CDATA[Consultas de Inmoclick]]>
			</item>
			<item id='5'  icono='interfaz/inmohost/images/iconos/32/interfaz.png' estado='1' destino='traeURL(\""._FILE_FORM_WWW_VISITAS."\", \"contenidoMenuActual3\")' inicio='0'>
				<![CDATA[Informe Estadistico de Visitas]]>
			</item>
			<!--item id='5'  icono='interfaz/inmohost/images/iconos/32/configurar.png' estado='1' destino='traeURL(\""._FILE_FORM_WWW_CONF."\", \"contenidoMenuActual3\")' inicio='0'>
				<![CDATA[Configurar]]>
			</item>
			<item id='6'  icono='interfaz/inmohost/images/iconos/32/publicar.png' estado='1' destino='traeURL(\""._FILE_FORM_PUBLICAR_WWW."\", \"contenidoMenuActual3\")' inicio='0'>
				<![CDATA[Publicar en Internet]]>
			</item-->
		</items>
      </contenido>
      <contenido id='4' icono='interfaz/inmohost/images/iconos/32/informes.png' inicio='0'>
        <titulo><![CDATA[Informes]]></titulo>
        <web_default></web_default>
		<items>
			<item id='1'  icono='interfaz/inmohost/images/iconos/32/barrios.png' estado='1' destino='ventana(\"inf_listado\", \"&amp;fileXML="._FILE_XML_INF."&amp;fileXSL="._FILE_XSL_INF_PRP."&amp;tipo_inf=propiedades&amp;propiedades_personal=1\", \""._FILE_PHP_INF."\", \"Informe de Inmuebles\"); display(\"menuPrincipal\");' inicio='0'>
				<![CDATA[Inmuebles]]>
			</item>
			<item id='2'  icono='interfaz/inmohost/images/iconos/32/propietario.png' estado='1' destino='ventana(\"inf_listado\", \"&amp;fileXML="._FILE_XML_INF."&amp;fileXSL="._FILE_XSL_INF_PROP."&amp;tipo_inf=propietarios\", \""._FILE_PHP_INF."\", \"Informe de Propietarios\"); display(\"menuPrincipal\");' inicio='0'>
				<![CDATA[Propietarios]]>
			</item>
			<item id='3'  icono='interfaz/inmohost/images/iconos/32/citas.png' estado='1' destino='ventana(\"inf_listado\", \"&amp;fileXML="._FILE_XML_INF."&amp;fileXSL="._FILE_XSL_INF_CITAS."&amp;tipo_inf=citas\", \""._FILE_PHP_INF."\", \"Informe de Citas\"); display(\"menuPrincipal\");' inicio='0'>
				<![CDATA[Citas]]>
			</item>
			<item id='4'  icono='interfaz/inmohost/images/iconos/32/tasaciones.png' estado='1' destino='ventana(\"inf_listado\", \"&amp;fileXML="._FILE_XML_INF."&amp;fileXSL="._FILE_XSL_INF_TASA."&amp;tipo_inf=tasaciones\", \""._FILE_PHP_INF."\", \"Informe de Tasaciones\"); display(\"menuPrincipal\");' inicio='0'>
				<![CDATA[Tasaciones]]>
			</item>
			<item id='5'  icono='interfaz/inmohost/images/iconos/32/demanda.png' estado='1' destino='ventana(\"inf_listado\", \"&amp;fileXML="._FILE_XML_INF."&amp;fileXSL="._FILE_XSL_INF_DEMANDAS."&amp;tipo_inf=demandas\", \""._FILE_PHP_INF."\", \"Informe de Pedidos\"); display(\"menuPrincipal\");' inicio='0'>
				<![CDATA[Pedidos]]>
			</item>
			<item id='6'  icono='interfaz/inmohost/images/iconos/32/medios.png' estado='1' destino='ventana(\"inf_listado\", \"&amp;fileXML="._FILE_XML_INF."&amp;fileXSL="._FILE_XSL_INF_MEDIOS."&amp;tipo_inf=medios\", \""._FILE_PHP_INF."\", \"Informe de Publicaciones\"); display(\"menuPrincipal\");' inicio='0'>
				<![CDATA[Medios]]>
			</item>
			<item id='7'  icono='interfaz/inmohost/images/iconos/32/archivo.png' estado='1' destino='traeURL(\""._FILE_FORM_INF_VARIOS."?us_id=\"+_USR_ID, \"contenidoMenuActual4\");' inicio='0'>
				<![CDATA[Resumen]]>
			</item>
		</items>
      </contenido>
      <contenido id='5' icono='interfaz/inmohost/images/iconos/32/configurar.png' inicio='0'>
        <titulo><![CDATA[Control]]></titulo>
        <web_default>"._FILE_FORM_PANEL_INMO."</web_default>
		<items>
			<item id='1'  icono='interfaz/inmohost/images/iconos/32/inmueble.png' estado='1' destino='traeURL(\""._FILE_FORM_PANEL_INMO."\", \"contenidoMenuActual5\");' inicio='0'>
				<![CDATA[Inmobiliaria]]>
			</item>
			<item id='2'  icono='interfaz/inmohost/images/iconos/32/usuario.png' estado='1' destino='traeURL(\""._FILE_FORM_PANEL_USUARIOS."\", \"contenidoMenuActual5\");' inicio='0'>
				<![CDATA[Usuarios]]>
			</item>
			<!--item id='3'  icono='interfaz/inmohost/images/iconos/32/copiadeseguridad.png' estado='1' destino='traeURL(\""._FILE_FORM_PANEL_BACKUP."\", \"contenidoMenuActual5\");' inicio='0'>
				<![CDATA[Copia de Seguridad]]>
			</item-->
			<item id='4'  icono='interfaz/inmohost/images/iconos/32/vercitas.png' estado='1' destino='traeURL(\""._FILE_FORM_PANEL_INTERFAZ."\", \"contenidoMenuActual5\");' inicio='0'>
				<![CDATA[Interfaz]]>
			</item>
			
			<item id='6'  icono='interfaz/inmohost/images/iconos/32/barrios.png' estado='1' destino='traeURL(\""._FILE_FORM_PANEL_VARIOS."?usr_login=$usr_login&amp;usr_id="._USR_ID."\", \"contenidoMenuActual5\");' inicio='0'>
				<![CDATA[Varios]]>
			</item>
		</items>
      </contenido>
      <contenido id='6' icono='interfaz/inmohost/images/iconos/32/ayuda.png' inicio='0'>
        <titulo><![CDATA[Ayuda]]></titulo>
		<items>
			<item id='1'  icono='interfaz/inmohost/images/iconos/32/ayuda.png' estado='1' destino='ventana(\"url_ayuda\", \"\", \""._FILE_PDF_AYUDA."\", \"\"); display(\"menuPrincipal\");' inicio='0'>
				<![CDATA[Ayuda]]>
			</item>
			<item id='2'  icono='interfaz/inmohost/images/iconos/32/servicios.png' estado='1' destino='traeURL(\""._FILE_INFO_SERVICIO_TECNICO."\", \"contenidoMenuActual6\");' inicio='0'>
				<![CDATA[Soporte tecnico]]>
			</item>
			<item id='3'  icono='interfaz/inmohost/images/iconos/32/inmueble.png' estado='1' destino='' inicio='0'>
				<![CDATA[Acerca de Inmohost]]>
			</item>
		</items>
      </contenido>
</XMLMENU>";

?>