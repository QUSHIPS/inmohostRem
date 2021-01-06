<?php

        extract ($_POST);
	extract ($_REQUEST);
	extract ($_GET);

        
        $usr_id_propiedad = $usr_id;       
	include("system/php/config.php");
	
	
	
	if (!isset($nocache)){
		$nocache = rand(0,1000);
	}
	
switch ($tip) {
    case "prp_foto":
        $url =  _FILE_XML_PRP_FOTOS."?prp_id=$prp_id&usr_id=$usr_id_propiedad&mod_edit=0&cache_fotos=$cache_fotos";
        break;
    case "banner_principal":
        $url =  _FILE_XML_BANNER_PRINCIPAL."?usr_id=$usr_id&cache_fotos=$cache_fotos";
        break;
    default:
        $url =  "";
		break;
}

//echo $url;
//note that this will not follow redirects

readfile($url);

?>