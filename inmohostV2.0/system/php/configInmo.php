<?php

	$USR_INMO=mysql_result(mysql_query("select valor from parametros where nom_var='usr_inmo'"),0,0);
	$USR_WEBMAIL=mysql_result(mysql_query("select valor from parametros where nom_var='webmail'"),0,0);
	

	
	$cadena="select * from usuarios where usr_id=$USR_INMO";
	// datos de inmobiliara // armar por MySQL
	$result=mysql_query($cadena);
	$fila=mysql_fetch_array($result);
	
	
	define("_USR_ID",$USR_INMO);
	define("_USR_RAZ", $fila['usr_raz']);
	define("_USR_CIM",$fila['usr_cim']);
	define("_USR_DOM",$fila['usr_dom']);
	define("_USR_TEL",$fila['usr_tel']);
	define("_USR_CCPIM",$fila['usr_ccpim']);
	define("_USR_WWW",$fila['web']);
	define("_USR_MAIL",$fila['usr_mail']);
	define("_USR_WEBMAIL",$USR_WEBMAIL);
	define("_PORCENTAJE_MAPA",18);
	define("_PORCENTAJE_PRECIO",20);
	define("_PORCENTAJE_DESCRIPCION",10);
	define("_PORCENTAJE_UNA_FOTO",49);
	define("_PORCENTAJE_TRES_FOTOS",50);
	define("_PORCENTAJE_CINCO_FOTOS",51);
	define("_PORCENTAJE_SEIS_FOTOS",52);
	define("_LONGITUD_MINIMA_PRP_DESC",250);
	define("_PRECIO_INMUEBLES_COTI",600000);
	define("_PRECIO_VENTA_CASAS",50000);
	define("_PRECIO_ALQUILER_CASAS",500);
	define("_PRECIO_ALQUILER_CASAS",500);
	define("_VALOR_DOLAR_OFICIAL",14);
	
//	$_INMO_COLOR1 = "FF6600"; // sin numeral
//	$_INMO_COLOR2 = "000000"; // sin numeral
	
	$_EFECTO_1 = "Appear";
	$_EFECTO_2 = "BlindUp";

?>